@extends('theme.layout.app')

@section('content')
    <!-- Main Banner 1 Area End Here -->
    <!-- Inner Page Banner Area Start Here -->
    <div class="pagination-area bg-secondary">
        <div class="container">
            <div class="pagination-wrapper">
                <ul>
                    <li><a href="/">Services</a><span> -</span></li>
                    <li>{{$service->name}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Inner Page Banner Area End Here -->
    <!-- Product Details Page Start Here -->
    <div class="product-details-page bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                    <div class="inner-page-main-body">
                        <div class="single-banner">
                            <img src="{{$service->image}}" alt="product" class="img-responsive">
                        </div>
                        <h2 class="title-inner-default">{{$service->name}}</h2>
                        <p class="para-inner-default">{{$service->description}}</p>
                        <div class="product-tag-line">
                            <ul class="product-tag-item">
                                @foreach($service->tags as $tag)
                                    <li><a href="#">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                            <ul class="social-default">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="product-details-tab-area">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <ul class="product-details-title">
                                        <li class="active"><a href="#description" data-toggle="tab"
                                                              aria-expanded="false">{{$service->name}} Setting</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="description">
                                            <h3>Manage templates</h3>
                                            @include('spark::settings.profile.update-default-template')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <div class="fox-sidebar">
                        <div class="sidebar-item">
                            <div class="sidebar-item-inner">
                                <h3 class="sidebar-item-title">Usage Cost</h3>
                                <ul class="sidebar-sale-info">
                                    <li><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
                                    <li>{{$service->points}} Pts/download</li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-item">
                            <div class="sidebar-item-inner">
                                <h3 class="sidebar-item-title">Product Information</h3>
                                <ul class="sidebar-product-info">
                                    <li>Usage cost:<span> {{$service->points}} Pts./Download</span></li>
                                    <li>Released On:<span> {{$service->created_at->format("dd M, Y")}}</span></li>
                                    <li>Last Update:<span> {{$service->updated_at->format("dd M, Y")}}</span></li>
                                    <li>Download:<span> {{$service->downloads}}</span></li>
                                    <li>Version:<span> {{$service->version}}</span></li>
                                    <li>Compatibility:<span> {{$service->compatibility}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
