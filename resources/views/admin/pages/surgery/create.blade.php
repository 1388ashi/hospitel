@extends('admin.layouts.master')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card">
        <div class="card-header border-bottom-0 d-flex justify-content-between">
            <p class="card-title font-weight-bolder">ثبت جراحی جدید</p>
        </div>
        <div class="card-body">
            <x-alert-danger></x-alert-danger>
            <x-alert-success></x-alert-success>
            <form action="{{route('admin.surgeries.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">نام بیمار</label><span class="text-danger">&starf;</span>
                    <input type="text" name="patient_name" class="form-control"  placeholder="نام بیمار را اینجا وارد کنید" required value="{{old('patient_name')}}">
                </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">کد ملی بیمار</label><span class="text-danger">&starf;</span>
                        <input type="text" name="patient_national_code" placeholder=" کد ملی را اینجا وارد کنید" value="{{old('patient_national_code')}}" required class="form-control">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">شماره سند</label><span class="text-danger">&starf;</span>
                        <input type="text" name="document_number" placeholder="شماره سند را اینجا وارد کنید" value="{{old('document_number')}}" required class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="font-weight-bold">نام عمل ها</label><span class="text-danger">&starf;</span>
                            <select class="form-control js-tags-example" name="operations[]" data-placeholder="نقش را انتخاب کنید" id="tags" multiple="multiple">             
                                @foreach($operations as $operations)
                                <option value="{{$operations->id}}">{{$operations->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">تاریخ عمل</label><span class="text-danger">&starf;</span>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="feather feather-calendar"></i>
                                </div>
                            </div>
                            <input class="form-control fc-datepicker" id="payment_date_show" placeholder="تاریخ عمل" type="text" autocomplete="off" value="{{ verta(old('surgeried_at', today()->format('Y-m-d')))->format('Y-m-d') }}">
                            <input name="surgeried_at" id="payment_date" type="hidden" value="{{old('surgeried_at', today()->format('Y-m-d')) }}">
                        </div>
                    </div>
                    </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label">تاریخ ترخیص</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="feather feather-calendar"></i>
                                </div>
                            </div>
                            <input class="form-control fc-datepicker" id="payment_date_show2" placeholder="تاریخ ترخیص" type="text" autocomplete="off" value="{{ verta(old('released_at', today()->format('Y-m-d')))->format('Y-m-d') }}">
                            <input name="released_at" id="payment_date2" type="hidden" value="{{old('released_at', today()->format('Y-m-d')) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="align-items: center;justify-content: center">
                <div class="col-4">
                    <div class="form-group">
                        <label class="ml-1 mr-5">بیمه پایه</label>
                        <select class="form-control custom-select select2" data-placeholder="Select Package" name="insurance_basic">
                            <option selected disabled>- بیمه پایه را انتخاب کنید  -</option>
                            @foreach($insurance_basic as $basic)
                            <option value="{{$basic->id}}" @selected($basic->id == old('insurance_basic'))>{{$basic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="ml-1 mr-5">بیمه تکمیلی</label>
                        <select class="form-control custom-select select2" data-placeholder="Select Package" name="insurance_supplementary">
                            <option selected disabled>- بیمه تکمیلی را انتخاب کنید  -</option>
                            @foreach($insurance_supplementary as $supplementary)
                            <option value="{{$supplementary->id}}" @selected($supplementary->id == old('insurance_supplementary'))>{{$supplementary->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                @foreach($doctor_roles as $doctor_role)
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">{{$doctor_role->title}}</label>
                        @if($doctor_role->required === 1)
                        <span class="text-danger">&starf;</span>
                        @endif
                        <select class="form-control custom-select select2" data-placeholder="Select Package" name="doctors[{{$doctor_role->id}}]">
                            <option selected disabled>- دکتر را انتخاب کنید  -</option>
                            @foreach($doctor_role->doctors as $doctors)
                            <option value="{{$doctors->id}}"  @selected(in_array($doctors->id, old('doctors', [])))>{{$doctors->name}} - متخصص {{$doctors->specialtie->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <label class="form-label ml-2">توضیحات</label>
                <textarea name="description"  cols="100" rows="4">{!! old('description') !!}</textarea>
            </div>
            <div class="card-footer text-right mt-1">
                <a href="{{route('admin.surgeries.index')}}" class="btn btn-danger btn-lg">برگشت</a>
                <button class="btn btn-primary btn-lg" >ثبت</button>
            </div>
            </form>
        </div>
        </div>
    </div>
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
    $('#payment_date_show2').MdPersianDateTimePicker({
        targetDateSelector: '#payment_date2',
        targetTextSelector: '#payment_date_show2',
        englishNumber: false,
        toDate:true,
        enableTimePicker: false,
        dateFormat: 'yyyy-MM-dd',
        textFormat: 'yyyy-MM-dd',
        groupId: 'rangeSelector1',
    });
    $('.js-tags-example').select2({
            tags:false
        });
        </script>
@endsection
