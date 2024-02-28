@foreach($invoices as $invoice)
<div class="modal fade mt-5" tabindex="-1" id="store-menu-{{ $invoice->id }}" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="min-width: 50vw;">
            <div class="modal-header">
                <p class="modal-title font-weight-bolder">ایجاد پرداختی</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.payments.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <p class="mr-2 ml-5">
                            مبلغ کل:
                            {{number_format($invoice->amount)}}
                        </p>
                        <p class="ml-5">
                            مبلغ باقی مانده:
                            {{number_format($invoice->getRemainningAmount())}}
                        </p>
                        <p class="ml-5">
                            مبلغ پرداخت شده:
                            {{number_format($invoice->getSumPaymentAmount())}}
                        </p>
                    </div>
                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">مبلغ<span class="text-danger">&starf;</span></label>
                            <input type="text" class="comma form-control" placeholder="مبلغ را وارد کنید" name="amount" value="{{old('amount')}}">
                        </div>
                        <div class="col form-group">
                            <label>نوع<span class="text-danger">&starf;</span></label>
                            <select class="form-control custom-select select2" data-placeholder="Select Package" name="pay_type">
                                <option selected disabled>- نوع پرداخت -</option>
                                <option value="cash">نقدی</option>
                                <option value="cheque">چک</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">عکس رسید</label>
                            <input class="form-control" type="file" name="recipt">
                        </div>
                        <div class="col form-group">
                            <label class="form-label">تاریخ سر رسید</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="feather feather-calendar"></i>
                                    </div>
                                </div>
                                <input class="form-control fc-datepicker payment_date_show" placeholder="تاریخ سر رسید" type="text" autocomplete="off">
                                <input name="due_date"  class="payment_date" type="hidden">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">توضیحات</label>
                            <textarea name="description" cols="87" rows="3">{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center ">
                            <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">بستن</button>
                            <button type="submit" class="btn btn-primary mr-2">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
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
    $('.payment_date_show').MdPersianDateTimePicker({
        targetDateSelector: '.payment_date',
        targetTextSelector: '.payment_date_show',
        englishNumber: false,
        toDate:true,
        enableTimePicker: false,
        dateFormat: 'yyyy-MM-dd',
        textFormat: 'yyyy-MM-dd',
        groupId: 'rangeSelector1',
    });
    $(document).ready(function () {
            $('input.comma').on('keyup', function(event) {
                if(event.which >= 37 && event.which <= 40) return;
                $(this).val(function(index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
        
        });
</script>
@endsection
