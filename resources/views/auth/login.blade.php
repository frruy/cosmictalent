@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Header start -->
@include('includes.inner_page_title', ['page_title'=>__('Login')])
<!-- Header end --> 




<div class="authpages">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
            @include('flash::message')
       
       <div class="useraccountwrap">

       <div class="userbtns">
                   <ul class="nav nav-tabs">
                       <?php
                       $c_or_e = old('candidate_or_employer', 'candidate');
                       ?>
                       <li class="nav-item"><a class="nav-link {{($c_or_e == 'candidate')? 'active':''}}" data-bs-toggle="tab" href="#candidate" aria-expanded="true">{{__('Candidate')}}</a></li>
                       <li class="nav-item"><a class="nav-link {{($c_or_e == 'employer')? 'active':''}}" data-bs-toggle="tab" href="#employer" aria-expanded="false">{{__('Employer')}}</a></li>
                   </ul>
               </div>
           <div class="userccount whitebg">
               
               
               
               <div class="tab-content">
                   <div id="candidate" class="formpanel mt-0 tab-pane {{($c_or_e == 'candidate')? 'active':''}}">
                    
                       <div class="socialLogin">
                                   <h5>{{__('Login with Social')}}</h5>
                                   <a href="{{ url('login/jobseeker/facebook')}}" class="fb"><i class="fab fa-facebook" aria-hidden="true"></i></a><a href="{{ url('login/jobseeker/twitter')}}" class="tw"><i class="fab fa-twitter" aria-hidden="true"></i></a> </div>

                                   <div class="divider-text-center"><span>{{__('Or login with your account')}}</span></div>


                       <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                           {{ csrf_field() }}
                           <input type="hidden" name="candidate_or_employer" value="candidate" />
                           <div class="formpanel">
                               <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                   <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('Email Address')}}">
                                   @if ($errors->has('email'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('email') }}</strong>
                                   </span>
                                   @endif
                               </div>
                               <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                                   <input id="password" type="password" class="form-control" name="password" value="" required placeholder="{{__('Password')}}">
                                   @if ($errors->has('password'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('password') }}</strong>
                                   </span>
                                   @endif
                               </div>  
                               <div class="mb-3"><i class="fas fa-lock" aria-hidden="true"></i> {{__('Forgot Your Password')}}? <a href="{{ route('password.request') }}">{{__('Click here')}}</a></div>          
                               <input type="submit" class="btn" value="{{__('Login')}}">
                           </div>
                           <!-- login form  end--> 
                       </form>
                       <!-- sign up form -->
               <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> {{__('New User')}}? <a href="{{route('register')}}">{{__('Register Here')}}</a></div>
               
               <!-- sign up form end-->
                   </div>
                   <div id="employer" class="formpanel mt-0 tab-pane fade {{($c_or_e == 'employer')? 'active':''}}">
                       <div class="socialLogin">
                                   <h5>{{__('Login with Social')}}</h5>
                                   <a href="{{ url('login/employer/facebook')}}" class="fb"><i class="fab fa-facebook" aria-hidden="true"></i></a> <a href="{{ url('login/employer/twitter')}}" class="tw"><i class="fab fa-twitter" aria-hidden="true"></i></a> </div>

                                   <div class="divider-text-center"><span>{{__('Or login with your account')}}</span></div>

                       <form class="form-horizontal" method="POST" action="{{ route('company.login') }}">
                           {{ csrf_field() }}
                           <input type="hidden" name="candidate_or_employer" value="employer" />
                           <div class="formpanel">
                               <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                   <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('Email Address')}}">
                                   @if ($errors->has('email'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('email') }}</strong>
                                   </span>
                                   @endif
                               </div>
                               <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                                   <input id="password" type="password" class="form-control" name="password" value="" required placeholder="{{__('Password')}}">
                                   @if ($errors->has('password'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('password') }}</strong>
                                   </span>
                                   @endif
                               </div>  
                               <div class="mb-3"><i class="fas fa-lock" aria-hidden="true"></i> {{__('Forgot Your Password')}}? <a href="{{ route('company.password.request') }}">{{__('Click here')}}</a></div>          
                               <input type="submit" class="btn" value="{{__('Login')}}">
                           </div>
                           <!-- login form  end--> 
                       </form>
                       <!-- sign up form -->
               <div class="newuser"><i class="fas fa-user" aria-hidden="true"></i> {{__('New User')}}? <a href="{{route('register')}}">{{__('Register Here')}}</a></div>
               
               <!-- sign up form end-->
                   </div>
               </div>
               <!-- login form -->

                

           </div>
       </div>
            </div>

        </div>
        
    </div>
</div>



@include('includes.footer')


@endsection
