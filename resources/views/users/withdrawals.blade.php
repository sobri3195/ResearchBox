@extends('users.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans('misc.withdrawals') }} ({{$data->total()}})
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	@if(Session::has('success_message'))
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		      <i class="fa fa-check margin-separator"></i>  {{ Session::get('success_message') }}
		    </div>
		@endif

        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h5>
                  		<strong>{{ trans('misc.default_withdrawal') }}</strong>: @if( Auth::user()->payment_gateway == '' ) {{trans('misc.unconfigured')}} @else {{Auth::user()->payment_gateway}} @endif
                  	</h5>

                    <div class="box-tools">
                      <a href="{{ url('dashboard/withdrawals/configure') }}" class="btn btn-sm btn-success no-shadow pull-right">
                        <i class="fa fa-cog myicon-right"></i> {{trans('misc.configure')}}
                      </a>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>

               	@if( $data->total() !=  0 && $data->count() != 0 )
                   <tr>
                      <th class="active">ID</th>
			   		  <th class="active">{{ trans('misc.campaign') }}</th>
			          <th class="active">{{ trans('admin.amount') }}</th>
			          <th class="active">{{ trans('misc.method') }}</th>
			          <th class="active">{{ trans('admin.status') }}</th>
			          <th class="active">{{ trans('admin.date') }}</th>
			          <th class="active">{{ trans('admin.actions') }}</th>
                    </tr><!-- /.TR -->

@foreach( $data as $withdrawal )

                    <tr>
                      <td>{{ $withdrawal->id }}</td>
                      <td>
                      	<a title="{{$withdrawal->title}}" href="{{ url('campaign',$withdrawal->campaigns()->id) }}" target="_blank">{{ str_limit($withdrawal->campaigns()->title,20,'...') }} <i class="fa fa-external-link-square"></i></a>
                      	</td>
                      <td>@if($settings->currency_position == 'left'){{ $settings->currency_symbol.$withdrawal->amount }}@else{{$withdrawal->amount.$settings->currency_symbol}}@endif</td>
                      <td>{{ $withdrawal->gateway }}</td>
                      <td>
                      	@if( $withdrawal->status == 'paid' )
                      	<span class="label label-success">{{trans('misc.paid')}}</span>
                      	@else
                      	<span class="label label-warning">{{trans('misc.pending_to_pay')}}</span>
                      	@endif
                      </td>
                      <td>{{ date($settings->date_format, strtotime($withdrawal->date)) }}</td>
                      <td>

                        @if( $withdrawal->status != 'paid' )
                              	{!! Form::open([
        			            'method' => 'POST',
        			            'url' => "delete/withdrawal/$withdrawal->id",
        			            'class' => 'displayInline'
        				        ]) !!}

        	            	{!! Form::button(trans('misc.delete'), ['class' => 'btn btn-danger btn-xs deleteW']) !!}
        	        	{!! Form::close() !!}

        	        	@else

        	        	- {{trans('misc.paid')}} -

        	        	@endif

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
              @if( $data->lastPage() > 1 )
             {{ $data->links() }}
             @endif
            </div>
          </div>

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('javascript')
<script type="text/javascript">

$(".deleteW").click(function(e) {
   	e.preventDefault();

   	var element = $(this);
    var form    = $(element).parents('form');
    element.blur();

	swal(
		{   title: "{{trans('misc.delete_confirm')}}",
		 text: "{{trans('misc.confirm_delete_withdrawal')}}",
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
		    	 	}
		    	 });


		 });
</script>
@endsection
