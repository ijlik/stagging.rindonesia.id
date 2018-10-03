@extends('layout.app')

@section('head')
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>
        {{ $post->title }} | R Indonesia</title>
    <meta name="keywords" content="{{ $post->meta_keywords }}">
    <meta name="description" content="{{ $post->meta_description }}">
    <meta name="author" content="{{ \App\User::find($post->author_id)->name }}">
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
<div class="site-content single-entry single-entry--video">
            @if(\App\Category::find($post->category_id)->type == 1)
            <div class="mnmd-block mnmd-block--fullwidth mnmd-block--contiguous single-billboard single-billboard--video">
                <div class="single-billboard__background background-img blurred-more" style="background-image: url('/vendor/tcg/voyager/assets/images/bg.jpg')"></div>
                <div class="container">
                    <div class="row">
                        <div class="mnmd-main-col">
                            <div class="mnmd-responsive-video">
<!--                                 <iframe src="https://player.vimeo.com/video/189291290?title=0&byline=0&portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> -->
<!--                                 <iframe width="1207" height="679" src="{{ $post->embed_video }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
                                <iframe frameborder="0" src="{{ $post->embed_video }}" allow="autoplay" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="mnmd-sub-col">
                            <div class="block-heading block-heading--line block-heading--inverse">
                                <h2 class="block-heading__title">Watch next</h2></div>
                            <ul class="list-unstyled list-space-md inverse-text">
                              @foreach(\App\Post::where('status','=','PUBLISHED')->where('category_id','=',7)->where('id','!=',$post->id)->orderBy('created_at','desc')->get()->take(5) as $ini)
                              <li>
                                    <article class="post--horizontal post--horizontal-xs cat-2">
                                        <div class="post__thumb">
                                            <a href="#"><img src="/storage/{{ $ini->image }}"></a>
                                        </div>
                                        <div class="post__text">
                                            <h3 class="post__title typescale-0"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3></div>
                                    </article>
                                </li>
                              @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            @endif
            <div class="mnmd-block mnmd-block--fullwidth single-header-wrap">
                <div class="container">
                    <header class="single-header"><a href="/category/{{ \App\Category::find($post->category_id)->slug }}" class="entry-cat cat-theme cat-{{ \App\Category::find($post->category_id)->order }}">{{ \App\Category::find($post->category_id)->name }}</a>
                        <h1 class="entry-title entry-title--lg">{{ $post->title }}</h1>
                        <div class="entry-teaser entry-teaser--lg">{{ $post->excerpt }}</div>
                        <div class="entry-meta"><span class="entry-author entry-author--with-ava"><img alt="{{ \App\User::find($post->author_id)->name }}" src="/storage/{{ \App\User::find($post->author_id)->avatar }}" class="entry-author__avatar" height="34" width="34">By <a href="/author/{{ $post->author_id }}" class="entry-author__name" title="" rel="author">{{ \App\User::find($post->author_id)->name }}</a> </span>
                            <time class="entry-date published" datetime="" itemprop="datePublished" title=""><i class="mdicon mdicon-schedule"></i>{{ $post->created_at->format('l, j F Y h:i A') }}</time>
                            <time class="updated" datetime="" title="">{{ $post->updated_at }}</time>
                            <time class="entry-date published" datetime="" itemprop="datePublished" title=""><i class="fa fa-eye"></i>{{ $post->views }}</time>
                        </div>
                    </header>
                    <div class="entry-interaction entry-interaction--horizontal">
                        <div class="entry-interaction__left">
                            <div class="post-sharing post-sharing--simple">
                                <ul>
                                    <li><a href="/#" class="sharing-btn sharing-btn-primary facebook-btn facebook-theme-bg" data-toggle="tooltip" data-placement="top" title="Share on Facebook"><i class="mdicon mdicon-facebook"></i><span class="sharing-btn__text">Share</span></a></li>
                                    <li><a href="/#" class="sharing-btn sharing-btn-primary twitter-btn twitter-theme-bg" data-toggle="tooltip" data-placement="top" title="Share on Twitter"><i class="mdicon mdicon-twitter"></i><span class="sharing-btn__text">Tweet</span></a></li>
                                    <li><a href="/#" class="sharing-btn pinterest-btn pinterest-theme-bg" data-toggle="tooltip" data-placement="top" title="Share on Pinterest"><i class="mdicon mdicon-pinterest-p"></i></a></li>
                                    <li><a href="/#" class="sharing-btn googleplus-btn googleplus-theme-bg" data-toggle="tooltip" data-placement="top" title="Share on Google+"><i class="mdicon mdicon-google-plus"></i></a></li>
                                </ul>
                            </div>
                      </div>
                    </div>
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
            <div class="mnmd-block mnmd-block--fullwidth single-entry-wrap">
                <div class="container">
                    <div class="row">
                        <div class="mnmd-main-col" role="main">
                            <article class="mnmd-block post post--single post-10 type-post status-publish format-standard has-post-thumbnail hentry category-abroad tag-landscape cat-5" itemscope itemtype="http://schema.org/Article">
                                <!-- Schema meta -->
                                <div class="page-schema-meta">
                                    <link itemprop="mainEntityOfPage" href="/post/{{ $post->slug }}">
                                    <meta itemprop="headline" content="{{ $post->excerpt }}">
                                    <meta itemprop="datePublished" content="{{ $post->created_at->toDateString() }}">
                                    <meta itemprop="dateModified" content="{{ $post->updated_at->toDateString() }}">
                                    <meta itemprop="commentCount" content="24">
                                    <div itemprop="image" itemscope itemtype="/storage/{{ $post->image }}">
                                        <meta itemprop="url" content="#image-url">
                                        <meta itemprop="width" content="">
                                        <meta itemprop="height" content="">
                                    </div>
                                    <div itemscope itemprop="author" itemtype="{{ \App\User::find($post->author_id)->name }}">
                                        <meta itemprop="name" content="{{ \App\User::find($post->author_id)->name }}">
                                    </div>
                                    <div itemprop="publisher" itemscope itemtype="/">
                                        <meta itemprop="name" content="R Indonesia">
                                        <div class="hidden" itemprop="logo" itemscope itemtype="/img/logo-color.png">
                                            <meta itemprop="url" content="R Indonesia">
                                            <meta itemprop="width" content="">
                                            <meta itemprop="height" content="">
                                        </div>
                                    </div>
                                </div>
                                <!-- Schema meta -->
                                <div class="single-content">
                                    <div class="entry-thumb single-entry-thumb"><img src="/storage/{{ $post->image }}"></div>
                                    <div class="single-body entry-content typography-copy" itemprop="articleBody">
                                        <?php echo $post->body; ?>
                                    </div>
                                    <footer class="single-footer entry-footer">
                                        <div class="entry-info">
                                            <div class="row row--space-between grid-gutter-10">
                                                <div class="entry-categories col-sm-6" style="text-align: left;">
                                                    <ul>
                                                        <li class="entry-categories__icon"><i class="mdicon mdicon-folder"></i><span class="sr-only">Posted in</span></li>
                                                        <li><a href="/category/{{ \App\Category::find($post->category_id)->slug }}" class="entry-cat cat-theme cat-{{ \App\Category::find($post->category_id)->order }}">{{ \App\Category::find($post->category_id)->name }}</a></li>
                                                    </ul>
                                                </div>
                                                <div class="entry-tags col-sm-6">
                                                    <ul>
                                                        <li class="entry-tags__icon"><i class="mdicon mdicon-local_offer"></i><span class="sr-only">Hastag</span></li>
                                                        @foreach($hastag as $ini)
                                                        <li><a href="/hastag/{{ $ini }}" class="post-tag" rel="tag">{{ $ini }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entry-interaction entry-interaction--horizontal">
                                            <div class="entry-interaction__left">
                                                <div class="post-sharing post-sharing--simple">
                                                    <ul>
                                                        <li><a href="/#" class="sharing-btn sharing-btn-primary facebook-btn facebook-theme-bg" data-toggle="tooltip" data-placement="top" title="Share on Facebook"><i class="mdicon mdicon-facebook"></i><span class="sharing-btn__text">Share</span></a></li>
                                                        <!--
					-->
                                                        <li><a href="/#" class="sharing-btn sharing-btn-primary twitter-btn twitter-theme-bg" data-toggle="tooltip" data-placement="top" title="Share on Twitter"><i class="mdicon mdicon-twitter"></i><span class="sharing-btn__text">Tweet</span></a></li>
                                                        <!--
					-->
                                                        <li><a href="/#" class="sharing-btn pinterest-btn pinterest-theme-bg" data-toggle="tooltip" data-placement="top" title="Share on Pinterest"><i class="mdicon mdicon-pinterest-p"></i></a></li>
                                                        <!--
					-->
                                                        <li><a href="/#" class="sharing-btn googleplus-btn googleplus-theme-bg" data-toggle="tooltip" data-placement="top" title="Share on Google+"><i class="mdicon mdicon-google-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                                <!-- .single-content -->
                            </article>
                            <!-- .post--single -->
                            <div class="author-box single-entry-section">
                                <div class="author-box__image">
                                    <div class="author-avatar"><img alt="{{ \App\User::find($post->author_id)->name }}" src="/storage/{{ \App\User::find($post->author_id)->avatar }}" class="avatar photo" height="80" width="80"></div>
                                </div>
                                <div class="author-box__text">
                                    <div class="author-name meta-font"><a href="/author/{{ $post->author_id }}" title="Posts by {{ \App\User::find($post->author_id)->name }}" rel="author">{{ \App\User::find($post->author_id)->name }}</a></div>
                                    <div class="author-bio">{{ \App\User::find($post->author_id)->bio }}</div>
                                    <div class="author-info">
                                        <div class="row row--space-between row--flex row--vertical-center grid-gutter-20">
                                            <div class="author-socials col-xs-12 col-sm-6">
                                                <ul class="list-unstyled list-horizontal list-space-sm">
                                                    <li><a href="mailto:{{ \App\User::find($post->author_id)->email }}"><i class="mdicon mdicon-mail_outline"></i><span class="sr-only">e-mail</span></a></li>
                                                    <li><a href="{{ \App\User::find($post->author_id)->twitter_url }}"><i class="mdicon mdicon-twitter"></i><span class="sr-only">Twitter</span></a></li>
                                                    <li><a href="{{ \App\User::find($post->author_id)->facebook_url }}"><i class="mdicon mdicon-facebook"></i><span class="sr-only">Facebook</span></a></li>
                                                    <li><a href="{{ \App\User::find($post->author_id)->googleplus_url }}"><i class="mdicon mdicon-google-plus"></i><span class="sr-only">Google+</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Posts navigation -->
                            <div class="posts-navigation single-entry-section clearfix">
                                @if(!is_null($postbefore))
                                <div class="posts-navigation__prev">
                                    <article class="post--overlay post--overlay-bottom post--overlay-floorfade">
                                        <div class="background-img" style="background-image: url('/storage/{{ $postbefore->image }}')"></div>
                                        <div class="post__text inverse-text">
                                            <div class="post__text-wrap">
                                                <div class="post__text-inner">
                                                    <h3 class="post__title typescale-1">{{ $postbefore->title }}</h3></div>
                                            </div>
                                        </div>
                                        <a href="/posts/{{ $postbefore->slug }}" class="link-overlay"></a>
                                    </article><a class="posts-navigation__label" href="/posts/{{ $postbefore->slug }}"><span><i class="mdicon mdicon-arrow_back"></i>Artikel Sebelumnya</span></a>
                                </div>
                                @endif
                                @if(!is_null($postafter))
                                <div class="posts-navigation__next">
                                    <article class="post--overlay post--overlay-bottom post--overlay-floorfade">
                                        <div class="background-img" style="background-image: url('/storage/{{ $postafter->image }}')"></div>
                                        <div class="post__text inverse-text">
                                            <div class="post__text-wrap">
                                                <div class="post__text-inner">
                                                    <h3 class="post__title typescale-1">{{ $postafter->title }}</h3></div>
                                            </div>
                                        </div>
                                        <a href="/posts/{{ $postafter->slug }}" class="link-overlay"></a>
                                    </article><a class="posts-navigation__label" href="/posts/{{ $postafter->slug }}"><span>Artikel Selanjutnya<i class="mdicon mdicon-arrow_forward"></i></span></a>
                                </div>
                                @endif
                            </div>
                            <!-- Posts navigation -->
                            <!-- Related posts -->
                            <div class="related-posts single-entry-section">
                                <div class="block-heading block-heading--line">
                                    <h4 class="block-heading__title">You may also like</h4></div>
                                <div class="row row--space-between">
                                  @foreach($mayalsolike as $ini)
                                    <div class="col-xs-12 col-sm-4">
                                        <article class="post--vertical cat-{{ \App\Category::find($ini->category_id)->order }}">
                                            <div class="post__thumb">
                                                <a href="/posts/{{ $ini->slug }}"><img src="/storage/{{ $ini->image }}"></a>
                                            </div>
                                            <div class="post__text">
                                                <h3 class="post__title typescale-1"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                                <div class="post__meta">
                                                    <time class="time published" datetime="" title=""><i class="mdicon mdicon-schedule"></i> {{ $ini->created_at->format('l, j F Y h:i A') }}</time>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                  @endforeach
                                </div>
                                <!-- .row -->
                            </div>
                            <!-- Related posts -->
                            <!-- Same category posts -->
                            <div class="same-category-posts single-entry-section">
                                <div class="block-heading block-heading--line">
                                    <h4 class="block-heading__title">More in <a href="/category/{{ \App\Category::find($post->category_id)->slug }}" class="cat-{{ \App\Category::find($post->category_id)->order }} cat-theme">{{ \App\Category::find($post->category_id)->name }}</a></h4></div>
                                <div class="row row--space-between">
                                  @foreach($moreincategory as $ini)
                                    <div class="col-xs-12 col-sm-4">
                                        <article class="post--vertical cat-{{ \App\Category::find($ini->category_id)->order }}">
                                            <div class="post__thumb">
                                                <a href="/posts/{{ $ini->slug }}"><img src="/storage/{{ $ini->image }}"></a>
                                            </div>
                                            <div class="post__text">
                                                <h3 class="post__title typescale-1"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                                <div class="post__meta">
                                                    <time class="time published" datetime="" title=""><i class="mdicon mdicon-schedule"></i> {{ $ini->created_at->format('l, j F Y h:i A') }}</time>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                  @endforeach
                                </div>
                                <!-- .row -->
                                <nav class="mnmd-pagination text-center" role="navigation"><a href="/category/{{ \App\Category::find($post->category_id)->slug }}" class="btn btn-default">Lihat semua di {{ \App\Category::find($post->category_id)->name }}<i class="mdicon mdicon-arrow_forward mdicon--last"></i></a></nav>
                            </div>
                            <!-- Same category posts -->
                        </div>
                        <!-- .mnmd-main-col -->
                        <div class="mnmd-sub-col mnmd-sub-col--right sidebar js-sticky-sidebar" role="complementary">
                            <!-- Widget Indexed posts C -->
                            <div class="mnmd-widget-indexed-posts-c mnmd-widget widget">
                                <div class="widget__title">
                                    <h4 class="widget__title-text"><span class="first-word">Topik</span> Terpopuler</h4>
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
                            <!-- Widget posts list -->
                            <div class="mnmd-widget-posts-list mnmd-widget widget">
                                <div class="widget__title">
                                    <h4 class="widget__title-text">Artikel Terkini</h4></div>
                                <ul class="posts-list list-space-sm list-unstyled">
                                    @foreach($news as $ini)
                                    <li>
                                        <article class="post post--horizontal post--horizontal-xxs cat-{{ \App\Category::find($ini->category_id)->order }}">
                                            <div class="post__thumb">
                                                <a href="/posts/{{ $ini->slug }}"><img src="/storage/{{ $ini->image }}"></a>
                                            </div>
                                            <div class="post__text">
                                                <h3 class="post__title typescale-0"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                                <div class="post__meta"><a href="" class="post__comments"><i class="fa fa-eye"></i> {{ $ini->views }} kali dilihat</a></div>
                                            </div>
                                        </article>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Widget posts list -->
                        </div>
                        <!-- .mnmd-sub-col -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
        </div>
        
@endsection