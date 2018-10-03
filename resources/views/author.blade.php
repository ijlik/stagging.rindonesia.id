@extends('layout.app')

@section('head')
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>
        Semua berita oleh {{ $author->name }}</title>
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
            <div class="mnmd-block mnmd-block--fullwidth">
                <div class="container">
                    <div class="row">
                        <div class="mnmd-main-col" role="main">
                            <div class="mnmd-block">
                                <div class="author-box">
                                    <div class="author-box__image">
                                        <div class="author-avatar"><img alt="" src="/storage/{{ $author->avatar }}" class="avatar photo" height="80" width="80"></div>                                        
                                    </div>
                                    <div class="author-box__text">
                                        <div class="author-name meta-font"><a href="#" title="Posts by {{ $author->name }}" rel="author">{{ $author->name }}</a> </div>
                                        <div class="author-bio">{{ $author->bio }}</div>
                                        @if(Auth::user() && Auth::user()->id == $author->id)
                                        <form action="/author/{{ $author->id }}" method="POST">
                                          {{ csrf_field() }}
                                          <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Profile</button>
                                        </form>
                                        @endif
                                        <div class="author-info">
                                            <div class="row row--space-between row--flex row--vertical-center grid-gutter-20">
                                                <div class="author-socials col-xs-12 col-sm-6">
                                                    <ul class="list-unstyled list-horizontal list-space-sm">
                                                        <li><a href="mailto:{{ $author->email }}"><i class="mdicon mdicon-mail_outline"></i><span class="sr-only">e-mail</span></a></li>
                                                        <li><a href="{{ $author->twitter_url }}"><i class="mdicon mdicon-twitter"></i><span class="sr-only">Twitter</span></a></li>
                                                        <li><a href="{{ $author->facebook_url }}"><i class="mdicon mdicon-facebook"></i><span class="sr-only">Facebook</span></a></li>
                                                        <li><a href="{{ $author->googleplus_url }}"><i class="mdicon mdicon-google-plus"></i><span class="sr-only">Google+</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                      @if($jumlah_post < $jumlah)
                                      <h5>{{ $jumlah_post }} <span class="label label-success">berita yang tayang</span> dari {{ $jumlah }} <span class="label label-default">berita yang dikirim</span></h5>
                                      @elseif($jumlah_post = $jumlah)
                                      <h5>{{ $jumlah }} <span class="label label-success">berita yang dikirim sukses ditayangkan</span></h5>
                                      @else
                                      <h5><span class="label label-info">belum ada berita yang dikirim</span></h5>
                                      @endif
                                    </div>
                                </div>
                                <div class="spacer-lg"></div>
                                <div class="posts-list list-unstyled list-space-lg">
                                  @foreach($post as $ini)
                                    <div class="list-item">
                                        <article class="post post--horizontal post--horizontal-sm cat-{{ \App\Category::find($ini->category_id)->order }}">
                                            <div class="post__thumb">
                                                <a href="#"><img src="/storage/{{ $ini->image }}"></a>
                                            </div>
                                            <div class="post__text"><a href="/category/{{ \App\Category::find($ini->category_id)->slug }}" class="post__cat cat-theme">{{ \App\Category::find($ini->category_id)->name }}</a>
                                                <h3 class="post__title typescale-2"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                                <div class="post__excerpt">{{ $ini->excerpt }}</div>
                                                <div class="post__meta">@if(Auth::user() && Auth::user()->id == $author->id)<h5><span class="label label-{{ ($ini->status == 'PUBLISHED') ? 'success' : 'warning' }}">{{ $ini->status }}</span></h5>@endif
                                                    <time class="time published" datetime="" title=""><i class="mdicon mdicon-schedule"></i>{{ $ini->created_at->format('l, j F Y h:i A') }}</time> <a href="/posts/{{ $ini->slug }}" title=""><i class="fa fa-eye"></i> {{ $ini->views }} kali dilihat</a></div>
                                            </div>
                                        </article>
                                    </div>
                                  @endforeach
                                </div>
                                <nav class="mnmd-pagination">
                                   <div class="text-center">
                                     {{ $post->links() }}
                                   </div>
                                </nav>
                            </div>
                            <!-- .mnmd-block -->
                        </div>
                        <!-- .mnmd-main-col -->
                        <div class="mnmd-sub-col mnmd-sub-col--right sidebar js-sticky-sidebar" role="complementary">
                            <div class="mnmd-widget-social-counter-counter mnmd-widget widget">
                                <div class="widget__title">
                                    <h4 class="widget__title-text"><span class="first-word">Iklan</span></h4>
                                </div>
                                <a href="#" ><img src="/img/iklan/iklan-3.png"></a>
                            </div>
                            <!-- .widget -->
                            <div class="mnmd-widget-social-counter-counter mnmd-widget widget">
                                <div class="widget__title">
                                    <h4 class="widget__title-text"><span class="first-word">Iklan</span></h4>
                                </div>
                                <a href="#" ><img src="/img/iklan/iklan-1.png"></a>
                            </div>
                            <!-- .widget -->
                        </div>
                        <!-- .mnmd-sub-col -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
        </div>
        <!-- .site-content -->
        
@endsection