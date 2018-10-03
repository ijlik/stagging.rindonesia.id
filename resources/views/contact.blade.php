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

    <!-- Site header -->
    <div class="site-content">
        <div class="mnmd-block mnmd-block--fullwidth mnmd-block--contiguous page-heading page-heading--has-background">
            <div class="container">
                <h1 class="page-heading__title">Hubungi Kami</h1>
                <div class="page-heading__subtitle">Kirimkan pesan anda melalui halaman ini. Pesan anda akan kami balas maksimal 1 minggu.</div>
            </div>
        </div>
        @if(!is_null($status))
            <div class="container">
                <br>
                <div class="alert alert-success alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p>{{ $messages }}</p>
                </div>
            </div>
        @endif

        <div class="mnmd-block mnmd-block--fullwidth">
            <div class="container">
                <div class="row">
                    <div class="mnmd-main-col">
                        <div class="single-content">
                            <div class="typography-copy">
                                <h3>Form Pesan</h3>
                                <form action="/hubungi-kami" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="status" value="baru">
                                    <div class="row">
                                        <div class="col-sm-4 form-group">
                                            <label for="contactform-name">Nama Lengkap <small>*</small></label>
                                            <input type="text" id="contactform-name" name="name" value="" class="form-control required" aria-required="true" required>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="contactform-email">Email <small>*</small></label>
                                            <input type="email" id="contactform-email" name="email" value="" class="required email form-control" aria-required="true" required>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="contactform-phone">Nomor Hp <small>*</small> (Whatsapp jika ada)</label>
                                            <input type="text" id="contactform-phone" name="phone" value="" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 form-group">
                                            <label for="contactform-subject">Subyek <small>*</small></label>
                                            <input type="text" id="contactform-subject" name="subject" value="" class="required form-control" aria-required="true" required>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label for="contactform-service">Kategori</label>
                                            <select id="contactform-service" name="category" class="form-control" required>
                                                <option value="">-- Pilih Salah Satu --</option>
                                                <option value="iklan">Iklan</option>
                                                <option value="karir">Karir</option>
                                                <option value="magang">Magang</option>
                                                <option value="redaksi">Redaksi</option>
                                                <option value="opini">Opini</option>
                                                <option value="kritik">Kritik & Saran</option>
                                                <option value="lain">Lain-Lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="contactform-message">Pesan <small>*</small></label>
                                        <textarea class="required form-control" id="contactform-message" name="body" rows="10" cols="30" aria-required="true" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit" id="contactform-submit" name="contactform-submit" value="submit">Send Message</button>
                                        {{--<a class="btn btn-success" href="">Send as Whatsapp</a>--}}
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- .single-content -->
                    </div>
                    <!-- .mnmd-main-col -->
                    <div class="mnmd-sub-col">
                        <div class="typography-copy">
                            <h3>Kontak</h3>
                            <dl><dt><i class="fa fa-address-card"></i><span> Postal Address</span></dt>
                                <dd>Jalan Raya Usuku Kulati, Nurul Furqon Media Lab, Timu, Tomia Timur, Tomia, Wakatobi Sulawesi Tenggara, Indonesia
                                    <br><b>Kode Pos : 93793</b></dd><br>

                                <dt><i class="fa fa-envelope"></i> <span>Email</span></dt>
                                <dd>redaksirumahindonesia@gmail.com</dd><br>

                            </dl>
                        </div>
                    </div>
                    <!-- .mnmd-sub-col -->
                </div>
                <!-- .row -->
            </div>
            <!-- .container -->
        </div>
        <div class="mnmd-block mnmd-block--fullwidth mnmd-block--contiguous">
            <a href="#" class="ratio-3by1 link-block">
                <div class="background-img" style="background-image: url('/vendor/tcg/voyager/assets/images/bg.jpg');"></div>
            </a>
        </div>
        <!-- .mnmd-block -->
    </div>
    <!-- .site-content -->

@endsection