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
                                        <h1 class="card-title font-weight-bolder">عمل ها</h1>
                                        
                                        <div class="card-options">
                                            @can('create operations')
                                            <a href="{{route('admin.create-specialties')}}" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addspecialtie">ثبت عمل جدید</a>
                                            @endcan
                                        </div>
                                    </div>
                                    <x-alert-danger></x-alert-danger>
                                    <x-alert-success></x-alert-success>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter text-nowrap table-hover border table-striped table-bordered " id="support-specialtielist">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0 w-15 text-center">#شناسه</th>
                                                        <th class="border-bottom-0 w-15 text-center">نام</th>
                                                        <th class="border-bottom-0 w-15 text-center">مبلغ(تومان)</th>
                                                        <th class="border-bottom-0 w-15 text-center">وضعیت</th>
                                                        <th class="border-bottom-0 w-15 text-center">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($operations as $operation)
                                                    <tr>
                                                            <td class="text-center"><span>{{$loop->iteration}}</span></td>
                                                            <td class="text-center"><span>{{$operation->name }}</span></td>
                                                            <td class="text-center"><span>{{ number_format($operation->price) }}</span></td>
                                                            <td class="text-center">@include('includes.status',["status" => $operation->status])</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center">
                                                                @can('edit operations')
                                                                    <button type="button" class="btn btn-warning btn-sm ml-1"
                                                                    data-toggle="modal"
                                                                    data-target="#edit-menu-{{ $operation->id }}">
                                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                                    </button>
                                                                @endcan
                                                                @can('delete operations')
                                                                        <button  class="action-btns1 item-delete"  data-toggle="modal" data-target="#deleteModal" data-title="{{$operation->name}}" data-id="{{$operation->id}}">
                                                                            <i class="feather feather-trash-2 text-danger"></i>
                                                                        </button>
                                                                    @endcan
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
                                                                        <form action="{{ route('admin.operations.delete',[$operation->id])}}" method="post">
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
                                                            @empty
                                                            <tr>
                                                                <td>
                                                                    <span class="text-danger">هیچ داده ای یافت نشد</span>
                                                                </td>
                                                            </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade"  id="addspecialtie">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{route('admin.operations.create')}}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <p class="modal-title font-weight-bolder">ثبت عمل جدید</p>
                                                <button  class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="form-label">نام <span class="text-danger">&starf;</span></label>
                                                    <input type="text" class="form-control" placeholder="نام  عمل را وارد کنید" name="name" value="{{old('name')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">مبلغ به تومان<span class="text-danger">&starf;</span></label>
                                                    <input type="text" class="comma form-control" placeholder="مبلغ عمل را وارد کنید" name="price" value="{{old('price')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label mt-1 ml-5">وضعیت: <span class="text-danger">&starf;</span></label>
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
                                            <div class="modal-footer justify-content-center">
                                                <button class="btn btn-outline-danger  text-right item-right" data-dismiss="modal">برگشت</button>
                                                <button  class="btn btn-primary  text-right item-right">ثبت</button>
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
    @can('edit operations')
    @include('admin.pages.operations.includes.edit')
    @endcan
    @endsection
    @section('scripts')
    <script>
        $(document).ready(function () {
            $('input.comma').on('keyup', function(event) {
                if(event.which >= 37 && event.which <= 40) return;
                $(this).val(function(index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
        
        });
    </script>
    @endsection