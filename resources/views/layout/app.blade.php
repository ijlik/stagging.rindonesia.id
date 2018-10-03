<!DOCTYPE html>
<html lang="en-US">

@yield('head')

<body class="home home-9 has-block-heading-line">
    <!-- .site-wrapper -->
    <div class="site-wrapper">
        <!-- Site header -->
        <header class="site-header site-header--skin-4">
            <!-- Header content -->
            <div class="header-main header-main--inverse hidden-xs hidden-sm">
                <div class="container">
                    <div class="row row--flex row--vertical-center">
                        <div class="col-xs-8">
                            <div class="site-logo header-logo text-left">
                                <a href="/">
                                    <img src="/img/logo-color.png" alt="logo" width="300">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="site-header__social inverse-text">
                                <ul class="social-list social-list--lg list-horizontal text-right">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-facebook">
</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter">
</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-youtube">
</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram">
</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header content -->
            <!-- Mobile header -->
            <div id="mnmd-mobile-header" class="mobile-header mobile-header--inverse visible-xs visible-sm">
                <div class="mobile-header__inner mobile-header__inner--flex">
                    <div class="header-branding header-branding--mobile mobile-header__section text-left">
                        <div class="header-logo header-logo--mobile flexbox__item text-left">
                            <a href="home-1.html">
                                <img src="/img/logo-color.png" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="mobile-header__section text-right">
                        <button type="submit" class="mobile-header-btn js-search-dropdown-toggle">
                            <span class="hidden-xs">
Search</span>
                            <i class="mdicon mdicon-search mdicon--last hidden-xs">
</i>
                            <i class="mdicon mdicon-search visible-xs-inline-block">
</i>
                        </button>
                        <a href="#mnmd-offcanvas-primary" class="offcanvas-menu-toggle mobile-header-btn js-mnmd-offcanvas-toggle">
                            <span class="hidden-xs">
Menu</span>
                            <i class="mdicon mdicon-menu mdicon--last hidden-xs">
</i>
                            <i class="mdicon mdicon-menu visible-xs-inline-block">
</i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Mobile header -->
            <!-- Navigation bar -->
            <nav class="navigation-bar navigation-bar--inverse hidden-xs hidden-sm js-sticky-header-holder">
                <div class="container">
                    <div class="navigation-bar__inner">
                        <div class="navigation-bar__section">
                            <a href="#mnmd-offcanvas-primary" class="offcanvas-menu-toggle navigation-bar-btn js-mnmd-offcanvas-toggle">
                                <i class="mdicon mdicon-menu">
</i>
                            </a>
                        </div>
                        <div class="navigation-wrapper navigation-bar__section js-priority-nav">
                            <ul id="menu-main-menu" class="navigation navigation--main navigation--inline">
                                <!-- ======================================================================= -->
                                <li class="menu-item-cat-3"><a href="/"><i class="fa fa-home"></i> Home</a></li>
                                <!-- ======================================================================= -->

                                @foreach(\App\Category::where('id','!=',9)->get() as $menuatas)
                                <!-- ======================================================================= -->
                                <li class="menu-item-cat-4"><a href="/category/{{ $menuatas->slug }}">{{ $menuatas->name }}</a>
                                    <div class="mnmd-mega-menu">
                                        <div class="mnmd-mega-menu__inner">
                                            <ul class="posts-list list-unstyled">
                                                @foreach(\App\Post::where('category_id','=', $menuatas->id)->where('status','=','PUBLISHED')->orderBy('created_at','desc')->get()->take(5) as $postmenu )
                                                <li>
                                                    <article class="post post--vertical cat-6">
                                                        <div class="post__thumb">
                                                            <a href="/posts/{{ $postmenu->slug }}"><img src="/storage/{{ $postmenu->image }}"></a>
                                                        </div>
                                                        <div class="post__text">
                                                            <h3 class="post__title typescale-0"><a href="/posts/{{ $postmenu->slug }}">{{ $postmenu->title }}</a></h3>
                                                            <div class="post__meta">
                                                                <time class="time published"><i class="mdicon mdicon-schedule"></i>{{ $postmenu->created_at }}</time>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </li>
                                                @endforeach

                                            </ul>
                                            {{--<ul class="sub-categories">--}}
                                                {{--<li><a href="#cat-url" class="post__cat post__cat--bg cat-theme-bg cat-1">Mobile</a></li>--}}
                                                {{--<li><a href="#cat-url" class="post__cat post__cat--bg cat-theme-bg cat-2">Computer</a></li>--}}
                                                {{--<li><a href="#cat-url" class="post__cat post__cat--bg cat-theme-bg cat-3">Car</a></li>--}}
                                                {{--<li><a href="#cat-url" class="post__cat post__cat--bg cat-theme-bg cat-4">Gadgets</a></li>--}}
                                            {{--</ul>--}}
                                        </div>
                                    </div>
                                </li>
                                <!-- ======================================================================= -->
                                @endforeach

                            </ul>
                        </div>
                        <div class="navigation-bar__section">
                            <button type="submit" class="navigation-bar-btn js-search-dropdown-toggle">
                                <i class="mdicon mdicon-search"></i>
                            </button>
                            @if(Auth::user())
                            <a href="/kabar-baik" class="navigation-bar__login-btn navigation-bar-btn">
                                <i class="fa fa-edit"></i> Tulis Kabar Baik
                            </a>

                            <a id="navbarDropdown" class="navigation-bar-btn dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="btn btn-block btn-default" href="/author/{{ Auth::user()->id }}">
                                   Profile
                                </a>
                                <a class="btn btn-block btn-primary" href="/logout"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                   <i class="fa fa-power-off"></i> Logout
                                </a>

                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                          @else
                            <a href="#login-modal" class="navigation-bar__login-btn navigation-bar-btn" data-toggle="modal" data-target="#login-modal">
                                <i class="fa fa-edit"></i> Tulis Kabar Baik
                            </a>
                          @endif
                        </div>
                    </div>
                    <!-- .navigation-bar__inner -->
                    <div id="header-search-dropdown" class="header-search-dropdown ajax-search is-in-navbar js-ajax-search">
                        <div class="container container--narrow">
                            <form class="search-form search-form--horizontal" action="{{ url('/search') }}" method="GET">
                                {{ csrf_field() }}
                                <div class="search-form__input-wrap">
                                    <input type="text" name="keywords" class="search-form__input" placeholder="Pencarian" value="">
                                </div>
                                <div class="search-form__submit-wrap">
                                    <button type="submit" class="search-form__submit btn btn-primary">Selengkapnya</button>
                                </div>
                            </form>
                            <div class="search-results">
                                <div class="typing-loader">
                                </div>
                                <div class="search-results__inner">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .header-search-dropdown -->
                </div>
                <!-- .container -->
            </nav>
            <!-- Navigation-bar -->
        </header>
        @if(!$errors->isEmpty())
             <div class="container">
               <br>
                <div class="alert alert-danger alert-dismissible fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  @foreach($errors->all() as $err)
                  {{ $err }}
                  @endforeach
                </div>
            </div>
        @endif
      
        @yield('content')
        <!-- .site-content -->
        <!-- Site footer -->
        
        <footer class="site-footer site-footer--inverse inverse-text">
            <div class="site-footer__section site-footer__section--flex site-footer__section--seperated">
                <div class="container">
                    <div class="site-footer__section-inner">
                        <div class="site-footer__section-left">
                            <div class="site-logo">
                                <a href="home-1.html">
                                    <img src="/img/logo-color-footer.png" alt="logo" width="400">
                                </a>
                            </div>
                        </div>
                        <div class="site-footer__section-right">
                            <ul class="social-list-2 social-list--lg list-horizontal">
                            <!-- <ul class="social-list list-horizontal"> -->
                                <li><a style="text-decoration: none" href="#"><i class="fa fa-facebook"></i>&nbsp;&nbsp;&nbsp;</a></li>
                                <li><a style="text-decoration: none" href="#"><i class="fa fa-twitter"></i>&nbsp;&nbsp;&nbsp;</a></li>
                                <li><a style="text-decoration: none" href="#"><i class="fa fa-youtube"></i>&nbsp;&nbsp;&nbsp;</a></li>
                                <li><a style="text-decoration: none" href="#"><i class="fa fa-instagram"></i>&nbsp;&nbsp;&nbsp;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer__section site-footer__section--flex site-footer__section--bordered-inner">
                <div class="container">
                    <div class="site-footer__section-inner">
                        <div class="site-footer__section-left">
                            {{ \App\Setting::where('key','=','site.footer')->first()->value }}</a>
                        </div>
                        <div class="site-footer__section-right">
                            <nav class="footer-menu">
                                <ul id="menu-footer-menu" class="navigation navigation--footer navigation--center">
                                    @foreach(\App\Kanal::where('position','=','bottom')->get() as $menu)
                                    <li><a href="/page/{{ $menu->slug }}">{{ $menu->display_name }}</a></li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Site footer -->
        <!-- Sticky header -->
        <div id="mnmd-sticky-header" class="sticky-header site-header--skin-4 js-sticky-header">
            <!-- Navigation bar -->
            <nav class="navigation-bar navigation-bar--inverse navigation-bar--fullwidth hidden-xs hidden-sm">
                <div class="navigation-bar__inner">
                    <div class="navigation-bar__section">
                        <a href="#mnmd-offcanvas-primary" class="offcanvas-menu-toggle navigation-bar-btn js-mnmd-offcanvas-toggle">
                            <i class="mdicon mdicon-menu icon--2x"></i>
                        </a>
                        <div class="site-logo header-logo">
                            <a href="home-1.html">
                                <img src="/img/logo-mark-color.png" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="navigation-wrapper navigation-bar__section js-priority-nav">
                        <ul id="menu-main-menu-1" class="navigation navigation--main navigation--inline">
                            <li class="menu-item-cat-3"><a href="/"><i class="fa fa-home"></i> Home</a></li>
                            @foreach(\App\Category::where('id','!=',9)->get() as $topmenuscroll)
                            <li class="menu-item-cat-3"><a href="/category/{{ $topmenuscroll->slug }}">{{ $topmenuscroll->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="navigation-bar__section">
                        <button type="submit" class="navigation-bar-btn js-search-dropdown-toggle">
                            <i class="mdicon mdicon-search"></i>
                        </button>
                      @if(Auth::user())
                        <a href="/kabar-baik" class="navigation-bar__login-btn navigation-bar-btn">
                            <i class="fa fa-edit"></i> Tulis Kabar Baik
                        </a>
                      
                        <a id="navbarDropdown" class="navigation-bar-btn dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="btn btn-block btn-default" href="/author/{{ Auth::user()->id }}">
                               Profile
                            </a>
                            <a class="btn btn-block btn-primary" href="/logout"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                               <i class="fa fa-power-off"></i> Logout
                            </a>

                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                      @else
                        <a href="#login-modal" class="navigation-bar__login-btn navigation-bar-btn" data-toggle="modal" data-target="#login-modal">
                            <i class="fa fa-edit"></i> Tulis Kabar Baik
                        </a>
                      @endif
                        
                    </div>
                </div>
                <!-- .navigation-bar__inner -->
            </nav>
            <!-- Navigation-bar -->
        </div>
        <!-- Sticky header -->
        <!-- Login modal -->
        <div class="modal fade login-modal" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal-label">
            <div class="modal-dialog" role="document">
                <div class="modal-content login-signup-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&#10005;</span>
                        </button>
                        <div class="modal-title" id="login-modal-label">
                            <ul class="nav nav-tabs js-login-form-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#login-tab" aria-controls="login-tab" role="tab" data-toggle="tab">Masuk</a>
                                </li>
                                <li role="presentation">
                                    <a href="#signup-tab" aria-controls="signup-tab" role="tab" data-toggle="tab">Daftar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="login-tab">
                                {{--<div class="login-with-social">--}}
                                    {{--<p>--}}
                                        {{--Masuk dengan akun sosial media</p>--}}
                                    {{--<ul class="social-list social-list--circle list-center">--}}
                                        {{--<li>--}}
                                            {{--<a href="#" class="facebook-theme-bg text-white">--}}
                                                {{--<i class="fa fa-facebook"></i>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="#" class="twitter-theme-bg text-white">--}}
                                                {{--<i class="fa fa-twitter"></i>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="#" class="googleplus-theme-bg text-white">--}}
                                                {{--<i class="fa fa-instagram"></i>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                                {{--<div class="block-divider">--}}
                                    {{--<span>atau</span>--}}
                                {{--</div>--}}
                                <form action="{{ route('voyager.login') }}" method="POST">
                                      {{ csrf_field() }}
                                      <div class="form-group form-group-default" id="emailGroup">
                                          <label>{{ __('voyager::generic.email') }}</label>
                                          <div class="controls">
                                              <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('voyager::generic.email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                           </div>
                                      </div>

                                      <div class="form-group form-group-default" id="passwordGroup">
                                          <label>{{ __('voyager::generic.password') }}</label>
                                          <div class="controls">
                                              <input type="password" name="password" placeholder="{{ __('voyager::generic.password') }}" class="form-control" required>
                                          </div>
                                      </div>

                                      <button type="submit" class="btn btn-block btn-primary login-button">
                                          <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                                          <span class="signin">{{ __('voyager::generic.login') }}</span>
                                      </button>
                                      <hr>
                                      <p class="login-lost-password">
                                        <a href="#forgot-tab" aria-controls="forgot-tab" role="tab" data-toggle="tab" class="link link--darken">Lupa password anda?</a>
                                      </p>
                                </form>

                                <div style="clear:both"></div>

                                

                            </div>
                          
                            <div role="tabpanel" class="tab-pane fade" id="forgot-tab">
                                <form method="POST" action="/forget-password">
                                    {{ csrf_field() }}
                                    <p class="login-username">
                                        <label for="user_login">
                                            Masukan email anda</label>
                                        <input type="email" name="email" id="user_login" class="input" value="" size="20" placeholder="Email">
                                        <p class="link link--darken">Kami akan mengirimkan pengaturan akun anda melalui email.</p>
                                        <div class="form-group form-group-default" id="captcha">
                                            <div class="g-recaptcha" data-sitekey="6LfDtXEUAAAAANBZyZSpXeVmiYJKwsYhC0LtrXh0" required></div>
                                        </div>
                                    </p>
                                    <button type="submit" class="btn btn-block btn-primary login-button">
                                        <span class="signingup hidden"><span class="voyager-refresh"></span> Mengirim...</span>
                                        <span class="signup">Kirim</span>
                                    </button>
                                </form>
                            </div>
                      
                            <div role="tabpanel" class="tab-pane fade" id="signup-tab">
                              <form method="POST" action="/register">
                                {{ csrf_field() }}

                                <div class="form-group form-group-default" id="nameGroup">
                                    <label>Nama Lengkap</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" value="{{ old('email') }}" placeholder="Nama Lengkap" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                     </div>
                                </div>
                                
                                <div class="form-group form-group-default" id="emailGroup">
                                    <label>Email</label>
                                    <div class="controls">
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                     </div>
                                </div>
                                <div class="form-group form-group-default" id="captcha">
                                    <div class="g-recaptcha" data-sitekey="6LfDtXEUAAAAANBZyZSpXeVmiYJKwsYhC0LtrXh0" required></div>
                                </div>

                                <button type="submit" class="btn btn-block btn-primary login-button">
                                    <span class="signingup hidden"><span class="voyager-refresh"></span> Mengirim...</span>
                                    <span class="signup">Daftar</span>
                                </button>
                                <hr>
                                <p class="login-lost-password">
                                    <a href="#login-tab" aria-controls="forgot-tab" role="tab" data-toggle="tab" class="link link--darken">Kembali ke Login</a>
                                </p>
                            </form>
<!--                                 <form name="login-form" id="loginform" action="#" method="post">
                                    <p class="login-username">
                                        <label for="user_login">
                                            Masukan email anda</label>
                                        <input type="email" name="email" id="user_login" class="input" value="" size="20" placeholder="Email">
                                        <p class="link link--darken">Kami akan mengirimkan reset akun anda melalui email.</p>
                                    </p>
                                    <p class="login-submit">
                                        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-block btn-primary" value="Kirim">
                                        <input type="hidden" name="redirect_to" value="#">
                                    </p>
                                    <p class="login-lost-password">
                                        <a href="#login-tab" aria-controls="forgot-tab" role="tab" data-toggle="tab" class="link link--darken">Kembali ke Login</a>
                                    </p>
                                </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login modal -->
        <!-- Off-canvas menu -->
        <div id="mnmd-offcanvas-primary" class="mnmd-offcanvas js-mnmd-offcanvas js-perfect-scrollbar">
            <div class="mnmd-offcanvas__title">
                <h2 class="site-logo"><a href="#"><img src="/img/logo-color.png" alt="logo" width="140"></a></h2>
                <ul class="social-list list-horizontal">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
                <a href="#mnmd-offcanvas-primary" class="mnmd-offcanvas-close js-mnmd-offcanvas-close" aria-label="Close">
                    <span aria-hidden="true">&#10005;</span>
                </a>
            </div>
            <div class="mnmd-offcanvas__section mnmd-offcanvas__section-navigation">
                <ul id="menu-offcanvas-menu" class="navigation navigation--offcanvas">
                    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="/author">Newsmaker</a></li>
                    <li><a href="/posts">Indeks Berita</a></li>
                    <li class="menu-item-has-children"><a href="">Kanal</a>
                        <ul class="sub-menu" style="display: none;">
                            @foreach(\App\Category::where('id','!=',9)->get() as $leftmenu)
                            <li><a href="/category/{{ $leftmenu->slug }}">{{ $leftmenu->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>                    
                </ul>
            </div>
            @if(Auth::user())
            <div class="mnmd-offcanvas__section">
                <ul id="menu-offcanvas-menu" class="navigation navigation--offcanvas">
                    <li><a href="/kabar-baik"><i class="fa fa-edit"></i> Tulis Kabar Baik</a>
                    </li>
                </ul>
            </div>
            <!-- Ketika sudah login -->
            <div class="mnmd-offcanvas__section">
                <ul id="menu-offcanvas-menu" class="navigation navigation--offcanvas">
                    <li class="menu-item-has-children"><a href="#">{{ Auth::user()->name }}</a>
                        <ul class="sub-menu" style="display: none">
                            <li><a href="/author/{{ Auth::user()->id }}">Profile</a></li>
                            <li><a href="/logout"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                               <i class="fa fa-power-off"></i> Logout
                            </a>

                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form></li>
                        </ul>
                    </li>
                </ul>
            </div>
            @else
            <div class="mnmd-offcanvas__section">
                <ul id="menu-offcanvas-menu" class="navigation navigation--offcanvas">
                    <li><a href="#login-modal" data-toggle="modal" data-target="#login-modal"><i class="fa fa-edit"></i> Tulis Kabar Baik</a>
                    </li>
                </ul>
            </div>
            <!-- Ketika belum login -->
            <div class="mnmd-offcanvas__section visible-xs visible-sm">
                <div class="text-center">
                    <a href="#login-modal" class="btn btn-default" data-toggle="modal" data-target="#login-modal">
                        <i class="mdicon mdicon-person mdicon--first"></i>
                        <span>Masuk / Daftar</span>
                    </a>
                </div>
            </div>
            @endif
            
            
        </div>
        <!-- Off-canvas menu -->
        <a href="#" class="mnmd-go-top btn btn-default hidden-xs js-go-top-el">
            <i class="mdicon mdicon-arrow_upward"></i>
        </a>
    </div>
    <!-- .site-wrapper -->
    <!-- Vendor -->
    @yield('script')
    <script type="text/javascript" src="/js/jquery.js">
    </script>
    <script type="text/javascript" src="/js/vendors.js">
    </script>
    <!-- Theme Scripts -->
    <script type="text/javascript" src="/js/scripts.js">
    </script>
    <!-- Theme Custom Scripts -->
    <script src="/js/custom.js">
    </script>
</body>

</html>