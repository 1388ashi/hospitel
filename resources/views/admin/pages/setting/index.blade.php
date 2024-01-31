@extends('admin.layouts.master')
@section('content')
<div class="page">
    <div class="page-main">
        <div class="app-content main-content"  style="margin-right:0px;margin-top:0px;">
            <div class="side-app">
                <div class="page-header d-xl-flex d-block">
                    <div class="page-leftheader">
                        <h4 class="page-title">تنظیمات</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="nav flex-column admisetting-tabs" id="settings-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active"  data-toggle="pill" href="#tab-5" role="tab">
                                    <i class="nav-icon las la-share-alt"></i>  تنظیمات مجازی
                                </a>
                                <a class="nav-link" data-toggle="pill" href="#tab-1" role="tab">
                                    <i class="nav-icon las la-cog"></i> تنظیمات عمومی
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="tab-content adminsetting-content" id="setting-tabContent">
                            <div class="tab-pane fade" id="tab-1" role="tabpanel">
                                <div class="card">
                                    <x-alert-danger></x-alert-danger>
                                    <x-alert-success></x-alert-success>
                                    <form action="{{route('update-setting',1)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="card-header  border-0">
                                            <h4 class="card-title">تنظیمات عمومی</h4>
                                        </div>
                                        <div class="card-body">
                                            <x-alert-danger></x-alert-danger>
                                            <x-alert-success></x-alert-success>
                                        @foreach ($settingTypesGeneral as $type => $settings)
                                            @if ($type == 'number')
                                                @foreach ($settings as $setting)
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="{{$setting->name}}" class="form-label mb-0 mt-2 mr-3" style="font-size: 18px">{{$setting->label}}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="{{$setting->type}}" id="{{$setting->name}}" min="0"class="form-control" name="{{$setting->name}}" value="{{$setting->value}}">
                                                    </div>
                                            </div>
                                            @endforeach
                                            @endif
                                            
                                            @if ($type == 'file')
                                            @foreach ($settings as $setting)
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="form-label mb-0 mt-2 mr-5" style="font-size: 18px">{{$setting->label}}</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group file-browser">
                                                            <input type="text" class="form-control border-left-0 browse-file" placeholder="choose" readonly>
                                                            <label class="input-group-append mb-0">
                                                                <span class="btn ripple btn-primary">
                                                                    انتخاب <input id="imageInput" name="{{$setting->name}}" type="{{$setting->type}}" style="display: none;" accept="image/*" multiple>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <img src="{{Storage::url($setting->value)}}" id="previewImage"  name="{{$setting->name}}"  style="width: 80px;margin-top:5px">
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        @endforeach    
                                        <div class="card-footer">
                                            <a  href="{{route('admin-index')}}"  class="btn btn-danger">برگشت</a>
                                            <button class="btn btn-warning">به روز رسانی</button>
                                        </div>
                                    </form>  
                                </div>
                            </div>
                            <div class="tab-pane fade  show active" id="tab-5" role="tabpanel">
                                <div class="card">
                                <form action="{{route('update-setting',2)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="card-header  border-0">
                                        <h4 class="card-title">تنظیمات مجازی</h4>
                                    </div>
                                    <div class="card-body">
                                        <x-alert-danger></x-alert-danger>
                                        <x-alert-success></x-alert-success>
                                    @foreach ($settingTypesSocial as $type => $settings)
                                        @if ($type == 'number')
                                            @foreach ($settings as $setting)
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                <div class="col-md-3">
                                                    <label for="{{$setting->name}}" class="form-label mb-0 mt-2 mr-3" style="font-size: 18px">{{$setting->label}}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="{{$setting->type}}" id="{{$setting->name}}" min="0"class="form-control" name="{{$setting->name}}" value="{{$setting->value}}">
                                                </div>
                                        </div>
                                        @endforeach
                                        @endif
                                        @if ($type == 'textarea')
                                        @foreach ($settings as $setting)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="{{$setting->name}}" class="form-label mb-0 mt-5 mr-5" style="font-size: 18px">{{$setting->label}}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <textarea name="{{$setting->name}}" id="{{$setting->name}}"cols="71"rows="3">{!! $setting->value !!}</textarea>
                                                </div>
                                        </div>
                                        @endforeach
                                        @endif
                                        @if ($type == 'text')
                                        @foreach ($settings as $setting)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="{{$setting->name}}" class="form-label mb-0 mt-2 mr-5" style="font-size: 18px">{{$setting->label}}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="{{$setting->name}}" type="{{$setting->type}}" id="{{$setting->name}}" value="{{$setting->value}}" class="form-control">
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif
                                        
                                        @if ($type == 'file')
                                        @foreach ($settings as $setting)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label mb-0 mt-2 mr-5" style="font-size: 18px">{{$setting->label}}</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="input-group file-browser">
                                                        <input type="text" class="form-control border-left-0 browse-file" placeholder="choose" readonly>
                                                        <label class="input-group-append mb-0">
                                                            <span class="btn ripple btn-primary">
                                                                انتخاب <input id="imageInput2" name="{{$setting->name}}" type="{{$setting->type}}" style="display: none;" accept="image/*" multiple>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <img src="{{Storage::url($setting->value)}}" id="previewImage2"  name="{{$setting->name}}"  style="width: 80px;margin-top:5px">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    @endforeach    
                                    <div class="card-footer">
                                        <a  href="{{route('admin-index')}}"  class="btn btn-danger">برگشت</a>
                                        <button class="btn btn-warning">به روز رسانی</button>
                                    </div>
                                </form>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row-->

            </div>
        </div><!-- end app-content-->
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $("#imageInput").change(function(){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
        $("#imageInput2").change(function(){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage2').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection