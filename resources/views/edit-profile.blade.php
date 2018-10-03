@extends('layout.app')

@section('head')
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>
        Edit Profile</title>
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
    <link rel="stylesheet" href="http://stagging.rindonesia.id/vendor/tcg/voyager/assets/css/app.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                    <div class="page-content container">
                        <form class="form-edit-add" role="form" action="/admin/users/{{ $author->id }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <!-- PUT Method if we are editing -->
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="panel panel-bordered">

                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <input type="text" class="form-control" id="name" placeholder="Name" value="{{ $author->name }}" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input type="email" class="form-control" id="email" placeholder="E-mail" value="{{ $author->email }}" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <br>
                                                <small>Biarkan kosong jika tidak ingin dirubah</small>
                                                <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="panel panel panel-bordered panel-warning">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <img src="/storage/{{ $author->avatar }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                                <input type="file" data-name="avatar" name="avatar">
                                            </div>
                                            <div class="form-group">
                                                <label for="bio">Biografi</label>
                                                <textarea rows="7" class="form-control" id="bio" name="bio">{{ $author->bio }}</textarea>

                                            </div>
                                            <div class="form-group">
                                                <label for="facebook">Facebook url</label>
                                                <input type="text" class="form-control" id="facebook_url" name="facebook_url" placeholder="Facebook url" value="{{ $author->facebook_url }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="twitter">Twitter url</label>
                                                <input type="text" class="form-control" id="twitter_url" name="twitter_url" placeholder="Twitter url" value="{{ $author->twitter_url }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="googleplus">Google Plus url</label>
                                                <input type="text" class="form-control" id="googleplus_url" name="googleplus_url" placeholder="Google Plus url" value="{{ $author->googleplus_url }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary pull-right save">
                                Update
                            </button>
                        </form>

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                        <form id="my_form" action="/admin/upload" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
                            {{ csrf_field() }}
                            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
                            <input type="hidden" name="type_slug" id="type_slug" value="users">
                        </form>
                    </div>
                </div>
                <!-- .container -->
            </div>
            <!-- .mnmd-block -->
        </div>
        <!-- .site-content -->
@endsection