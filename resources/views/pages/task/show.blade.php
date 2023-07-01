@extends('layouts.master')
@section('css')

@section('title')
task Details

@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    task Details
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
                                       aria-selected="true"> {{ $task->name }}  task details</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">task name</th>
                                            <td>{{ $task->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">task description</th>
                                            <td>{{$task->description}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">project</th>
                                            <td>{{$task->project->name}}</td>
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
