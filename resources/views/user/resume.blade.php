@extends('layouts.app')

@section('content') 

<!-- Header start --> 

@include('includes.header') 
<!-- Header end --> 

<!-- Inner Page Title start --> 

@include('includes.inner_page_title', ['page_title'=>__('Print Resume')]) 

<?php $true = FALSE; ?>



<?php 

if(Auth::guard('company')->user()){

$package = Auth::guard('company')->user();

if(null!==($package)){

    $array_ids = explode(',',$package->availed_cvs_ids);

    if(in_array($user->id, $array_ids)){

        $true = TRUE;

    }

}

}

?>

<!-- Inner Page Title end -->

<div class="listpgWraper">

    <div class="container">  
        @include('flash::message')  
<div class="row">

        @include('includes.user_dashboard_menu')

        <div class="col-md-9 col-sm-8" >
        <div id="printableArea" >
            <div class="js-embeddable">
            <div id="resume-cl-embed">
               <div class="tab-content">
                  <div class="tab-pane active" id="resume-tab">
                     <div class="resume-container custom-style-container elemental html">
                        <header class="about-section photo-resume">
                           <div class="personal-details">
                              <div class="row">
                                 <div class="col-md-3 col-sm-3">
                                    <div class="photo">
                                       {{$user->printUserImage()}}
                                    </div>
                                 </div>
                                 <div class="col-sm-9 name">
                                    <div class="name-inner">
                                       <h1>
                                         {{$user->getName()}}
                                       </h1>
                                       <h6 class="subheader">@if((bool)$user->is_immediate_available)

                                            <span>{{__('Immediate Available For Work')}}</span>

                                            @endif</h6>
                                    </div>
                                    <table class="contact">
                                       <tbody>
                                          <tr>
                                             <td class="label-container">
                                                <span class="contact-label break-word">
                                                Location:
                                                </span>
                                             </td>
                                             <td>
                                                <strong> {{$user->getLocation()}}</strong>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="label-container">
                                                <span class="contact-label break-word">
                                                {{__('Member Since')}} :
                                                </span>
                                             </td>
                                             <td>
                                                <strong>{{$user->created_at->format('M d, Y')}}</strong>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="label-container">
                                                <span class="contact-label break-word">
                                                Phone:
                                                </span>
                                             </td>
                                             <td>
                                                <strong class="break-word">
                                                   @if(!empty($user->phone))

                                                   <a href="tel:{{$user->phone}}">{{$user->phone}}</a>

                                                    @endif
                                                </strong>
                                             </td>
                                             <tr>
                                             <td class="label-container">
                                                <span class="contact-label break-word">
                                                Email:
                                                </span>
                                             </td>
                                             <td>
                                                <strong class="break-word">
                                                    @if(!empty($user->email))

                                                    <a href="mailto:{{$user->email}}">{{$user->email}}</a>

                                                    @endif
                                                </strong>
                                             </td>
                                         </tr>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </header>
                        <section class="resume-content-section photo-resume">
                           <div class="column-container">
                              <div class="three-fourth">
                                 <div class="section objective">
                                     <h2 class="section-header section-header-about">
                                       <span>
                                          {{__('About me')}}
                                       </span>
                                    </h2>
                                    <p style="text-align: justify;">{{$user->getProfileSummary('summary')}}</p>
                                 </div>
                                 <div class="section experiences">
                                    <h2 class="section-header">
                                       <span>
                                       {{__('Experience')}}
                                       </span>
                                    </h2>
                                    <div class="item-outer">
                                        <div class="" id="experience_div"></div>
                                    </div>
                                 </div>
                                 <div class="section educations">
                                    <h2 class="section-header">
                                       <span>
                                      {{__('Education')}}
                                       </span>
                                    </h2>
                                    <div class="item-outer">
                                      <div class="" id="education_div"></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="one-fourth">
                                 <div class="section honors">
                                    <h2 class="section-header">
                                       <span>
                                      {{__('Candidate Detail')}}
                                       </span>
                                    </h2>
                                    <div class="item">
                                       <div class="row">
                                          <div class="description col-md-12">
                                             <ul class="jbdetail">
                                                <li class="row">
                                                <div class="col-md-6 col-xs-6">{{__('Is Email Verified')}}</div>

                                                <div class="col-md-6 col-xs-6"><span>{{((bool)$user->verified)? 'Yes':'No'}}</span></div>
                                                </li>
                                                <li class="row">

                                                    <div class="col-md-6 col-xs-6">{{__('Immediate Available')}}</div>

                                                    <div class="col-md-6 col-xs-6"><span>{{((bool)$user->is_immediate_available)? 'Yes':'No'}}</span></div>

                                                </li>
                                               <li class="row">

                                                    <div class="col-md-6 col-xs-6">{{__('Age')}}</div>

                                                    <div class="col-md-6 col-xs-6"><span>{{$user->getAge()}} Years</span></div>

                                                </li>
                                                <li class="row">

                                                    <div class="col-md-6 col-xs-6">{{__('Gender')}}</div>

                                                    <div class="col-md-6 col-xs-6"><span>{{$user->getGender('gender')}}</span></div>

                                                </li>
                                                <li class="row">

                                                    <div class="col-md-6 col-xs-6">{{__('Marital Status')}}</div>

                                                    <div class="col-md-6 col-xs-6"><span>{{$user->getMaritalStatus('marital_status')}}</span></div>

                                                </li>

                                                <li class="row">

                                                    <div class="col-md-6 col-xs-6">{{__('Experience')}}</div>

                                                    <div class="col-md-6 col-xs-6"><span>{{$user->getJobExperience('job_experience')}}</span></div>

                                                </li>

                                                <li class="row">

                                                    <div class="col-md-6 col-xs-6">{{__('Career Level')}}</div>

                                                    <div class="col-md-6 col-xs-6"><span>{{$user->getCareerLevel('career_level')}}</span></div>

                                                </li>             

                                                <li class="row">

                                                    <div class="col-md-6 col-xs-6">{{__('Current Salary')}}</div>

                                                    <div class="col-md-6 col-xs-6"><span class="">{{$user->current_salary}} {{$user->salary_currency}}</span></div>

                                                </li>

                                                <li class="row">

                                                    <div class="col-md-6 col-xs-6">{{__('Expected Salary')}}</div>

                                                    <div class="col-md-6 col-xs-6"><span class="">{{$user->expected_salary}} {{$user->salary_currency}}</span></div>

                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="section skills">
                                    <h2 class="section-header">
                                       <span>
                                       {{__('Skills')}}
                                       </span>
                                    </h2>
                                    <div class="item">
                                       <div class="row">
                                          <div class="description col-md-12">
                                             <div id="skill_div"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </section>
                     </div>
                  </div>
               </div>
            </div>
        </div>
        </div>

        <div class="" style="text-align: center;">           
         <input style=""type="button" onclick="printDiv('printableArea')" class="btn btn-primary" value="Print Resume" />
        </div>  
