@extends('admin.layouts.master')
@section('content')


<link href="{{asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />


    

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
                                        <h4 class="card-title">تگ ها</h4>
                                        
                                        <div class="card-options">
                                            <a href="{{route('tags.index')}}" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addtag">ثبت تگ جدید</a>
                                        </div>
                                    </div>
                                    <x-alert-danger></x-alert-danger>
                                    <x-alert-success></x-alert-success>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter text-nowrap table-hover border table-striped" id="support-taglist">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0 w-5 text-center">#id</th>
                                                        <th class="border-bottom-0 w-5 text-center">عنوان</th>
                                                        <th class="border-bottom-0 w-5 text-center">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($tags as $tag)
                                                    <tr>
                                                            <td class="text-center"><span>{{$loop->iteration}}</span></td>
                                                            <td class="text-center"><span>{{$tag->name}}</span></td>

                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="{{route('tags.update',[$tag->id])}}" class="action-btns1"  data-target="#viewtag">
                                                                        <i class="feather feather-edit text-warning" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                                    </a>
                                                                    
                                                                        <button  class="action-btns1 item-delete"  data-toggle="modal" data-target="#deleteModal" data-title="{{$tag->name}}" data-id="{{$tag->id}}">
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
                                                                        <form action="{{route('tags.destroy',[$tag->id])}}" method="post">
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
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade"  id="addtag">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{route('tags.store')}}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">ثبت تگ جدید</h5>
                                                <button  class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="form-label">عنوان
                                                        <i class="text-danger">*</i>
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}">
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