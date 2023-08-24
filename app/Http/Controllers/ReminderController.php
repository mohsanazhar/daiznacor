<?php

namespace App\Http\Controllers;
use App\Helper\RequestHelper;
use App\Mail\NotifyEmail;
use App\Models\Policy;
use App\Models\ReminderModel;
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
        return view('pages.reminder.custom-events', [
            'user' => $user,
            'events'=>$events
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

                    if(($today>=$notify_date) /*&& ($today<strtotime($v->policy_expiration))*/ ){
                        $mailData = [
                            'title' => 'Recordatorio de vencimiento de póliza',
                            'body' => 'La póliza número #('.$v->number.') vence el día "('.$v->policy_expiration.')'
                        ];
                        // To send HTML mail, the Content-type header must be set
                        $headers[] ='MIME-Version: 1.0';
                        $headers[] = 'From: '.env('MAIL_FROM_NAME').' <'.env('MAIL_FROM_ADDRESS').'>';
                        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

                        /*$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
                        $headers[] = 'From: Birthday Reminder <birthday@example.com>';
                        $headers[] = 'Cc: birthdayarchive@example.com';
                        $headers[] = 'Bcc: birthdaycheck@example.com';*/
                        //\mail($v->email, $mailData['title'], $mailData['body'], implode("\r\n", $headers));
                        info("Policy Email:".$v->email.'<br>');
                         $mail = RequestHelper::mail_set();
                        RequestHelper::send_mail($mail,$v->user_name,$v->email,'Admin',env('MAIL_FROM_ADDRESS'),$mailData['title'],$mailData['body']);
                    
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
                    if (($today >= $notify_date)/* && ($today<strtotime($v->start))*/) {
                        $mailData = [
                            'title' => $v->title,
                            'body' => "Event Location:".$v->location.'<br>Event Description:'.$v->description
                        ];
                        // To send HTML mail, the Content-type header must be set
                        $headers[] = 'MIME-Version: 1.0';
                       $headers[] = 'From: '.env('MAIL_FROM_NAME').' <'.env('MAIL_FROM_ADDRESS').'>';
                        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

                        /*$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
                        $headers[] = 'From: Birthday Reminder <birthday@example.com>';
                        $headers[] = 'Cc: birthdayarchive@example.com';
                        $headers[] = 'Bcc: birthdaycheck@example.com';*/
                        //\mail($user['email'], $mailData['title'], $mailData['body'], implode("\r\n", $headers));
                        //Mail::to($user['email'])->send(new NotifyEmail($mailData));
                        $mail = RequestHelper::mail_set();
                        RequestHelper::send_mail($mail,$user['name'],$user['email'],'Admin',env('MAIL_FROM_ADDRESS'),$mailData['title'],$mailData['body']);
                        info("Event Email:".$user['email'].'<br>');
                    }
                }
            }
        }
    }
    /*
     * plates cron job
     */
    function plateCronJob(){
        $currrent_month  = date('m');
        $query = DB::table('vehicles')
            ->join('policies','vehicles.policy_id','=','policies.id')
            ->join('companies','vehicles.company_id','=','companies.id')
            ->join('company_emails','companies.id','=','company_emails.company_id')
            ->join('users','companies.created_by_user_id','=','users.id')
            ->select(
                'vehicles.id as vehicle_id',
                'vehicles.name as vehicle_name',
                'vehicles.car_plate',
                'vehicles.month_renewal',
                'vehicles.brand',
                'vehicles.model',
                'vehicles.year',
                'vehicles.engine',
                'vehicles.color',
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
            ->where('vehicles.month_renewal',$currrent_month)
            ->get();
        if(count($query)>0){
            //dd($query);
            foreach ($query as $l=>$v){
                // check if user enabled reminders
                if($v->enable_reminders==1){
                    $view = view('emails.policy_mail',[
                        'policy_number'=>$v->number,
                        'policy_expire'=>$v->policy_expiration
                    ])->render();
                    $mailData = [
                        'title' => 'Recordatorio de vencimiento de póliza',
                        'body' => $view
                    ];
                    // To send HTML mail, the Content-type header must be set
                    $headers[] ='MIME-Version: 1.0';
                    $headers[] ='From: Your name <info@address.com>';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

                    /*$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
                    $headers[] = 'From: Birthday Reminder <birthday@example.com>';
                    $headers[] = 'Cc: birthdayarchive@example.com';
                    $headers[] = 'Bcc: birthdaycheck@example.com';*/
                    //\mail($v->email, $mailData['title'], $mailData['body'], implode("\r\n", $headers));
                   // Mail::to($v->email)->send(new NotifyEmail($mailData));
                }
            }
        }
    }
    /*
     * post events
     */
    function postCustomEvents(Request $request){
        $valid = validator()->make($request->input('data'),[
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
            return response()->json(['status'=>false,'msg'=>$ht]);
        }else{
            $user = \auth()->user();
            $d = $request->input('data');
            $d['start'] = date('Y-m-d H:i',strtotime($d['start']));
            $d['end'] = date('Y-m-d H:i',strtotime($d['end']));
            $d['user_id'] = $user['id'];
            if(array_key_exists('id',$d)){
                $model = ReminderModel::find($d['id']);
                unset($d['id']);
                foreach ($d as $l=>$h){
                    $model->$l = $h;
                }
                $model->save();
                return response()->json(['status'=>true,'msg'=>'Reminder event is update']);
            }else {
                ReminderModel::create($d);
                return response()->json(['status'=>true,'msg'=>'Reminder event is created']);
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
}
