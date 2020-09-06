@extends('layouts.admin ');
@section('title','Product'.(isset($data) ? 'Update' : 'Add').'Form')
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
@endsection
@section('scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>

        $('#description').summernote({
            height:200
        });

        $('#cat_id').change(function(){
            let cat_id = $(this).val();


            if(cat_id){
                let edit_selected_cat = "{{ isset($data, $data->sub_cat_id) ? $data->sub_Cat_id : null }}";

                $.ajax({
                    url:" {{ route('get-child') }}",
                    type:"post",
                    data: {
                        _token: "{{csrf_token()}}",
                        cat_id: cat_id
                    },
                    success: function(response){
                        if(typeof(response) != "object"){
                            response = JSON.parse(response);
                        }

                        var html_option = '<option value="" selected> --Select Any One --</option>';
                        if(response.status){
                            $.each(response.data, function(key, value){
                                html_option += "<option value='"+key+"' ";

                                if(edit_selected_cat == key){
                                    html_option += " selected ";
                                }

                                html_option += ">"+value+"</option>";
                            });
                            $('#sub_cat_div').removeClass('d-none');
                        } else {
                            $('#sub_cat_div').addClass('d-none');

                        }
                        $('#sub_cat_id').html(html_option);
                    }

                });
            }

        });
        $('#cat_id').change();
    </script>


@endsection
@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Product {{ isset($data) ? 'Update' : 'Add' }}

                        </div>

                    </div>
                    <div class="ibox-body">
                        @if(isset($data))
                            {{ Form::open(['url'=>route('product.update',$data->id),'class'=>'form','files'=>true]) }}
                            @method('put')
                        @else
                            {{ Form::open(['url'=>route('product.store'),'class'=>'form','files'=>true]) }}
                        @endif
                        <div class="form-group row">
                            {{ Form::label('title','Title',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::text('title',@$data->title,['class'=>'form-control form-control-sm','id'=>'title','placeholder'=>'Enter Product title'])}}
                                @error('title')
                                <span class="alert-danger">{{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('summary','Summary',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::textarea('summary',@$data->summary,['class'=>'form-control form-control-sm','id'=>'summary','required'=>true, 'placeholder'=>'Enter Summary','style'=>'resize-none','rows'=>5])}}
                                @error('summary')
                                <span class="alert-danger">{{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('description','Description',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::textarea('description',@$data->description,['class'=>'form-control form-control-sm','id'=>'description','placeholder'=>'Enter Description','style'=>'resize-none','rows'=>5])}}
                                @error('description')
                                <span class="alert-danger">{{$message}}  </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row " id="parent_div">
                            {{ Form::label('parent_id',"Category: ",['class' =>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('cat_id',$parent_cats,@$data->cat_id,['class' =>'form form-control form-control-sm','id' => 'cat_id','required'=>true,'placeholder'=>'---Select Any One---'])}}
                                @error('cat_id')
                                <span class="alert-danger">{{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-none" id="sub_cat_div">
                            {{ Form::label('sub_cat_id',"SubCategory: ",['class' =>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('sub_cat_id',[],@$data->sub_cat_id,['class' =>'form form-control form-control-sm','id' => 'sub_cat_id','placeholder'=>'---Select Any One---'])}}
                                @error('sub_cat_id')
                                <span class="alert-danger">{{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                            <div class="form-group row">
                                {{ Form::label('price','Price (NPR.)',['class'=>'col-sm-3'])}}
                                <div class="col-sm-9">
                                    {{Form::number('price',@$data->price,['class'=>'form-control form-control-sm','id'=>'price','required'=>true,'placeholder'=>'Enter Product price','min'=> 100])}}
                                    @error('price')
                                    <span class="alert-danger">{{$message}}  </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('discount','Discount (%)',['class'=>'col-sm-3'])}}
                                <div class="col-sm-9">
                                    {{Form::number('discount',@$data->discount,['class'=>'form-control form-control-sm','id'=>'discount','placeholder'=>'Enter Product price','min'=> 0, 'max'=>90])}}
                                    @error('discount')
                                    <span class="alert-danger">{{$message}}  </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('brand','Brand',['class'=>'col-sm-3'])}}
                                <div class="col-sm-9">
                                    {{Form::text('brand',@$data->brand,['class'=>'form-control form-control-sm','id'=>'brand','required'=>false,'placeholder'=>'Enter Product brand'])}}
                                    @error('brand')
                                    <span class="alert-danger">{{$message}}  </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                {{ Form::label('is_featured','Is Featured',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::checkbox('is_featured',1,true,['id'=>'is_featured']) }} Yes
                                    @error('parent_id')
                                    <span class="alert-danger">{{$message}}  </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row " id="parent_div">
                                {{ Form::label('seller_id',"Vendor: ",['class' =>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('seller_id',$seller_list,@$data->seller_id,['class' =>'form form-control form-control-sm','id' => 'seller_id','required'=>true,'placeholder'=>'---Select Any One---'])}}
                                    @error('seller_id')
                                    <span class="alert-danger">{{$message}}  </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                            {{ Form::label('status','Status',['class'=>'col-sm-3'])}}
                            {{ Form::label('status','Status',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::select('status',['active'=> 'Published','inactive'=>'Unpublished','out_of_stock'=>'Out Of Stock'],@$data->status,['class'=>'form-control form-control-sm','id'=>'status','required'=>true])}}
                                @error('status')
                                <span class="alert-danger">{{$message}}  </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            {{ Form::label('image','Image',['class'=>'col-sm-3'])}}
                            <div class="col-sm-4">
                                {{Form::file('image',['id'=>'image','required'=>(isset($data) ? false : true),'accept'=>'image/*'] ) }}
                                @error('image')
                                <span class="alert-danger">{{$message}}  </span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                @if(isset($data))
                                    <img src="{{ imageUrl($data->image,'product') }}" alt="">
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            @if(isset($data))
                                @foreach($data->images as $product_image)
                                    <div class="col-md-2">
                                        <img src="{{ imageUrl($product_image->image_name, 'product') }}" alt="" class="img img-thumbnail img-fluid">
                                        {{ Form::checkbox('del_image[]',$product_image->image_name,false) }} Delete
                                    </div>
                                @endforeach
                            @endif
                        </div>


                        <div class="form-group row">
                            {{ Form::label('related_image','Other Image',['class'=>'col-sm-3'])}}
                            <div class="col-sm-4">
                                {{Form::file('related_image[]',['accept'=>'image/*','multiple'=>true] ) }}
                                @error('image')
                                <span class="alert-danger">{{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('','',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::button('<i class="fa fa-trash"></i>Reset',['class'=>'btn btn-sm btn-danger', 'id'=>'reset','type'=>'reset'] ) }}
                                {{ Form::button('<i class="fa fa-paper-plane"></i>Submit',['class'=>'btn btn-sm btn-success', 'id'=>'submit','type'=>'submit'] ) }}
                            </div>

                        </div>
                        {{ Form::close()}}
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection