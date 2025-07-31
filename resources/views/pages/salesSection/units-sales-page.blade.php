@extends('layouts.app')
@section('page-title','Services')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>

    .fixed-card {
        display: flex;
        flex-direction: column;
        height: 550px;
        margin-bottom: 30px;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        background-color: #fff;
        transition: all 0.3s ease-in-out;
        overflow: hidden;

    }

    .fixed-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
        border-color: #ffd200;
    }
    .fixed-card .card-body {
        padding: 20px;
    }



    /* توحيد حجم الفيديو والصورة */
    .fixed-card figure {
        height: 250px;
        overflow: hidden;
        border-radius: 5px;
        position: relative;
    }

    .fixed-card figure video,
    .fixed-card figure img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 5px;
    }
    .center-video-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        font-size:24px;
        border:solid 2px rgba(255,255,255,.3);
        padding:16px;
        width:60px;
        height:60px;
        border-radius:60px;
        text-align:center;
        color:#fff;
    }
    .center-video-icon i.btn-action:hover{
        border-color:rgba(255,255,255,0);
        background:rgba(255,255,255,.3);
    }
    .more-details-btn {
        width: 100%;
        background-color: #ffd200;
        color: #222222 !important;
        border: 2px solid #ffd200; /* جرب 2px بدل 5px */
        border-radius: 6px;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        text-align: center;
        padding: 10px 12px;
        display: inline-block;
        box-shadow: none;
    }

    .more-details-btn:hover {
        background-color: #ffffff;
        color: rgba(34, 34, 34, 0.68) !important;
        text-decoration: none;
    }
    .address-widget
    {
        display: inline-block;
        background-color: #ffffff;
        border: 2px solid #ffd200; /* جرب 2px بدل 5px */
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: bold;
        color: #222222 !important;
        text-decoration: none;
        transition: background-color 0.3s;
        margin-top: 10px;
        margin-bottom: 10px
    }
    .address-widget:hover
    {
        background-color: #ffd200;
        color: #222222 !important;
        text-decoration: none;
    }

</style>

<style>
    body, h1, h2, h3, h4, h5, h6, p, a, span, li, button {
        font-family: 'Cairo', sans-serif;
    }

</style>
<style>
    .btn:hover {
        background-color: #ffd200 !important;
        color: #222222 !important;
    }
</style>
@section('main-content')
    <!-- subheader -->
    <section id="subheader" data-stellar-background-ratio=".3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Apartments for Sale</h1>
                    <div class="small-border-deco"><span></span></div>
                    <ul class="crumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="sep"></li>
                        <li>Apartments</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- subheader close -->
    <!-- content begin -->
    <div id="content">
        <div class="container">
            <div class="row">
                @foreach($projects as $item)
                    @php
                        $video = $item->video_url;
                        $main_image = $item->main_image ?? 'images/placeholder.jpg';
                        $diagram_image = $item->diagram_image ?? 'images/placeholder.jpg';
                    @endphp

                    <div class="col-md-4 col-sm-6 px-3 mb-4 wow fadeInUp" data-wow-delay=".{{ $loop->index }}s">
                        <div class="fixed-card">
                        <figure class="pic-hover hover-scale mb20">
  <span class="{{ $video ? 'center-video-icon' : 'center-xy' }}">
    @if($video)
          <a class="popup-video" href="{{ $video }}">
            <i class="fa fa-play btn-action btn-play btn-action-hide" style="color: #ffd200;"></i>
        </a>
      @elseif($main_image)
          <a class="image-popup" href="{{ $main_image }}">
            <i class="fa fa-image btn-action btn-action-hide" style="color: #ffd200;"></i>
        </a>
      @endif
</span>
                            <span class="bg-overlay"></span>

                            @if($video)
                                <video autoplay muted playsinline loop controls style="width: 100%; border-radius: 5px;">
                                    <source src="{{ $video }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @elseif($main_image)
                                <img src="{{ $main_image ?? asset('images/placeholder.jpg') }}" class="img-responsive" alt="" style="border-radius: 8px;">
                            @endif
                        </figure>
                        <div class="card-body">
                            <h3 style="font-size: 22px; font-weight: 700; color: #222222; line-height: 1.4;">
                                <i class="fa fa-building" style="color: #ffd200; margin-right: 6px;"></i>
                                <a href="{{ route('unitsBooks',$item->id) }}" style="color: #222222; text-decoration: none;" onmouseover="this.style.color='#ffd200'" onmouseout="this.style.color='#222222'">
                                    {{ $item->main_title }}
                                </a>
                            </h3>

                        <p style="color: #222222;">
                            <i class="fa fa-file-alt" style="color: #ffd200; margin-right: 6px;"></i>
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->marketing_description), 120) }}
                        </p>

                        <ul class="list-unstyled mb10" style="color: #222222;">
                            <li>
                                <i class="fa fa-barcode" style="color: #ffd200; margin-right: 6px;"></i>
                                <strong>Project Code:</strong> {{ $item->project->project_code }}
                            </li>

                            @if($item->project->number_of_floor)
                                <li>
                                    <i class="fa fa-layer-group" style="color: #ffd200; margin-right: 6px;"></i>
                                    <strong>Floors:</strong> {{ $item->project->number_of_floor }}
                                </li>
                            @endif

                            <li>
                                <i class="fa fa-calendar-alt" style="color: #ffd200; margin-right: 6px;"></i>
                                <strong>Completion Date:</strong>
                                {{ \Carbon\Carbon::parse($item->project->expected_date_of_completed)->format('F Y') }}
                            </li>
                            @if($item->address && $item->location_link)
                                <a href="{{ $item->location_link }}" target="_blank"
                                   class="address-widget">
                                    <i class="fa fa-map-marker-alt" style="margin-right: 6px;"></i> {{ $item->address }}
                                </a>
                            @endif
                        </ul>
                            <div>
                                <a href="{{route('unitsBooks',$item->id)}}"
                                   class="more-details-btn mt-3">
                                    <i class="fa fa-info-circle " style="margin-right: 5px"></i> More Details
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>


@endsection
