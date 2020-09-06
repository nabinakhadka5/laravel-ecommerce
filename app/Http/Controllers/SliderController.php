<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $slider = null;
    public function __construct(Slider $slider){
        $this->slider = $slider;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->slider = $this->slider->paginate();
        return view('admin.sliders')->with('data_list',$this->slider);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = $this->slider->getRules();
        $request->validate($rule);
        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;

        if($request->image){
            $image_name = uploadImage($request->image,'slider','1500x300');
            if($image_name){
                $data['image'] =$image_name;
            }
        }
        $this->slider->fill($data);
        $status = $this->slider->save();
        if($status){
            $request->session()->flash('success','Slider added successfully');
        } else {
            $request->session()->flash('error','Sorry! Slider couldnot be added.');
        }
        return redirect()->route('slider.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->slider  = $this->slider->find($id);
        if(!$this->slider){
            request()->session()->flash('error','Slider not found');
            return redirect()->route('slider.index');
        }

        return view('admin.slider-form')->with('data',$this->slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->slider  = $this->slider->find($id);
        if(!$this->slider){
            request()->session()->flash('error','Slider not found');
            return redirect()->route('slider.index');
        }


        $rule = $this->slider->getRules('update');
        $request->validate($rule);
        $data = $request->except('image');

        if($request->image){
            $image_name = uploadImage($request->image,'slider','1200x300');
            if($image_name){
                $data['image'] =$image_name;
                if($this->slider->image!=''){
                    deleteImage($this->slider->image,'slider');
                }
            }
        }
        $this->slider->fill($data);
        $status = $this->slider->save();
        if($status){
            $request->session()->flash('success','Slider Updated successfully');
        } else {
            $request->session()->flash('error','Sorry! Slider couldnot be updated.');
        }
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $this->slider = $this->slider->find($id);
        if(!$this->slider){
            request()->session()->flash('error','Slider Not Found');
            return redirect()->route('slider.index');
        }
        $image = $this->slider->image;
        $status = $this->slider->delete();
        if($status){
            deleteImage($image,'slider');
            request()->session()->flash('success','Slider deleted successfully');
        } else {
            request()->session()->flash('error','Slider Not deleted');
        }

        return redirect()->route('slider.index');

    }

}
