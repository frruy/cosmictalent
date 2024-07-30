@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_top_search')
<!-- Inner Page Title end -->
<div class="about-wraper">
    <div class="container">

    <div class="largebanner shadow3 mt-0">
<div class="adin">
{!! $siteSetting->cms_page_ad !!}
</div>
<div class="clearfix"></div>
</div>



        
    <h2>{{$cmsContent->page_title}}</h2>
    <p>{!! $cmsContent->page_content !!}</p>
            
       
    </div>  
</div>
@include('includes.footer')
@endsection