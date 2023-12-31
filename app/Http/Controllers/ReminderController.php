<?php

namespace App\Http\Controllers;
use App\Helper\RequestHelper;
use App\Mail\NotifyEmail;
use App\Models\Company;
use App\Models\Policy;
use App\Models\ReminderModel;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function viewCustomEvents()
    {
        $user = Auth::user();
        $events = ReminderModel::where(['user_id'=>$user['id']])->orderBy('id','DESC')->get();
        $policies = Policy::orderBy('id','DESC')->get();
        $vehicles = Vehicle::orderBy('id','DESC')->get();
        return view('pages.reminder.custom-events', [
            'user' => $user,
            'events'=>$events,
            'policies'=>$policies,
            'vehicles'=>$vehicles
        ]);
    }

    public function viewSetting()
    {
        $user = Auth::user();
        return view('pages.reminder.setting', [
            'user' => $user,
        ]);
    }
    /*
     * send reminders base on policies linked with companies create by each users
     */
    function policyCronJob(){
        $query = DB::table('policies')
            ->join('companies','policies.identification_card','=','companies.id')
            ->join('company_emails','companies.id','=','company_emails.company_id')
            ->join('users','companies.created_by_user_id','=','users.id')
            ->select(
                'policies.id as policy_id',
                'policies.number',
                'policies.insured_name',
                'policies.policy_issuance',
                'policies.policy_expiration',
                'companies.name',
                'companies.dv',
                'companies.district',
                'companies.corregimiento',
                'companies.street',
                'companies.house_number',
                'company_emails.email',
                'users.name as user_name',
                'users.email as user_email',
                'users.enable_reminders',
                'users.notify_before'
            )
            ->get();
        if(count($query)>0){
            
            foreach ($query as $l=>$v){
                // check if user enabled reminders
                if($v->enable_reminders==1){
                    $days_before = $v->notify_before;
                    $days_before = $days_before+1;
                    $date = new \DateTime($v->policy_expiration);
                    $date->modify("-$days_before day");
                    $notify_date = strtotime($date->format("Y-m-d H:i:s"));

                    $today = strtotime(date('Y-m-d H:i:s'));

                    if(($today>=$notify_date) && ($today<strtotime($v->policy_expiration)) ){
                        $mailData = [
                            'title' => 'Recordatorio de vencimiento de póliza',
                            'body' => view('emails.policy_mail',['policy_number'=>$v->number,'policy_expire'=>$v->policy_expiration])->render()
                        ];
                        RequestHelper::send_mail($v->user_name,$v->email,'Admin',env('MAIL_FROM_ADDRESS'),$mailData['title'],$mailData['body']);
                    
                    }
                }
            }
        }
    }
    /*
     * event cron job
     */
    function eventCronJob(){
        $query = ReminderModel::with('user')->get();
        if(!is_null($query)){
            
            foreach ($query as $l=>$v) {
                if ($v->user['enable_reminders'] == 1) {
                    $user = $v->user;
                    $days_before = $user['notify_before'];
                    $days_before = $days_before + 1;
                    $date = new \DateTime($v->start);
                    $date->modify("-$days_before day");
                    $notify_date = strtotime($date->format("Y-m-d H:i:s"));

                    $today = strtotime(date('Y-m-d H:i:s'));
                    if (($today >= $notify_date) && ($today<strtotime($v->start))) {
                        $mailData = [
                            'title' => $v->title,
                            'body' => view('emails.event_mail',['location'=>$v->location,'description'=>$v->description])->render()
                        ];
                        RequestHelper::send_mail($user['name'],$user['email'],'Admin',env('MAIL_FROM_ADDRESS'),$mailData['title'],$mailData['body']);
                    }
                }
            }
        }
    }
    /*
     * plates status cron job
     */
    function plateStatusCronJob(){
        $currrent_month  = (int)date('m');
        $query  =Company::with(['createdByUserId','emails'])->get();

        if(count($query)>0){
            foreach ($query as $l=>$v){
                $createBy = $v->createdByUserId;
                $emails = $v->emails->first();
                $vehicles = Vehicle::where(['company_id'=>$v['id']])->get()->toArray();
                // check if user enabled reminders
                if(count($vehicles)>0){
                   $current_status = "vigente";
                   if($vehicles['month_renewal']==$currrent_month){
                       $currrent_status = "por vencer";
                   }
                   if($vehicles['month_renewal']>$currrent_month){
                       $current_status = "vencido";
                   }
                   Vehicle::updateOrCreate([
                       'id'=>$vehicles['id']
                   ],[
                       'status'=>$current_status
                   ]);
                }
            }
        }
    }
    /*
     * plates cron job
     */
    function plateCronJob(){
        $currrent_month  = (int)date('m');
        $query  =Company::with(['createdByUserId','emails'])->get();

        if(count($query)>0){
            foreach ($query as $l=>$v){
                $createBy = $v->createdByUserId;
                $emails = $v->emails->first();
                $vehicles = Vehicle::where(['month_renewal'=>$currrent_month,'company_id'=>$v['id']])->get()->toArray();
                // check if user enabled reminders
                if(($createBy['enable_reminders']==1) && count($vehicles)>0){
                    $ht = "";
                    foreach ($vehicles as $vehicle) {
                        $ht .= "PLACA (".$vehicle['car_plate'].")";
                        $ht .="<br>";
                    }
                    $view = view('emails.plate_mail',[
                        'plate_month'=>date('F'),
                        'plates'=>$ht
                    ])->render();
                    $mailData = [
                        'title' => 'RECORDATORIO DE RENOVACIÓN DE PLACA',
                        'body' => $view
                    ];
                    RequestHelper::send_mail($v->name,$emails['email'],'Admin',env('MAIL_FROM_ADDRESS'),$mailData['title'],$mailData['body']);
                }
            }
        }
    }
    /*
     * post events
     */
    function postCustomEvents(Request $request){
        $valid = validator()->make($request->input(),[
            'title'=>'required',
            'start'=>'required',
            'end'=>'required',
            ],
            [
                'title.required'=>'Event title is required',
                'start.required'=>'Event start date is required',
                'end.required'=>'Event end date is required'
            ]);
        if($valid->fails()){
            $ht = '';
            $errors = $valid->errors()->all();
            foreach ($errors as $k => $v) {
                $ht .= $v;
                if ($k < count($errors) - 1) {
                    $ht .= '<br>';
                }
            }
            \session()->flash('error',$ht);
            return redirect()->back();
        }else{
            $user = \auth()->user();
            $d = $request->except(['_token']);
            $d['start']  = $d['start'].' '.$d['start_time'];
            $d['end']  = $d['end'].' '.$d['end_time'];
            unset($d['start_time']);
            unset($d['end_time']);
            $d['start'] = date('Y-m-d H:i',strtotime($d['start']));
            $d['end'] = date('Y-m-d H:i',strtotime($d['end']));
            $d['user_id'] = $user['id'];
            if(array_key_exists('id',$d)){
                $model = ReminderModel::find($d['id']);
                unset($d['id']);
                if(!is_null($model)){
                    foreach ($d as $l=>$h){
                        $model->$l = $h;
                    }
                    $model->save();
                }
                \session()->flash('status','Reminder event is update');
                return redirect()->to(route('customEvents'));
            }else {
                ReminderModel::create($d);
                \session()->flash('status','Reminder event is created');
               return redirect()->to(route('customEvents'));
            }
        }
    }
    /*
     * delete custom events
     */
    function deleteCustomEvent(Request $request){
        if($request->input('data')>0){
            $model = ReminderModel::where([
                'id'=>$request->input('data'),
                'user_id'=>\auth()->id()
            ])->delete();
            return response()->json(['status'=>true,'msg'=>'Reminder event is deleted']);
        }
    }
    /*
     * get edit view of events
     */
    function editEvents(Request $request,$id){
        $event = ReminderModel::find($id);
        $user = Auth::user();
        $companies = Company::get();
        return view('pages.reminder.edit_event',compact('user','companies','event'));
    }
    /*
     * create reminder
     */
    function create(Request $request){
        $user = Auth::user();
        $companies = Company::get();
        return view('pages.reminder.create',compact('user','companies'));
    }
}
