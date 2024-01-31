<div class="modal fade mt-5" id="create-menu" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document"">
    <div class="modal-content w-50" style="min-width: 50vw;">
      <div class="modal-header">
        <p class="modal-title font-weight-bolder">ثبت منو آیتم جدید</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('menus.store')}}" method="POST">
          @csrf
          <input type="hidden" name="menu_group_id" value="{{ $menuGroup->id }}">
          <div class="row">
            <div class="col form-group">
              <label class="font-weight-bold">عنوان :</label><span class="text-danger">&starf;</span>
              <input type="text" name="title" class="form-control" required/>
            </div>
          </div>
          <div class="row">
            <div class="col form-group">
              <label class="font-weight-bold">نوع لینک :</label><span class="text-danger">&starf;</span>
              <select id="linkableType" onchange="toggleInput()" name="linkable_type" class="form-control">
                <option value="none" class="custom-menu">انتخاب</option>
                <option value="self_link" class="custom-menu">لینک دلخواه</option>
                @foreach($models as $key => $value)
                  <option value="{{ $key }}" class="model">{{ $value }}</option>
                @endforeach
              </select>
            </div>
            <div class="col form-group">
              <label class="font-weight-bold">آیتم های دسته بندی :</label>
              <select id="linkableId" name="linkable_id" class="form-control" disabled>
                <option value="none" class="custom-menu">انتخاب</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" class="model">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col form-group">
              <label class="font-weight-bold">لینک دلخواه :</label>
              <input type="text" id="link" name="link" class="form-control" disabled>
            </div>
          </div>
          <div class="row">
            <div class="col form-group">
              <label class="font-weight-bold">باز شدن در صفحه جدید :</label><span class="text-danger">&starf;</span>
              <select name="new_tab" class="form-control">
                <option value="none" class="custom-menu">انتخاب</option>
                <option value="1" class="custom-menu">باز شود</option>
                <option value="0" class="custom-menu">باز نشود</option>
              </select>
            </div>
            <div class="col form-group">
              <label class="font-weight-bold">وضعیت :</label><span class="text-danger">&starf;</span>
              <select name="status" class="form-control">
                <option value="none" class="custom-menu">انتخاب</option>
                <option value="1" class="custom-menu">فعال</option>
                <option value="0" class="custom-menu">غیر فعال</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col d-flex justify-content-center">
              <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">بستن</button>
              <button type="submit" class="btn btn-primary mr-2">ثبت</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
