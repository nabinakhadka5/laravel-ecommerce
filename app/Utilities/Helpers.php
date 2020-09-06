<?php


function getHeader(){
    $category =  New \App\Models\Category();
    $category = $category->with('child_cats')->where('parent_id', null)->where('status','active')->orderBy('title','ASC')->get();
    if($category){
        echo "<li>";
        echo '<a href="javascript:;" class="dropbtn">Category</a>';
        echo '<ul class="dropdown">';
        foreach ($category as $cat_info) {
            if($cat_info->child_cats->count()>0) {
                echo '<li style="width:250px;"><a href="#">'.$cat_info->title.'</a>';
                echo '<ul class="dropdown-subcontent">';
                foreach($cat_info->child_cats as $child_category){
                    echo '<li><a href="'.route('sub_cat_detail',[$cat_info->slug,$child_category->slug]).'">'.$child_category->title.'</a></li>';
                }
                echo "</ul>";
                echo "</li>";
            } else {
                echo '<li style= "width:250px;"><a href="'.route('cat-detail',$cat_info->slug).'">'.$cat_info->title.'</a></li>';
            }
        }
        echo "</ul>";
        echo "</li>";
    }
}
function deleteImage($image, $dir){
    if($image){
        $path = public_path().'/uploads/'.$dir;
        if($image != null && file_exists($path.'/'.$image)){
            unlink($path.'/'.$image);
            if(file_exists($path.'/'.'/Thumb-'.$image)){
                unlink($path.'/Thumb-'.$image);
            }
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}



function imageUrl($image,$dir){

    if($image != null && file_exists(public_path().'/uploads/'.$dir.'/Thumb-'.$image)){
        $url = asset('uploads/'.$dir.'/Thumb-'.$image);
    } else if($image != null && file_exists(public_path().'/uploads/'.$dir.'/'.$image)){
        $url = asset('uploads/'.$dir.'/'.$image);
    } else {
        $url = null;
    }
    return $url;

}



function uploadImage($file, $dir,$thumb=null){ //obj,string,200x200
    $path = public_path().'/uploads/'.$dir;  //public/uploads/slider
    if(!File::exists($path)){
        File::makeDirectory($path,0777,true,true); //folder create
    }
    //Slider
    $file_name = ucfirst($dir)."-".date("Ymdhis").rand(0,999).".".$file->getClientOriginalExtension();

    $status = $file->move($path,$file_name);
    if($status){
        if($thumb){
            list($width,$height) = explode('x',$thumb);
            Image::make($path."/".$file_name)->resize($width, $height, function($constraints){
                return $constraints->aspectRatio();
                })->save($path.'/Thumb-'.$file_name);
        }
        return $file_name;

    } else {
        return false;
    }
}