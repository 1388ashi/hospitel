@foreach($specialties as $specialtie)
    <div class="modal fade mt-5" tabindex="-1" id="edit-menu-{{ $specialtie->id }}" role="dialog"
         aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="min-width: 50vw;">
                <div class="modal-header">
                    <p class="modal-title font-weight-bolder">ویرایش تخصص</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.update-specialties', $specialtie->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col form-group">
                                <label class="font-weight-bold">عنوان :</label><span class="text-danger">&starf;</span>
                                <input type="text" name="title" class="form-control" value="{{ $specialtie->title }}"
                                required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-1 ml-5">
                                <i class="text-danger">*</i>
                                وضعیت:</label>
                                <label class="custom-control custom-radio success ml-4">
                                    <input type="radio" class="custom-control-input" name="status" value="1" @if($specialtie->status == 1) checked @endif>
                                    <span class="custom-control-label">فعال</span>
                                </label>
                                <label class="custom-control custom-radio success ml-4">
                                    <input type="radio" class="custom-control-input" name="status" value="0" @if($specialtie->status == 0) checked @endif>
                                    <span class="custom-control-label">غیر فعال</span>
                                </label>
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