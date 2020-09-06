<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $user = null;
    protected $category = null;
    protected $product = null;

    public function __construct(Category $category, User $user, Product $product){
        $this->category = $category;
        $this->user = $user;
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->product = $this->product
            ->with(['cat_info','sub_cat_info','seller_info'])->orderBy('id','DESC')->paginate();
        return view('admin.product')->with('data_list',$this->product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->user = $this->user->where('role','seller')->pluck('name','id');
        $this->category = $this->category->getAllParents();
        return view('admin.product-form')
            ->with('seller_list',$this->user)
            ->with('parent_cats',$this->category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->product->getRules();
        $request->validate($rules);

        $data = $request->except('image','related_image');

        $data['slug'] = $this->product->getSlug($request->title);
        $data['added_by'] = $request->user()->id;
        $data['actual_price'] = $request->price - (($request->price * $request->discount)/100);

        if($request->image){
            $image_name = uploadImage($request->image, 'product', '200x200');
            if($image_name){
                $data['image'] = $image_name;

            }
        }

        $this->product->fill($data);
        $status = $this->product->save();
        if($status){
            if($request->related_image){
                foreach ($request->related_image as $rel_image) {
                    $img_name = uploadImage($rel_image, 'product','200x200');
                    if($img_name){
                       $temp_data = array(
                           'product_id' => $this->product->id,
                           'image_name' => $img_name
                       );
                       $product_image = new ProductImage();
                       $product_image->fill($temp_data);
                       $product_image->save();
                    }
                }
            }
            $request->session()->flash('success','Product added successfully');


        } else {
            $request->session()->flash('error','Sorry, there was problem while adding product');
        }
        return redirect()->route('product.index');
    }

    /**
     *
     * $data['status'] = 'inactive'
     * $data['seller_id'] = $request->user->id
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
        $this->product = $this->product->find($id);
        if(!$this->product){
            request()->session()->flash('error','Product not found');
            return redirect()->route('product.index');
        }
        $this->user = $this->user->where('role','seller')->pluck('name','id');
        $this->category = $this->category->getAllParents();

        return view('admin.product-form')
            ->with('seller_list',$this->user)
            ->with('data',$this->product)
            ->with('parent_cats',$this->category);


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
        $this->product = $this->product->find($id);
        if(!$this->product){
            request()->session()->flash('error','Product not found');
            return redirect()->route('product.index');
        }

        $rules = $this->product->getRules('update');
        $request->validate($rules);

        $data = $request->except('image','related_image');

        $data['actual_price'] = $request->price - (($request->price * $request->discount)/100);

        if($request->image){
            $image_name = uploadImage($request->image, 'product', '200x200');
            if($image_name){
                $data['image'] = $image_name;
                deleteImage($this->product->image,'product');

            }
        }

        $this->product->fill($data);
        $status = $this->product->save();
        if($status){

            if(isset($request->del_image)){
                foreach ($request->del_image as $del_images){
                    $img_prod = new ProductImage();
                    $img_prod = $img_prod->where('image_name',$del_images)->first();
                if($img_prod){
                    $img_prod->delete();
                    deleteImage($del_images, 'product');
                }
            }
        }
            if($request->related_image){
                foreach ($request->related_image as $rel_image) {
                    $img_name = uploadImage($rel_image, 'product','200x200');
                    if($img_name){
                        $temp_data = array(
                            'product_id' => $this->product->id,
                            'image_name' => $img_name
                        );
                        $product_image = new ProductImage();
                        $product_image->fill($temp_data);
                        $product_image->save();
                    }
                }
            }
            $request->session()->flash('success','Product updated successfully');


        } else {
            $request->session()->flash('error','Sorry, there was problem while updating product');
        }
        return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product = $this->product->with('images')->find($id);
        if(!$this->product){
            request()->session()->flash('error','Sorry! Product does not exists');
            return redirect()->route('product.index');
        }
        $cover_image = $this->product->image;

        $images = $this->product->images;

        $del = $this->product->delete();

        if($del){
            if($cover_image){
                deleteImage($cover_image,'product');

            }

            if($images->count()>0){
                foreach ($images as $product_image){
                    deleteImage($product_image->image_name,'product');
                }
            }
            request()->session()->flash('success','Product deleted successfully');
        } else {
            request()->session()->flash('error','Product couldnot be deleted at this moment');
        }
        return redirect()->route('product.index');
    }
}
