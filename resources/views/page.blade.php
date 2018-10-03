@extends('layout.app')

@section('head')
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>
        {{ $post->title }} | R Indonesia</title>
    <meta name="keywords" content="{{ $post->meta_keywords }}">
    <meta name="description" content="{{ $post->meta_description }}">
    <meta name="author" content="Tim Redaksi R Indonesia">
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

    <!-- Site header -->
    <div class="site-content single-entry single-entry--no-sidebar single-entry--billboard-overlap-title">
       <br><br><br><br>
        <div class="mnmd-block mnmd-block--fullwidth single-entry-wrap">
            <article class="post post--single post-10 type-post status-publish format-standard has-post-thumbnail hentry category-abroad tag-landscape cat-5" itemscope itemtype="http://schema.org/Article">
                <!-- Schema meta -->
                <div class="page-schema-meta">
                    <link itemprop="mainEntityOfPage" href="/page/{{ $post->slug }}">
                    <meta itemprop="headline" content="{{ $post->meta_description }}">
                    <meta itemprop="datePublished" content="{{ $post->created_at }}">
                    <meta itemprop="dateModified" content="{{ $post->updated_at }}">
                    <meta itemprop="commentCount" content="24">
                    <div itemprop="image" itemscope itemtype="">
                        <meta itemprop="url" content="">
                        <meta itemprop="width" content="1000">
                        <meta itemprop="height" content="563">
                    </div>
                    <div itemscope itemprop="author" itemtype="">
                        <meta itemprop="name" content="Tim Redaksi R Indonesia">
                    </div>
                    <div itemprop="publisher" itemscope itemtype="">
                        <meta itemprop="name" content="R Indonesia">
                        <div class="hidden" itemprop="logo" itemscope itemtype="">
                            <meta itemprop="url" content="">
                            <meta itemprop="width" content="200">
                            <meta itemprop="height" content="70">
                        </div>
                    </div>
                </div>
                <!-- Schema meta -->
                <div class="single-content">
                    <div class="container">
                        <header class="single-header single-header--center single-header--svg-bg single-header--has-background">
                            <div class="single-header__inner inverse-text">
                                <h1 class="entry-title entry-title--lg typescale-6">{{ $post->title }}</h1>
                            </div>
                        </header>
                    </div>
                    <div class="container container--narrow">

                        <div class="single-body single-body--wide entry-content typography-copy" itemprop="articleBody">
                            <?php echo $post->body; ?>
                        </div>

                    </div>
                    <!-- .container container--narrow -->
                </div>
                <!-- .single-content -->
            </article>
            <!-- .post--single -->
        </div>
    </div>

@endsection