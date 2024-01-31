@extends('admin.layouts.master')
@section('content')
<div class="page">
    <div class="app-content main-content" style="margin-right:0px;margin-top:0px;">
        <div class="side-app" style="margin-top:0px;">
            @php
            $vertaDate = verta($post->published_at);
            @endphp
            <div class="page-header d-xl-flex d-block" style="margin-top: 1px">
                <div class="page-leftheader mr-md-auto ml-4">
                        <div class="btn-list">
                            <a href="{{route('posts.index')}}" class="btn btn-primary text-left"><i class="feather feather-plus fs-15 my-auto ml-2"></i>ثبت خبر</a>
                        </div>
                </div>
            </div>
            <div class="row item-right text-right" >
                <div class="card" style="width: 95%;margin: 0 auto;top:-30px;">
                    <div style="margin:0 auto;justify-content: center;align-content: center;align-items: center">
                        <img src="{{Storage::url($post->image)}}" style="width: 90px">
                    </div>
                        <div class="card-body">
                            <div>
                                    <a class="text-dark">
                                        <h3 class="title">{{$post->title}}</h3>
                                        <div class="subtitle mt-5">Explorefeatures</div>
                                    </a>
                                    <div class="col col-auto item-left text-left mb-4">
                                        نوشته شده توسط<a class="mb-0 font-weight-semibold text-orange mr-1 ml-1">{{$post->user->name}}</a> در تاریخ <a class="mb-0 font-weight-semibold text-orange">{{$post->created_at->diffForHumans()}}</a>
                                    </div>
                                <div class="d-flex" >
                                    <ul class=" d-md-flex" style="justify-content: center;align-items: center;margin: 0 auto;text-align: center">                      
                                        <li class="ml-5" data-placement="top" data-toggle="tooltip" title="تاریخ انتشار">
                                            <a class="icons" > <i class="feather feather-calendar"></i>{{$vertaDate->format('Y/n/j')}}</a>
                                        </li>
                                        <li class="ml-5" data-placement="top" data-toggle="tooltip" title="بازدید">
                                            <a class="icons" ><i class="si si-eye text-muted ml-1"></i>{{$post->views_count}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <br>
                            <h5 class="mb-4 font-weight-semibold">خلاصه :</h5>
                            <ul class="list-style-disc mb-5">
                                <li>{{$post->summary}}</li>
                            </ul>
                            <h5 class="mb-4 font-weight-semibold">بدنه</h5>
                            <ul class="list-style-disc mb-5">
                                <li>{!!$post->body!!}</li>
                            </ul>
                            <div class="card-body">
                                <div class="list-id">
                                    <div class="row">
                                        <div class="col item-right text-right">
                                            <a class="mb-0">
                                            @foreach($post->tags as $tag)
                                                <span class="tag">#{{$tag->name}}</span>
                                            @endforeach    
                                            </a>
                                        </div>
                                        <div class="col item-right text-right">
                                            <a class="mb-0">
                                                @if (!empty($post->resource_url))
                                                    منبع :  {{$post->resource_url}}
                                                @endif
                                            </a>
                                        </div>
                                    <div class="col item-center text-center">
                                        <a class="mb-0 tag">{{$post->category->neme}}</a>
                                    </div>
                                    <div class="col item-left text-left">
                                        <a class="mb-0"> شناسه اطلاعیه:#{{$post->id}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="icons">
                                <a class="btn btn-danger"  href="{{route('posts.index')}}">برگشت</a>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- End Row -->
                    </div>

    </div><!-- end app-content-->
</div>
</div>
    <style>
    .tag {
        display: inline-block;
        background-color: #f2f2f2;
        color: #333;
        padding: 5px 10px;
        margin-right: 5px;
        border-radius: 5px;
    }
        .title{
            font-size: 26px;
            color: #333;
            position: relative;top:70px;
        }
        .subtitle {
            position: relative;
            top: 35px;
            font-size: 18px;
            color: #666;
        }
    </style>
    @endsection