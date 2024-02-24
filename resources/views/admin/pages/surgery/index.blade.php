@extends('admin.layouts.master')
@section('content')

    <!--Section-->
    <section>
        <div class="cover-image sptb ml-5 mr-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        @include('admin.pages.surgery.filter')
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="card mb-0 table-bordered">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">جراحی ها</h4>
                                        
                                        <div class="card-options">
                                            @can('create surguries')
                                            <a href="{{route('admin.surgeries.create')}}" class="btn btn-primary mr-30" data-target="#adddoctors">ثبت جراحی جدید</a>
                                            @endcan
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
                                                        <th class="border-bottom-0 w-5 text-center">نام بیمار</th>
                                                        <th class="border-bottom-0 w-5 text-center">کد ملی بیمار</th>
                                                        <th class="border-bottom-0 w-5 text-center">شماره سند</th>
                                                        <th class="border-bottom-0 w-5 text-center"> عمل ها</th>
                                                        <th class="border-bottom-0 w-5 text-center">تاریخ عمل</th>
                                                        <th class="border-bottom-0 w-5 text-center">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($surguries as $surgery)
                                                    <tr>
                                                        <td class="text-center"><span>{{$loop->iteration}}</span></td>
                                                        <td class="text-center "><span>{{$surgery->patient_name}}</span></td>
                                                        <td class="text-center "><span>{{$surgery->patient_national_code}}</span></td>
                                                        <td class="text-center "><span>{{$surgery->document_number}}</span></td>
                                                        <td class="text-center "><span>
                                                            @foreach($surgery->operations as $key => $item)
                                                            {{$item->name}}
                                                            @if($key < $surgery->operations->count() - 1),@endif
                                                        @endforeach
                                                        </span></td>
                                                            @php
                                                            $vertaDate = verta($surgery->surgeried_at);
                                                            @endphp
                                                            <td class="text-center"><span>{{$vertaDate->format('Y/n/j')}}</span></td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="{{route('admin.surgeries.show',[$surgery->id])}}" class="action-btns1"  data-target="#viewdoctors">
                                                                        <i class="feather feather-eye text-primary" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                                    </a>
                                                                @can('edit doctors')
                                                                    <a href="{{route('admin.surgeries.edit',[$surgery->id])}}" class="action-btns1"  data-target="#viewdoctors">
                                                                        <i class="feather feather-edit text-warning" data-toggle="tooltip" data-placement="top" title="ویرایش"></i>
                                                                    </a>
                                                                    @endcan
                                                                    @can('delete doctors')
                                                                    <button  class="action-btns1 item-delete"  data-toggle="modal" data-target="#deleteModal" data-title="{{$surgery->patient_name}}" data-id="{{$surgery->id}}">
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
                                                                        <form action="{{ route('admin.surgeries.destroy',[$surgery->id])}}" method="post">
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
                                                        <tr>
                                                            <td>
                                                                <span class="text-danger">هیچ داده ای یافت نشد</span>
                                                            </td>
                                                        </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{$surguries->onEachSide(1)->links("vendor.pagination.bootstrap-4")}}
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