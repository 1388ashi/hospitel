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
                                <div class="card mb-0">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">فعالیت ادمین ها</h4>
                                    </div>
                                    <x-alert-success></x-alert-success>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <ul class="list-group">
                                                @foreach ($logActivitys as $item)
                                                <li class="list-group-item">
                                                    {{$item->description}}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    {{$logActivitys->onEachSide(10)->links("vendor.pagination.bootstrap-4")}}
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