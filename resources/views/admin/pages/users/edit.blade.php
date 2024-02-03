@extends('admin.layouts.master')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card">
        <div class="card-header border-bottom-0 d-flex justify-content-between">
            <p class="card-title font-weight-bolder">ویرایش ادمین</p>
        </div>
        <div class="card-body">
            <x-alert-danger></x-alert-danger>
            <x-alert-success></x-alert-success>
            <form action="{{route('admin.users.update',[$admin->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("put")
            <div class="row">
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">نام </label><span class="text-danger">&starf;</span>
                    <input type="text" name="name" class="form-control"  placeholder="نام را اینجا وارد کنید" value="{{$admin->name}}" required>
                </div>
                </div>
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">تلفن همراه</label><span class="text-danger">&starf;</span>
                    <input type="text" name="mobile" class="form-control" placeholder="شماره تلفن را اینجا وارد کنید" value="{{$admin->mobile}}" required>
                </div>
                </div>
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">ایمیل</label>
                    <input type="email" name="email" placeholder=" ایمیل را اینجا وارد کنید" value="{{$admin->email}}" class="form-control">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">کلمه عبور</label><span class="text-danger">&starf;</span>
                        <input type="password" name="password" class="form-control"  placeholder="کلمه عبور را اینجا وارد کنید" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold"> تکرار کلمه عبور</label><span class="text-danger">&starf;</span>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="کلمه عبور را دوباره اینجا وارد کنید" required>
                    </div>
                </div>
            </div>
            <div class="row ml-2 mt-1">
                <div class="col-12">
                    @foreach ( $permission_all  as $item)
                            <label class="mt-2 ml-1 mr-8">{{ $item->label }}</label>
                            <input type="checkbox" name="permissions[]" value="{{ $item->id }}"  {{ $admin->getDirectPermissions()->contains($item) ? 'checked' : '' }}>
                    @endforeach
                    {{-- @if($item->user->name) @checked(true) @endif --}}
                </div>
            </div>
            <div class="card-footer text-right mt-1">
                <a href="{{route('admin.users.index')}}" class="btn btn-danger btn-lg">برگشت</a>
                <button class="btn btn-warning btn-lg" >ویرایش</button>
            </div>
            </form>
        </div>
        </div>
    </div>
@endsection
