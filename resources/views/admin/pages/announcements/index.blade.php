@extends('admin.layouts.master')
@section('content')

    <!--Section-->
    <section>
        <div class="cover-image sptb ml-5 mr-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        @include('admin.pages.announcements.filter')
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="card mb-0 table-bordered">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">اطلاعیه ها</h4>
                                        
                                        <div class="card-options">
                                            <a href="{{route('announcements.create')}}" class="btn btn-primary mr-30" data-target="#addposts">ثبت اطلاعیه جدید</a>
                                        </div>
                                    </div>
                                    <x-alert-danger></x-alert-danger>
                                    <x-alert-success></x-alert-success>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter text-nowrap table-hover border table-striped" id="support-categorylist">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0 w-5">#شناسه</th>
                                                        <th class="border-bottom-0 w-5 text-center">نویسنده</th>
                                                        <th class="border-bottom-0 w-5 text-center">تیتر</th>
                                                        <th class="border-bottom-0 w-5 text-center">خلاصه توضیحات</th>
                                                        <th class="border-bottom-0 w-5 text-center">تصویر</th>
                                                        <th class="border-bottom-0 w-5 text-center">وضعیت</th>
                                                        <th class="border-bottom-0 w-5 text-center">زمان انتشار</th>
                                                        <th class="border-bottom-0 w-5 text-center">تعداد بازدید</th>
                                                        <th class="border-bottom-0 w-5 text-center">تاریخ ساخت</th>
                                                        <th class="border-bottom-0 w-5 text-center">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($Announcements   as $item)
                                                    <tr>
                                                            <td class="text-center"><span>{{$loop->iteration}}</span></td>
                                                            <td class="text-center"><span>{{$item->user->name}}</span></td>
                                                            <td class="text-center "><span>{{$item->title}}</span></td>
                                                            <td class="text-center "><span>{{$item->summary}}</span></td>
                                                            <td><a href="{{Storage::url($item->image)}}" target="blank"><img src="{{Storage::url($item->image)}}" style="width: 90px"></a></td>
                                                            <td class="text-center">@include('includes.status',["status" => $item->status])</td>
                                                            @php
                                                            $inputDate = $item->published_at;
                                                            $gregorianDate = \DateTime::createFromFormat('Y/m/d', $inputDate);
                                                            $jalaliDate = Morilog\Jalali\Jalalian::fromDateTime($gregorianDate);
                                                            $convertedDate = $jalaliDate->format('Y/m/d');
                                                            @endphp
                                                            <td class="text-center"><span>{{ $convertedDate }}</span></td>
                                                            <td class="text-center "><span>{{$item->views_count}}</span></td>
                                                            <td class="text-center"><span>{{$item->created_at->diffForHumans()}}</span></td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="{{route('announcements.show',[$item->id])}}" class="action-btns1">
                                                                        <i class="feather feather-eye text-primary" data-toggle="tooltip" data-placement="top" title="نمایش"></i>
                                                                    </a>
                                                                    <a href="{{route('announcements.edit',[$item->id])}}" class="action-btns1"  data-target="#viewannouncements">
                                                                        <i class="feather feather-edit text-warning" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                                    </a>
                                                                        <button  class="action-btns1 item-delete"  data-toggle="modal" data-target="#deleteModal" data-title="{{$item->title}}" data-id="{{$item->id}}">
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
                                                                        <form action="{{route('announcements.destroy',[$item->id])}}" method="post">
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
        <footer class="text-white footer-support">
            <div class="footer-main">
                <div class="col-lg-12 col-sm-12 pt-5 pb-5 text-center">
                    <p class="mb-0">Copyright © 2021 <a href="#" class="fs-14 text-primary">Dayone</a>. Designed by <a href="#" class="fs-14 text-primary"> Spruko Technologies Pvt.Ltd </a>All rights reserved. </p>
                </div>
            </div>
        </footer>
    @endsection