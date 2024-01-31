@extends('admin.layouts.master')
@section('content')

<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/apexchart/apexcharts.js')}}"></script>
<script src="{{asset('assets/js/support/support-sidemenu.js')}}"></script>
<script src="{{asset('assets/js/support/support-category.js')}}"></script>


    <!--Section-->
    <div class="page">
            <div class="row">
                <div class="col-md-11" style="margin: 0 auto">
                    <div class="card">
                        <div class="card-header border-bottom-0">
                            <div class="card-title">ویرایش هشتگ</div>
                        </div>
                        <div class="card-body">
                            <x-alert-danger></x-alert-danger>
                            <x-alert-success></x-alert-success>
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{route('tags.update',[$tag->id])}}" method="post">
                                        @csrf
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="form-label">عنوان
                                                <i class="text-danger">*</i>
                                            </label>
                                            <input type="text" class="form-control" placeholder="Name" name="name"  value="@if(old('name')){{old('name')}}@else{{$tag->name}}@endif">
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-outline-danger" href="{{route('tags.index')}}" >برگشت</a>
                                    <button class="btn btn-success">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- end app-content-->
    </div>
    @endsection
    
		<!-- End  Add Category Modal  -->