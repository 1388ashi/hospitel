<div class="card">
    <div class="card-header border-0">
        <p class="card-title" style="font-weight: bolder;">جستجو پیشرفته</p>
    </div>
    <div class="card-body">
        <div class="row">
            <form action="{{ route('admin.invoice.index') }}" method="get">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="font-weight-bold" for="doctor">انتخاب دکتر:</label>
                            <select class="form-control custom-select select2" data-placeholder="Select Package" id="doctor" name="doctor">
                                <option selected disabled>- انتخاب کنید  -</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"  @selected(request("doctor") == $doctor->id)>{{ $doctor->name }}</option>
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
                <a href="{{route('admin.invoice.index')}}" class="btn btn-gray btn-lg">ریست</a>
                <button class="btn btn-info btn-lg" >جستوجو</button>
            </div>
            </form>
        </div>
    </div>
</div>