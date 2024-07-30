<div class="section greybg">
    <div class="container">
        <div class="topsearchwrap">

        

        <div class="titleTop">
        <h3>{{__('Browse Jobs By Categories')}}</h3>
        </div>

                <div class="srchint">
                <ul class="row categorylisting">
                        @if(isset($topFunctionalAreaIds) && count($topFunctionalAreaIds)) 
                        @foreach($topFunctionalAreaIds as $functional_area_id_num_jobs)                        
                        <?php
                        $functionalArea = App\FunctionalArea::where('functional_area_id', '=', $functional_area_id_num_jobs->functional_area_id)->lang()->active()->first();
                        ?>
                         @if(null !== $functionalArea)

                        

                        <li class="col-lg-3 col-6">
                            <a class="catecard" href="{{route('job.list', ['functional_area_id[]'=>$functionalArea->functional_area_id])}}" title="{{$functionalArea->functional_area}}">
                                <div class="iconcircle">
                                @if ($functionalArea->image && file_exists(public_path('uploads/functional_area/' . $functionalArea->image)))
                                    <img src="{{ asset('uploads/functional_area/' . $functionalArea->image) }}" alt="">
                                @else
                                    <!-- Use your dummy image path or URL here -->
                                    <img src="{{ asset('images/no-image.png') }}" alt="Dummy Image">
                                @endif
                                </div>                                   
                                <div class="catedata">
                                    <h3>{!! \Illuminate\Support\Str::limit($functionalArea->functional_area, $limit = 20, $end = '...') !!}</h3>
                                    <div class="badge"><i class="fas fa-briefcase"></i> ({{$functional_area_id_num_jobs->num_jobs}}) {{__('Jobs')}}</div>
                                </div>
                            </a>
                        </li>

                        @endif @endforeach @endif
                    </ul>
                    <!--Categories end-->
                </div>

                <div class="viewallbtn"><a href="{{url('/all-categories')}}">{{__('View All Categories')}}</a></div>

            
        </div>
    </div>
</div>