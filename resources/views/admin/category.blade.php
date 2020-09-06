@extends('layouts.admin ');
@section('title','Category Listing Page| Admin Page')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Category List

                        </div>
                        <a href="{{route('category.create')}}" class="btn btn-success float-right">
                            <i class="fa fa-plus"></i>Add Category
                        </a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Summary</th>

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
                                            @if($data_indiv->child_cats->count()>0)

                                                <ol>
                                                    @foreach($data_indiv->child_cats as $child_cats)
                                                        <li>

                                                            <div class="row">

                                                                <a href="{{ route('category.edit',$data_indiv->id) }}">
                                                                    <small>{{$child_cats->title}}</small>
                                                                </a>
                                                                {{Form::open(['url'=>route('category.destroy',$child_cats->id),'class'=>'float-right','onsubmit'=>'return confirm("Are You sure you want to delete this Category")'])}}
                                                                @method('delete')
                                                                {{Form::button('<i class="fa fa-trash"></i>',['class'=>'btn btn-link','type'=>'submit','style'=>'margin-top: -6px;'])}}
                                                                {{Form::close()}}
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $data_indiv->summary }}
                                        </td>

                                        <td>
                                                        <span class="badge badge-{{ $data_indiv->status == 'active' ? 'success' : 'danger' }}">
                                                        {{ ($data_indiv->status == 'active') ? 'Published' : 'Un-Published' }}
                                                        </span>
                                        </td>
                                        <td>
                                        <!-- <img src="{{ asset('uploads/data/Thumb-'.$data_indiv->image)}}" alt=""> -->
                                            <img style="max-width: 150px" src="{{imageUrl($data_indiv->image,'Category')}}" alt="">
                                        </td>
                                        <td>
                                            <a href="{{ route('category.edit',$data_indiv->id) }}" class="btn btn-success btn-circle">
                                                <i class="fa fa-edit"></i>

                                            </a>
                                        {{Form::open(['url'=>route('category.destroy',$data_indiv->id),'class'=>'form float-left','onsubmit'=>'return confirm("Are You sure you want to delete this Category")'])}}
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