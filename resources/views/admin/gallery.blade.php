@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans('misc.gallery') }} ({{$data->count()}})
          </h4>

        </section>

        @include('errors.errors-forms')

        <!-- Main content -->
        <section class="content">

		    @if(Session::has('success_message'))
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		      <i class="fa fa-check margin-separator"></i> {{ Session::get('success_message') }}
		    </div>
		@endif

        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> {{ trans('misc.gallery') }}</h3>
                  <div class="box-tools">
                    <aa href="#" data-toggle="modal" data-target="#addNew" class="btn btn-sm btn-success no-shadow pull-right">
	        		<i class="glyphicon glyphicon-plus myicon-right"></i> {{ trans('misc.add_new') }}
	        		</a>
                  </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>

               	@if( $data->count() !=  0 )
                   <tr>
                      <th class="active">ID</th>
                      <th class="active">{{ trans('misc.image') }}</th>
                      <th class="active">{{ trans('admin.actions') }}</th>
                    </tr>

                  @foreach( $data as $gallery )
                    <tr>
                      <td>{{ $gallery->id }}</td>
                      <td><img src="{{ url('public/gallery', 'thumb-'.$gallery->image) }}" width="100" /></td>
                      <td>
                   {!! Form::open([
			            'method' => 'post',
			            'url' => ['panel/admin/gallery/delete', $gallery->id],
			            'id' => 'form'.$gallery->id,
			            'class' => 'displayInline'
				        ]) !!}
	            	{!! Form::submit(trans('admin.delete'), ['data-url' => $gallery->id, 'class' => 'btn btn-danger btn-sm padding-btn actionDelete']) !!}
	        	{!! Form::close() !!}
                      		</td>

                    </tr><!-- /.TR -->
                    @endforeach

                    @else
                    <hr />
                    	<h3 class="text-center no-found">{{ trans('misc.no_results_found') }}</h3>
                    @endif

                  </tbody>


                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- ***** Modal Create Subcategories ****** -->
      	<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      	  <div class="modal-dialog">
      	    <div class="modal-content">
      	      <div class="modal-header">
      	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      	        <h4 class="modal-title text-left" id="myModalLabel"><strong>{{{ trans('misc.add_new') }}}</strong></h4>
      	      </div>

              <!-- form start -->
             <form class="form-horizontal" method="post" action="{{{ url('panel/admin/gallery/add') }}}" id="addSubForm" enctype="multipart/form-data">
      	      <div class="modal-body">
                @csrf
                <div class="btn btn-info box-file">
                  <input type="file" accept="image/*" name="image" class="filePhoto" />
                  <i class="glyphicon glyphicon-cloud-upload myicon-right"></i>
                  <span class="text-file">{{ trans('misc.choose_image') }}</span>
                  </div>

              <p class="help-block">{{ trans('misc.recommended_size') }} 1280x850 px</p>

              <div class="btn-default btn-lg btn-border btn-block text-left display-none fileContainer" id="fileContainer">
                <i class="glyphicon glyphicon-paperclip myicon-right"></i>
                <small class="myicon-right file-name-file"></small> <i class="icon-cancel-circle delete-image btn pull-right" title="{{ trans('misc.delete') }}"></i>
               </div>
      	      </div><!-- modal-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right">{{{ trans('auth.send') }}}</button>
              </div><!-- /.box-footer -->

              </form>
      	    </div>
      	  </div>
      	</div> <!-- ***** Modal ****** -->
@endsection

@section('javascript')

<script type="text/javascript">

$(".actionDelete").click(function(e) {
   	e.preventDefault();

   	var element = $(this);
	var id     = element.attr('data-url');
	var form    = $(element).parents('form');

	element.blur();

	swal(
		{   title: "{{trans('misc.delete_confirm')}}",
		  type: "warning",
		  showLoaderOnConfirm: true,
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		   confirmButtonText: "{{trans('misc.yes_confirm')}}",
		   cancelButtonText: "{{trans('misc.cancel_confirm')}}",
		    closeOnConfirm: false,
		    },
		    function(isConfirm){
		    	 if (isConfirm) {
		    	 	form.submit();
		    	 	//$('#form' + id).submit();
		    	 	}
		    	 });
		 });

     $(".filePhoto").on('change', function(){

       var element = $(this);

       $('.text-file').html('{{trans('misc.choose_image')}}');

     	var loaded = false;
     	if(window.File && window.FileReader && window.FileList && window.Blob){
         // Check empty input filed
     		if($(this).val()) {

     			oFReader = new FileReader(), rFilter = /^(?:image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/png|image)$/i;
     			if($(this)[0].files.length === 0){return}

     			var oFile = $(this)[0].files[0];
           var fsize = $(this)[0].files[0].size; //get file size
     			var ftype = $(this)[0].files[0].type; // get file type

           // Validate formats
           if(!rFilter.test(oFile.type)) {
     				element.val('');
     				alert("{{ trans('misc.formats_available') }}");
     				return false;
     			}

           // Validate Size
           if(!rFilter.test(oFile.type)) {
     				element.val('');
     				alert("{{ trans('misc.formats_available') }}");
     				return false;
     			}

     			oFReader.onload = function (e) {

     				var image = new Image();
             image.src = oFReader.result;

     				image.onload = function() {

               $('.fileContainer').removeClass('display-none');
               $('.file-name-file').html(oFile.name);
             };// <<--- image.onload
           }
             oFReader.readAsDataURL($(this)[0].files[0]);
     		}// Check empty input filed
     	}// window File
     });
     // END UPLOAD PHOTO

     $('.delete-image').click(function(){
           var element = $(this);

           $('.fileContainer').addClass('display-none');
           $('.file-name-file').html('');
           $('.filePhoto').val('');
     });
</script>
@endsection
