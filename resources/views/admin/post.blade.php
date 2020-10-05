@extends('layouts.admin ');
@section('title','Post'.(isset($data) ? 'Update' : 'Add').'Form')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Post {{ isset($data) ? 'Update' : 'Add' }}
                        </div>
                    </div>
                    <div class="ibox-body">
                        @if(isset($data))
                            {{ Form::open(['url'=>route('post.update',$data->id),'class'=>'form','files'=>true]) }}
                            @method('put')
                        @else
                            {{ Form::open(['url'=>route('post.store'),'class'=>'form','files'=>true]) }}
                        @endif
                        <div class="form-group row">
                            {{ Form::label('title','Title',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::text('title',$data->title,['class'=>'form-control form-control-sm','id'=>'title','placeholder'=>'Enter post title'])}}
                                @error('title')
                                <span class="alert-danger">{{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('body','body',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::text('body',$data->body,['class'=>'form-control form-control-sm','id'=>'body','placeholder'=>'Enter post body'])}}
                                @error('body')
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
