<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;

class Product extends Model
{

    protected $fillable = ['title','slug','summary','description','cat_id','sub_cat_id','price','discount','actual_price','brand','status','is_featured','image','related_image','seller_id','added_by'];

    public function getSlug($str){
        $slug = Str::slug($str);
        if($this->where('slug',$slug)->count()>0){
            $slug .=date('Ymdhis').rand(0,999);
        }
        return $slug;

    }

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }


    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','sub_cat_id');
    }


    public function seller_info(){
        return $this->hasOne('App\User','id','seller_id');
    }


    public function images(){
        return $this->hasMany('App\Models\ProductImage','product_id','id');
    }


    public function getRules($act = 'add'){
        $rules = array(
          'title' => 'required|string',
          'summary' => 'required|string',
          'description' => 'nullable|string',
          'price' => 'required|numeric|min:100',
          'discount' => 'nullable|numeric|min:0|max:90',
          'cat_id' => 'required|exists:categories,id',
          'sub_cat_id' => 'nullable|exists:categories,id',
          'is_featured' => 'sometimes|in:1',
          'seller_id' => 'nullable|exists:users,id',
          'image' => 'required',
          'related_image' => 'sometimes',
          'brand' => 'nullable|string',
          'status' => 'required|in:inactive,active,out_of_stock',
        );
        if($act != 'add'){
            $rules['image'] = 'sometimes';
        }

        return $rules;
    }
}
