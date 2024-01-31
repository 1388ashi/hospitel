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
                        <form action="{{route('categories.update',[$category->id])}}" method="post">
                            @csrf
                            @method('Put')
                            <div class="card-header border-bottom-0">
                                <div class="card-title">ویرایش دسته بندی</div>
                            </div>
                            <div class="card-body">
                            <x-alert-danger></x-alert-danger>
                            <x-alert-success></x-alert-success>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="form-label">عنوان
                                                <i class="mt-1 text-danger" style="color: red">*</i>
                                            </label>
                                            <input type="text" class="form-control" placeholder="Name" name="name"  value="@if(old('name')){{old('name')}}@else{{$category->name}}@endif">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="form-label">نامک</label>
                                            <input type="text" class="form-control" placeholder="slug" name="slug"  value="@if(old('slug')){{old('slug')}}@else{{$category->slug}}@endif">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-1 ml-5">
                                            <i class="text-danger">*</i>
                                            نوع:</label>
                                            <label class="custom-control custom-radio success ml-4">
                                                <input type="radio" class="custom-control-input" name="type" value="news" @if($category->type == 'news') checked @endif>
                                                <span class="custom-control-label">خبری</span>
                                            </label>
                                            <label class="custom-control custom-radio success ml-4">
                                                <input type="radio" class="custom-control-input" name="type"  value="article" @if($category->type == 'article') checked @endif>
                                                <span class="custom-control-label">آموزشی</span>
                                            </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-1 ml-5">
                                            <i class="text-danger">*</i>
                                            وضعیت:</label>
                                            <label class="custom-control custom-radio success ml-4">
                                                <input type="radio" class="custom-control-input" name="status" value="1" @if($category->status == 1) checked @endif>
                                                <span class="custom-control-label">فعال</span>
                                            </label>
                                            <label class="custom-control custom-radio success ml-4">
                                                <input type="radio" class="custom-control-input" name="status" value="0" @if($category->status == 0) checked @endif>
                                                <span class="custom-control-label">غیر فعال</span>
                                            </label>
                                    </div>
                                </div>
                            </div>        
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-outline-danger" href="{{route('categories.index')}}" >برگشت</a>
                                    <button class="btn btn-warning">به روز رسانی</button>
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