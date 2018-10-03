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
                    <h2 class="page-heading__title">Kategori: {{ $slug }}</h2>
                    <div class="page-heading__subtitle">Semua berita pada kategori {{ $slug }}</div>
                </div>
            </div>
            <div class="mnmd-block mnmd-block--fullwidth">
                <div class="container">
                    <div class="row">
                        <div class="mnmd-main-col" role="main">
                            <div class="mnmd-block">
                                <div class="posts-listing list-unstyled list-space-lg">
                                  <?php $index = 0; ?>
                                  @foreach($post as $ini)
                                    <?php if($index == 0 || $index == 4) { ?>
                                    <li class="list-item">
                                        <article class="post--overlay post--overlay-floorfade post--overlay-bottom post--overlay-sm post--overlay-padding-lg has-score-badge cat-{{ \App\Category::find($ini->category_id)->order }}">
                                            <div class="background-img" style="background-image: url('/storage/{{ $ini->image }}')"></div>
                                            <div class="post__text inverse-text">
                                                <div class="post__text-wrap">
                                                    <div class="post__text-inner"><a href="/category/{{ \App\Category::find($ini->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg">{{ \App\Category::find($ini->category_id)->name }}</a>
                                                        <h3 class="post__title typescale-4"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                                        <div class="post__excerpt">{{ $ini->excerpt }}</div>
                                                        <div class="post__meta"><span class="entry-author">By <a href="/author/{{ $ini->author_id }}" class="entry-author__name">{{ \App\User::find($ini->author_id)->name }}</a></span>
                                                            <time class="time published" datetime="" title=""><i class="mdicon mdicon-schedule"></i>{{ $ini->created_at->format('l, j F Y h:i A') }}</time>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="/posts/{{ $ini->slug }}" class="link-overlay"></a>
                                        </article>
                                    </li>
                                    <?php } else { ?> 
                                    <div class="list-item">
                                        <article class="post post--horizontal post--horizontal-sm cat-{{ \App\Category::find($ini->category_id)->order }}">
                                            <div class="post__thumb">
                                                <a href="/posts/{{ $ini->slug }}"><img src="/storage/{{ $ini->image }}"></a>
                                            </div>
                                            <div class="post__text"><a href="/category/{{ \App\Category::find($ini->category_id)->slug }}" class="post__cat cat-theme">{{ \App\Category::find($ini->category_id)->name }}</a>
                                                <h3 class="post__title typescale-2"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                                <div class="post__excerpt">{{ $ini->excerpt }}</div>
                                                <div class="post__meta"><span class="entry-author">By <a href="/author/{{ $ini->author_id }}" class="entry-author__name">{{ \App\User::find($ini->author_id)->name }}</a></span>
                                                    <time class="time published" datetime="" title=""><i class="mdicon mdicon-schedule"></i>{{ $ini->created_at->format('l, j F Y h:i A') }}</time> <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a></div>
                                            </div>
                                        </article>
                                    </div>
                                    <?php } ?>
                                    <?php $index++; ?>
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
                            <!-- Widget Indexed posts C -->
                            <div class="mnmd-widget-indexed-posts-c mnmd-widget widget">
                                <div class="widget__title">
                                    <h4 class="widget__title-text"><span class="first-word">{{ $slug }}</span> Terpopuler</h4>
                                    <div class="widget__title-seperator"></div>
                                </div>
                                <ol class="posts-list list-space-md list-seperated-exclude-first list-unstyled">
                                  
                                    <li>
                                        <article class="post post--overlay post--overlay-bottom cat-{{ \App\Category::find($firstpopular->category_id)->order }}">
                                            <div class="background-img background-img--darkened" style="background-image: url('/storage/{{ $firstpopular->image }}')"></div>
                                            <div class="post__text inverse-text">
                                                <div class="post__text-inner">
                                                    <div class="media">
                                                        <div class="media-left media-middle"><span class="list-index">1</span></div>
                                                        <div class="media-body media-middle">
                                                            <h3 class="post__title typescale-1">{{ $firstpopular->title }}</h3>
                                                            <div class="post__meta"><a href="/category/{{ \App\Category::find($firstpopular->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg">{{ \App\Category::find($firstpopular->category_id)->name }}</a> <a href="/#" class="post__comments"><i class="fa fa-eye"></i>{{ $firstpopular->views }} kali dilihat</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="/posts/{{ $firstpopular->slug }}" class="link-overlay"></a>
                                        </article>
                                    </li>
                                  <?php $nomorurut = 2; ?>
                                  @foreach($listpopular as $ini)
                                    <li>
                                        <article class="post cat-{{ \App\Category::find($ini->category_id)->order }}">
                                            <div class="media">
                                                <div class="media-left media-middle"><span class="list-index">{{ $nomorurut }}</span></div>
                                                <div class="media-body media-middle">
                                                    <h3 class="post__title typescale-0"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                                    <div class="post__meta"><a href="/category/{{ \App\Category::find($ini->category_id)->slug }}" class="post__cat post__cat--bg cat-theme-bg">{{ \App\Category::find($ini->category_id)->name }}</a> <a href="/#" class="post__comments"><i class="fa fa-eye"></i>{{ $ini->views }} kali dilihat</a></div>
                                                </div>
                                            </div>
                                        </article>
                                    </li>
                                  <?php $nomorurut++; ?>
                                  @endforeach
                                </ol>
                            </div>
                            <!-- Widget Indexed posts C -->
                            <div class="mnmd-widget-social-counter-counter mnmd-widget widget">
                                <div class="widget__title">
                                    <h4 class="widget__title-text"><span class="first-word">Iklan</span></h4>
                                </div>
                                <a href="#" ><img src="/img/iklan/iklan-2.png"></a>
                            </div>
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