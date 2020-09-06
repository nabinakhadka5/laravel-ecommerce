@extends('layouts.admin ');
@section('title','Page'.(isset($data) ? 'Update' : 'Add').'Form')
@section('scripts')
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
@endsection
@section('scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>

        $('#description').summernote({
            height:200
        });
        </script>

@endsection
@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Page {{ isset($data) ? 'Update' : 'Add' }}

                        </div>

                    </div>
                    <div class="ibox-body">
                            {{ Form::open(['url'=>route('page.update',$data->id),'class'=>'form','files'=>true]) }}
                            @method('put')

                        <div class="form-group row">
                            {{ Form::label('title','Title',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::text('title',@$data->title,['class'=>'form-control form-control-sm','id'=>'title','placeholder'=>'Enter Page title'])}}
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



                        <div class="form-group row">
                            {{ Form::label('layout','Layout',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::select('layout',['default'=> 'Default','about-us'=>'About Page Layout'],@$data->layout,['class'=>'form-control form-control-sm','id'=>'layout','required'=>true])}}
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
                                    <img src="{{ imageUrl($data->image,'page') }}" alt="">
                                @endif
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