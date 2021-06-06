@extends('users.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans('misc.donation') }} #{{$data->id}}
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
					  <dt>{{ trans('auth.full_name') }}</dt>
					  <dd>{{$data->fullname}}</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans_choice('misc.campaigns_plural', 1) }}</dt>
					  <dd><a href="{{url('campaign',$data->campaigns()->id)}}" target="_blank">{{ $data->campaigns()->title }} <i class="fa fa-external-link-square"></i></a></dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('auth.email') }}</dt>
					  <dd>{{$data->email}}</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('misc.donation') }}</dt>
					  <dd><strong class="text-success">{{App\Helper::amountFormat($data->donation)}}</strong></dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('misc.country')  }}</dt>
					  <dd>{{$data->country}}</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('misc.postal_code') }}</dt>
					  <dd>{{$data->postal_code}}</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('misc.payment_gateway') }}</dt>
					  <dd>{{$data->payment_gateway}}</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('misc.comment') }}</dt>
					  <dd>
					  	@if( $data->comment != '' )
					  	{{$data->comment}}
					  	@else
					  	-------------------------------------
					  	@endif
					  	</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('admin.date') }}</dt>
					  <dd>{{date($settings->date_format, strtotime($data->date))}}</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('misc.anonymous') }}</dt>
					  <dd>
					  	@if( $data->anonymous == '1' )
					  	{{trans('misc.yes')}}
					  	@else
					  	{{trans('misc.no')}}
					  	@endif
					  	</dd>
					  <!-- ./end -->

            <!-- start -->
					  <dt>{{ trans('misc.reward') }}</dt>
					  <dd>
					  	@if( $data->rewards_id )
               <strong>ID</strong>: {{$data->rewards()->id}} <br />
               <strong>{{trans('misc.title')}}</strong>: {{$data->rewards()->title}} <br />
					  	 <strong>{{trans('misc.amount')}}</strong>: {{$settings->currency_symbol.$data->rewards()->amount}} <br />
               <strong>{{trans('misc.delivery')}}</strong>: {{ date('F, Y', strtotime($data->rewards()->delivery)) }} <br />
               <strong>{{trans('misc.description')}}</strong>:{{$data->rewards()->description}}
					  	@else
					  	{{trans('misc.no')}}
					  	@endif
					  	</dd>
					  <!-- ./end -->

					</dl>
              	</div><!-- box body -->

              	<div class="box-footer">
                  	 <a href="{{ url('dashboard/donations') }}" class="btn btn-default">{{ trans('auth.back') }}</a>
                  </div><!-- /.box-footer -->

              </div><!-- box -->
            </div><!-- col -->
         </div><!-- row -->

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
