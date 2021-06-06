@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans('misc.withdrawals') }} #{{$data->id}}
          </h4>
        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="row">
            <div class="col-xs-12">
              <div class="box">

              	<div class="box-body">
              		<dl class="dl-horizontal">

					  <!-- start -->
					  <dt>ID</dt>
					  <dd>{{$data->id}}</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans_choice('misc.campaigns_plural', 1) }}</dt>
					  <dd><a href="{{url('campaign',$data->campaigns()->id)}}" target="_blank">{{ $data->campaigns()->title }} <i class="fa fa-external-link-square"></i></a></dd>
					  <!-- ./end -->

					@if( $data->gateway == 'Paypal' )
					  <!-- start -->
					  <dt>{{ trans('admin.paypal_account') }}</dt>
					  <dd>{{$data->account}}</dd>
					  <!-- ./end -->

					  @else
					   <!-- start -->
					  <dt>{{ trans('misc.bank_details') }}</dt>
					  <dd>{!!App\Helper::checkText($data->account)!!}</dd>
					  <!-- ./end -->

					  @endif

					  <!-- start -->
					  <dt>{{ trans('admin.amount') }}</dt>
					  <dd><strong class="text-success">@if($settings->currency_position == 'left'){{ $settings->currency_symbol.$data->amount }}@else{{$data->amount.$settings->currency_symbol}}@endif</strong></dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('misc.payment_gateway') }}</dt>
					  <dd>{{$data->gateway}}</dd>
					  <!-- ./end -->


					  <!-- start -->
					  <dt>{{ trans('admin.date') }}</dt>
					  <dd>{{date($settings->date_format, strtotime($data->date))}}</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('admin.status') }}</dt>
					  <dd>
					  	@if( $data->status == 'paid' )
                      	<span class="label label-success">{{trans('misc.paid')}}</span>
                      	@else
                      	<span class="label label-warning">{{trans('misc.pending_to_pay')}}</span>
                      	@endif
					  </dd>
					  <!-- ./end -->

					@if( $data->status == 'paid' )
					  <!-- start -->
					  <dt>{{ trans('misc.date_paid') }}</dt>
					  <dd>
					  	{{date('d M, y', strtotime($data->date_paid))}}
					  </dd>
					  <!-- ./end -->
					  @endif



					</dl>
              	</div><!-- box body -->

              	<div class="box-footer">
                  	 <a href="{{ url('panel/admin/withdrawals') }}" class="btn btn-default">{{ trans('auth.back') }}</a>

                 @if( $data->gateway == 'Paypal' )

                 <?php
                 if ( $settings->paypal_sandbox == 'true') {
					// SandBox
					$action = "https://www.sandbox.paypal.com/cgi-bin/webscr";
					} else {
					// Real environment
					$action = "https://www.paypal.com/cgi-bin/webscr";
					}

                 ?>

                 <form name="_xclick" action="{{$action}}" method="post" class="displayInline">
				        <input type="hidden" name="cmd" value="_xclick">
				        <input type="hidden" name="return" value="{{url('panel/admin/withdrawals')}}">
				        <input type="hidden" name="cancel_return"   value="{{url('panel/admin/withdrawals')}}">
				        <input type="hidden" name="notify_url" value="{{url('paypal/withdrawal/ipn')}}">
				        <input type="hidden" name="currency_code" value="{{$settings->currency_code}}">
				        <input type="hidden" name="amount" id="amount" value="{{$data->amount}}">
				        <input type="hidden" name="custom" value="{{$data->id}}">
				        <input type="hidden" name="item_name" value="{{ trans('misc.payment_campaigning').' '.$data->campaigns()->title }}">
				        <input type="hidden" name="business" value="{{$data->account}}">
				        <button type="submit" class="btn btn-default pull-right"><i class="fa fa-paypal"></i> {{trans('misc.paid_paypal')}}</button>
				        </form>

	        	@endif

                  @if( $data->status == 'pending' )

                {!! Form::open([
			            'method' => 'POST',
			            'url' => "panel/admin/withdrawals/paid/$data->id",
			            'class' => 'displayInline'
				        ]) !!}

	            	{!! Form::submit(trans('misc.mark_paid'), ['class' => 'btn btn-success pull-right myicon-right']) !!}
	        	{!! Form::close() !!}

	        	@endif

                  </div><!-- /.box-footer -->

              </div><!-- box -->
            </div><!-- col -->
         </div><!-- row -->

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
