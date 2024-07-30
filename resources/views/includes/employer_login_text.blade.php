@if(!Auth::user() && !Auth::guard('company')->user())
<div class="emploginbox">
		<div class="usrintxt">
		<div class="titleTop">			
           <h3>{{__('Are You Looking For Candidates!')}}</h3>
			<h4>{{__('Post a Job Today')}}</h4>
        </div>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nunc ex, maximus vel felis ut, vestibulum tristique enim. Proin eu nulla est. Maecenas tempor euismod suscipit. Sed at libero ante. Vestibulum nec odio lacus.</p>
		<div class="viewallbtn"><a href="{{route('register')}}">{{__('Post a Job')}}</a></div>
		</div>		
</div>
@endif