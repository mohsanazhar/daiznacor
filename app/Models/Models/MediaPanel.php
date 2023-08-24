<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use function Ramsey\Uuid\Generator\timestamp;
use Spatie\PdfToImage\Pdf;

class MediaPanel extends Model
{
    protected $mediaurl;
    public $mediadir;
    public $allowedmedia;
    public function __construct(){
        parent::__construct();
        $this->mediaurl = url('/')."/images/";
        $this->mediadir = "storage/image/";
        $this->allowedmedia = "jpg|jpeg|gif|png|pdf";
    }
    static public function insertMedia(){
        $data = array("mediaurl"=>url('/')."/images/", "mediadir"=>"storage/image",
            "allowedmedia"=>"jpg|jpeg|gif|png|pdf");
        return view("mediaPanel.insertMedia", $data);
    }
    static public function _getFolders(){
        $rows = CategoryModel::where(["type"=>"folder", "parent"=>0])->get();
        echo "<option value='0'>None</option>";
        if(count($rows)>0) {
            foreach ($rows as $k => $v) {
                echo "<option value='$v->id'>$v->name</option>";

            }
        }
    }
    static public function _get_images(){
        $allowed = explode("|","jpg|jpeg|pdf|png");
        $page = (\request()->has('page')) ? \request()->input('page'): 1;
        $folder = (\request()->has('f')) ? \request()->input('f'): "";
        $folder = ($folder!="") ? $folder : "";
        $page = ($page==1)? 0 : ($page - 1)  * 20;

        $rows = MediaModel::where(['post_by'=>'admin','user_id'=>auth()->id()])->orderBy('id','DESC')->limit(20,$page)->get();
        if (count($rows) == 0){
            echo "No More Image";
        }
        foreach($rows as $k=>$v){

            $exp=explode(".", $v->media);
            $file_type="image";
            $info = explode(".",$v->media);
            $file_ext = strtolower(end($info));
            
            if (in_array($file_ext, $allowed)){
                $f = explode(".",$v->media);
                $file_name = str_replace(".".end($f),"", $v->media);
                $name = str_replace(".".end($f),"", $v->media);
                $name = str_replace("-", " ",$name);
                $name = str_replace("_", " ",$name);
                $name = str_replace("thumb","",$name);
                $name = ucwords($name);
                if (file_exists(base_path('/public_html'."/".$v->media))){
                    $size = filesize(base_path('/public_html'."/".$v->media));
                    $date = filemtime(base_path('/public_html'."/".$v->media));
                    if ($file_type=="image"){
                        $pt = base_path('/public_html'."/".$v->media);
                        if (file_exists($pt)){
                            list($width, $height) = getimagesize($pt);
                            $dimension = "$width x $height";
                        }else{
                            $dimension = "100 x 100";
                        }

                    }
                    $thumbnail = url('/')."/"."$file_name".".".$file_ext;
                    $full_image = url('/')."/"."$file_name".".".$file_ext;
                    if($file_ext!="pdf") {
                        echo "
						<li>
							<img src='" . $full_image . "'  data-file='$full_image' data-ext='$file_ext'
							 data-size='$size' data-dimension='$dimension' data-date='$date' data-type='$file_ext'
							 data-name='$name' class='m-ins-image' data-id='$v->id'>
						</li>
					";
                    }
                }
            }
        }
    }
    // getting sub folders
    static public  function _get_sub_folder($parent){
        $sub_folders = CategoryModel::where(['parent'=>$parent,'type'=>'folder'])->get();
        return $sub_folders;
    }
    static public function _createFolder(){
        $d = \request()->input();
        $folder_name = $d['t'];
        $type = $d["s"];
        $parent=$d['parent'];
        $data = array(
            "type" => "folder",
            "name" => $folder_name,
            'user_id'=>auth()->id(),
        );
        if ($type=="new"){
            $data['parent'] = 0;
            $modal = new CategoryModel();
            $modal->fill($data);
            $modal->save();
        }else{

            $data['parent']=(!is_null($parent))?0:$parent;
            $category = CategoryModel::where(['name'=>$type])->first()->toArray();
            $modal = CategoryModel::find($category['id']);
            $modal->name = $data['name'];
            $modal->parent = $data['parent'];
            $modal->update();
            //$this->db->update("category", $data, "name='$type'");
        }

        $r = CategoryModel::where(['type'=>'folder','parent'=>0])->orderBy('name','ASC')->get();
        foreach ($r as $k=>$row){
            echo "
				<li>
					".$row->name."
					<div class='action'>
						<a data-title='".$row->name."' data-parent='".$row->parent."' class='edit-folder'>Edit</a>
						<a data-title='".$row->name."' data-parent='".$row->parent."' class='del-folder'>x</a>
					</div>
					<div class='m-clear'></div>
				</li>
			";
            $sfolder=  CategoryModel::where(['type'=>'folder','parent'=>$row->id])->orderBy('name','ASC')->get();
            if(count($sfolder)>0){
                foreach($sfolder as $s=>$sf){
                    echo "
                                    <li>
                                                -".$sf->name."
                                                <div class='action'>
                                                        <a data-title='".$sf->name."' data-parent='".$sf->parent."' class='edit-folder'>Edit</a>
                                                        <a data-title='".$sf->name."' data-parent='".$sf->parent."' class='del-folder'>x</a>
                                                </div>
                                                <div class='m-clear'></div>
                                        </li>
                                ";
                }
            }
        }
    }

    /*
        Media Manager
    */

    static public function _upload_mediamanager(){
        $d = \request()->all();
        $file = $d['file'];
        if(\request()->file('file')->getSize()){
            $orginal_name = \request()->file('file')->getClientOriginalName();
            $temp = explode(".", $orginal_name);
            $name = round(microtime(true));
            $newfilename =  $name. '.' . end($temp);
            $destinationPath = 'storage/image';
            \request()->file('file')->move($destinationPath,$newfilename);
            if(end($temp)=="pdf") {
               
                    $pdf = new Pdf(base_path('/public_html/'.$destinationPath."/".$newfilename));
                    $pdf->setOutputFormat('jpeg')
                        ->setPage(1)
                        ->setResolution(100)
                        ->saveImage(base_path('public_html/storage/image/'.$name.'.png')); 
            }
            $data = array(
                "folder" => $d['folder'],
                "media" => $destinationPath."/".$name.".png",
                'name'=>$name,
                "post_by" => "admin",
                'user_id'=>auth()->id()
            );
            $modal = new MediaModel();
            $modal->fill($data);
            $modal->save();
            $ht =  (new MediaPanel())->_get_images();
            return $ht;
        }
    }
    static public  function _delMedia(){
        $image_id = \request()->input('t');
        $row = MediaModel::find($image_id);
        if (!is_null($row)){
            $image  = $row['media'];
            $exp = explode(".",$image);
            $ext = end($exp);
            $file_name = str_replace(".$ext", "", $image);
            $full = public_path('/')."$file_name".".$ext";
//			if (file_exists($thumb)){
//				unlink($thumb);
//			}
//			if (file_exists($mid)){
//				unlink($mid);
//			}
			if (file_exists($full)){
				unlink($full);
			}
           $row->delete();
        }
    }
}

