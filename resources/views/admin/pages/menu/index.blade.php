@extends('admin.layouts.master')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <button type="button" class="btn btn-info btn-group-sm" data-toggle="modal" data-target="#create-menu">
                    ثبت منو جدید
                </button>
            </div>
            <div class="card-body">
                <x-alert-danger></x-alert-danger>
                <x-alert-success></x-alert-success>
                <form action="{{route('menu.sort')}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="table-responsive">
                        <div id="hr-table-wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                                    <thead>
                                    <tr>
                                        <th class="text-center border-top">انتخاب</th>
                                        <th class="text-center border-top">الویت</th>
                                        <th class="text-center border-top">عنوان</th>
                                        <th class="text-center border-top">شناسه</th>
                                        <th class="text-center border-top">وضعیت</th>
                                        <th class="text-center border-top">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center" id="items">
                                    @foreach ($menuItems as $menuItem)
                                        <tr>
                                            <input type="hidden" value="{{ $menuItem->id }}" name="menus[]">
                                            <td class="text-center"><span class="glyphicon glyphicon-move ml-3"aria-hidden="true"></span></td>
                                            <td class="text-center">{{ $menuItem->order }}</td>
                                            <td class="text-center">{{ $menuItem->title }}</td>
                                            <td class="text-center">{{ $menuItem->id }}</td>
                                            <td class="text-center">
                                                @if ($menuItem->status)
                                                    <span class="badge badge-success">فعال</span>
                                                @else
                                                    <span class="badge badge-danger">غیر فعال</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-warning btn-sm ml-1"
                                                            data-toggle="modal"
                                                            data-target="#edit-menu-{{ $menuItem->id }}">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </button>
                                                    <button  class="action-btns1 item-delete  btn-danger"  data-toggle="modal" data-target="#deleteModal" data-title="{{$menuItem->title}}"  data-id="{{$menuItem->id}}">
                                                        <i class="feather feather-trash-2 text-white"></i>
                                                    </button>
                                            </div>
                                        </div>
                                    </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-orange mt-5" type="submit">ذخیره مرتب سازی</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <span>آیا از حذف</span>
                        <mark id="delete_title"></mark>
                        <span>مطمئن هستید؟</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{route('menus.destroy',1)}}" method="post">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="type" value="cat_delete">
                        <input type="hidden" name="item_id" id="item_id" value="">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-danger">حذف شود</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
    @include('admin.pages.menu.includes.create-menu-item-modal')
    @include('admin.pages.menu.includes.edit-menu-item-modal')
    @include('admin.pages.menu.includes.scripts')
@endsection
