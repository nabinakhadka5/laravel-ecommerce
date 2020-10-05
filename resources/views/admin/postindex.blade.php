@extends('layouts.admin ');
@section('title','post Listing Page| Admin Page')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">post List

                        </div>
                        <a href="{{route('post.create')}}" class="btn btn-success float-right">
                            <i class="fa fa-plus"></i>Add post
                        </a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($data)
                                @foreach($data as $data_indiv)
                                    <tr>
                                        <td>{{ $data_indiv->title }}
                                        </td>
                                        <td>{{ $data_indiv->body}}
                                        </td>

                                        <td>
                                            <a href="{{ route('post.edit',$data_indiv->id) }}" class="btn btn-success btn-circle">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        {{Form::open(['url'=>route('post.destroy',$data_indiv->id),'class'=>'form float-left','onsubmit'=>'return confirm("Are You sure you want to delete this post")'])}}
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
