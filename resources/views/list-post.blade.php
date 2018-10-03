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
                <div class="container-fluid max-width-xl">
                    <div class="page-heading page-heading--center">
                        <h2 class="page-heading__title cat-theme">Indeks Berita</h2>
                        <div class="page-heading__subtitle">Selalu update dengan berita terkini dari R Indonesia</div>
                    </div>
                    <div class="row row--space-between">
                        <div class="mosaic-item col-xs-12 col-lg-6">
                            <article class="post post--overlay post--overlay-floorfade post--overlay-bottom cat-{{ \App\Category::find($popular[0]->category_id)->order }}">
                                <div class="background-img" style="background-image: url('/storage/{{ $popular[0]->image }}')"></div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title typescale-4">{{ $popular[0]->title }}</h3>
                                            <div class="post__meta"><span class="entry-author">By <a href="/author/{{ $popular[0]->author_id }}" class="entry-author__name">{{ \App\User::find($popular[0]->author_id)->name }}</a></span></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/posts/{{ $popular[0]->slug }}" class="link-overlay"></a> <a href="/category/{{ \App\Category::find($popular[0]->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($popular[0]->category_id)->name }}</a>
                          </article>
                        </div>
                      
                        <div class="mosaic-item col-xs-12 col-md-6 col-lg-3">
                            <article class="post post--overlay post--overlay-floorfade post--overlay-bottom cat-{{ \App\Category::find($popular[1]->category_id)->order }}">
                                <div class="background-img" style="background-image: url('/storage/{{ $popular[1]->image }}')"></div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title typescale-3">{{ $popular[1]->title }}</h3>
                                            <div class="post__meta"><span class="entry-author">By <a href="/author/{{ $popular[1]->author_id }}" class="entry-author__name">{{ \App\User::find($popular[1]->author_id)->name }}</a></span></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/posts/{{ $popular[1]->slug }}" class="link-overlay"></a> <a href="/category/{{ \App\Category::find($popular[1]->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($popular[1]->category_id)->name }}</a>
                          </article>
                        </div>
                      
                        <div class="mosaic-item mosaic-item--half col-xs-12 col-sm-6 col-lg-3">
                            <article class="post post--overlay post--overlay-floorfade post--overlay-bottom cat-{{ \App\Category::find($popular[2]->category_id)->order }}">
                                <div class="background-img" style="background-image: url('/storage/{{ $popular[2]->image }}')"></div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title typescale-1"><a href="/posts/{{ $popular[2]->slug }}">{{ $popular[2]->title }}</a></h3>
                                            <div class="post__meta"><span class="entry-author">By <a href="/author/{{ $popular[2]->author_id }}" class="entry-author__name">{{ \App\User::find($popular[2]->author_id)->name }}</a></span></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/posts/{{ $popular[2]->slug }}" class="link-overlay"></a> <a href="/category/{{ \App\Category::find($popular[2]->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($popular[2]->category_id)->name }}</a>
                          </article>
                        </div>
                        <div class="mosaic-item mosaic-item--half col-xs-12 col-sm-6 col-lg-3">
                            <article class="post post--overlay post--overlay-floorfade post--overlay-bottom cat-{{ \App\Category::find($popular[3]->category_id)->order }}">
                                <div class="background-img" style="background-image: url('/storage/{{ $popular[3]->image }}')"></div>
                                <div class="post__text inverse-text">
                                    <div class="post__text-wrap">
                                        <div class="post__text-inner">
                                            <h3 class="post__title typescale-1"><a href="/posts/{{ $popular[3]->slug }}">{{ $popular[3]->title }}</a></h3>
                                            <div class="post__meta"><span class="entry-author">By <a href="/author/{{ $popular[3]->author_id }}" class="entry-author__name">{{ \App\User::find($popular[3]->author_id)->name }}</a></span></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/posts/{{ $popular[3]->slug }}" class="link-overlay"></a> <a href="/category/{{ \App\Category::find($popular[3]->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($popular[3]->category_id)->name }}</a>
                          </article>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .mnmd-block -->
            <div class="mnmd-block mnmd-block--fullwidth">
                <div class="container">
                    <div class="mnmd-ad-spot text-center">
                        <a href="https://ghadu.id" target="_blank"><img src="img/thb_adv.png" alt="thb-adv"></a>
                    </div>
                </div>
                <!-- .container -->
            </div>
  
            <!-- .mnmd-block -->
            <div class="mnmd-block mnmd-block--fullwidth">
                <div class="container">
                    <div class="posts-listing">
                        <div class="row row--space-between">
                            <?php $index = 0; ?>
                            @foreach($post as $ini)
                            <?php if($index == 2) { ?>
                            <div class="clearfix visible-sm"></div>
                            <?php } else if($index == 3) { ?>
                            <div class="clearfix visible-md visible-lg"></div>
                            <?php } else if($index == 4) { ?>
                            <div class="clearfix visible-sm"></div>
                            <?php } else if($index == 6) { ?>
                            <div class="clearfix hidden-xs"></div>
                            <?php } else if($index == 8) { ?>
                            <div class="clearfix visible-sm"></div>
                            <?php } ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <article class="post post--vertical cat-{{ \App\Category::find($ini->category_id)->order }}">
                                    <div class="post__thumb">
                                        <a href="/posts/{{ $ini->slug }}"><img src="/storage/{{ $ini->image }}"></a> </a><a href="/category/{{ \App\Category::find($ini->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left">{{ \App\Category::find($ini->category_id)->name }}</a></div>
                                    <div class="post__text">
                                        <h3 class="post__title typescale-2"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                        <div class="post__excerpt">{{ $ini->excerpt }}</div>
                                        <div class="post__meta"><span class="entry-author">By <a href="/author/{{ $ini->author_id }}" class="entry-author__name">{{ \App\User::find($ini->author_id)->name }}</a></span>
                                            <time class="time published" datetime="" title=""><i class="mdicon mdicon-schedule"></i>{{ $ini->created_at->format('l, j F Y h:i A') }}</time> <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a></div>
                                    </div>
                                </article>
                            </div>
                            <?php $index++; ?>
                            @endforeach
                        </div>
                        <!-- .row -->
                    </div>
                    <nav class="mnmd-pagination">
                       <div class="text-center">
                         {{ $post->links() }}
                       </div>
                    </nav>
<!--                     <nav class="mnmd-pagination">
                        <h4 class="mnmd-pagination__title sr-only">Posts navigation</h4>
                        <div class="mnmd-pagination__links text-center">
                          <a class="mnmd-pagination__item mnmd-pagination__item-prev" href="#"><i class="mdicon mdicon-arrow_back"></i></a> 
                          <a class="mnmd-pagination__item" href="#">1</a> 
                          <span class="mnmd-pagination__item mnmd-pagination__item-current">2</span> 
                          <a class="mnmd-pagination__item" href="#">3</a> 
                          <a class="mnmd-pagination__item" href="#">4</a> 
                          <span class="mnmd-pagination__item mnmd-pagination__dots">&hellip;</span> 
                          <a class="mnmd-pagination__item" href="#">26</a> 
                          <a class="mnmd-pagination__item mnmd-pagination__item-next" href="#"><i class="mdicon mdicon-arrow_forward"></i></a></div>
                    </nav> -->
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
        </div>
@endsection