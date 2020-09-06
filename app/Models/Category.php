<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;

class Category extends Model

{

    public function parent_info(){
        return $this->hasOne('App\Models\Category','id','parent_id');
    }

    public function child_cats(){
        return $this->hasMany('App\Models\Category','parent_id','id');
    }


    public function getAllChildren($cat_id){
        return $this->where('parent_id',$cat_id)->pluck('title','id');
    }


    public function getAllParents(){
        return $this->where('parent_id',NULL)->orderBy('title','ASC')->pluck('title','id');

    }

    public function getSlug($str){
        $slug =  Str::slug($str);
        if($this->where('slug',$slug)->count()>0){
            $slug .=date('Ymdhis').rand(0,999);
        }
        return $slug;

    }

    protected $fillable = ['title','slug','summary','image','status','parent_id','added_by'];


    public function getRules($act = 'add'){
        $rules = array(
        'title' => 'required|string|unique:categories,title',
        'summary' => 'nullable|string',
        'image' => 'sometimes',
        'status' => 'required|in:active,inactive',
        'parent_id' => 'nullable|exists:categories,id'
        );
        if($act == 'update'){
            $rules['title'] = 'required|string';
        }
        return $rules;
    }
}
