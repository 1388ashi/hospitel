@extends('admin.layouts.master')
@section('content')
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.css')}}">
<link href="{{asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/notify/css/notifIt-rtl.css')}}" rel="stylesheet" />
<!--Section-->
    <div class="page-main">
        <div class="side-app">
            <!--Page header-->
            <div class="page-header d-xl-flex d-block">
                <div class="page-leftheader">
                    <h4 class="page-title">ثبت آموزش</h4>
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
                            <form action="{{route('articles.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <x-alert-danger></x-alert-danger>
                                    <x-alert-success></x-alert-success>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">عنوان
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
                                            <label class="form-label">خلاصه توضیحات
                                            <i class="mt-1 text-danger" style="color: red">*</i>
                                            </label>
                                            <textarea name="summary" cols="60" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">تصویر آموزش
                                                <i class="mt-1 text-danger" style="color: red">*</i>
                                            </label>
                                            <input  class="form-control" type="file" name="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">یدنه
                                        <i class="mt-1 text-danger" style="color: red">*</i>
                                    </label>
                                    <textarea name="body" id="example"></textarea>
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">منبع آموزش</label>
                                            <input class="form-control" type="text" placeholder="منبع اموزش" name="resource">
                                        </div>
                                    </div>
                                    <br>
                                <div class="custom-controls-stacked d-md-flex">
                                    <label class="form-label mt-1 ml-5">
                                        <i class="text-danger">*</i>
                                        وضعیت:</label>
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
                                 <a href="{{route('articles.index')}}" class="btn btn-danger btn-lg">برگشت</a>
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
