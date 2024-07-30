@extends('admin.layouts.admin_layout')
@push('css')
@endpush
@section('content')

<div class="page-content-wrapper"> 

    <!-- BEGIN CONTENT BODY -->

    <div class="page-content"> 

        <!-- BEGIN PAGE HEADER--> 

        <!-- BEGIN PAGE BAR -->

        <div class="page-bar">

            <ul class="page-breadcrumb">

                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>

                <li> <span>Company Details</span> </li>

            </ul>

        </div>




<div class="listpgWraper">

    <div class="container">
<br><br>
        @include('flash::message')

        <!-- Job Header start -->

        <div class="job-header">

            <div class="jobinfo">

                <div class="row">

                    <div class="col-md-8 col-sm-8">

                        <!-- Candidate Info -->

                        <div class="candidateinfo">
							<div class="row">
								<div class="col-md-2"><div class="userPic">{{$company->printCompanyImage()}}</div></div>
								<div class="col-md-10">
								<div class="title">{{$company->name}}</div>
                            <div class="desi">{{$company->getIndustry('industry')}}</div>
                            <div class="loctext"><i class="fa fa-history" aria-hidden="true"></i>
                                {{__('Member Since')}}, {{$company->created_at->format('M d, Y')}}</div>
                            <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                {{$company->location}}</div>
								</div>
							</div>
                            


                        </div>

                    </div>

                    <div class="col-md-4 col-sm-4">

                        <!-- Candidate Contact -->


                        <div class="candidateinfo">

                            @if(!empty($company->phone))

                            <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$company->phone}}">{{$company->phone}}</a></div>

                            @endif

                            @if(!empty($company->email))

                            <div class="loctext"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$company->email}}">{{$company->email}}</a></div>

                            @endif

                            @if(!empty($company->website) && filter_var($company->website, FILTER_VALIDATE_URL) !== FALSE)

                            <div class="loctext"><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{$company->website}}" target="_blank">{{$company->website}}</a></div>
                            @else
                            URL not present in profile
                            @endif

                            <div class="cadsocial"> {!!$company->getSocialNetworkHtml()!!} </div>

                        </div>                      

                        

                    </div>

                </div>

            </div>



        </div>



        <!-- Job Detail start -->

        <div class="row">

            <div class="col-md-8">

                <!-- About Employee start -->

                <div class="job-header">

                    <div class="contentbox">

                        <h3>{{__('About Company')}}</h3>

                        <p>{!! $company->description !!}</p>

                    </div>

                </div>



                <!-- Opening Jobs start -->

                <div class="relatedJobs">

                    <h3>{{__('Job Openings')}}</h3>

                    <ul class="searchList">
                        <?php $jobs = $company->jobs()->notExpire()->where('jobs.is_active', 1)->get(); ?>
                        @if(isset($jobs) && count($jobs))

                        @foreach($jobs as $companyJob)

                        <!--Job start-->

                        <li>

                            <div class="row">

                                <div class="col-md-8 col-sm-8">                                   

                                    <div class="jobinfo">

                                        <h3><a href="{{ route('public.job', ['id' => $companyJob->id]) }}"

                                                title="{{$companyJob->title}}">{{$companyJob->title}}</a></h3>

                                        

                                        <div class="location">

                                            <label class="fulltime"

                                                title="{{$companyJob->getJobType('job_type')}}">{{$companyJob->getJobType('job_type')}}</label>

                                            <label class="partTime"

                                                title="{{$companyJob->getJobShift('job_shift')}}">{{$companyJob->getJobShift('job_shift')}}</label>

                                            - <span>{{$companyJob->getCity('city')}}</span></div>

                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="listbtn"><a

                                            href="{{ route('public.job', ['id' => $companyJob->id]) }}">{{__('View Job Details')}}</a>

                                    </div>

                                </div>

                            </div>

                            <p>{{\Illuminate\Support\Str::limit(strip_tags($companyJob->description), 150, '...')}}</p>

                        </li>

                        <!--Job end-->

                        @endforeach

                        @endif



                        <!-- Job end -->

                    </ul>

                </div>

            </div>

            <div class="col-md-4">

                <!-- Company Detail start -->

                <div class="job-header">

                    <div class="jobdetail">

                        <h3>{{__('Company Details')}}</h3>

                        <ul class="jbdetail">

                            <li class="row">

                                <div class="col-md-6 col-xs-6">{{__('Email Verified')}}</div>

                                <div class="col-md-6 col-xs-6"><span>{{((bool)$company->verified)? 'Yes':'No'}}</span>

                                </div>

                            </li>

                            <li class="row">

                                <div class="col-md-6 col-xs-6">{{__('Total Employees')}}</div>

                                <div class="col-md-6 col-xs-6"><span>{{$company->no_of_employees}}</span></div>

                            </li>

                            <li class="row">

                                <div class="col-md-6 col-xs-6">{{__('Established In')}}</div>

                                <div class="col-md-6 col-xs-6"><span>{{$company->established_in}}</span></div>

                            </li>

                            <li class="row">

                                <div class="col-md-6 col-xs-6">{{__('Current jobs')}}</div>

                                <div class="col-md-6 col-xs-6">

                                    <span>{{$company->countNumJobs('company_id',$company->id)}}</span></div>

                            </li>

                        </ul>

                    </div>

                </div>




            </div>

        </div>

    </div>

</div>
</div>
</div>

@endsection

@push('styles')

<style type="text/css">

    .formrow iframe {

        height: 78px;

    }

</style>

@endpush

@push('scripts') 

<script type="text/javascript"></script> 

@endpush