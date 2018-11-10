@extends('theme.layout.app')

@section('content')
    <div class="main-banner2-area">
        <div class="container">
            <div class="main-banner2-wrapper">
                <h1>Welcome To Xero Services!</h1>
                <p>Arabic PDF, Word, Custom Templates And Many More ...</p>
            </div>
        </div>
    </div>

    <div class="newest-products-area section-space-default">
        <div class="container">
            <h2 class="title-default">Let's Check Out Our Newest Release Tools</h2>
        </div>
        <div class="container" id="isotope-container">
            <div class="isotope-classes-tab isotop-box-btn">
                <a href="#" data-filter="*" class="current">All</a>
                @foreach ($tags as $tag)
                    <a href="#" data-filter=".{{strtolower($tag->name)}}">{{$tag->name}}</a>
                @endforeach
            </div>
            <div class="row featuredContainer">
                @foreach ($services as $service)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 component {{$service->tags_classes}}">
                        <div class="single-item-grid">
                            <div class="item-img">
                                <img src="{{$service->image}}" alt="product" class="img-responsive">
                                <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt"
                                                                                   aria-hidden="true"></i></div>
                            </div>
                            <div class="item-content">
                                <div class="item-info">
                                    <h3><a href="/services/{{$service->id}}">{{$service->name}}</a></h3>
                                    <span>{{$service->tags_list}}</span>
                                    <div class="price">{{$service->points}} points</div>
                                </div>
                                <div class="item-profile">
                                    <div class="profile-title">
                                        <div class="img-wrapper">
                                            <img style="height: 35px"
                                                 src="http://trustangle.com/wp-content/uploads/2015/12/xero-logo-150F46D39F-seeklogo.com_.png"
                                                 alt="profile" class="img-responsive img-circle">
                                        </div>
                                        <span>Xero</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="pricing-plan-area section-space-default">
        <div class="container">
            <h2 class="title-default">Our Monthly Pricing Plan</h2>
        </div>
        <div class="container">
            <div class="row pricing-plan-wrapper">
                <div class="pricing-plan-box">
                    <div class="pricing">
                        <h3>$39 /<span>mo</span></h3>
                        <p>1 WEBSITE LICENSE</p>
                    </div>
                    <ul class="pricing-info">
                        <li>Choose any single theme</li>
                        <li>1 WordPress Theme</li>
                        <li>Support & updates</li>
                        <li>1 year Theme Updates</li>
                        <li>1yearr Dedicated Support Access</li>
                        <li>10% Off Future Purchases</li>
                    </ul>
                    <a href="#" class="pricing-btn">Buy Now</a>
                </div>
                <div class="pricing-plan-box">
                    <div class="pricing">
                        <h3>$59 /<span>mo</span></h3>
                        <p>3 WEBSITES LICENSE</p>
                    </div>
                    <ul class="pricing-info">
                        <li>Choose any single theme</li>
                        <li>1 WordPress Theme</li>
                        <li>Support & updates</li>
                        <li>1 year Theme Updates</li>
                        <li>1yearr Dedicated Support Access</li>
                        <li>10% Off Future Purchases</li>
                    </ul>
                    <a href="#" class="pricing-btn">Buy Now</a>
                </div>
                <div class="pricing-plan-box">
                    <div class="pricing">
                        <h3>$99 /<span>mo</span></h3>
                        <p>UNLIMITED WEBSITES LICENSE</p>
                    </div>
                    <ul class="pricing-info">
                        <li>Choose any single theme</li>
                        <li>1 WordPress Theme</li>
                        <li>Support & updates</li>
                        <li>1 year Theme Updates</li>
                        <li>1yearr Dedicated Support Access</li>
                        <li>10% Off Future Purchases</li>
                    </ul>
                    <a href="#" class="pricing-btn">Buy Now</a>
                </div>
            </div>
        </div>
    </div>

@stop
