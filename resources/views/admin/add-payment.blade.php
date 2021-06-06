@extends('admin.layout')

@section('css')
<link href="{{ asset('public/plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            {{ trans('admin.admin') }}
            			<i class="fa fa-angle-right margin-separator"></i>
            				{{ trans('misc.add_payment') }}
          </h4>

        </section>

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

        	<div class="content">

        		<div class="row">

        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('misc.add_payment') }}</h3>
                </div><!-- /.box-header -->


                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{ url('panel/admin/payment/add') }}">

                	<input type="hidden" name="_token" value="{{ csrf_token() }}">

					@include('errors.errors-forms')

          <!-- Start Box Body -->
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">{{ trans('misc.campaign') }}</label>
              <div class="col-sm-10">
                <select name="campaign" class="form-control select2">
                  <option value="">{{trans('misc.select_one')}}</option>
                @foreach(  App\Models\Campaigns::where('status', 'active')->where('finalized','0')->orderBy('id')->get() as $campaign )
                    <option value="{{$campaign->id}}">ID #{{ $campaign->id }} - {{ $campaign->title }}</option>
                    @endforeach
                  </select>
                  </select>
              </div>
            </div>
          </div><!-- /.box-body -->

                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('misc.donation') }}</label>
                      <div class="col-sm-10">
                        <input type="number" value="{{ old('donation') }}" name="donation" class="form-control" placeholder="{{ trans('misc.donation') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('auth.full_name') }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ old('full_name') }}" name="full_name" class="form-control" placeholder="{{ trans('auth.full_name') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('auth.email') }}</label>
                      <div class="col-sm-10">
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="{{ trans('auth.email') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('misc.country') }}</label>
                      <div class="col-sm-10">
                        <select name="country" class="form-control select2">
                          <option value="">{{trans('misc.select_one')}}</option>
                        @foreach(  App\Models\Countries::orderBy('country_name')->get() as $country )
                            <option value="{{$country->country_name}}">{{ $country->country_name }}</option>
                            @endforeach
                          </select>
                          </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('misc.postal_code') }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ old('postal_code') }}" name="postal_code" class="form-control" placeholder="{{ trans('misc.postal_code') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('misc.transaction_id') }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ old('transaction_id') }}" name="transaction_id" class="form-control" placeholder="{{ trans('misc.transaction_id') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('misc.payment_gateway') }}</label>
                      <div class="col-sm-10">

                    @foreach (PaymentGateways::where('enabled', '1')->where('type', '<>', 'bank')->orderBy('type')->get(); as $payment)

                      	<div class="radio">
                        <label class="padding-zero">
                          <input @if (PaymentGateways::where('enabled', '1')->where('type', '<>', 'bank')->count() == 1) checked @endif type="radio" name="payment_gateway" value="{{$payment->name}}" class="custom-control-input paymentGateway">
                          {{ $payment->name }}
                        </label>
                      </div>
                    @endforeach

                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">{{ trans('admin.save') }}</button>
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
<script src="{{ asset('public/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$('.select2').select2();

	 	  //Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
	</script>

@endsection
