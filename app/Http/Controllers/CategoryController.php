<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $category = null;
    public function __construct(Category $category){
        $this->category = $category;

    }

    public function getAllChild(Request $request){
        $this->category = $this->category->getAllChildren($request->cat_id);
        if($this->category->count()>0){

            return response()->json(['data'=>$this->category,'status'=>true]);
        } else {
            return response()->json(['data'=>null,'status'=>false]);

        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->category = $this->category->with(['parent_info','child_cats'])->where('parent_id',null)->paginate();
        return view('admin.category')->with('data_list',$this->category);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = $this->category->getAllParents();
        return view('admin.category-form')
            ->with('parent_cats',$parent_cats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->category->getRules();
        $request->validate($rules);

        $data = $request->except('image');
        $data['slug']=$this->category->getSlug($request->title);
        $data['added_by'] = $request->user()->id;

        if($request->image){
            $image_name = uploadImage($request->image,'category',env('CATEGORY_IMAGE_SIZE','200x200'));
            if($image_name){
                $data['image'] = $image_name;
            }
        }


        $this->category->fill($data);
        $status = $this->category->save();
        if($status){
            $request->session()->flash('success','Category added successfully');

        } else {
            $request->session()->flash('error','Sorry, there was problem while adding category');
        }
        return redirect()->route('category.index');
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
        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error','Category not found');
            return redirect()->route('category.index');
        }
        $parent_cats = $this->category->getAllParents();
        return view('admin.category-form')
            ->with('data',$this->category)
            ->with('parent_cats',$parent_cats);

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
        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error','Category not found');
            return redirect()->route('category.index');
        }

        $rules = $this->category->getRules();
        $request->validate($rules);

        $data = $request->except('image');

        if($request->image){
            $image_name = uploadImage($request->image,'category',env('CATEGORY_IMAGE_SIZE','200x200'));
            if($image_name){
                $data['image'] = $image_name;
                deleteImage($this->category->image,'category');
            }
        }


        $this->category->fill($data);
        $status = $this->category->save();
        if($status){
            $request->session()->flash('success','Category Updated successfully');

        } else {
            $request->session()->flash('error','Sorry, there was problem while Updating category');
        }
        return redirect()->route('category.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $this->category = $this->category->find($id);
    if(!$this->category){
        request()->session()->flash('error','Category not found');
        return redirect()->route('category.index');
    }

    $image = $this->category->image;
    $del = $this->category->delete();

    if($del){
        deleteImage($image,'category');
        request()->session()->flash('success','Category deleted successfully');
        return redirect()->route('category.index');

    } else {
        request()->session()->flash('error','Category could not be deleted ');
        return redirect()->route('category.index');
    }
    }
}
