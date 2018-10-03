@extends('layout.app')

@section('head')
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>
        {{ \App\Setting::where('key','=','site.title')->first()->value }}</title>
    <meta name="keywords" content="{{ \App\Setting::where('key','=','site.keywords')->first()->value }}">
    <meta name="description" content="{{ \App\Setting::where('key','=','site.description')->first()->value }}">
    <meta name="author" content="{{ \App\Setting::where('key','=','site.author')->first()->value }}">
    <!-- Favicon -->
    <link rel="icon" href="/img/favicon.png" sizes="32x32">
    <link rel="icon" href="/img/favicon.png" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="/img/favicon.png">
    <meta name="msapplication-TileImage" content="/img/favicon.png">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Vendor CSS -->
    <link href="/css/vendors.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="/css/style.css" rel="stylesheet">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/mavia/css/app.css">
    <script src="/mavia/js/sweetalert.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Web Fonts  -->
    <script>
        WebFontConfig = {
            google: {
                families: ['Rubik:300,400,700,900']
            },
            active: function() {
                $(window).trigger('webfontLoaded');
            }
        };

        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
</head>
@endsection

@section('content')

<div class="site-content">
            <div class="mnmd-block mnmd-block--fullwidth mnmd-mosaic mnmd-mosaic--gutter-10">
                <div class="container">
                    <div class="row row--space-between">
                      <!-- Headline 0 -->
                        <div class="mosaic-item col-xs-12 col-md-8">
                            <article class="post--overlay post--overlay-bottom post--overlay-floorfade post--overlay-padding-lg cat-{{ \App\Category::find($headline[0]->category_id)->order }}">
                                <div class="background-img" style="background-image: url('/storage/{{ $headline[0]->image }}')">
                                </div>
                                <div class="post__text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner inverse-text">
                                            <h3 class="post__title typescale-4">{{ $headline[0]->title }}</h3>
                                            <div class="post__excerpt post__excerpt--lg hidden-xs">
                                                {{ $headline[0]->excerpt }}</div>
                                            <div class="post__meta">
                                                <span class="entry-author">By <a href="#" class="entry-author__name">{{ \App\User::find($headline[0]->author_id)->name }}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/posts/{{ $headline[0]->slug }}" class="link-overlay">
                                </a>
                                <a href="/category/{{ \App\Category::find($headline[0]->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($headline[0]->category_id)->name }}</a>
                            </article>
                        </div>
                      
                      <!-- Headline 1 & 2 -->
                      <?php for($i = 1; $i<3; $i++){ ?>
                        <div class="mosaic-item mosaic-item--half col-xs-12 col-sm-6 col-md-4">
                            <article class="post--overlay post--overlay-bottom post--overlay-floorfade post--overlay-padding-lg cat-{{ \App\Category::find($headline[$i]->category_id)->order }}">
                                <div class="background-img" style="background-image: url('/storage/{{ $headline[$i]->image }}')">
                                </div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title typescale-2">{{ $headline[$i]->title }}</h3>
                                            <div class="post__meta">
                                                <span class="entry-author">By <a href="#" class="entry-author__name">{{ \App\User::find($headline[$i]->author_id)->name }}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/posts/{{ $headline[$i]->slug }}" class="link-overlay">
                                </a>
                                <a href="/category/{{ \App\Category::find($headline[$i]->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($headline[$i]->category_id)->name }}</a>
                            </article>
                        </div>
                      <?php } ?>
                                             
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
  
            <div class="mnmd-block mnmd-block--fullwidth mnmd-carousel mnmd-carousel-heading-aside has-background">
                <div class="background-svg-pattern background-svg-pattern--solid-color"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="carousel-heading">
                                <div class="block-heading block-heading--inverse block-heading--vertical">
                                    <h4 class="block-heading__title"><span class="first-word">R Live</span> Video</h4><span class="block-heading__subtitle">Tonton berita video terbaru</span></div>
                                <div class="mnmd-carousel-nav-custom-holder" data-carouselid="carousel-video-1">
                                    <div class="owl-prev js-carousel-prev"><i class="mdicon mdicon-arrow_back"></i></div>
                                    <div class="owl-next js-carousel-next"><i class="mdicon mdicon-arrow_forward"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-wrap col-xs-12 col-sm-8 col-md-9 fullwidth-xs">
                            <div id="carousel-video-1" class="owl-carousel js-mnmd-carousel-heading-aside-3i">
                              @foreach($rlive as $ini)
                                <div class="slide-content">
                                    <article class="post post--card post--card-sm cat-1 text-center shadow-hover-3">
                                        <div class="post__thumb">
                                            <a href="/posts/{{ $ini->slug }}">
                                                <div class="background-img" style="background-image: url('/storage/{{ $ini->image }}')"></div>
                                                <div class="overlay-item--center-xy post-type-icon"><i class="mdicon mdicon-play_circle_outline"></i></div>
                                            </a>
                                        </div>
                                        <div class="post__text"><a href="/category/r-live" class="post__cat cat-theme">R Live</a>
                                            <h3 class="post__title typescale-1"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3></div>
                                        <div class="post__footer">
                                            <div class="post__meta">
                                                <time class="time published" datetime="" title=""><i class="mdicon mdicon-schedule"></i>{{ $ini->created_at->format('l, j F Y h:i A') }}</time> <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a></div>
                                        </div>
                                    </article>
                                </div>
                              @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
            <div class="mnmd-layout-split mnmd-block mnmd-block--fullwidth">
                <div class="container">
                    <div class="row">
                        <div class="mnmd-main-col">
                            <div class="mnmd-block">
                                <div class="block-heading">
                                    <h4 class="block-heading__title"><span class="first-word">Topik</span> Pilihan</h4>
                                </div>
                                <div class="row row--space-between">
                                    <div class="col-xs-12 col-md-8">
                                        <div class="row row--space-between">
                                          
                                          <!-- Headline 3-->
                                            <div class="col-xs-12">
                                                <article class="post post--vertical cat-{{ \App\Category::find($headline[3]->category_id)->order }}">
                                                    <div class="post__thumb">
                                                        <a href="/posts/{{ $headline[3]->slug }}">
                                                            <img src="/storage/{{ $headline[3]->image }}">
                                                        </a>
                                                        <a href="/category/{{ \App\Category::find($headline[3]->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($headline[3]->category_id)->name }}</a>
                                                    </div>
                                                    <div class="post__text">
                                                        <h3 class="post__title typescale-3"><a href="/posts/{{ $headline[3]->slug }}">{{ $headline[3]->title }}</a></h3>
                                                        <div class="post__meta">
                                                            <span class="entry-author">By <a href="/author/{{ $headline[3]->author_id }}" class="entry-author__name">{{ \App\User::find($headline[3]->author_id)->name }}</a></span>
                                                            <time class="time published" datetime="" title=""><i class="mdicon mdicon-schedule"></i> {{ $headline[3]->created_at->format('l, j F Y h:i A') }}</time>
                                                            <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                          
                                          <?php for($i = 4; $i < 6; $i++) { ?>
                                            <div class="col-xs-12 col-sm-6">
                                                <article class="post post--vertical cat-{{ \App\Category::find($headline[$i]->category_id)->order }}">
                                                    <div class="post__thumb">
                                                        <a href="/posts/{{ $headline[$i]->slug }}">
                                                            <img src="/storage/{{ $headline[$i]->image }}">
                                                        </a>
                                                        <a href="/category/{{ \App\Category::find($headline[$i]->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($headline[$i]->category_id)->name }}</a>
                                                    </div>
                                                    <div class="post__text">
                                                        <h3 class="post__title typescale-1"><a href="/posts/{{ $headline[$i]->slug }}">{{ $headline[$i]->title }}</a></h3>
                                                        <div class="post__meta">
                                                            <time class="time published" datetime="" title="">
                                                                <i class="mdicon mdicon-schedule"></i> {{ $headline[$i]->created_at->format('l, j F Y h:i A') }}</time>
                                                            <a href=""><i class=" fa fa-eye"></i> {{ $headline[$i]->views }} kali dilihat</a>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                          <?php } ?>
                                          
                                        </div>
                                        <!-- .row -->
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <ul class="list-space-xs list-unstyled list-seperated">
                                          <?php for($i=6;$i<11;$i++){ ?>
                                            <li>
                                                <article class="post cat-{{ \App\Category::find($headline[$i]->category_id)->order }}">
                                                    <a href="/category/{{ \App\Category::find($headline[$i]->category_id)->slug }}" class="post__cat cat-theme">{{ \App\Category::find($headline[$i]->category_id)->name }}</a>
                                                    <h3 class="post__title typescale-0"><a href="/posts/{{ $headline[$i]->slug }}">{{ $headline[$i]->title }}</a></h3>
                                                    <div class="post__meta">
                                                        <time class="time published" datetime="" title="">
                                                            <i class="mdicon mdicon-schedule"></i> {{ $headline[$i]->created_at->format('l, j F Y h:i A') }}</time>
                                                    </div>
                                                </article>
                                            </li>
                                          <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- .row -->
                            </div>
                            <!-- .mnmd-block -->
                            <div class="mnmd-block mnmd-carousel">
                                <div class="block-heading">
                                    <h4 class="block-heading__title"><span class="first-word"></span>Infografik</h4>
                                </div>
                                <div class="owl-carousel js-carousel-3i4m-small">
                                    @foreach($infografis as $ini)
                                    <div class="slide-content">
                                        <article class="post--overlay post--overlay-sm has-score-badge-bottom cat-{{ \App\Category::find($ini->category_id)->order }}">
                                            <div class="background-img background-img--darkened" style="background-image: url('/storage/{{ $ini->image }}')">
                                            </div>
                                            <div class="post__text inverse-text text-center">
                                                <div class="post__text-wrap">
                                                    <div class="post__text-inner">
                                                        <h3 class="post__title typescale-2">{{ $ini->title }}</h3>
                                                        <div class="post__meta">
                                                            <time class="time published" datetime="2016-08-20T08:53+00:00" title="August 20, 2016 at 08:53 am">
                                                                <i class="mdicon mdicon-schedule"></i> {{ $ini->created_at->format('l, j F Y h:i A') }}
                                                            </time>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-score-hexagon">
                                                <svg class="hexagon-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" viewbox="-5 -5 184 210">
                                                    <g>
                                                        <path fill="#FC3C2D" stroke="#fff" stroke-width="10px" d="M81.40638795573723 2.9999999999999996Q86.60254037844386 0 91.7986928011505 2.9999999999999996L168.0089283341811 47Q173.20508075688772 50 173.20508075688772 56L173.20508075688772 144Q173.20508075688772 150 168.0089283341811 153L91.7986928011505 197Q86.60254037844386 200 81.40638795573723 197L5.196152422706632 153Q0 150 0 144L0 56Q0 50 5.196152422706632 47Z">
                                                        </path>
                                                    </g>
                                                </svg>
                                                <span class="post-score-value">{{ $ini->views }}</span>
                                            </div>
                                            <a href="/posts/{{ $ini->slug }}" class="link-overlay">
                                            </a>
                                        </article>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- .mnmd-block -->
                            <div class="mnmd-block">
                                <div class="block-heading">
                                    <h4 class="block-heading__title"><span class="first-word">Artikel</span> Terkini</h4>
                                </div>
                                <div class="posts-list list-space-lg">
                                    <div class="list-item">
                                        <article class="post post--vertical cat-{{ \App\Category::find($news[0]->category_id)->order }}">
                                            <div class="post__thumb">
                                                <a href="/posts/{{ $news[0]->slug }}">
                                                    <img src="/storage/{{ $news[0]->image }}">
                                                </a>
                                                <a href="/category/{{ \App\Category::find($news[0]->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($news[0]->category_id)->name }}</a>
                                            </div>
                                            <div class="post__text">
                                                <h3 class="post__title typescale-4">
                                                  <a href="/posts/{{ $news[0]->slug }}">
                                                  {{ $news[0]->title }}</a>
                                                  </h3>
                                                <div class="post__excerpt post__excerpt--lg">
                                                    {{ $news[0]->excerpt }}</div>
                                                <div class="post__meta">
                                                    <span class="entry-author">
                                                      By <a href="/author/{{ $ini->author_id }}" class="entry-author__name">
                                                      {{ \App\User::find($news[0]->author_id)->name }}</a>
                                                      </span>
                                                    <time class="time published" datetime="2016-08-20T08:53+00:00" title="August 20, 2016 at 08:53 am">
                                                        <i class="mdicon mdicon-schedule">
                                                      </i> {{ $news[0]->created_at->format('l, j F Y h:i A') }}</time>
                                                      <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                  <?php for($i = 1; $i < 6; $i++) { ?>
                                    <div class="list-item">
                                        <article class="post post--horizontal post--horizontal-sm cat-{{ \App\Category::find($news[$i]->category_id)->order }}">
                                            <div class="post__thumb">
                                                <a href="/posts/{{ $news[$i]->slug }}">
                                                    <img src="/storage/{{ $news[$i]->image }}">
                                                </a>
                                            </div>
                                            <div class="post__text">
                                                <a href="/category/{{ \App\Category::find($news[$i]->category_id)->slug }}" class="post__cat cat-theme"> {{ \App\Category::find($news[$i]->category_id)->name }}</a>
                                                <h3 class="post__title typescale-2">
                                                    <a href="/posts/{{ $news[$i]->slug }}">
                                                    {{ $news[$i]->title }}</a>
                                                    </h3>
                                                <div class="post__excerpt">
                                                    {{ $news[$i]->excerpt }}</div>
                                                <div class="post__meta">
                                                    <span class="entry-author">
                                                        By <a href="/author/{{ $news[$i]->author_id }}" class="entry-author__name">
                                                        {{ \App\User::find($news[$i]->author_id)->name }}</a>
                                                        </span>
                                                    <time class="time published" datetime="" title="">
                                                        <i class="mdicon mdicon-schedule">
                                                         </i> {{ $news[$i]->created_at->format('l, j F Y h:i A') }}</time>
                                                      <a href=""><i class=" fa fa-eye"></i> {{ $news[$i]->views }} kali dilihat</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- .mnmd-block -->
                        </div>
                        <!-- .mnmd-main-col -->
                        <div class="mnmd-sub-col js-sticky-sidebar" role="complementary">
                            <!-- Widget indexed posts B -->
                            <div class="mnmd-widget-indexed-posts-b mnmd-widget widget">
                                <div class="widget__title">
                                    <h4 class="widget__title-text"><span class="first-word">Topik</span> Terpopuler</h4>
                                </div>
                                <ol class="posts-list list-space-sm list-unstyled">
                                  @foreach($popular as $ini)
                                    <li>
                                        <article class="post post--vertical cat-{{ \App\Category::find($ini->category_id)->order }}">
                                            <div class="post__thumb">
                                                <a href="/posts/{{ $ini->slug }}">
                                                    <img src="/storage/{{ $ini->image }}">
                                                </a>
                                            </div>
                                            <div class="post__text">
                                                <a href="/category/{{ \App\Category::find($ini->category_id)->slug }}" class="post__cat cat-theme">{{ \App\Category::find($ini->category_id)->name }}</a>
                                                <h3 class="post__title typescale-1"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                                <div class="post__meta">
                                                    <time class="time published" datetime="" title=""><i class="mdicon mdicon-schedule"></i> {{ $ini->created_at->format('l, j F Y h:i A') }}</time>
                                                    <time class="time published" datetime="" title=""><i class="fa fa-eye"></i> {{ $ini->views }}</time>
                                                </div>
                                            </div>
                                        </article>
                                    </li>
                                  @endforeach
                                </ol>
                            </div>
                            <!-- Widget indexed posts B -->
                            <!-- Widget Most Commented -->
                            <div class="mnmd-widget-most-commented mnmd-widget widget">
                                <div class="widget__title">
                                    <h4 class="widget__title-text"><span class="first-word">Iklan</span></h4>
                                </div>
                              <div class="widget-content">
                                <a href="#" ><img src="/img/iklan/iklan-1.png"></a>
                                </div>
                            </div>
                            <!-- Widget Most Commented -->
                        </div>
                        <!-- .mnmd-sub-col -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
            <div class="mnmd-block mnmd-block--fullwidth mnmd-carousel mnmd-carousel-dots-none mnmd-carousel-nav-c">
                <div class="container">
                    <div class="block-heading">
                        <h4 class="block-heading__title"><span class="first-word">Tokoh Pilihan</span> Pekan ini</h4>
                    </div>
                    <div class="owl-carousel js-carousel-2i4m">
                      @foreach($tokoh as $ini)
                        <div class="slide-content">
                            <article class="post--overlay post--overlay-bottom post--overlay-floorfade post--overlay-sm post--overlay-padding-lg cat-{{ \App\Category::find($ini->category_id)->order }}">
                                <div class="background-img" style="background-image: url('/storage/{{ $ini->image }}')">
                                </div>
                                <div class="post__text inverse-text text-center">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <a href="" class="post__cat post__cat--bg cat-theme-bg">{{ \App\Category::find($ini->category_id)->name }}</a>
                                            <h3 class="post__title typescale-3">{{ $ini->title }}</h3>
                                            <div class="post__meta">
                                                <time class="time published" datetime="" title="">
                                                    <i class="mdicon mdicon-schedule"></i> {{ $ini->created_at->format('l, j F Y h:i A') }}</time>
                                                <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/posts/{{ $ini->slug }}" class="link-overlay">
                                </a>
                            </article>
                        </div>
                      @endforeach
                      
                    </div>
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
            <div class="mnmd-layout-split mnmd-block mnmd-block--fullwidth">
                <div class="container">
                    <div class="row">
                        <div class="mnmd-main-col" role="main">
                            <div class="mnmd-block">
                                <div class="posts-list list-space-lg">
                                    <div class="list-item">
                                        <article class="post post--vertical cat-{{ \App\Category::find($firstrand->category_id)->order }}">
                                            <div class="post__thumb">
                                                <a href="/posts/{{ $firstrand->slug }}">
                                                    <img src="/storage/{{ $firstrand->image }}">
                                                </a>
                                                <a href="/category/{{ \App\Category::find($firstrand->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($firstrand->category_id)->name }}</a>
                                            </div>
                                            <div class="post__text">
                                                <h3 class="post__title typescale-4"><a href="/posts/{{ $firstrand->slug }}">{{ $firstrand->title }}</a></h3>
                                                <div class="post__excerpt post__excerpt--lg">
                                                    {{ $firstrand->excerpt }}</div>
                                                <div class="post__meta">
                                                    <span class="entry-author">By <a href="/author/{{ $firstrand->author_id }}" class="entry-author__name">{{ \App\User::find($firstrand->author_id)->name }}</a></span>
                                                    <time class="time published" datetime="" title="">
                                                        <i class="mdicon mdicon-schedule"></i> {{ $firstrand->created_at->format('l, j F Y h:i A') }}</time>
                                                    <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                  @foreach($leftrand as $ini)
                                    <div class="list-item">
                                        <article class="post post--horizontal post--horizontal-sm cat-{{ \App\Category::find($ini->category_id)->order }}">
                                            <div class="post__thumb">
                                                <a href="/posts/{{ $ini->slug }}">
                                                    <img src="/storage/{{ $ini->image }}">
                                                </a>
                                            </div>
                                            <div class="post__text">
                                                <a href="/category/{{ \App\Category::find($ini->category_id)->slug }}" class="post__cat cat-theme">{{ \App\Category::find($ini->category_id)->name }}</a>
                                                <h3 class="post__title typescale-2"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                                <div class="post__excerpt">
                                                    {{ $ini->excerpt }}</div>
                                                <div class="post__meta">
                                                    <span class="entry-author">By <a href="/author/{{ $ini->author_id }}" class="entry-author__name">{{ \App\User::find($ini->author_id)->name }}</a></span>
                                                    <time class="time published" datetime="" title="">
                                                        <i class="mdicon mdicon-schedule"></i> {{ $ini->created_at->format('l, j F Y h:i A') }}</time>
                                                   <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                  @endforeach
                                </div>
                                <nav class="mnmd-pagination text-center">
                                    <a href="/posts" class="btn btn-default">Lihat artikel lainya<i class="mdicon mdicon-arrow_forward mdicon--last"></i></a>
                                </nav>
                            </div>
                            <!-- .mnmd-block -->
                        </div>
                        <!-- .mnmd-main-col -->
                        <div class="mnmd-sub-col mnmd-sub-col--right js-sticky-sidebar" role="complementary">
                            <!-- Widget posts list -->
                            <div class="mnmd-widget widget">
                                <div class="widget__title">
                                    <h4 class="widget__title-text"><span class="first-word">Random</span> posts</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="list-unstyled list-space-md list-seperated-exclude-first">
                                      
                                        <li>
                                            <article class="post post--overlay post--overlay-bottom post--overlay-floorfade post--overlay-xs cat-{{ \App\Category::find($secondrand->category_id)->order }}">
                                                <div class="background-img" style="background-image: url('/storage/{{ $secondrand->image }}')">
                                                </div>
                                                <a href="/posts/{{ $secondrand->slug }}" class="link-overlay">
                                                </a>
                                                <div class="post__text">
                                                    <div class="post__text-wrap">
                                                        <div class="post__text-inner inverse-text">
                                                            <a href="{{ \App\Category::find($secondrand->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg">{{ \App\Category::find($secondrand->category_id)->name }}</a>
                                                            <h3 class="post__title typescale-1">{{ $secondrand->title }}</h3>
                                                            <div class="post__meta">
                                                                <time class="time published" datetime="" title="">
                                                                    <i class="mdicon mdicon-schedule"></i> {{ $secondrand->created_at->format('l, j F Y h:i A') }}</time>
                                                                <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                      @foreach($rightrand as $ini)
                                        <li>
                                            <article class="post--horizontal post--horizontal-xxs cat-{{ \App\Category::find($ini->category_id)->order }}">
                                                <div class="post__thumb">
                                                    <a href="/posts/{{ $ini->slug }}">
                                                      <img src="/storage/{{ $ini->image }}">
                                                    </a>
                                                </div>
                                                <div class="post__text">
                                                    <h3 class="post__title typescale-0"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                                    <div class="post__meta">
                                                        <time class="time published" datetime="" title="">
                                                            <i class="mdicon mdicon-schedule"></i> {{ $ini->created_at->format('l, j F Y h:i A') }}</time>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                      @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- .mnmd-sub-col -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
            <div class="mnmd-block mnmd-block--fullwidth has-background">
                <div class="background-svg-pattern background-svg-pattern--solid-color">
                </div>
                <div class="container">
                    <div class="block-heading block-heading--center block-heading--lg block-heading--inverse">
                        <h4 class="block-heading__title"><span class="first-word">Editor's</span> Picks</h4>
                    </div>
                    <div class="row row--space-between">
                      @foreach($editorpick as $ini)
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <article class="post post--card post--card-sm cat-{{ \App\Category::find($ini->category_id)->order }} text-center shadow-hover-4">
                                <div class="post__thumb">
                                    <a href="/posts/{{ $ini->slug }}">
                                        <div class="background-img" style="background-image: url('/storage/{{ $ini->image }}')">
                                        </div>
                                    </a>
                                    <a href="/category/{{ \App\Category::find($ini->category_id)->slug }}" class="post__cat post__cat--bg post__cat--overlap cat-theme-bg">{{ \App\Category::find($ini->category_id)->name }}</a>
                                </div>
                                <div class="post__text">
                                    <h3 class="post__title typescale-1"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                </div>
                                <div class="post__footer">
                                    <div class="post__meta">
                                        <time class="time published" datetime="" title="">
                                            <i class="mdicon mdicon-schedule"></i> {{ $ini->created_at->format('l, j F Y h:i A') }}</time>
                                        <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a>
                                    </div>
                                </div>
                            </article>
                        </div>                    
                      @endforeach
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
        </div>
        <!-- .site-content -->
        
@endsection