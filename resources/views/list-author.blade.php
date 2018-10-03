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
            <div class="mnmd-block mnmd-block--fullwidth mnmd-block--contiguous page-heading page-heading--has-background">
                <div class="container">
                    <h2 class="page-heading__title">Newsmaker</h2>
                    <div class="page-heading__subtitle">Berikut ini adalah daftar penulis berdasarkan jumlah tulisan terbanyak</div>
                </div>
            </div>
            <div class="mnmd-block mnmd-block--fullwidth">
                <div class="container">
                    <div class="row">
                        <div class="mnmd-main-col" role="main">
                            <div class="mnmd-block">
                                <ul class="list-unstyled list-space-lg">
                                  <?php $n = 0; ?>
                                  @foreach($author as $ini)
                                    <li>
                                        <div class="author-box">
                                            <div class="author-box__image">
                                                <div class="author-avatar"><img alt="Ryan Reynold" src="/storage/{{ $ini->avatar }}" class="avatar photo" height="80" width="80"></div>
                                            </div>
                                            <div class="author-box__text">
                                                <div class="author-name meta-font"><a href="/author/{{ $ini->id }}" title="Posts by {{ $ini->name }}" rel="author">{{ $ini->name }}</a></div>
                                                <div class="author-bio">{{ $ini->bio }}</div>
                                                <div class="author-info">
                                                    <div class="row row--space-between row--flex row--vertical-center grid-gutter-20">
                                                        <div class="author-socials col-xs-12 col-sm-6">
                                                            <ul class="list-unstyled list-horizontal list-space-sm">
                                                                <li><a href="mailto:{{ $ini->email }}"><i class="mdicon mdicon-mail_outline"></i><span class="sr-only">e-mail</span></a></li>
                                                                <li><a href="{{ $ini->twitter_url }}"><i class="mdicon mdicon-twitter"></i><span class="sr-only">Twitter</span></a></li>
                                                                <li><a href="{{ $ini->facebook_url }}"><i class="mdicon mdicon-facebook"></i><span class="sr-only">Facebook</span></a></li>
                                                                <li><a href="{{ $ini->googleplus_url }}"><i class="mdicon mdicon-google-plus"></i><span class="sr-only">Google+</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($jumlah_post[$n] < $jumlah[$n])
                                                <h5>{{ $jumlah_post[$n] }} <span class="label label-success">berita yang tayang</span> dari {{ $jumlah[$n] }} <span class="label label-default">berita yang dikirim</span></h5>
                                                @elseif($jumlah_post[$n] = $jumlah[$n])
                                                <h5>{{ $jumlah[$n] }} <span class="label label-success">berita yang dikirim sukses ditayangkan</span></h5>
                                                @else
                                                <h5><span class="label label-info">belum ada berita yang dikirim</span></h5>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                  <?php $n++; ?>
                                  @endforeach
                                </ul>
                            </div>
                            <!-- .mnmd-block -->
                        </div>
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
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
        </div>
        <!-- .site-content -->
        
@endsection