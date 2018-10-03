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
            <div class="mnmd-block mnmd-block--fullwidth mnmd-block--contiguous page-heading page-heading--center page-heading--has-background">
                <div class="container">
                    <h2 class="page-heading__title">Kata Kunci: {{ $katakunci }}</h2>
                    <div class="page-heading__subtitle">Semua berita yang mengandung kata kunci {{ $katakunci }}</div>
                </div>
            </div>
            <div class="mnmd-block mnmd-block--fullwidth">
                <div class="container container--narrow">
                    <div class="posts-list list-unstyled list-space-lg">
                        @if($hasil->count() == 0)
                        <div class="alert alert-warning" role="alert">
                          <h4 class="alert-heading">Waduh !!</h4>
                          <p>Maaf artikel dengan kata kunci {{ $katakunci }} yang anda cari tidak ada. Silahkan gunakan kata kunci lain atau kembali ke halaman sebelumnya.</p>
                          <hr>
                          <p class="mb-0">Tidak ada data yang ditampilkan</p>
                        </div>
                        @endif
                      
                        @foreach($hasil as $ini)
                        <div class="list-item">
                            <article class="post post--horizontal post--horizontal-sm cat-{{ \App\Category::find($ini->category_id)->order }}">
                                <div class="post__thumb">
                                    <a href="/posts/{{ $ini->slug }}"><img src="/storage/{{ $ini->image }}"></a>
                                </div>
                                <div class="post__text"><a href="/category/{{ \App\Category::find($ini->category_id)->slug }}" class="post__cat cat-theme">{{ \App\Category::find($ini->category_id)->name }}</a>
                                    <h3 class="post__title typescale-3"><a href="/posts/{{ $ini->slug }}">{{ $ini->title }}</a></h3>
                                    <div class="post__excerpt">{{ $ini->excerpt }}</div>
                                    <div class="post__meta"><span class="entry-author">By <a href="/author/{{ $ini->author_id }}" class="entry-author__name">{{ \App\User::find($ini->author_id)->name }}</a></span>
                                        <time class="time published" datetime="" title=""><i class="mdicon mdicon-schedule"></i>{{ $ini->created_at->format('l, j F Y h:i A') }}</time> <a href=""><i class=" fa fa-eye"></i> {{ $ini->views }} kali dilihat</a></div>
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                    <nav class="mnmd-pagination">
                       <div class="text-center">
                         {{ $hasil->render() }}
                       </div>
                    </nav>
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
        </div>
        <!-- .site-content -->
        
        
@endsection