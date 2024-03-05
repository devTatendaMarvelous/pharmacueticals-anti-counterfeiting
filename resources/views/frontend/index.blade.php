@extends('layouts.app')
@section('content')
    <!-- Banner Section Start -->
    <section class="banner-section container ratio_60 wow fadeInUp">
        <div class="title container pl-5">
            <h2>Our Registered Pharmacies </h2>
            <span class="title-leaf">
                <svg class="icon-width">
                    <use xlink:href="{{asset('assets/svg/leaf.svg')}}#leaf"></use>
                </svg>
            </span>
        </div>
        <div class="container-fluid-lg">
            <div class="banner-slider">
            @forelse ($agents as $agent )
                <div>
                    <div class="banner-contain hover-effect" >
                        <a href="{{ route('agent',[$agent->id]) }}" >
                            <img src="{{$agent->photo? asset('storage/'.$agent->photo):asset('assets/images/vegetable/banner/4.jpg')}}" class="bg-img blur-up lazyload " alt="" style="max-width: fit-content;
  overflow: hidden;">
                            <div class="banner-details" >
                                <div class="banner-box" style="background: linear-gradient(rgba(2, 97, 26, 0.5),rgba(2, 97, 26, 0.5))">

                                    {{-- <h5 class="text-white">{{ $agent->name }}</h5> --}}
                                    <h6 class="text-content text-white">{{ $agent->type_name }}</h6>
                                </div>
                            </div>
                            <div class="banner-button text-white bg-success btn py-2 ">
                                    <h5 class="text-white">{{ $agent->name }}</h5> <br>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
            @endforelse
            </div>
        </div>
    </section>
    <!-- Banner Section End -->
@endsection
