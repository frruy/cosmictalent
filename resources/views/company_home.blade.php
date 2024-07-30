@extends('layouts.app')

@section('content') 

<!-- Header start --> 

@include('includes.header') 

<!-- Header end --> 

<!-- Inner Page Title start --> 

@include('includes.inner_page_title', ['page_title'=>__('Dashboard')]) 

<!-- Inner Page Title end -->

<div class="listpgWraper">

    <div class="container">@include('flash::message')

        <div class="row"> @include('includes.company_dashboard_menu')

            <div class="col-md-9 col-sm-8"> @include('includes.company_dashboard_stats')

        <?php

        if((bool)config('company.is_company_package_active')){        

        $packages = App\Package::where('package_for', 'like', 'employer')->get();

        $package = Auth::guard('company')->user()->getPackage();

        

        ?>

        

        <?php if(null !== $package){ ?>

        @include('includes.company_package_msg')

        @include('includes.company_packages_upgrade')

        <?php }elseif(null !== $packages){ ?>

        @include('includes.company_packages_new')

        <?php }} ?>

        </div>

        </div>

    </div>

</div>




@include('includes.footer')

@endsection

@push('scripts')
<script src="https://sandbox.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID')}}"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return fetch('/paypal/order', {
                method: 'post',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    package_id:'3'  // Pass the relevant package_id
                })
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                return orderData.id;
            });
        },
        onApprove: function(data, actions) {
            return fetch('/paypal/order/3/capture', {
                method: 'post',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                // Handle the captured order details
                console.log('Capture result', orderData);
            });
        }
    }).render('#paypal-button-container');
</script>

@include('includes.immediate_available_btn')

@endpush

