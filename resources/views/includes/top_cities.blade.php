<div class="section citieswrap">
    <div class="container">
        <!-- title start -->
        <div class="titleTop">            
            <h3>{{__('Jobs by Cities')}}</h3>
        </div>
        <!-- title end -->
                <div class="srchint">
                    <ul class="row citiessrchlist">
                        @if(isset($topCityIds) && count($topCityIds)) @foreach($topCityIds as $city_id_num_jobs)
                        <?php
                        $city = App\City::getCityById($city_id_num_jobs->city_id);
                        ?> @if(null !== $city && $city->upload_image)

                        <li class="col-lg-3 col-md-4">
                        
                        @if(isset($city) && null!==($city->upload_image ))        
                        <div class="cityimg">{{ ImgUploader::print_image("city_images/$city->upload_image") }}</div>                   
                        @endif  
                        <div class="cityinfobox">
                        <h4><a href="{{route('job.list', ['city_id[]'=>$city->city_id])}}" title="{{$city->city}}">{{$city->city}}</a></h4>
                        <span>({{$city_id_num_jobs->num_jobs}}) {{__('Open Jobs')}}</span>
                        </div>
                        </li>

                        @endif @endforeach @endif
                    </ul>
                    <!--Cities end-->
                </div>
    </div>
</div>