@extends('users.layout')

@section('css')
<link href="{{ asset('public/plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            {{ trans('admin.admin') }}
            	<i class="fa fa-angle-right margin-separator"></i>
            		{{ trans('misc.withdrawals') }} {{ trans('misc.configure') }}
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

          @if (session('error'))
        			<div class="alert alert-danger btn-sm alert-fonts" role="alert">
        				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    		{{ session('error') }}
                    		</div>
                    	@endif

                    	@if (session('success'))
        			<div class="alert alert-success btn-sm alert-fonts" role="alert">
        				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    		{{ session('success') }}
                    		</div>
                    	@endif

        	<div class="content">

        		<div class="row">

        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h5>
                    {{ trans('misc.select_method_payment') }} - <strong>{{ trans('misc.default_withdrawal') }}</strong>: @if( Auth::user()->payment_gateway == '' ) {{trans('misc.unconfigured')}} @else {{Auth::user()->payment_gateway}} @endif
                    </h5>
                    <h3><i class="fa fa-paypal myicon-right"></i> PayPal</h3>
                </div><!-- /.box-header -->

                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{url('withdrawals/configure/paypal')}}">

                	<input type="hidden" name="_token" value="{{ csrf_token() }}">

					@include('errors.errors-forms')

                     <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('admin.paypal_account') }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{Auth::user()->paypal_account}}" id="email_paypal" name="email_paypal" class="form-control" placeholder="{{ trans('admin.paypal_account') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
               <div class="box-body">
                 <div class="form-group">
                   <label class="col-sm-2 control-label">{{ trans('misc.confirm_email') }}</label>
                   <div class="col-sm-10">
                     <input type="text" value="{{Auth::user()->paypal_account}}" name="email_paypal_confirmation" class="form-control" placeholder="{{ trans('misc.confirm_email') }}">
                   </div>
                 </div>
               </div><!-- /.box-body -->

                  <div class="box-footer">
                    <a href="{{url('dashboard/withdrawals')}}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
                    <button type="submit" class="btn btn-success pull-right">{{ trans('misc.submit') }}</button>
                  </div><!-- /.box-footer -->
                </form>

<hr />
<form method="post" action="{{url('withdrawals/configure/bank')}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-university myicon-right"></i> {{ trans('misc.bank_transfer') }} </h3>
                </div><!-- /.box-header -->

                <!-- Start Box Body -->
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">{{ trans('misc.bank_details') }}</label>
                    <div class="col-sm-10">

                      <textarea name="bank"rows="5" cols="40" class="form-control" placeholder="{{ trans('misc.bank_details') }}">{{Auth::user()->bank}}</textarea>
                    </div>
                  </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">

                    <a href="{{url('dashboard/withdrawals')}}" class="btn btn-default">{{ trans('admin.cancel') }}</a>
                    <button type="submit" class="btn btn-success pull-right">{{ trans('misc.submit') }}</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>

        		</div><!-- /.row -->

        	</div><!-- /.content -->

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('javascript')

	<!-- icheck -->
	<script src="{{ asset('public/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

	<script type="text/javascript">
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });

	</script>


@endsection
