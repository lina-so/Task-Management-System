@extends('layouts.master')
@section('css')
@section('title')
Project Details

@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Project Details
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true"> {{ $project->name }}  project details</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">project name</th>
                                            <td>{{ $project->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">project description</th>
                                            <td>{{$project->description}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">user</th>
                                            <td>{{$project->user->name}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

            <!-- row closed -->
@endsection
@section('js')

@endsection
