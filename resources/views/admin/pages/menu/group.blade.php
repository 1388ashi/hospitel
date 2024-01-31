@extends('admin.layouts.master')
@section('content')
<section>
        <div class="cover-image sptb ml-5 mr-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-10" >
                                <div class="d-flex" style="justify-content: center;">
                                    <div class="card">
                                            <div class="card-body pb-0">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-lg-6">
                                                        <div class="offer offer-default">
                                                            <div class="shape">
                                                                <div class="shape-text">
                                                                    هدر
                                                                </div>
                                                            </div>
                                                            <a href="{{ route('menus.index',  ['menu_group_id' => 1])}}">
                                                                <div class="offer-content " style="background-color: rgb(63, 123, 172)">
                                                                    <h3 class="lead font-weight-semibold text-light">
                                                                    هدر
                                                                </h3>
                                                            </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-lg-6">
                                                        <div class="offer offer-danger">
                                                            <div class="shape">
                                                                <div class="shape-text">
                                                                    فوتر
                                                                </div>
                                                            </div>
                                                        <a href="{{ route('menus.index', ['menu_group_id' => 2])}}">
                                                            <div class="offer-content" style="background-color: rgb(211, 21, 21)">
                                                                <h3 class="lead font-weight-semibold text-light">
                                                                    فوتر
                                                                </h3>
                                                            </div>
                                                        </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
