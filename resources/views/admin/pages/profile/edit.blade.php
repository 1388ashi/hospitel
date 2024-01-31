@extends('admin.layouts.master')
@section('content')
<div class="page">
    <div class="page-main">
        <div class="app-content main-content" style="margin-right:0px;margin-top:1px;">
            <div class="side-app">

                <div class="page-header d-lg-flex d-block">
                    <div class="page-leftheader">
                        <h4 class="page-title">ویرایش پروفایل</h4>
                    </div>
                </div>
                <!--End Page header-->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12 col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <x-alert-danger></x-alert-danger>
                                <x-alert-success></x-alert-success>
                                <div class="card-title">ویرایش پروفایل:</div>
                                <form action="{{route('admin-profile-update',[$user->id])}}" method="post">
                                    @csrf
                                    @method('Put')
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">نام کاربری</label>
                                            <input type="text" class="form-control" placeholder="Name" name="name" value="@if(old('name')){{old('name')}}@else{{$user->name}}@endif">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">آدرس ایمیل</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email" value="@if(old('email')){{old('email')}}@else{{$user->email}}@endif">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">شماره تلفن</label>
                                            <input type="number" class="form-control" placeholder="Number" name="phone" value="@if(old('phone')){{old('phone')}}@else{{$user->phone}}@endif">
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button  class="btn btn-lg btn-warning">به روزرسانی</button>
                                        <button  class="btn btn-lg btn-danger">برگشت</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row-->

            </div>
        </div><!-- end app-content-->
    </div>
</div>
@endsection