@foreach($invoices as $invoice)
    <div class="modal fade mt-5" tabindex="-1" id="edit-menu-{{ $invoice->id }}" role="dialog"
         aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="min-width: 50vw;">
                <div class="modal-header">
                    <p class="modal-title font-weight-bolder">ویرایش صورت حساب</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.invoices.update', $invoice->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col form-group">
                                <label for="">توضیحات</label>
                                <textarea name="description" cols="85" rows="4">{{old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center ">
                                <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">بستن</button>
                                <button type="submit" class="btn btn-warning mr-2">ویرایش</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach