@extends('admin.layouts.master')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card">
        <div class="card-header border-bottom-0 d-flex justify-content-between">
            <p class="card-title font-weight-bolder">ثبت دکتر جدید</p>
        </div>
        <div class="card-body">
            <x-alert-danger></x-alert-danger>
            <x-alert-success></x-alert-success>
            <form action="{{route('admin.doctors.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">نام </label><span class="text-danger">&starf;</span>
                    <input type="text" name="name" class="form-control"  placeholder="نام را اینجا وارد کنید" required value="{{old('name')}}">
                </div>
                </div>
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">تلفن همراه</label><span class="text-danger">&starf;</span>
                    <input type="text" name="mobile" class="form-control" placeholder="شماره تلفن را اینجا وارد کنید" value="{{old('mobile')}}" required>
                </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">تخصص</label><span class="text-danger">&starf;</span>
                        <select class="form-control custom-select select2" data-placeholder="Select Package" name="speciality_id">
                            <option selected disabled>- انتخاب کنید  -</option>
                            @foreach($specialitys as $speciality)
                            <option value="{{$speciality->id}}">{{$speciality->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">نقش دکتر</label><span class="text-danger">&starf;</span>
                    <select class="form-control js-tags-example" name="roles[]" data-placeholder="نقش را انتخاب کنید" id="tags" multiple="multiple">             
                        @foreach($roles as $role)
                        <option value="{{$role->title}}">{{$role->title}}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">شماره نظام پزشکی </label>
                    <input type="text" name="medical_number" class="form-control"  placeholder="شماره نظام پزشکی وارد کنید" value="{{old('medical_number')}}">
                </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">کد ملی</label>
                        <input type="text" name="national_code" placeholder=" کد ملی را اینجا وارد کنید" value="{{old('national_code')}}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">کلمه عبور</label><span class="text-danger">&starf;</span>
                        <input type="password" name="password" class="form-control" placeholder="کلمه عبور را اینجا وارد کنید" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold"> تکرار کلمه عبور</label><span class="text-danger">&starf;</span>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="کلمه عبور را دوباره اینجا وارد کنید" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">ایمیل</label>
                        <input type="email" name="email" placeholder=" ایمیل را اینجا وارد کنید" value="{{old('email')}}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label mt-1 ml-5">وضعیت: <span class="text-danger">&starf;</span></label>
                    <div class="d-flex">
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
                </div>
            <div class="card-footer text-right mt-1">
                <a href="{{route('admin.doctors.index')}}" class="btn btn-danger btn-lg">برگشت</a>
                <button class="btn btn-primary btn-lg" >ثبت</button>
            </div>
            </form>
        </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        //tags
        $('.js-tags-example').select2({
            tags:true
        });
    </script>
@endsection
