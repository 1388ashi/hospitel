@extends('admin.layouts.master')
@section('content')
<div class="row mx-4 my-4">
    <div class="col-xl-10 col-md-12 col-lg-12">
        <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
            <div class="tab-content">
                <div class="tab-pane active" id="tab5">
                    <div class="card-body">
                        <h3 class="page-title mb-3">اطلاعات اعلان {{$notification->title}} </h3>
                        <div class="d-flex justify-content-center align-items-center">
                            @php
                            $vertaDate = verta($notification->created_at);
                            @endphp
                            <ul class="mb-0 d-md-flex " style="">
                                <li class="ml-5" style="position: absolute;left:10px;top:40px" data-placement="top" data-toggle="tooltip" title="تاریخ اعلان">
                                    <a class="icons" > <i class="feather feather-calendar"></i>{{$vertaDate->format('Y/n/j')}}</a>
                                </li>
                            </ul>
                        </div>
                        <p>{{$notification->body}}</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="icons">
                        <a class="btn btn-danger icons" href="{{route('admin.invoice.index')}}"> برگشت</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        @endsection