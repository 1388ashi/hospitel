@extends('admin.layouts.master')
@section('content')
<div class="col-12 mt-5 justify-content-center">
    <div class="card">
        <div class="card-header border-bottom-0 d-flex justify-content-between">
        <p class="card-title font-weight-bolder">لیست دکتر ها</p>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.filter-index-surgeries') }}" method="get">
            @csrf
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold" for="doctor">انتخاب دکتر:</label>
                        <select class="form-control custom-select select2" data-placeholder="Select Package" id="doctor" name="doctor">
                            <option selected disabled>- انتخاب کنید  -</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}"  @selected(request("doctor") == $doctor->id)>{{ $doctor->name }} - متخصص {{$doctor->specialtie->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="start_date" class="font-weight-bold">تاریخ شروع:</label>
                        <input class="form-control fc-datepicker" id="payment_date_show" placeholder="تاریخ شروع" type="text" autocomplete="off" value="{{ verta(old('start_date', today()->format('Y-m-d')))->format('Y-m-d') }}">
                        <input name="start_date" id="payment_date" type="hidden" value="{{ request("start_date") }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="font-weight-bold" for="end_date">تاریخ پایان:</label>
                        <input class="form-control fc-datepicker" id="payment_date_show2" placeholder="تاریخ پایان" type="text" autocomplete="off" value="{{ verta(old('end_date', today()->format('Y-m-d')))->format('Y-m-d') }}">
                        <input name="end_date" id="payment_date2" type="hidden"  value="{{ request("end_date") }}">
                    </div>
                </div>
            </div>
        <div class="card-footer text-right mt-1">
            <a href="{{route('admin.dashboard')}}" class="btn btn-danger btn-lg">برگشت</a>
            <button class="btn btn-info btn-lg" >جستوجو</button>
        </div>
        </form>
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