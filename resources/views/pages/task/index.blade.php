@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">tasks</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ tasks list</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

    @if(session()->has('success_task'))
        <script>
        window.onload=function(){
        notif({
        msg:"تم اضافة التاسك بنجاح",
        type:"success"
        })
        }
        </script>

    @endif

    @if(session()->has('update_task'))
    <script>
    window.onload=function(){
    notif({
    msg:"تم تعديل التاسك بنجاح",
    type:"success"
    })
    }
    </script>

    @endif


    @if(session()->has('delete_task'))
        <script>
        window.onload=function(){
        notif({
        msg:"تم حذف التاسك بنجاح",
        type:"success"
        })
        }
        </script>

    @endif


	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif


				<!-- row -->
				<div class="row">
                <!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<a class="modal-effect btn btn-outline-primary btn-md" data-effect="effect-scale"  data-toggle="modal" href="#modaldemo4"> Add task</a>

							</div>


							<div class="card-body">
								<div class="table-responsive">

									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">task Name</th>
                                                <th class="border-bottom-0">description</th>
                                                <th class="border-bottom-0">project</th>

                                                <th class="border-bottom-0"></th>
                                            </tr>
										</thead>
										<tbody>
										@php
										$i=0;
										@endphp
										@foreach($tasks as $task)
										@php
										$i++;
										@endphp
											<tr>

												<td>{{$i}}</td>
												<td>{{$task->name}}</td>
                                                <td>{{$task->description }}</td>
                                                <td>{{$task->project->name }}</td>

                                                <td></td>
												<td>

                                                    <a class="modal-effect btn btn-sm btn-warning " data-effect="effect-scale"
                                                        href="#modaldemo9{{$task->id}}"  data-toggle="modal"  title="تعديل"><i
                                                    class="las la-edit"></i></a>

                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-toggle="modal" href="#modaldemo6{{$task->id}}" title="حذف"><i
                                                        class="las la-trash"></i></a>


                                                    <a class=" btn btn-sm btn-success" role="button"  aria-pressed="true"
                                                    data-id="{{$task->id}}"
                                                    href="{{route('task.show',$task->id)}}" title="show"><i
                                                    class="las la-eye"></i></a>
												</td>
											</tr>

                                            	<!-- delete -->
											<div class="modal" id="modaldemo6{{$task->id}}">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content modal-content-demo">
														<div class="modal-header">
															<h6 class="modal-title"> Delete task</h6><button aria-label="Close" class="close"
																data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
														</div>
														<form action="{{route('task.destroy',$task->id)}}" method="post">
															{{ method_field('delete') }}
															{{ csrf_field() }}
                                                            <div class="form-group">
                                                                <input type="hidden" class="form-control" id="id" name="id" value="{{$task->id}}">
                                                            </div>

															<div class="modal-body">
																<p>? Are you sure you want to delete this task</p><br>
                                                                <br>
																<input type="text" name="id" id="id" value="{{$task->name}}">
                                                                : task Name
															</div>
															<div class="modal-footer">

																<button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
																<button type="submit" class="btn btn-danger">save</button>
															</div>
													    </form>
                                                    </div>
												</div>
											</div>


                                            	<!-- Edit modal -->
                                                <div class="modal" id="modaldemo9{{$task->id}}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title"> Edit task</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <form action="{{route('task.update',$task->id)}}" method="post">
                                                                    {{method_field('patch')}}
                                                                    {{csrf_field()}}

                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmaili">task name</label>

                                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>description : <span class="text-danger">*</span></label>
                                                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="{{ $task->description }}"></textarea>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label > project</label>
                                                                            <select class="custom-select my-1 mr-sm-2" name="project_id">
                                                                                <option selected disabled>choose...</option>
                                                                                @foreach($projects as $project)
                                                                                    <option style="color: black" value="{{$project->id}}">{{$project->name}}</option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>

                                                                            <div class="inputBox multiselect">
                                                                                <select data-placeholder="select tags" multiple class="chosen-select" name="tag_id[]">
                                                                                    <option selected disabled>choose...</option>
                                                                                    @foreach($tags as $tag)
                                                                                        <option style="tag: black" value="{{$tag->id}}">{{$tag->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>


                                                                        {{-- <div class="form-group">
                                                                            <label > tags </label>
                                                                            <select class="custom-select my-1 mr-sm-2" name="tag_id[]">
                                                                                <option selected disabled>choose...</option>
                                                                                @foreach($tags as $tag)
                                                                                    <option style="tag: black" value="{{$tag->id}}">{{$tag->name}}</option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div> --}}

                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <button class="btn  btn-primary" type="submit">save</button>
                                                                        <button class="btn  btn-secondary" data-dismiss="modal" type="button">cancel</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

											@endforeach




										</tbody>
									</table>
                                    {{-- <div class="pagination">
                                        {{ $tasks->links() }}
                                    </div> --}}
								</div>
							</div>
						</div>
					</div>
				</div>




						<!-- Basic modal -->
				<div class="modal" id="modaldemo4">
					<div class="modal-dialog" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title"> Add task</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
								<form action="{{route('task.store')}}" method="post">
									{{csrf_field()}}

									<div class="modal-body">
										<div class="form-group">
											<label for="exampleInputEmaili">task name</label>

											<input type="text" class="form-control" id="name" name="name" required>
										</div>

                                        <div class="form-group">
                                            <label>description : <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>


                                        <div class="form-group">
                                            <label > project</label>
                                            <select class="custom-select my-1 mr-sm-2" name="project_id">
                                                <option selected disabled>choose...</option>
                                                @foreach($projects as $project)
                                                    <option style="color: black" value="{{$project->id}}">{{$project->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label > tags</label>
                                            <select data-placeholder="select tags" multiple class="custom-select my-1 mr-sm-2" name="tag_id[]">
                                                <option selected disabled>choose...</option>
                                                @foreach($tags as $tag)
                                                    <option style="tag: black" value="{{$tag->id}}">{{$tag->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

									</div>


									<div class="modal-footer">
										<button class="btn  btn-primary" type="submit">save</button>
										<button class="btn  btn-secondary" data-dismiss="modal" type="button">cancel</button>
									</div>
								</form>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>



	<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection
