@extends('layouts.admin ');
@section('title','Product Listing Page| Admin Page')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Product List

                        </div>
                        <a href="{{route('product.create')}}" class="btn btn-success float-right">
                            <i class="fa fa-plus"></i>Add Product
                        </a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Is Featured</th>
                                <th>Seller</th>

                                <th>Status</th>
                                <th>Image</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($data_list)
                                @foreach($data_list as $data_indiv)
                                    <tr>
                                        <td>{{ $data_indiv->title }}
                                        </td>
                                        <td>
                                            {{ $data_indiv->cat_info['title'] }}
                                            <sub>
                                                {{ $data_indiv->sub_cat_id }}
                                            </sub>
                                        </td>
                                        <td>
                                            NPR. {{ number_format($data_indiv->actual_price) }}


                                        </td>
                                        <td>
                                            {{ $data_indiv->is_featured == 1 ? 'yes' : 'No' }}
                                        </td>
                                        <td>
                                            {{ $data_indiv->seller_info['name'] }}
                                        </td>

                                        <td>
                                            <span class="badge badge-{{ $data_indiv->status == 'active' ? 'success' : 'danger' }}">
                                                {{ ($data_indiv->status == 'active') ? 'Published' : 'Un-Published' }}
                                            </span>
                                        </td>
                                        <td>
                                        <!-- <img src="{{ asset('uploads/data/Thumb-'.$data_indiv->image)}}" alt=""> -->
                                            <img style="max-width: 100px" src="{{imageUrl($data_indiv->image,'Product')}}" alt="">
                                        </td>
                                        <td>
                                            <a href="{{ route('product.edit',$data_indiv->id) }}" class="btn btn-success btn-circle">
                                                <i class="fa fa-edit"></i>

                                            </a>
                                        {{Form::open(['url'=>route('product.destroy',$data_indiv->id),'class'=>'form float-left','onsubmit'=>'return confirm("Are You sure you want to delete this Product")'])}}
                                        @method('delete')
                                        {{Form::button('<i class="fa fa-trash"></i>',['class'=>'btn btn-danger btn-circle','type'=>'submit'])}}
                                        {{Form::close()}}

                                    </tr>
                                @endforeach
                            @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection