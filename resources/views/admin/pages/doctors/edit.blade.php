@extends('admin.layouts.master')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card">
        <div class="card-header border-bottom-0 d-flex justify-content-between">
            <p class="card-title font-weight-bolder">ویرایش دکتر</p>
        </div>
        <div class="card-body">
            <x-alert-danger></x-alert-danger>
            <x-alert-success></x-alert-success>
            <form action="{{route('admin.doctors.update',[$doctor->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("put")
            <div class="row">
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">نام </label><span class="text-danger">&starf;</span>
                    <input type="text" name="name" class="form-control"  placeholder="نام را اینجا وارد کنید" value="@if(old('name')){{old('name')}}@else{{$doctor->name}}@endif" required>
                </div>
                </div>
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">تلفن همراه</label><span class="text-danger">&starf;</span>
                    <input type="text" name="mobile" class="form-control" placeholder="شماره تلفن را اینجا وارد کنید" value="@if(old('mobile')){{old('mobile')}}@else{{$doctor->mobile}}@endif" required>
                </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">کد ملی</label>
                        <input type="text" name="national_code" placeholder=" کد ملی را اینجا وارد کنید"   value="@if(old('national_code')){{old('national_code')}}@else{{$doctor->national_code}}@endif" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">نقش دکتر</label><span class="text-danger">&starf;</span>
                        <select class="form-control js-tags-example" name="roles[]" data-placeholder="نقش را انتخاب کنید" multiple="multiple">             
                            @foreach($roles as $role)
                                <option @if(in_array($role->id, $doctorRolesIds)) selected="selected" @endif>{{$role->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">تخصص</label><span class="text-danger">&starf;</span>
                        <select class="form-control custom-select select2" data-placeholder="Select Package" name="speciality_id">
                            <option selected disabled>- انتخاب کنید  -</option>
                            @foreach($specialitys as $speciality)
                            @php
                            $selected = $doctor->specialties_id==$speciality->id?'selected':'';
                            @endphp
                            <option value="<?= $speciality->id ?>" <?= $selected ?>>  {{$speciality->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">شماره نظام پزشکی </label>
                        <input type="text" name="medical_number" class="form-control"  placeholder="شماره نظام پزشکی وارد کنید" value="@if(old('national_code')){{old('national_code')}}@else{{$doctor->national_code}}@endif">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">ایمیل</label>
                        <input type="email" name="email" placeholder=" ایمیل را اینجا وارد کنید" value="{{$doctor->email}}" class="form-control">
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
                <button class="btn btn-warning btn-lg" >ویرایش</button>
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
