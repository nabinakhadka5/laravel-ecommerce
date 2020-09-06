@extends('layouts.admin ');
@section('title','Page Listing Page| Admin Page')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Page List

                        </div>
                        <a href="{{route('page.create')}}" class="btn btn-success float-right">
                            <i class="fa fa-plus"></i>Add Page
                        </a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Summary</th>
                                <th>Image</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($data_list)
                                @foreach($data_list as $data_indiv)
                                    <tr>
                                        <td>{{ $data_indiv->title }}</td>
                                        <td>{{ $data_indiv->summary }}</td>
                                        <td>
                                            <img style="max-width:150px;" src="{{ imageUrl($data_indiv->image,'page') }}" alt="">
                                        </td>

                                        <td>
                                            <a href="{{ route('page.edit',$data_indiv->id) }}" class="btn btn-success btn-circle">
                                                <i class="fa fa-edit">

                                                </i>
                                            </a>
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