</div>

</div>

</div>

<div class="modal fade" id="sendmessage" role="dialog">

    <div class="modal-dialog">



        <!-- Modal content-->

        <div class="modal-content">

            <form action="" id="send-form">

                @csrf

                <input type="hidden" name="seeker_id" id="seeker_id" value="{{$user->id}}">

                <div class="modal-header">                    

                    <h4 class="modal-title">Send Message</h4>

                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <textarea class="form-control" name="message" id="message" cols="10" rows="7"></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>

            </form>
            

        </div>
    </div>

</div>

@include('includes.footer')

@endsection

@push('styles')

<style type="text/css">

    .formrow iframe {

        height: 78px;

    }

</style>

@endpush

@push('scripts') 

<script type="text/javascript">

    $(document).ready(function () {

    $(document).on('click', '#send_applicant_message', function () {

    var postData = $('#send-applicant-message-form').serialize();

    $.ajax({

    type: 'POST',

            url: "{{ route('contact.applicant.message.send') }}",

            data: postData,

            //dataType: 'json',

            success: function (data)

            {

            response = JSON.parse(data);

            var res = response.success;

            if (res == 'success')

            {

            var errorString = '<div role="alert" class="alert alert-success">' + response.message + '</div>';

            $('#alert_messages').html(errorString);

            $('#send-applicant-message-form').hide('slow');

            $(document).scrollTo('.alert', 2000);

            } else

            {

            var errorString = '<div class="alert alert-danger" role="alert"><ul>';

            response = JSON.parse(data);

            $.each(response, function (index, value)

            {

            errorString += '<li>' + value + '</li>';

            });

            errorString += '</ul></div>';

            $('#alert_messages').html(errorString);

            $(document).scrollTo('.alert', 2000);

            }

            },

    });

    });

    showEducation();

    showProjects();

    showExperience();

    showSkills();

    showLanguages();

    });

    function showProjects()

    {

    $.post("{{ route('show.applicant.profile.projects', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})

            .done(function (response) {

            $('#projects_div').html(response);

            });

    }

    function showExperience()

    {

    $.post("{{ route('show.applicant.profile.experience', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})

            .done(function (response) {

            $('#experience_div').html(response);

            });

    }


    function showEducation()

    {

    $.post("{{ route('show.applicant.profile.education', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})

            .done(function (response) {

            $('#education_div').html(response);

            });

    }

    function showLanguages()

    {

    $.post("{{ route('show.applicant.profile.languages', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})

            .done(function (response) {

            $('#language_div').html(response);

            });

    }

    function showSkills()

    {

    $.post("{{ route('show.applicant.profile.skills', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})

            .done(function (response) {

            $('#skill_div').html(response);

            });

    }



    function send_message() {

        const el = document.createElement('div')

        el.innerHTML = "Please <a class='btn' href='{{route('login')}}' onclick='set_session()'>log in</a> as a Employer and try again."

        @if(null!==(Auth::guard('company')->user()))

        $('#sendmessage').modal('show');

        @else

        swal({

            title: "You are not Loged in",

            content: el,

            icon: "error",

            button: "OK",

        });

        @endif

    }

    if ($("#send-form").length > 0) {

        $("#send-form").validate({

            validateHiddenInputs: true,

            ignore: "",



            rules: {

                message: {

                    required: true,

                    maxlength: 5000

                },

            },

            messages: {



                message: {

                    required: "Message is required",

                }



            },

            submitHandler: function(form) {

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });

                @if(null !== (Auth::guard('company')->user()))

                $.ajax({

                    url: "{{route('submit-message-seeker')}}",

                    type: "POST",

                    data: $('#send-form').serialize(),

                    success: function(response) {

                        $("#send-form").trigger("reset");

                        $('#sendmessage').modal('hide');

                        swal({

                            title: "Success",

                            text: response["msg"],

                            icon: "success",

                            button: "OK",

                        });

                    }

                });

                @endif

            }

        })

    }

</script> 
<script type="text/javascript">
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print('');

     document.body.innerHTML = originalContents;
}
</script>
@endpush