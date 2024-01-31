@extends('admin.layouts.master')
@section('content')
<!--Section-->
    <div class="page-main">
            <div class="side-app">
            <!--Page header-->
            <div class="page-header d-xl-flex d-block">
                <div class="page-leftheader">
                    <h4 class="page-title">ثبت خبر</h4>
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
                        <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
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
                                        <label class="form-label">دسته بندی
                                            <i class="mt-1 text-danger" style="color: red">*</i>
                                        </label>
                                        <select class="form-control custom-select select2" data-placeholder="Select Package" name="category">
                                            <option selected disabled>- انتخاب کنید  -</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">رو تیتر
                                            <i class="mt-1 text-danger" style="color: red">*</i>
                                        </label>
                                        <input class="form-control" type="text" placeholder="رو تیتر" name="subtitle">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">نامک
                                            <i class="mt-1 text-danger" style="color: red">*</i>
                                        </label>
                                        <input class="form-control" type="text" placeholder="اسلاگ" name="slug">
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
                                    <div class="form-group">
                                        <label class="form-label">تصویر خبر
                                            <i class="mt-1 text-danger" style="color: red">*</i>
                                        </label>
                                        <input  class="form-control" type="file" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">بدنه
                                    <i class="mt-1 text-danger" style="color: red">*</i>
                                </label>
                                    <textarea name="body" id="example" cols="100" rows="4"></textarea>
                                </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">منبع خبر</label>
                                        <input class="form-control" type="text" placeholder="منبع خبر" name="resource_url">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">برچسب ها
                                            <i class="mt-1 text-danger" style="color: red">*</i>
                                        </label>
                                        <select class="form-control js-tags-example" name="tags[]" data-placeholder="هشتگ را انتخاب کنید" id="tags" multiple="multiple">             
                                            @foreach($tags as $tag)
                                            <option value="{{$tag->name}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row d-flex">            
                                <div class="col-md-6">
                                    <div class="form-group d-flex mt-5">
                                        <label class="form-label mt-1 ml-5">ویژه
                                            <i class="text-danger">*</i></label>
                                    <label class="custom-control custom-radio success ml-5">
                                        <input type="radio" class="custom-control-input" name="featured" value="1" checked>
                                        <span class="custom-control-label">فعال</span>
                                    </label>
                                    <label class="custom-control custom-radio success ml-4">
                                        <input type="radio" class="custom-control-input" name="featured" value="0">
                                        <span class="custom-control-label">غیر فعال</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
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
                            <div class="custom-controls-stacked d-md-flex">
                                <label class="form-label mt-1 ml-5">وضعیت
                                    <i class="text-danger">*</i></label>
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
                                <a href="{{route('posts.index')}}" class="btn btn-danger btn-lg">برگشت</a>
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