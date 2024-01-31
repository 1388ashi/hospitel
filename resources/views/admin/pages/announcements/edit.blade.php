@extends('admin.layouts.master')
@section('content')
<!--Section-->
    <div class="page-main">
            <div class="side-app">
                <!--Page header-->
                <div class="page-header d-xl-flex d-block">
                    <div class="page-leftheader">
                        <h4 class="page-title">ویرایش اطلاعیه</h4>
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
                            <form action="{{route('announcements.update',[$announcements->id])}}" method="post"  enctype="multipart/form-data">
                                @method('Put')                           
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
                                            <input class="form-control" type="text" placeholder="عنوان" name="title"  value="@if(old('title')){{old('title')}}@else{{$announcements->title}}@endif">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">خلاصه توضیحات
                                                <i class="mt-1 text-danger" style="color: red">*</i>
                                            </label>
                                            <textarea name="summary" cols="65" rows="3">@if(old('summary')){{old('summary')}}@else{{$announcements->summary}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">زمان انتشار</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="feather feather-calendar"></i>
                                                    </div>
                                                </div>
                                                <input class="form-control fc-datepicker" id="payment_date_show" placeholder="تاریخ انتشار" type="text" autocomplete="off" value=" @if(old('published_at')) {{verta(old('published_at', today()->format('Y-m-d')))->format('Y-m-d') }} @else{{$announcements->published_at}} @endif">
                                                <input name="payment_date" id="payment_date" type="hidden" value="{{ old('published_at', today()->format('Y-m-d')) }}">
                                            </div>
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
                                <div class="form-group">
                                    <label class="form-label">بدنه:
                                        <i class="mt-1 text-danger" style="color: red">*</i>
                                    </label>
                                    <textarea name="body" id="example">{{$announcements->body}}</textarea>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group ">
                                        <label class="form-label">نامک
                                            <i class=" text-danger" style="color: red">*</i>
                                        </label>
                                        <input class="form-control" type="text" placeholder="اسلاگ" name="slug"  value="@if(old('slug')){{old('slug')}}@else{{$announcements->slug}}@endif">
                                    </div>
                                </div>
                                <div class="custom-controls-stacked d-md-flex">
                                    <label class="form-label mt-5 mr-5">وضعیت
                                        <i class="text-danger">*</i></label>
                                    <label class="custom-control custom-radio success mr-5 mt-5">
                                        <input type="radio" class="custom-control-input" name="status" value="1"  @if($announcements->status == 1) checked @endif>
                                        <span class="custom-control-label">فعال</span>
                                    </label>
                                    <label class="custom-control custom-radio success ml-4 mt-5 mr-4">
                                        <input type="radio" class="custom-control-input" name="status" value="0"  @if($announcements->status == 0) checked @endif>
                                        <span class="custom-control-label">غیر فعال</span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                 <a href="{{route('announcements.index')}}" class="btn btn-danger btn-lg">برگشت</a>
                                 <button class="btn btn-warning btn-lg">به روزرسانی</button>
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

        //tags
        $('.js-tags-example').select2({
            tags:true
        });
        </script>
@endsection