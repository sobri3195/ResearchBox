@extends('app')

@section('title') {{ trans('auth.password') }} - @endsection

@section('content')
<div class="jumbotron mb-0 bg-sections text-center">
      <div class="container position-relative">
        <h1>{{ trans('auth.password') }}</h1>
        <p class="mb-0">
          {{ trans('misc.password_desc') }}
        </p>
      </div>
    </div>

<div class="container py-5">

  <div class="wrap-container">
		<!-- Col MD -->
		<div class="col-md-12">
			@if (session('notification'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
            		{{ session('notification') }}
            		</div>
            	@endif

            	 @if (session('incorrect_pass'))
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
            		{{ session('incorrect_pass') }}
            		</div>
            	@endif

			@include('errors.errors-forms')

		<!-- ***** FORM ***** -->
       <form action="{{ url('account/password') }}" method="post" name="form">

          	<input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- ***** Form Group ***** -->
            <div class="form-group">
            	<label>{{ trans('misc.old_password') }}</label>
              <input type="password" class="form-control" name="old_password" placeholder="{{ trans('misc.old_password') }}" title="{{ trans('misc.old_password') }}" autocomplete="off">
             </div><!-- ***** Form Group ***** -->


         <!-- ***** Form Group ***** -->
            <div class="form-group">
            	<label>{{ trans('misc.new_password') }}</label>
              <input type="password" class="form-control" name="password" placeholder="{{ trans('misc.new_password') }}" title="{{ trans('misc.new_password') }}" autocomplete="off">
         </div><!-- ***** Form Group ***** -->


           <button type="submit" id="buttonSubmit" class="btn btn-block btn-lg btn-primary no-hover">{{ trans('misc.save_changes') }}</button>
           <div class="text-center mt-3">
             <a href="{{url('account')}}"><i class="fa fa-cog"></i> {{ trans('users.account_settings') }}</a>
           </div>
       </form><!-- ***** END FORM ***** -->

		</div><!-- /COL MD -->
    </div><!-- / Wrap -->
 </div><!-- container -->

 <!-- container wrap-ui -->
@endsection
