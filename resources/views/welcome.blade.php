<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">

@include('web.includes.head')

<body>


<!-- Start Preloader Area -->
<div class="preloader-area">
    <div class="loader-box">
        <div class="loader"></div>
    </div>
</div>
<!-- End Preloader Area -->


<!-- Start Header Area -->
<!-- End Header Area -->

<div id="app">
    @include('web.includes.header')

    <router-view></router-view>
    <!-- set progressbar -->
    <vue-progress-bar></vue-progress-bar>
</div>

<!-- start footer Area -->
@include('web.includes.footer')

</body>

</html>
