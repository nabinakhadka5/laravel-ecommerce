@extends('layouts.admin ');
@section('title','Slider'.(isset($data) ? 'Update' : 'Add').'Form')

@section('content')
<div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Slider {{ isset($data) ? 'Update' : 'Add' }}

                                </div>
                               
                            </div>
                            <div class="ibox-body">

                                @if(isset($data))
                                    {{Form::open(['url'=>route('slider.update',$data->id),'class'=>'form','files'=>true ]) }}
                                        @method('put')
                                @else
                                    {{Form::open(['url'=>route('slider.store'),'class'=>'form','files'=>true ]) }}

                                @endif

                                <div class="form-group row">
                                        {{Form::label('title','Title',['class'=>'col-sm-3'])}}
                                        <div class="col-sm-9">
                                            {{Form::text('title',@$data->title,['class'=>'form-control form-control-sm','id'=>'title','required'=>true,'placeholder'=>'Enter Slider title.... '])}}
                                            @error('title')
                                                <span class="alert-danger">
                                                    {{message}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    {{Form::label('link','Link',['class'=>'col-sm-3'])}}
                                    <div class="col-sm-9">
                                        {{Form::url('link',@$data->link,['class'=>'form-control form-control-sm','id'=>'link','required'=>false,'placeholder'=>'Enter Slider link.... '])}}
                                        @error('link')
                                        <span class="alert-danger">
                                            {{message}}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{Form::label('status','Status',['class'=>'col-sm-3'])}}
                                    <div class="col-sm-9">
                                        {{Form::select('status',['active'=>'Published','inactive'=>'Unpublished'],@$data->status,['class'=>'form-control form-control-sm','id'=>'status','required'=>true])}}
                                        @error('status')
                                        <span class="alert-danger">
                                            {{message}}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{Form::label('image','Image',['class'=>'col-sm-3'])}}
                                    <div class="col-sm-4">
                                        {{Form::file('image',['id'=>'image','required'=>(isset($data) ? false : true),'accept'=>'image/*'])}}
                                        @error('image')
                                        <span class="alert-danger">
                                            {message}}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        @if(isset($data))
                                            <img style="max-width:150px;" src="{{ imageUrl($data->image,'slider') }}" alt="">
                                            @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    {{Form::label('','',['class'=>'col-sm-3'])}}
                                    <div class="col-sm-9">
                                        {{Form::button('<i class="fa fa-trash"></i> Reset',['class'=>'btn btn-danger btn-sm','id'=>'reset','type'=>'reset'])}}
                                        {{Form::button('<i class="fa fa-paper-plane"></i> Submit',['class'=>'btn btn-success btn-sm','id'=>'submit','type'=>'submit'])}}

                                    </div>
                                </div>
                                 {{ Form::close()}}
                            
                        
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection