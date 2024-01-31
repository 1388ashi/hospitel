@extends('admin.layouts.master')
@section('content')
<link href="{{asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/notify/css/notifIt-rtl.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/modal-datepicker/datepicker.css')}}" rel="stylesheet" />
<!--Section-->
    <div class="page-main">
            <div class="side-app">
                <!--Page header-->
                <div class="page-header d-xl-flex d-block">
                    <div class="page-leftheader">
                        <h4 class="page-title">ویرایش خبر</h4>
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
                            <form action="{{route('posts.update',[$post->id])}}" method="post" enctype="multipart/form-data">
                                @method('Put')
                                @csrf
                                <div class="card-body">
                                    <x-alert-danger></x-alert-danger>
                                    <x-alert-success></x-alert-success>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">تیتر
                                                    <i class="text-danger">*</i>
                                                </label>
                                            <input type="text" class="form-control" placeholder="تیتر" name="title"  value="@if(old('title')){{old('title')}}@else{{$post->title}}@endif">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">دسته بندی
                                                <i class="text-danger">*</i>
                                            </label>
                                            <select class="form-control custom-select select2" data-placeholder="Select Package" name="category">
                                                <option selected disabled>- انتخاب کنید  -</option>
                                                @foreach($categories as $category)
                                                @php
                                                $selected = $post->category_id==$category->id?'selected':'';
                                                @endphp
                                                <option value="<?= $category->id ?>" <?= $selected ?>>  {{$category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">رو تیتر
                                                <i class="text-danger">*</i>
                                            </label>
                                    <input type="text" class="form-control" placeholder="رو تیتر" name="subtitle" value="@if(old('subtitle')){{old('subtitle')}}@else{{$post->subtitle}}@endif">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">تصویر خبر
                                                <i class="text-danger">*</i>
                                            </label>
                                            <input  class="form-control" type="file" name="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">توضیحات کوتاه
                                                <i class="text-danger">*</i>
                                            </label>
                                            <textarea name="summary" cols="50" rows="3">@if(old('summary')){{old('summary')}}@else{{$post->summary}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label ml-2">برچسب ها
                                                <i class="text-danger">*</i>
                                            </label>
                                            <select class="form-control js-tags-example" name="tags[]" data-placeholder="هشتگ را انتخاب کنید" multiple="multiple">             
                                                @foreach($tags as $tag)
                                                    <option @if(in_array($tag->id, $tag_ids)) selected="selected" @endif>{{$tag->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group d-flex mt-5">
                                            <label class="form-label mt-1 ml-5">
                                                <i class="text-danger">*</i>
                                                ویژه:</label>
                                            <label class="custom-control custom-radio success ml-5">
												<input type="radio" class="custom-control-input" name="featured" value="1"  @if($post->featured == 1) checked @endif>
												<span class="custom-control-label">فعال</span>
											</label>
											<label class="custom-control custom-radio success ml-4">
                                                <input type="radio" class="custom-control-input" name="featured" value="0"  @if($post->featured == 0) checked @endif>
												<span class="custom-control-label">غیر فعال</span>
											</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group d">
                                            <label class="form-label">زمان انتشار</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="feather feather-calendar"></i>
                                                    </div>
                                                </div>
                                                <input class="form-control fc-datepicker" id="payment_date_show" placeholder="تاریخ انتشار" type="text" autocomplete="off" value=" @if(old('published_at')) {{verta(old('published_at', today()->format('Y-m-d')))->format('Y-m-d') }} @else{{$post->published_at}} @endif">
                                                <input name="payment_date" id="payment_date" type="hidden" value="{{ old('published_at', today()->format('Y-m-d')) }}">
                                            </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">بدنه
                                        <i class="text-danger">*</i>
                                    </label>
                                    <textarea name="body" id="example" cols="100" rows="4">@if(old('body')){{old('body')}}@else{{$post->body}}@endif</textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">منبع خبر</label>
                                        <input class="form-control" type="text" placeholder="منبع خبر" name="resource_url" value="@if(old('resource_url')){{old('resource_url')}}@else{{$post->resource_url}}@endif">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">نامک
                                                <i class="mt-1 text-danger" style="color: red">*</i>
                                            </label>
                                            <input class="form-control" type="text" placeholder="اسلاگ" name="slug"  value="@if(old('resource_url')){{old('resource_url')}}@else{{$post->slug}}@endif">
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="custom-controls-stacked d-md-flex">
                                    <label class="form-label mt-1 ml-5">
                                        <i class="text-danger">*</i>
                                        وضعیت :</label>
                                    <label class="custom-control custom-radio success ml-4">
                                        <input type="radio" class="custom-control-input" name="status" value="1"  @if($post->status == 1) checked @endif>
                                        <span class="custom-control-label">فعال</span>
                                    </label>
                                    <label class="custom-control custom-radio success ml-4">
                                        <input type="radio" class="custom-control-input" name="status" value="0"  @if($post->status == 0) checked @endif>
                                        <span class="custom-control-label">غیر فعال</span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                 <a href="{{route('posts.index')}}" class="btn btn-danger btn-lg">برگشت</a>
                                 <button class="btn btn-warning btn-lg" >به روز رسانی</button>
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