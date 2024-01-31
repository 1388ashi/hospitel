@extends('admin.layouts.master')
@section('content')
<!--Section-->
    <div class="page-main">
            <div class="side-app">
                <!--Page header-->
                <div class="page-header d-xl-flex d-block">
                    <div class="page-leftheader">
                        <h4 class="page-title">ویرایش اسلایدر</h4>
                    </div>
                </div>
                <!--End Page header-->

                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{route('sliders.update',[$slider->id])}}" method="post" enctype="multipart/form-data">
                            @method('Put')
                            @csrf
                            <div class="card-body">
                                <x-alert-danger></x-alert-danger>
                                <x-alert-success></x-alert-success>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">عنوان</label>
                                            <input class="form-control" type="text" placeholder="عنوان" name="title"  value="@if(old('title')){{old('title')}}@else{{$slider->title}}@endif">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">تصویر اسلایدر</label>
                                            <input  class="form-control" type="file" name="image" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">خلاصه توضیحات</label>
                                            <textarea name="summary"  cols="50" rows="3">@if(old('summary')){{old('summary')}}@else{{$slider->summary}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">لینک</label>
                                            <input class="form-control" type="text" placeholder="لینک ها" name="link" value="@if(old('link')){{old('link')}}@else{{$slider->link}}@endif">
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-controls-stacked d-md-flex">
                                    <label class="form-label mt-1 ml-1">وضعیت :</label>
                                    <label class="custom-control custom-radio success ml-4">
                                        <input type="radio" class="custom-control-input" name="status" value="1"  @if($slider->status == 1) checked @endif>
                                        <span class="custom-control-label">فعال</span>
                                    </label>
                                    <label class="custom-control custom-radio success ml-4">
                                        <input type="radio" class="custom-control-input" name="status" value="0"  @if($slider->status == 0) checked @endif>
                                        <span class="custom-control-label">غیر فعال</span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                 <a href="{{route('sliders.index')}}" class="btn btn-danger btn-lg">برگشت</a>
                                 <button class="btn btn-warning btn-lg" >به روزرسانی</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <!-- End Row -->
        </div><!-- end app-content-->
    </div>
</div>
@endsection