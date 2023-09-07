<?php

namespace App\Helper;

use App\Models\MediaModel;
use App\Models\Vehicle;
use App\Models\VehiclePaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestHelper
{
    public static function months(){
        $months = [
            1 => "Enero",
            2 => "Febrero",
            3 => "Marzo",
            4 => "Abril",
            5 => "Mayo",
            6 => "Junio",
            7 => "Julio",
            8 => "Agosto",
            9 => "Septiembre",
            10 => "Octubre",
            11 => "Noviembre",
            12 => "Diciembre",
        ];
        return $months;
    }
    public static function uploadImage(Request $request, $input = 'image', $category = 'company')
    {

        if (!$request->hasFile($input)) return null;

        $randomize = rand(111111, 999999);
        $extension = $request->file($input)->getClientOriginalExtension();
        $filename = $randomize . '.' . $extension;

        $path = "storage/image/$category/";

        $image = $request->file($input)->move($path, $filename);

        return $image;
    }

    public static function getMediaFile($name)
    {
        $output = ['is' => false, 'name' => ''];
        if (trim($name) != "") {
            $name = str_replace(url('/') . '/', "", $name);
            $expl = explode("/",$name);
            $name = end($expl);
            $expl = explode('.',$name);
            $name = str_replace(".".end($expl),"",$name);

            $media = MediaModel::where(['name' => $name])->get()->first();
            if (!is_null($media)) {

                if (file_exists(base_path('/public_html/storage/').$media['folder'] . "/" . $name . ".pdf")) {
                    $output = ['is' => true, 'name' => url('/') . '/storage/'.$media['folder'].'/' . $name . '.pdf'];
                }
            }
        }
        return $output;
    }

    public static function slug_maker($s = '')
    {
        $r = '';
        if ($s == '') {
            $r = 0;
        } else {
            $c = array(" , ", ' ( ', ' ) ', ' $ ', ' & ', ' @ ', ' # ', ' % ', ' ^ ', ' * ', ' / ', ' + ', ' ~ ', ' ! ', ' ` ', ',', '(', ')', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', ' _ ', '', ' ', '/', ' (', ' )');
            $len = strlen($s);
            for ($n = 0; $n < $len; $n++) {
                if (in_array($s[$n], $c)) {
                    $r = str_replace($c, '-', strtolower($s));
                }
            }
        }
        if ($r == '') {
            $r = strtolower($s);
        }
        return $r;
    }
    /*
     * function to get link vehicle with media file
     */
    public static function getLinkedVehicle($s ='',$is_unique=true){
        $r = 0;
        $user = auth()->user();
        if(trim($s)!=""){
            $query = VehiclePaper::with(['vehicle','owner'])
                ->orWhere('record','like',"%".$s."%")
                ->orWhere('reviewed','like',"%".$s."%")
                ->orWhere('policy','like',"%".$s."%")
                ->orWhere('weight-dimension','like',"%".$s."%")
                ->orWhere('payment-receipt','like',"%".$s."%")
                ->orWhere('scanned-sticker','like',"%".$s."%")
                ->orWhere('photos-01','like',"%".$s."%")
                ->orWhere('photos-02','like',"%".$s."%")
                ->orWhere('photos-03','like',"%".$s."%")
                ->orWhere('photos-04','like',"%".$s."%")
                ->orderBy('id','DESC')
                ->get();
            if($is_unique){
                $query = $query->collect()->unique('vehicle_id');
            }else{
                return $query;
            }
            if(!is_null($query)){
                $ht = "";

                if(count($query)>0){
                    foreach ($query as $k=>$v){
                        if(!is_null($v['vehicle'])){
                            $ht .="<a href='".route('createGloveBox',['id'=>$v['vehicle_id']])."'>".$v['vehicle']['name']."</a><br>";
                        }
                    }
                }
                return $ht;
            }else{
               return "";
            }
        }else{
            return "";
        }
    }
    public static function getEloquentSqlWithBindings($query)
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            return is_numeric($binding) ? $binding : "'{$binding}'";
        })->toArray());
    }
    public static  function send_mail($to_label,$to_mail,$from_label,$from_mail,$subject,$message){
        require_once "PHPMailer/PHPMailerAutoload.php";
        $mail = new \PHPMailer();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = env('MAIL_HOST');
        $mail->Port = env('MAIL_PORT');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->setFrom($from_mail, $from_label);
        $mail->addReplyTo($from_mail, $from_label);
        $mail->addAddress($to_mail, $to_label);
        $mail->Subject =  ($subject=="")?'Here is the subject':$subject;
        $message = ($message=="")?'This is the HTML message body <b>in bold!</b>':$message;
        $mail->msgHTML($message);
        //dd($mail->send());
        if (!$mail->send()) {
          //return true;
        } else {
           // echo "true";
        }
    }

}
