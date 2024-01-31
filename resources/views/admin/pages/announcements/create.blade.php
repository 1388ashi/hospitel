@extends('admin.layouts.master')
@section('content')
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.css')}}">
<link href="{{asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/notify/css/notifIt-rtl.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/modal-datepicker/datepicker.css')}}" rel="stylesheet" />
<!--Section-->
    <div class="page-main">
            <div class="side-app">
                <!--Page header-->
                <div class="page-header d-xl-flex d-block">
                    <div class="page-leftheader">
                        <h4 class="page-title">ثبت اطلاعیه</h4>
                    </div>
                    <div class="page-leftheader mr-md-auto">
                        <div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
                            <div class="btn-list">
                                <button  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                                <button  class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                                <button  class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Page header-->
                
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{route('announcements.store')}}" method="post"  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <x-alert-danger></x-alert-danger>
                                    <x-alert-success></x-alert-success>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">تیتر
                                                <i class="mt-1 text-danger" style="color: red">*</i>
                                                </label>
                                                <input class="form-control" type="text" placeholder="عنوان" name="title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">تصویر اطلاعیه
                                                <i class="mt-1 text-danger" style="color: red">*</i>
                                                </label>
                                            <input  class="form-control" type="file" name="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">خلاصه توضیحات
                                                <i class="mt-1 text-danger" style="color: red">*</i>
                                                </label>
                                            <textarea name="summary" cols="50" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label class="form-label">زمان انتشار</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="feather feather-calendar"></i>
                                                    </div>
                                                </div>
                                                <input class="form-control fc-datepicker" id="payment_date_show" placeholder="تاریخ انتشار" type="text" autocomplete="off" value="{{ verta(old('published_at', today()->format('Y-m-d')))->format('Y-m-d') }}">
                                                <input name="published_at" id="payment_date" type="hidden" value="{{old('published_at', today()->format('Y-m-d')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">بدنه
                                            <i class="mt-1 text-danger" style="color: red">*</i>
                                        </label>
                                        <textarea name="body" id="example" cols="160" rows="4"></textarea>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group ">
                                            <label class="form-label">نامک
                                                <i class=" text-danger" style="color: red">*</i>
                                            </label>
                                            <input class="form-control" type="text" placeholder="اسلاگ" name="slug">
                                        </div>
                                    </div>
                                    <div class="custom-controls-stacked d-md-flex">
                                        <label class="form-label mt-5 mr-5">وضعیت
                                            <i class="text-danger">*</i></label>
                                        <label class="custom-control custom-radio success mr-5 mt-5">
                                            <input type="radio" class="custom-control-input" name="status" value="1" checked>
                                            <span class="custom-control-label">فعال</span>
                                        </label>
                                        <label class="custom-control custom-radio success mr-5 mt-5">
                                            <input type="radio" class="custom-control-input" name="status" value="0">
                                            <span class="custom-control-label">غیر فعال</span>
                                        </label>
                                    </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{route('announcements.index')}}" class="btn btn-danger btn-lg">برگشت</a>
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
@section('scripts')
<script>
    $('#payment_date_show').MdPersianDateTimePicker({
        targetDateSelector: '#payment_date',
        targetTextSelector: '#payment_date_show',
        englishNumber: false,
        toDate:true,
        enableTimePicker: false,
        dateFormat: 'yyyy-MM-dd',
        textFormat: 'yyyy-MM-dd',
        groupId: 'rangeSelector1',
    });


        </script>
@endsection
<script src="{{asset('assets/plugins/modal-datepicker/datepicker.js')}}"></script>
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('assets/plugins/circle-progress/circle-progress.min.js')}}"></script>
<script src="{{asset('assets/plugins/notify/js/notifIt-rtl.js')}}"></script>

@endsection