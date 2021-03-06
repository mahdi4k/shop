<?php
         
    
           $Jdf=new \App\lib\Jdf();
        ?>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand text-center col-sm-3 col-md-2 mr-0" href="#">هوشمند خودرو</a>
     
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
        <a class="nav-link" href="{{url('logout')}}">خروج از سایت</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class=" bg-light sidebar">
            <div class="sidebar-sticky">
                <div class="user-interface">
                        <img width="150" class="d-table mx-auto " src="{{url('img/icon.gif')}}">
                         <i style="
                        right: 147px;
                         
                        color: green;
                        font-size: 18pt;" class="fa fa-check position-absolute"></i>
                    <span style="color:white" class=" mx-auto d-table">ادمین</span>
                    <span style="color:white" class=" mx-auto d-table">{{arabic_w2e(jdate(\Carbon\Carbon::now()->toDateTimeString())->format('%A, %d %B %y'))}}</span>
                    
                </div>
                <ul class="nav flex-column">
                    <li id="click_advance" class="nav-item">
                        <a class="nav-link  {{ Request::path() == 'admin' ? 'active' : '' }}" href="/admin">
                            <span data-feather="home"></span>
                            داشبورد
                        </a>
                    </li>
                    <li id="click_advance1" class="nav-item">
                        <a data-toggle="collapse" data-target="#collapseExample1" href="#" aria-expanded="false"
                            aria-controls="collapseExample1"
                            class="nav-link  {{ Request::path() == 'admin/order' ? 'active' : '' }}  ">
                            <span data-feather="file"></span>
                            <i style="color: #2dabd2;font-size: 22px;" class="fa fa-angle-down pull-left"></i>
                            سفارشات
                        </a>
                        <div style="padding-right: 41px;" aria-expanded="false" aria-controls="collapseExample1"
                            class="collapse text-right   custom-collapse" id="collapseExample1">

                            <a href="/admin/order">
                                <p>مدیریت سفارشات</p>
                            </a>
                            <a href="/admin/order/discount">
                                <p>کد های تخفیف</p>
                            </a>
                            <a href="/admin/order/cart">
                                <p>کارت هدیه</p>
                            </a>

                        </div>
                    </li>
                    <li id="click_advance" class="nav-item">

                        <a data-toggle="collapse" data-target="#collapseExample" href="#" aria-expanded="false"
                            aria-controls="collapseExample"
                            class="nav-link {{ Request::path() == 'admin/product' ? 'active' : '' }}">
                            <span data-feather="shopping-cart"></span>
                            <i style="color: #2dabd2;font-size: 22px;" class="fa fa-angle-down pull-left"></i>
                            محصولات
                        </a>

                        <div style="padding-right: 41px;" aria-expanded="false" aria-controls="collapseExample"
                            class="collapse text-right   custom-collapse" id="collapseExample">

                            <a href="/admin/product">
                                <p>مدیریت محصولات</p>
                            </a>
                            <a href="/admin/product/create">
                                <p>افزودن محصولات</p>
                            </a>
                            <a href="/admin/amazing">
                                <p>محصولات شگفت انگیز</p>
                            </a>
                            <a href="{{ url('admin/filter') }}">
                                <p>فیلتر های محصول</p>
                            </a>
                            <a href="{{ url('admin/item') }}">
                                <p>ایتم های محصول</p>
                            </a>

                        </div>
                    </li>
                    <li id="click_advance3" class="nav-item ">
                        <a data-toggle="collapse" data-target="#collapseExample2" href="#" aria-expanded="false"
                            aria-controls="collapseExample" class="nav-link">
                            <span data-feather="users"></span>
                            <i style="color: #2dabd2;font-size: 22px;" class="fa fa-angle-down pull-left"></i>
                            کاربران <span class="sr-only">(current)</span>
                        </a>
                        <div style="padding-right: 41px;" aria-expanded="false" aria-controls="collapseExample2"
                            class="collapse text-right   custom-collapse" id="collapseExample2">

                            <a href="/admin/user">
                                <p>مدیریت کاربران</p>
                            </a>
                            <a href="/admin/user/create">
                                <p>کاربر جدید</p>
                            </a>


                        </div>
                    </li>

                    <li id="click_advance4" class="nav-item">

                        <a data-toggle="collapse" data-target="#collapseExample4" href="#" aria-expanded="false"
                            aria-controls="collapseExample4"
                            class="nav-link {{ Request::path() == 'admin/product' ? 'active' : '' }}">
                            <span data-feather="archive"></span>
                            <i style="color: #2dabd2;font-size: 22px;" class="fa fa-angle-down pull-left"></i>
                            اخبار 
                        </a>

                        <div style="padding-right: 41px;" aria-expanded="false" aria-controls="collapseExample4"
                            class="collapse text-right   custom-collapse" id="collapseExample4">

                            <a href="/admin/news">
                                <p>خبرها</p>
                            </a>
                              
                            <a href="{{ url('admin/news/create') }}">
                                <p>افزودن خبر</p>
                            </a>

                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'admin/statistics' ? 'active' : '' }} "
                            href="{{url('admin/statistics')}}">
                            <span data-feather="bar-chart-2"></span>
                            آمار سایت
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'admin/slider' ? 'active' : '' }}"
                            href="{{url('admin/slider')}}">
                            <span data-feather="monitor"></span>
                            اسلایدر
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ Request::path() == 'admin/comment' ? 'active' : '' }}"
                            href="{{url('admin/comment')}}">
                            <span style="opacity:.7" class="badge badge-pill badge-danger">{{$comment_count}}</span>
                            مدیریت نظرات کاربران

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'admin/question' ? 'active' : '' }}"
                            href="{{url('admin/question')}}">
                            <span style="opacity:.7" class="badge badge-pill badge-danger">{{$question_count}}</span>
                            مدیریت پرسش های کاربران
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'admin/category' ? 'active' : '' }}"
                            href="/admin/category">
                            <span data-feather="layers"></span>
                            دسته بندی ها
                        </a>
                    </li>
                    <li id="click_advance7" class="nav-item ">
                        <a data-toggle="collapse" data-target="#collapseExample7" href="#" aria-expanded="false"
                            aria-controls="collapseExample" class="nav-link">
                            <span data-feather="users"></span>
                            <i style="color: #2dabd2;font-size: 22px;" class="fa fa-angle-down pull-left"></i>
                            تنظیمات سایت <span class="sr-only">(current)</span>
                        </a>
                        <div style="padding-right: 41px;" aria-expanded="false" aria-controls="collapseExample7"
                            class="collapse text-right   custom-collapse" id="collapseExample7">

                            <a href="/admin/setting/pay">
                                <p>تنظیمات پرداخت</p>
                            </a>


                        </div>
                    </li>

                </ul>
            </div>
        </nav>


    </div>
</div>