<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="@yield('description_custom'){{$settings->description}}">
		<meta name="keywords" content="{{ $settings->keywords }}" />
		<link rel="shortcut icon" href="{{ asset('public/img/favicon.png') }}" />
		<title>@section('title')@show @if(isset($settings->title)){{$settings->title}}@endif</title>

		@include('includes.css_general')
		@yield('css')

@if($settings->color_default <> '')
<style>
::selection{ background-color: {{$settings->color_default}}; color: white; }
::moz-selection{ background-color: {{$settings->color_default}}; color: white; }
::webkit-selection{ background-color: {{$settings->color_default}}; color: white; }

body a,
a:hover,
a:focus,
a.page-link,
.btn-outline-primary {
    color: {{$settings->color_default}};
}
.btn-primary:not(:disabled):not(.disabled).active,
.btn-primary:not(:disabled):not(.disabled):active,
.show>.btn-primary.dropdown-toggle,
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active,
.btn-primary,
.btn-primary.disabled,
.btn-primary:disabled,
.custom-checkbox .custom-control-input:checked ~ .custom-control-label::before,
.page-item.active .page-link,
.page-link:hover {
    background-color: {{$settings->color_default}};
    border-color: {{$settings->color_default}};
}
.bg-primary,
.dropdown-item:focus,
.dropdown-item:hover,
.dropdown-item.active,
.dropdown-item:active,
.owl-theme .owl-dots .owl-dot.active span,
.owl-theme .owl-dots .owl-dot:hover span,
#updates li:hover:before {
    background-color: {{$settings->color_default}}!important;
}
.owl-theme .owl-dots .owl-dot.active span::before,
.owl-theme .owl-dots .owl-dot:hover span::before,
.form-control:focus,
.custom-checkbox .custom-control-input:indeterminate ~ .custom-control-label::before,
.custom-control-input:focus:not(:checked) ~ .custom-control-label::before,
.custom-select:focus,
.btn-outline-primary {
	border-color: {{$settings->color_default}};
}
.custom-control-input:not(:disabled):active~.custom-control-label::before,
.custom-control-input:checked~.custom-control-label::before,
.btn-outline-primary:hover,
.btn-outline-primary:focus,
.btn-outline-primary:not(:disabled):not(.disabled):active {
    color: #fff;
    background-color: {{$settings->color_default}};
    border-color: {{$settings->color_default}};
}
</style>
@endif
	<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/{{config('fb_app.lang')}}/sdk.js#xfbml=1&version=v2.8&appId={{config('fb_app.id')}}";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div class="popout font-default"></div>
		@include('includes.navbar')

<main role="main" @if(request()->path() != '/')style="padding-top: 78px;"@endif>
		@yield('content')

			@include('includes.footer')
</main>

		@include('includes.javascript_general')

	@yield('javascript')

<script type="text/javascript">
	Cookies.set('cookieBanner');

		$(document).ready(function() {
    if (Cookies('cookieBanner'));
    else {
    	$('.showBanner').fadeIn();
        $("#close-banner").click(function() {
            $(".showBanner").slideUp(50);
            Cookies('cookieBanner', true);
        });
    }
});
</script>
<div id="bodyContainer"></div>
</body>
</html>
