@extends('admin.layouts.master')
@section('content')
 <!--Section-->
 <section>
    <div class="cover-image sptb ml-5 mr-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="card mb-0 table-bordered">
                                <div class="card-header border-0">
                                    <h4 class="card-title">جراحی ها مربوط به دکتر{{$doctor->name}}</h4>
                                </div>
                                <x-alert-danger></x-alert-danger>
                                <x-alert-success></x-alert-success>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-vcenter text-nowrap table-hover border table-striped" id="support-categorylist">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0 w-5 text-center"></th>
                                                    <th class="border-bottom-0 w-5">#شناسه</th>
                                                    <th class="border-bottom-0 w-5 text-center">نام بیمار</th>
                                                    <th class="border-bottom-0 w-5 text-center">کد ملی بیمار</th>
                                                    <th class="border-bottom-0 w-5 text-center">عمل ها</th>
                                                    <th class="border-bottom-0 w-5 text-center">تاریخ ترخیص</th>
                                                    <th class="border-bottom-0 w-5 text-center"> مبلغ عمل(تومان)</th>
                                                    <th class="border-bottom-0 w-5 text-center">پرداخت به پزشک</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <input type="checkbox"  id="selectAllCheckbox"> انتخاب همه
                                                @forelse($doctorSurgeries as $doctorSurgery)
                                                
                                                <form method="POST" action="{{route('admin.invoice.store')}}">
                                                    @csrf
                                                    <input type="hidden" value="{{$doctor->id}}" name="doctorId">
                                                <tr>
                                                    <td class="text-center"><span><input type="checkbox" value="{{$doctorSurgery->id}}" name="doctorSurgery[]"></span></td>
                                                    <td class="text-center"><span>{{$doctorSurgery->id}}</span></td>
                                                    <td class="text-center "><span>{{$doctorSurgery->surgery->patient_name}}</span></td>
                                                    <td class="text-center "><span>{{$doctorSurgery->surgery->patient_national_code}}</span></td>
                                                    <td class="text-center "><span>
                                                        @foreach($doctorSurgery->surgery->operations as $key => $item)
                                                        {{$item->name}}
                                                        @if($key < $doctorSurgery->surgery->operations->count() - 1),@endif
                                                        @endforeach
                                                    </span></td>
                                                        @php
                                                        $vertaDate = verta($doctorSurgery->released_at);
                                                        @endphp
                                                        <td class="text-center"><span>{{$vertaDate->format('Y/n/j')}}</span></td>
                                                        <td class="text-center"><span>{{ number_format($doctorSurgery->surgery->getTotalPrice()) }}</span></td>
                                                        <td class="text-center "><span>
                                                            {{number_format($doctorSurgery->amount)}}
                                                        </span></td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td>
                                                        <span class="text-danger">هیچ داده ای یافت نشد</span>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </div>
                                        </tbody>
                                    </table>
                                    <div class="d-flex" style="justify-content: center;align-items: center;">
                                        {{-- @php
                                            $amount = $doctorSurgery->sum('amount')
                                        @endphp
                                        <span>جمع کل مبلغ پرداخت:{{number_format($amount) }}</span> --}}
                                        <button class="btn btn-success text-white mx-auto">ایجاد صورت حساب</button>
                                    </div>
                                    {{-- <div class="d-flex" style="justify-content: center;align-items: center;">
                                        <span id="totalAmount"></span>
                                        <button class="btn btn-success text-white mx-auto">ایجاد صورت حساب</button>
                                    </div> --}}
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                Copyright © 2021 <a href="#">Dayone</a>. Designed by <a href="#">Spruko Technologies Pvt.Ltd</a> All rights reserved.
            </div>
        </div>
    </div>
</footer>
@endsection
@section('scripts')
<script>
    var checkboxes = document.querySelectorAll('input[name="doctorSurgery[]"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            calculateTotalAmount();
        });
    });

    var selectAllCheckbox = document.getElementById('selectAllCheckbox');
    selectAllCheckbox.addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[name="doctorSurgery[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
        calculateTotalAmount();
    });

    function calculateTotalAmount() {
        var totalAmount = 0;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                var amount = parseFloat(checkbox.getAttribute('data-amount'));
                totalAmount += amount;
            }
        });
        document.getElementById('totalAmount').innerText = 'مجموع مبالغ: ' + totalAmount.toFixed(2) + ' واحد پول';
    }
</script>
@endsection
