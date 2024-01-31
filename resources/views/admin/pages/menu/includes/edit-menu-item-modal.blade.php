@foreach($menuItems as $menuItem)
    <div class="modal fade mt-5" id="edit-menu-{{ $menuItem->id }}" tabindex="-1" role="dialog"
         aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="min-width: 50vw;">
                <div class="modal-header">
                    <p class="modal-title font-weight-bolder">ویرایش منو شماره {{$menuItem->id}}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('menus.update', $menuItem->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col form-group">
                                <label class="font-weight-bold">عنوان :</label><span class="text-danger">&starf;</span>
                                <input type="text" name="title" class="form-control" value="{{ $menuItem->title }}"
                                       required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="font-weight-bold">نحوه ثبت لینک :</label><span
                                    class="text-danger">&starf;</span>
                                <select name="linkable_type" id="linkableTypeEdit-{{$menuItem->id}}"
                                        onchange="toggleEditInput({{$menuItem}})" class="form-control">
                                    <option value="self_link" class="custom-menu">لینک دلخواه</option>
                                    @foreach($models as $key => $value)
                                        <option value="{{ $key }}"
                                                class="model" @selected($menuItem->linkable_type == $key)>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col form-group">
                                <label class="font-weight-bold">آیتم های دسته بندی :</label>
                                <select name="linkable_id" id="linkableIdEdit-{{$menuItem->id}}"
                                        class="form-control" @disabled(!$menuItem->linkable_id)>
                                    <option value="none" class="custom-menu">انتخاب</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                class="model" @selected($menuItem->linkable_id == $category->id)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col form-group">
                                <label class="font-weight-bold">لینک دلخواه :</label>
                                <input type="text" id="linkEdit-{{$menuItem->id}}" name="link"
                                       value="{{ $menuItem->link }}" @disabled(!$menuItem->link) class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="font-weight-bold">باز شدن در صفحه جدید :</label><span class="text-danger">&starf;</span>
                                <select name="new_tab" class="form-control">
                                    <option value="1" class="custom-menu" @selected($menuItem->new_tab)>باز شود</option>
                                    <option value="0" class="custom-menu" @selected(!$menuItem->new_tab)>باز نشود
                                    </option>
                                </select>
                            </div>
                            <div class="col form-group">
                                <label class="font-weight-bold">وضعیت :</label><span class="text-danger">&starf;</span>
                                <select name="status" class="form-control">
                                    <option value="0" class="custom-menu" @selected(!$menuItem->status)>غیر فعال
                                    </option>
                                    <option value="1" class="custom-menu" @selected($menuItem->status)>فعال</option>
                                </select>
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
    <form action="{{ route('menus.destroy', $menuItem->id) }}" method="post" id="delete-{{ $menuItem->id }}"
          style="display: none">
        @csrf
        @method('DELETE')
    </form>
@endforeach
