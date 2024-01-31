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
                                <div class="card mb-0 table-bordered">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">لینک ها</h4>
                                        <div class="card-options">
                                            <a href="{{route('links.create')}}" class="btn btn-primary mr-30" data-target="#addlinks">ثبت لینک جدید</a>
                                        </div>
                                    </div>
                                    <x-alert-success></x-alert-success>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter text-nowrap table-hover border table-striped" id="support-categorylist">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0 w-5">#شناسه</th>
                                                        <th class="border-bottom-0 w-5 text-center">تیتر</th>
                                                        <th class="border-bottom-0 w-5 text-center">رو تیتر</th>
                                                        <th class="border-bottom-0 w-5 text-center">وضعیت</th>
                                                        <th class="border-bottom-0 w-5 text-center">عکس</th>
                                                        <th class="border-bottom-0 w-5 text-center">تاریخ ساخت</th>
                                                        <th class="border-bottom-0 w-5 text-center">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($links as $link)
                                                    <tr>
                                                            <td class="text-center"><span>{{$loop->iteration}}</span></td>
                                                            <td class="text-center "><span>{{$link->title}}</span></td>
                                                            <td class="text-center "><span>{{$link->subtitle}}</span></td>
                                                            <td class="text-center">@include('includes.status',["status" => $link->status])</td>
                                                            <td><a href="{{Storage::url($link->image)}}" target="blank"><img src="{{Storage::url($link->image)}}" style="width: 90px"></a></td>
                                                            <td class="text-center"><span>{{$link->created_at->diffForHumans()}}</span></td>
                                                        
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="{{route('links.edit',[$link->id])}}" class="action-btns1"  data-target="#viewlinks">
                                                                        <i class="feather feather-edit text-warning" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                                    </a>
                                                                    
                                                                        <button  class="action-btns1 item-delete"  data-toggle="modal" data-target="#deleteModal" data-title="{{$link->title}}" data-id="{{$link->id}}">
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
                                                                        <form action="{{ route('links.destroy',[$link->id])}}" method="post">
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
                                                        <div class="alert alert-danger">هیچ داده ای یافت نشد</div>       
                                                        @endforelse
                                                </tbody>
                                            </table>
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