<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Storage;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function index(){

    return view('home');

}

   public function read(){
       
  
   $path = storage_path('app/json/imageGallery.json');
  
     $data  = file_get_contents($path);
    
     $data = json_decode($data, true);

     return $data;
    
 }

   public function add(Request $request){

 $v = $request->validate([
         'image'  => 'required|mimes:png|max:5000',
       ]);
    if (!$v) {
       return response()->json(array('status' =>404, 'message' =>'This Seystem Allow Onle PNG File')); 
    }
    

 $date=  date('Y-m-d H:i:s');


 $path = storage_path('app/json/imageGallery.json');
  
     $data  = file_get_contents($path);
     
     $data = json_decode($data, true);

// Get IDs list
//$idsList = array_column($data, 'id');
// Get unique id
//$auto_id = max($idsList) + 1;
  $id = Str::random(9);


     $image_title =$request->image_title;
     $image=$request->file('image');

     if($image) {
      $image_name=Str::random(20);
      $ext=strtolower($image->getClientOriginalExtension());
      $image_full_name=$image_name.'.'.$ext;
      $upload_path='public/upload/';
      $image_path='upload/';
      $image_url=$image_path.$image_full_name;
      $success=$image->move($upload_path,$image_full_name);
      if ($success) {

       $path = storage_path('app/json/imageGallery.json');
             $current_data = file_get_contents($path);  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'id'             => $id,  
                     'image_title'    => $image_title,  
                     'image'          => $image_url,
                     'c_date'         => $date
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                if(file_put_contents($path, $final_data))  
                {  
                return response()->json(array('status' =>1, 'message' =>'Upload Completed'), 200); 
                }  
               }  
            else  
             {  
                return response()->json(array('status' =>404, 'message' =>'This Seystem Allow Onle PNG File'), 200); 
            }  



   }

}


//delete
   
 public function delete(Request $request){
 
   $r = $request->delete;


  $image_d = public_path().'/'.$r;

  $dd= unlink($image_d);
  if ($dd) {
       
$path = storage_path('app/json/imageGallery.json');
  
     $data  = file_get_contents($path);
     
     $posts = json_decode($data);

       
       foreach ($posts as $i => $post) 
    {
        if ($post->image == $r) 
        {
            unset ($posts[$i]);
            $save = json_encode(array_values($posts), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents($path, $save);
            break;
        }
    }
 return response()->json(array('status' =>1, 'message' =>'delete success'), 200); 

 }


}


//end class
 }     




