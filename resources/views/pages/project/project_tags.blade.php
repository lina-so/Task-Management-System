@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12 margin-tb">

                            <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                                action="{{route('task.store','test')}}" method="post">
                                {{csrf_field()}}

                                <div class="">

                                    <div class="row mg-b-20">
                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" >
                                            <label>task name <span class="tx-danger">*</span></label>
                                            <input class="form-control form-control-sm mg-b-20"
                                                data-parsley-class-handler="#lnWrapper" name="name" required="" type="name">
                                        </div>

                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" >
                                            <label>description : <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mg-b-20">
                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" >
                                        <label > project</label>
                                        <select class="custom-select my-1 mr-sm-2" name="project_id">
                                                <option selected style="color: black" value="{{$project->id}}">{{$project->name}}</option>
                                        </select>
                                    </div>

                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" >
                                        <label > tags</label>
                                        <select data-placeholder="select tags" multiple class="custom-select my-1 mr-sm-2" name="tag_id[]">
                                            <option selected disabled>choose...</option>
                                            @foreach($tags as $tag)
                                                <option style="tag: black" value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>


                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" >
                                        <label > Suggest tags</label>
                                        <select data-placeholder="select tags" multiple class="custom-select my-1 mr-sm-2" name="tag_id[]">
                                            <option selected disabled>choose...</option>
                                            @foreach($sugg_tags as $tag)
                                                <option style="tag: black" value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="btn btn-main-primary pd-x-20" type="submit">save</button>
                                </div>
                            </form>
                        </div>

                        {{-- <div class="modal-dialog" role="document">
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
                                                        <option selected style="color: black" value="{{$project->id}}">{{$project->name}}</option>
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
                        </div> --}}
                    </div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
