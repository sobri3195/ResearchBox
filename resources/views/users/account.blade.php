@extends('app')

@section('title') {{ trans('users.account_settings') }} - @endsection

@section('content')
<div class="jumbotron mb-0 bg-sections text-center">
      <div class="container wrap-jumbotron position-relative">
        <h1>{{ trans('users.account_settings') }}</h1>
        <p class="mb-0">
          {{ trans('misc.account_desc') }}
        </p>
      </div>
    </div>

<div class="container py-5">

  <div class="wrap-container">
			<!-- Col MD -->
		<div class="col-md-12">

			@if (session('notification'))
			<div class="alert alert-success btn-sm alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		{{ session('notification') }}
            		</div>
            	@endif

			@include('errors.errors-forms')

		<!-- *********** AVATAR ************* -->

		<form action="{{url('upload/avatar')}}" method="POST" id="formAvatar" accept-charset="UTF-8" enctype="multipart/form-data">
    		@csrf

    		<div class="text-center position-relative avatar-wrap">

          <div class="progress-upload">0%</div>

          @if (auth()->user()->status != 'pending')
          <a href="javascript:;" class="position-absolute button-avatar-upload" id="avatar_file">
            <i class="fa fa-camera"></i>
          </a>
          <input type="file" name="photo" id="uploadAvatar" accept="image/*" style="visibility: hidden;">
          @endif

    			<img src="{{ asset('public/avatar').'/'.Auth::user()->avatar }}" alt="User" width="125" height="125" class="rounded-circle avatarUser"  />
    		</div>
			</form><!-- *********** AVATAR ************* -->



		<!-- ***** FORM ***** -->
       <form action="{{ url('account') }}" method="post" name="form">
          	@csrf
            <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label>{{ trans('misc.full_name_misc') }}</label>
              <input type="text" class="form-control" value="{{ e( auth()->user()->name ) }}" name="full_name" placeholder="{{ trans('misc.full_name_misc') }}" title="{{ trans('misc.full_name_misc') }}" autocomplete="off">
             </div><!-- ***** Form Group ***** -->

			<!-- ***** Form Group ***** -->
            <div class="form-group">
            	<label>{{ trans('auth.email') }}</label>
              <input type="email" class="form-control" value="{{auth()->user()->email}}" name="email" placeholder="{{ trans('auth.email') }}" title="{{ trans('auth.email') }}" autocomplete="off">
         </div><!-- ***** Form Group ***** -->

         <!-- ***** Form Group ***** -->
            <div class="form-group">
            	<label>{{ trans('misc.country') }}</label>
            	<select name="countries_id" class="custom-select" >
                <option value="">{{trans('misc.select_your_country')}}</option>
                  @foreach (App\Models\Countries::orderBy('country_name')->get() as $country)
                    <option @if( auth()->user()->countries_id == $country->id ) selected="selected" @endif value="{{$country->id}}">{{ $country->country_name }}</option>
                    @endforeach
                          </select>
            	    </div><!-- ***** Form Group ***** -->

           <button type="submit" id="buttonSubmit" class="btn btn-block btn-lg btn-primary no-hover">{{ trans('misc.save_changes') }}</button>

           <div class="text-center mt-3">
             <a href="{{url('account/password')}}"><i class="fa fa-lock"></i> {{ trans('misc.change_password') }}</a>
           </div>

       </form><!-- ***** END FORM ***** -->

		</div><!-- /COL MD -->
  </div><!-- / Wrap -->

 </div><!-- container -->

 <!-- container wrap-ui -->
@endsection

@section('javascript')

<script type="text/javascript">

	//<<<<<<<=================== * UPLOAD AVATAR  * ===============>>>>>>>//
    $(document).on('change', '#uploadAvatar', function() {

      $('.progress-upload').show();

   (function() {

     var percent = $('.progress-upload');
 		 var percentVal = '0%';

	 $("#formAvatar").ajaxForm({
	 dataType : 'json',

   beforeSend: function() {
      percent.html(percentVal);
  },
  uploadProgress: function(event, position, total, percentComplete) {
      var percentVal = percentComplete + '%';
      percent.html(percentVal);
  },
	 success:  function(e){
	 if (e) {

     if (e.success == false) {
		$('.progress-upload').hide();

		var error = '';
        for($key in e.errors) {
        	error += '' + e.errors[$key] + '';
        }
		swal({
    			title: "{{ trans('misc.error_oops') }}",
    			text: ""+ error +"",
    			type: "error",
    			confirmButtonText: "{{ trans('users.ok') }}"
    			});

			$('#uploadAvatar').val('');
      percent.html(percentVal);

		} else {

			$('#uploadAvatar').val('');
			$('.avatarUser').attr('src',e.avatar);
      $('.progress-upload').hide();
      percent.html(percentVal);
		}

		}//<-- e
			else {
        $('.progress-upload').hide();
        percent.html(percentVal);
				swal({
    			title: "{{ trans('misc.error_oops') }}",
    			text: '{{trans("misc.error")}}',
    			type: "error",
    			confirmButtonText: "{{ trans('users.ok') }}"
    			});

				$('#uploadAvatar').val('');
			}
		   }//<----- SUCCESS
		}).submit();
    })(); //<--- FUNCTION %
});//<<<<<<<--- * ON * --->>>>>>>>>>>
//<<<<<<<=================== * UPLOAD AVATAR  * ===============>>>>>>>//
</script>
@endsection
