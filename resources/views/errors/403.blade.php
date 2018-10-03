<!DOCTYPE html>
<html lang="en-US">
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
<meta name="msapplication-TileImage" content="img/favicon.png">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width,initial-scale=1">
<!-- Vendor CSS -->
<link href="/css/vendors.css" rel="stylesheet">
<!-- Theme CSS -->
<link href="/css/style.css" rel="stylesheet">
<!-- Theme Custom CSS -->
<link rel="stylesheet" href="/css/custom.css">
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
			var wf = d.createElement('script'), s = d.scripts[0];
			wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore(wf, s);
		})(document);</script>
</head>
<body class="page page-404">
<!-- .site-wrapper -->
<div class="site-wrapper">
<div class="site-content">
<div class="container">
<div class="page-404-logo site-logo text-center">
<a href="/index.html">
<img src="/img/logo-color-footer.png" alt="logo" width="200">
</a>
</div>
<div class="page-404-image">
<img src="/img/403.png">
</div>
<div class="page-404-text text-center">
<p>
<b class="typescale-5">
Anda tidak diizinkan mengakses url ini</b>
</p>
<p>
Silahkan kembali ke halaman <a href="/">
Homepage</a>
.</p>
</div>
<div class="page-404-search">
<form class="search-form search-form--inline" method="get" action="#">
<input type="text" name="s" class="search-form__input" placeholder="Type here to search" value="">
 <button type="submit" class="search-form__submit btn btn-primary">
Search</button>
</form>
</div>
</div>
</div>
</div>
<!-- .site-wrapper -->
<!-- Vendor -->
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
