@extends('admin.layouts.master')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card">
        <div class="card-header border-bottom-0 d-flex justify-content-between">
            <p class="card-title font-weight-bolder">ویرایش جراحی</p>
        </div>
        <div class="card-body">
            <x-alert-danger></x-alert-danger>
            <x-alert-success></x-alert-success>
            <form action="{{route('admin.surgeries.update',[$surgery->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("put")
            <div class="row">
                <div class="col-4">
                <div class="form-group">
                    <label class="font-weight-bold">نام بیمار</label><span class="text-danger">&starf;</span>
                    <input type="text" name="patient_name" class="form-control"  placeholder="نام بیمار را اینجا وارد کنید" required value="@if(old('national_code')){{old('national_code')}}@else{{$surgery->patient_name}}@endif">
                </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">کد ملی بیمار</label><span class="text-danger">&starf;</span>
                        <input type="text" name="patient_national_code" placeholder=" کد ملی را اینجا وارد کنید" value="@if(old('national_code')){{old('patient_national_code')}}@else{{$surgery->patient_national_code}}@endif" required class="form-control">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">شماره سند</label><span class="text-danger">&starf;</span>
                        <input type="text" name="document_number" placeholder="شماره سند را اینجا وارد کنید" value="@if(old('national_code')){{old('national_code')}}@else{{$surgery->document_number}}@endif" required class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">عمل ها</label><span class="text-danger">&starf;</span>
                        <select class="form-control js-tags-example" name="operations[]" data-placeholder="عمل را انتخاب کنید" multiple="multiple">             
                            @foreach($operations as $operation)
                            <option @if(in_array($operation->id, $operationsEdit)) selected="selected" @endif>{{$operation->name}}</option>
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
                            <input class="form-control fc-datepicker" id="payment_date_show" placeholder="تاریخ عمل" type="text" autocomplete="off"  value=" @if(old('surgeried_at')) {{verta(old('surgeried_at', today()->format('Y-m-d')))->format('Y-m-d') }} @else{{$surgery->surgeried_at}} @endif">
                            <input name="surgeried_at" id="payment_date" type="hidden" value="{{ old('surgeried_at') ?: $surgery->surgeried_at }}"/>
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
                            <input class="form-control fc-datepicker" id="payment_date_show2" placeholder="تاریخ ترخیص" type="text" autocomplete="off" value=" @if(old('released_at')) {{verta(old('released_at', today()->format('Y-m-d')))->format('Y-m-d') }} @else{{$surgery->released_at}} @endif">
                            <input name="released_at" id="payment_date2" type="hidden" value="{{ old('released_at') ?: $surgery->released_at }}"/>
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
                            <option value="{{$basic->id}}" @if($basic->id ==  $surgery->basic_insurance_id) selected @endif>
                            {{$basic->name}}</option>
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
                            <option value="{{$supplementary->id}}" @if($supplementary->id == $surgery->supp_insurance_id) selected @endif>
                            {{$supplementary->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                @foreach($doctor_roles as $doctor_role)
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold">{{$doctor_role->title}}</label><span class="text-danger">&starf;</span>
                        <select class="form-control custom-select select2" data-placeholder="Select Package"  name="doctors[{{ $doctor_role->id }}]">
                            <option selected disabled>- انتخاب کنید  -</option>
                            @foreach($doctor_role->doctors as $doctor)
                            <option value="{{ $doctor->id }}"  @selected($surgery->doctors()->where('doctor_role_id',$doctor_role->id)->get()->contains($doctor->id))>{{ $doctor->name }} - متخصص {{$doctor->specialtie->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row ml-2">
                <label class="form-label ml-3">توضیحات</label>
                <textarea name="description"  cols="100" rows="4">{!! old('description', $surgery->description) !!}</textarea>
            </div>
            <div class="card-footer text-right mt-1">
                <a href="{{route('admin.surgeries.index')}}" class="btn btn-danger btn-lg">برگشت</a>
                <button class="btn btn-warning btn-lg" >ویرایش</button>
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
        //tags
        $('.js-tags-example').select2({
            tags:false
        });
    </script>
@endsection
