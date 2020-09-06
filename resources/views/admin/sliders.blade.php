@extends('layouts.admin ');
@section('title','Slider Listing Page| Admin Page')

@section('content')
<div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Slider List
 
                                </div>
                                <a href="{{route('slider.create')}}" class="btn btn-success float-right">
                                        <i class="fa fa-plus"></i>Add Slider 
                                    </a>
                            </div>
                            <div class="ibox-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Link</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @if($data_list)
                                        @foreach($data_list as $data_indiv)
                                            <tr>
                                                <td>{{ $data_indiv->title }}</td>
                                                <td><a href="{{ $data_indiv->link }}" target="slider" class="btn btn-link">
                                                        {{ $data_indiv->link }}
                                                    </a></td>
                                                <td>
                                                    <span class="badge badge-{{ $data_indiv->status == 'active' ? 'success' : 'danger' }}">
                                                        {{ ($data_indiv->status == 'active') ? "Published" : "Un-Published" }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <img style="max-width:150px;" src="{{ imageUrl($data_indiv->image,'slider') }}" alt="">
                                                </td>

                                                <td>
                                                    <a href="{{ route('slider.edit',$data_indiv->id) }}" class="btn btn-success btn-circle">
                                                        <i class="fa fa-edit">

                                                        </i>
                                                    </a>
                                                    {{ Form::open(['url'=>route('slider.destroy',$data_indiv->id),'class'=>'form float-left', 'onsubmit' => 'return confirm("Are You Sure You want to delete this slider")']) }}
                                                    @method('delete')
                                                    {{Form::button('<i class="fa fa-trash"></i>',['class'=>'btn btn-danger btn-circle','type' =>'submit'])}}


                                                    {{ Form::close() }}
                                                </td>
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