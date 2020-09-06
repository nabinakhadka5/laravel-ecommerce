<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $page = null;
    public function __construct(Page $page){
        $this->page = $page;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->page = $this->page->get();
        return view('admin.page')->with('data_list',$this->page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $this->page = $this->page->find($id);
        if(!$this->page){
            request()->session()->flash('error','Page Not Found');
            return redirect()->route('page.index');
        }
        return view('admin.page-form')->with('data',$this->page);
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
        $this->page = $this->page->find($id);
        if(!$this->page){
            request()->session()->flash('error','Page Not Found');
            return redirect()->route('page.index');
        }

        $data = $request->except('image');
        $data['updated_by'] = $request->user()->id;

        if($request->image){
            $image_name = uploadImage($request->image, 'page','200x200');
            if($image_name){
                $data['image'] = $image_name;
                deleteImage($this->page->image,'page');
            }
        }
        $this->page->fill($data);
        $status = $this->page->save();
        if($status){
            $request->session()->flash('success','Page Updated successfully');
        } else {
            $request->session()->flash('error','Page could not be Updated');
        }
        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
