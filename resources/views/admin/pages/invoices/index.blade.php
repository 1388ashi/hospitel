@extends('admin.layouts.master')
@section('content')

    <!--Section-->
    <section>
        <div class="cover-image sptb ml-5 mr-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        @include('admin.pages.invoices.includes.filter')
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="card mb-0 table-bordered">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">صورت حساب ها</h4>
                                        
                                        <div class="card-options">
                                            @can('create surguries')
                                            <a href="{{route('admin.filter-doctor')}}" class="btn btn-primary mr-30" data-target="#adddoctors">پرداخت به پزشک</a>
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
                                                        <th class="border-bottom-0 w-5 text-center">نام دکتر</th>
                                                        <th class="border-bottom-0 w-5 text-center">ایجاد صورت حساب</th>
                                                        <th class="border-bottom-0 w-5 text-center">مبلغ کل</th>
                                                        <th class="border-bottom-0 w-5 text-center">وضعیت</th>
                                                        <th class="border-bottom-0 w-5 text-center">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($invoices as $invoice)
                                                    <tr>
                                                        <td class="text-center"><span>{{$invoice->id}}</span></td>
                                                        <td class="text-center "><span>{{$invoice->doctor->name}}</span></td>
                                                        <td class="text-center"><span>{{$invoice->created_at->diffForHumans()}}</span></td>
                                                        <td class="text-center "><span>{{number_format($invoice->amount)}}</span></td>
                                                        {{-- <td class="text-center "><span>@if(empty($invoice->description)){{"ندارد"}}@else{{$invoice->description}}@endif</span></td> --}}
                                                        <td class="text-center">@include('includes.statusInvoice',["status" => $invoice->status])</td>
                                                        </span></td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center">
                                                                @if ($invoice->amount !== $invoice->getSumPaymentAmount())
                                                                    <button type="button" class=" action-btns1"
                                                                        data-toggle="modal"
                                                                        style="background-color: aqua"
                                                                        data-target="#store-menu-{{ $invoice->id }}">
                                                                        <i class="fe fe-dollar-sign text-success" data-toggle="tooltip" aria-hidden="true" data-placement="top" title="پرداخت صورت حساب"></i>
                                                                    </button>
                                                                @endif
                                                                <a href="{{route('admin.invoices.show',[$invoice->id])}}" class="action-btns1" style="background-color: lightblue"  data-target="#viewdoctors">
                                                                        <i class="feather feather-eye text-primary" data-toggle="tooltip" data-placement="top" title="بازدید"></i>
                                                                    </a>
                                                                    <button type="button" class="btn btn-warning btn-sm ml-1"
                                                                    data-toggle="modal"
                                                                    data-target="#edit-menu-{{ $invoice->id }}">
                                                                    <i class="fa fa-edit" aria-hidden="true" title="ویرایش"></i>
                                                                    </button>
                                                                    <button  class="action-btns1 item-delete"  data-toggle="modal" data-target="#deleteModal" data-title="{{$invoice->doctor->name}}" data-id="{{$invoice->id}}">
                                                                        <i class="feather feather-trash-2 text-danger" ></i>
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
                                                                            <span> آیا از حذف صورت حساب</span>
                                                                            <mark id="delete_title"></mark>
                                                                            <span>مطمئن هستید؟</span>
                                                                        </div>
                                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{ route('admin.invoices.destroy',[$invoice->id])}}" method="post">
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
                                        {{$invoices->onEachSide(1)->links("vendor.pagination.bootstrap-4")}}
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
                    Copyright © 2024 <a href="#">Dayone</a>. Designed by <a href="#">Spruko Technologies Pvt.Ltd</a> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    @include('admin.pages.invoices.includes.edit')
    @include('admin.pages.invoices.includes.create-payment')
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