@extends('layout.app')

@section('head')
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>
        Tulis Kabar Baik</title>
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
    <link rel="stylesheet" href="/vendor/tcg/voyager/assets/css/app.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/vendor/tcg/voyager/assets/css/app.css">

        <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
    
    <!-- Few Dynamic Styles -->
    <style type="text/css">
        .voyager .side-menu .navbar-header {
            background:#22A7F0;
            border-color:#22A7F0;
        }
        .widget .btn-primary{
            border-color:#22A7F0;
        }
        .widget .btn-primary:focus, .widget .btn-primary:hover, .widget .btn-primary:active, .widget .btn-primary.active, .widget .btn-primary:active:focus{
            background:#22A7F0;
        }
        .voyager .breadcrumb a{
            color:#22A7F0;
        }
    </style>

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

@section('script')
 <script type="text/javascript" src="http://stagging.rindonesia.id/vendor/tcg/voyager/assets/js/app.js"></script>

@endsection

@section('content')  
<div class="site-content">
            <div class="mnmd-block mnmd-block--fullwidth">
                <div class="container">
                    <div class="page-content container">
                        <form class="form-edit-add" role="form" action="/admin/posts" method="POST" enctype="multipart/form-data">
                            <!-- PUT Method if we are editing -->
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- ### TITLE ### -->
                                    <div class="panel">
                                        <div class="panel-body" style="">
                                            <h4 class="panel-title">
                                                    <i class="voyager-character"></i> Judul berita
                                                    <span class="panel-desc"> Judul berita yang akan anda tulis</span>
                                                </h4>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="" required>
                                        </div>
                                    </div>

                                    <!-- ### CONTENT ### -->
                                    <div class="panel">
                                        <div class="panel-body" style="">
                                          <h4 class="panel-title">Konten berita</h4>
                                          <textarea class="form-control richTextBox" name="body" id="richtextbody"></textarea>

                                        </div>
                                    </div>
                                    <!-- .panel -->


                                </div>
                                <div class="col-md-4">
                                    <!-- ### EXCERPT ### -->
                                    <div class="panel">
                                        <div class="panel-body" style="">
                                            <h4 class="panel-title">Kutipan <small>Kutipan singkat tentang berita ini</small></h4>
                                            <textarea rows="7" class="form-control" name="excerpt" required></textarea>
                                        </div>
                                    </div>
                                    <!-- ### DETAILS ### -->
                                    <div class="panel panel panel-bordered panel-warning">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label for="slug">URL slug</label>
                                                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" { data-slug-origin="title" data-slug-forceupdate="true" } value required>
                                            </div>
                                            <div class="form-group">
                                                <label for="category_id">Kategori berita</label>
                                                @if(Auth::user()->role_id == 3)
                                                <select class="form-control" name="category_id" required>
                                                    <option value="3">Kolom</option>
                                                    <option value="4">Tokoh</option>
                                                    <option value="5">Opini</option>
                                                    <option value="6">R Nesia</option>
                                                    <option value="7">R Live</option>
                                                    <option value="8">Generasi Z</option>
                                                    <option value="9">Infografis</option>
                                                </select>
                                                @endif
                                              
                                                @if(Auth::user()->role_id == 4)
                                                <select class="form-control" name="category_id" required>
                                                    <option value="3">Kolom</option>
                                                    <option value="4">Tokoh</option>
                                                    <option value="5">Opini</option>
                                                    <option value="6">R Nesia</option>
                                                    <option value="8">Generasi Z</option>
                                                </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ### IMAGE ### -->
                                    <div class="panel">
                                        <div class="panel-body" style="">
                                            <h4 class="panel-title"><i class="icon wb-image"></i> Gambar Berita</h4>
                                            <input type="file" name="image" required>
                                        </div>
                                    </div>

                                    <div class="panel">
                                        <div class="panel-body" style="">
                                          <h4 class="panel-title">Tambahan</h4>
                                            <input type="hidden" name="views" value="0">
                                            <input type="hidden" name="status" value="DRAFT">
                                            <div class="form-group  ">

                                                <label for="name">Embed Video</label>
                                                <input type="text" class="form-control" name="embed_video" placeholder="Embed Video" value="">

                                            </div>
                                            <div class="form-group  ">

                                                <label for="name">Hastag (pisahkan dengan koma ,)</label>
                                                <input type="text" class="form-control" name="hastag" placeholder="Hastag (pisahkan dengan koma ,)" value="" required>

                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary pull-right">
                                <i class="icon wb-plus-circle"></i> Kirim berita</button>
                        </form>

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                        <form id="my_form" action="/admin/upload" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
                            {{ csrf_field() }}
                            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
                            <input type="hidden" name="type_slug" id="type_slug" value="posts">
                        </form>
                    </div>
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
        </div>
        <!-- .site-content -->
@endsection