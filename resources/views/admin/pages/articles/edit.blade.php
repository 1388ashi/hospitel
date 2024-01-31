@extends('admin.layouts.master')
@section('content')
<!--Section-->
    <div class="page-main">
            <div class="side-app">
                <!--Page header-->
                <div class="page-header d-xl-flex d-block">
                    <div class="page-leftheader">
                        <h4 class="page-title">ویرایش آموزش</h4>
                    </div>
                </div>
                <!--End Page header-->

                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{route('articles.update', $article->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <x-alert-danger></x-alert-danger>
                                <x-alert-success></x-alert-success>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">عنوان
                                                <i class="mt-1 text-danger" style="color: red">*</i>
                                            </label>
                                            <input type="text" class="form-control" placeholder="تیتر" name="title"  value="@if(old('title')){{old('title')}}@else{{$article->title}}@endif">
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
                                                @php
                                                $selected = $article->category_id==$category->id?'selected':'';
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
                                            <label class="form-label">توضیحات کوتاه
                                                <i class="mt-1 text-danger" style="color: red">*</i>
                                            </label>
                                            <textarea name="summary" cols="50" rows="3">@if(old('summary')){{old('summary')}}@else{{$article->summary}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">تصویر آموزش</label>
                                            <input  class="form-control" type="file" name="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">بدنه
                                        <i class="mt-1 text-danger" style="color: red">*</i>
                                    </label>
                                    <textarea name="body" id="example" >@if(old('body')){{old('body')}}@else{{$article->body}}@endif</textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">منبع آموزش</label>
                                        <input class="form-control" type="text" placeholder="منبع آموزش" name="resource" value="@if(old('resource')){{old('resource')}}@else{{$article->resource}}@endif">
                                    </div>
                                </div>
                                </div>
                                <div class="custom-controls-stacked d-md-flex ml-5 mr-5">
                                    <label class="form-label mt-1 ml-5">
                                        <i class="text-danger">*</i>
                                        وضعیت:</label>
                                    <label class="custom-control custom-radio success ml-4">
                                        <input type="radio" class="custom-control-input" name="status" value="1" @if($article->status == 1) checked @endif>
                                        <span class="custom-control-label">فعال</span>
                                    </label>
                                    <label class="custom-control custom-radio success ml-4">
                                        <input type="radio" class="custom-control-input" name="status" value="0"  @if($article->status == 0) checked @endif>
                                        <span class="custom-control-label">غیر فعال</span>
                                    </label>
                                </div>
                            <div class="card-footer text-right">
                                 <a href="{{route('articles.index')}}" class="btn btn-danger btn-lg">برگشت</a>
                                 <button class="btn btn-warning btn-lg" >به روزرسانی</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Row -->
        </div><!-- end app-content-->
    </div>
</div>

@endsection