@extends('admin.layouts.master')
@section('content')

    <!--Section-->
    <section>
        <div class="cover-image sptb ml-5 mr-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        @include('admin.pages.news.filter')
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="card mb-0 table-bordered">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">خبر ها</h4>
                                        <div class="card-options">
                                            <a href="{{route('posts.create')}}" class="btn btn-primary mr-30" data-target="#addposts">ثبت خبر جدید</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <x-alert-danger></x-alert-danger>
                                        <x-alert-success></x-alert-success>
                                        <div class="table-responsive">
                                            <table class="table table-vcenter text-nowrap table-hover border table-striped" id="support-categorylist">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0 w-5">#شناسه</th>
                                                        <th class="border-bottom-0 w-5 text-center">دسته بندی</th>
                                                        <th class="border-bottom-0 w-5 text-center">تیتر</th>
                                                        <th class="border-bottom-0 w-5 text-center">رو تیتر</th>
                                                        <th class="border-bottom-0 w-5 text-center">خلاصه توضیحات</th>
                                                        <th class="border-bottom-0 w-5 text-center">وضعیت</th>
                                                        <th class="border-bottom-0 w-5 text-center">زمان انتشار</th>
                                                        <th class="border-bottom-0 w-5 text-center">عکس</th>
                                                        <th class="border-bottom-0 w-5 text-center">ویژه</th>
                                                        <th class="border-bottom-0 w-5 text-center">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($posts as $post)
                                                        <tr>
                                                            <td class="text-center"><span>{{$loop->iteration}}</span></td>
                                                            <td class="text-center "><span>{{$post->category->name}}</span></td>
                                                            <td class="text-center "><span>{{$post->title}}</span></td>
                                                            <td class="text-center "><span>{{$post->subtitle}}</span></td>
                                                            <td class="text-center "><span>{{Str::limit($post->summary,60, '...')}}</span></td>
                                                            <td class="text-center">@include('includes.status',["status" => $post->status])</td>
                                                            @php
                                                            $vertaDate = verta($post->published_at);
                                                            @endphp
                                                            <td class="text-center"><span>{{$vertaDate->format('Y/n/j')}}</span></td>
                                                            <td><a href="{{Storage::url($post->image)}}" target="blank"><img src="{{Storage::url($post->image)}}" style="width: 90px"></a></td>
                                                            <td class="text-center">@include('includes.status',["status" => $post->featured])</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="{{route('posts.show',[$post->id])}}" class="action-btns1">
                                                                        <i class="feather feather-eye text-primary" data-toggle="tooltip" data-placement="top" title="نمایش"></i>
                                                                    </a>
                                                                    <a href="{{route('posts.edit',[$post->id])}}" class="action-btns1"  data-target="#viewpost">
                                                                        <i class="feather feather-edit text-warning" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                                    </a>
                                                                        <button  class="action-btns1 item-delete"  data-toggle="modal" data-target="#deleteModal" data-title="{{$post->title}}"  data-id="{{$post->id}}">
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
                                                                        <form action="{{route('posts.destroy',[$post->id])}}" method="post">
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