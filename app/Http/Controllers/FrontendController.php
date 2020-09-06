<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    protected $slider = null;
    protected $category = null;


    public function __construct(Slider $slider,Category $category){
        $this->slider = $slider;
        $this->category = $category;
    }
    public function homePage(){
        $this->slider = $this->slider->where('status','active')->orderBy('id','DESC')->limit(8)->get();
        $banner = $this->category->where('status','active')->where('parent_id', Null)->orderBy('title','ASC')->limit(4)->get();
        $parents = $this->category->where('status','active')->where('parent_id', Null)->orderBy('title','ASC')->limit(8)->get();
        return view('home.index')
            ->with('slider',$this->slider)
            ->with('category',$parents)
            ->with('banner',$banner);
    }
}
