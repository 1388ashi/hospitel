<div class="card">
    <div class="card-header border-0">
        <p class="card-title" style="font-weight: bolder;">جستجو پیشرفته</p>
    </div>
    <div class="card-body">
        <div class="row">
            <form action="{{ route("admin.surgeries.index") }}" class="col-12">
                <div class="row">
                    <div class="col-4 form-group">
                        <label class="font-weight-bold">نام بیمار :</label>
                        <input type="text" name="patient_name" value="{{ request("نام جراحی") }}" class="form-control" />
                    </div>
                    <div class="col-4 form-group">
                        <label class="font-weight-bold">انتخاب دکتر :</label>
                        <select name="doctor_id" class="form-control select2">
                            <option value="all">همه</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @selected(request("doctor_id") == $doctor->id)>{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label class="font-weight-bold"> نام عمل ها:</label>
                        <select name="operation_id" class="form-control select2">
                            <option value="all">همه</option>
                            @foreach ($operations as $operation)
                                <option value="{{ $operation->id }}" @selected(request("operation_id") == $operation->id)>{{ $operation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <button class="col-12 btn btn-primary align-self-center">جستجو</button>
                        <a href="{{route('admin.surgeries.index')}}" class="col-12 btn btn-warning align-self-center mt-1">ریست</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>