@extends('admin.layouts.master')
@section('content')
    <!--Section-->
    <section>
        <div class="cover-image sptb ml-5 mr-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="card mb-0">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">دسته بندی ها</h4>
                                        
                                        <div class="card-options">
                                            <a href="{{route('categories.create')}}" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addcategory">ثبت دسته بندی جدید</a>
                                        </div>
                                    </div>
                                    <x-alert-success></x-alert-success>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter text-nowrap table-hover border table-striped" id="support-categorylist">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0 w-5">#شناسه</th>
                                                        <th class="border-bottom-0 w-5 text-center">عنوان</th>
                                                        <th class="border-bottom-0 w-5 text-center">وضعیت</th>
                                                        <th class="border-bottom-0 w-5 text-center">نوع</th>
                                                        <th class="border-bottom-0 w-5 text-center">نامک</th>
                                                        <th class="border-bottom-0 w-5 text-center">تاریخ</th>
                                                        <th class="border-bottom-0 w-2">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($categories as $category)
                                                    <tr>
                                                            <td class="text-center"><span>{{$loop->iteration}}</span></td>
                                                            <td class="text-center"><span>{{$category->name}}</span></td>
                                                            <td class="text-center">@include('includes.status',["status" => $category->status])</td>
                                                            <td class="text-center"><span>@if($category->type == 'news'){{'خبری'}}@else {{'آموزشی'}} @endif</span></td>
                                                            <td class="text-center"><span>@if(empty($category->slug)){{"ندارد"}}@else{{$category->slug}}@endif</span></td>
                                                            <td class="text-center"><span>{{$category->created_at->diffForHumans()}}</span></td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="{{route('categories.edit',[$category->id])}}" class="action-btns1">
                                                                        <i class="feather feather-edit text-warning" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                                    </a>
                                                                    
                                                                        <button  class="action-btns1 item-delete"  data-toggle="modal" data-target="#deleteModal" data-title="{{$category->name}}" data-id="{{$category->id}}">
                                                                            <i class="feather feather-trash-2 text-danger"></i>
                                                                        </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                        
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                        
                                                                        <div>
                                                                            <span>آیا از حذف</span>
                                                                            <mark id="delete_title"></mark>
                                                                            <span>مطمئن هستید؟</span>
                                                                        </div>
                                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{ route('categories.destroy',[$category->id])}}" method="post">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <input type="hidden" name="type" value="cat_delete">
                                                                            <input type="hidden" name="item_id" id="item_id" value="">
                                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">انصراف</button>
                                                                            <button type="submit" class="btn btn-danger">حذف شود</button>
                                                                        </form>                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <td class="text-center"> <h4 class="text-danger">داده ای یافت نشد</h4></td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade"  id="addcategory">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{route('categories.store')}}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">ثبت دسته بندی جدید</h5>
                                                <button  class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="form-label">عنوان
                                                        <i class="mt-1 text-danger" style="color: red">*</i>
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">نامک</label>
                                                    <input type="text" class="form-control" placeholder="slug" name="slug" value="{{old('slug')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label mt-1 ml-5">
                                                        <i class="text-danger">*</i>
                                                        نوع:</label>
                                                        <label class="custom-control custom-radio success ml-4">
                                                            <input type="radio" class="custom-control-input" name="type" value="article">
                                                            <span class="custom-control-label">آموزشی</span>
                                                        </label>
                                                        <label class="custom-control custom-radio success ml-4">
                                                            <input type="radio" class="custom-control-input" name="type"  value="news">
                                                            <span class="custom-control-label">خبری</span>
                                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label mt-1 ml-5">
                                                        <i class="text-danger">*</i>
                                                        وضعیت:</label>
                                                        <label class="custom-control custom-radio success ml-4">
                                                            <input type="radio" class="custom-control-input" name="status" value="1">
                                                            <span class="custom-control-label">فعال</span>
                                                        </label>
                                                        <label class="custom-control custom-radio success ml-4">
                                                            <input type="radio" class="custom-control-input" name="status" value="0">
                                                            <span class="custom-control-label">غیر فعال</span>
                                                        </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-outline-danger" data-dismiss="modal">برگشت</button>
                                                <button  class="btn btn-success">ثبت</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                    Copyright © 2021 <a href="#">Dayone</a>. Designed by <a href="#">Spruko Technologies Pvt.Ltd</a> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    @endsection