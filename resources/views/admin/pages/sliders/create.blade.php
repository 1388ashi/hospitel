@extends('admin.layouts.master')
@section('content')
<!--Section-->
    <div class="page-main">
            <div class="side-app">
                <!--Page header-->
                <div class="page-header d-xl-flex d-block">
                    <div class="page-leftheader">
                        <h4 class="page-title">ثبت اسلایدر</h4>
                    </div>
                </div>
                <!--End Page header-->
                
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <x-alert-danger></x-alert-danger>
                                <x-alert-success></x-alert-success>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">عنوان
                                                <i class=" text-danger">*</i>
                                            </label>
                                            <input class="form-control" type="text" placeholder="عنوان" name="title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">تصویر اسلایدر
                                                <i class=" text-danger">*</i>
                                            </label>
                                            <input  class="form-control" type="file" name="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">خلاصه توضیحات
                                                <i class=" text-danger">*</i>
                                            </label>
                                            <textarea name="summary" cols="50" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label class="form-label">لینک</label>
                                            <input class="form-control" type="text" placeholder="لینک ها" name="link">
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-controls-stacked d-md-flex">
                                    <label class="form-label mt-1 ml-5">
                                        <i class="text-danger">*</i>
                                        وضعیت :</label>
                                    <label class="custom-control custom-radio success ml-4">
                                        <input type="radio" class="custom-control-input" name="status" value="1" checked>
                                        <span class="custom-control-label">فعال</span>
                                    </label>
                                    <label class="custom-control custom-radio success ml-4">
                                        <input type="radio" class="custom-control-input" name="status" value="0">
                                        <span class="custom-control-label">غیر فعال</span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                 <a href="{{route('sliders.index')}}" class="btn btn-danger btn-lg">برگشت</a>
                                 <button class="btn btn-primary btn-lg" >ثبت</button>
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
