@extends('admin.layout')

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
					  <dt>{{ trans('misc.transaction_id') }}</dt>
					  <dd>{{$data->txn_id != 'null' ? $data->txn_id : trans('misc.not_available')}}</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans('auth.full_name') }}</dt>
					  <dd>{{$data->fullname}}</dd>
					  <!-- ./end -->

					  <!-- start -->
					  <dt>{{ trans_choice('misc.campaigns_plural', 1) }}</dt>
					  <dd>
              @if(isset($data->campaigns()->id))
              <a href="{{url('campaign',$data->campaigns()->id)}}" target="_blank">
                {{ $data->campaigns()->title }} <i class="fa fa-external-link-square"></i>
              </a>
            @else
            <em class="text-muted">{{trans('misc.campaign_deleted')}}</em>
            @endif
            </dd>
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

            @if($data->payment_gateway == 'Bank Transfer' && $data->bank_transfer == '')
              <br />
              <dt>{{ trans('misc.bank_swift_code') }}</dt>
  					  <dd>{{$data->bank_swift_code}}</dd>

              <dt>{{ trans('misc.account_number') }}</dt>
  					  <dd>{{$data->account_number}}</dd>

              <dt>{{ trans('misc.branch_name') }}</dt>
  					  <dd>{{$data->branch_name}}</dd>

              <dt>{{ trans('misc.branch_address') }}</dt>
  					  <dd>{{$data->branch_address}}</dd>

              <dt>{{ trans('misc.account_name') }}</dt>
  					  <dd>{{$data->account_name}}</dd>

              <dt>{{ trans('misc.iban') }}</dt>
  					  <dd>{{$data->iban}}</dd>
              <br />

            @elseif($data->payment_gateway == 'Bank Transfer' && $data->bank_transfer != '')
              <br />
              <dt>{{ trans('admin.bank_transfer_details') }}</dt>
  					  <dd>{!! nl2br($data->bank_transfer) !!}</dd>
              <br />
            @endif
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
                  	 <a href="{{ url('panel/admin/donations') }}" class="btn btn-default">{{ trans('auth.back') }}</a>

                     @if($data->approved == '0')

                       {{-- Delete Donation --}}
                       {!! Form::open([
                          'method' => 'POST',
                          'url' => 'delete/donation',
                          'class' => 'displayInline',
                          'id' => 'formDeleteDonation'
                        ]) !!}
                     {!! Form::hidden('id',$data->id ); !!}
                     {!! Form::submit(trans('misc.delete'), ['class' => 'btn btn-danger pull-right margin-separator actionDelete']) !!}

                    {!! Form::close() !!}

                    {{-- Approve Donation --}}
                       {!! Form::open([
                          'method' => 'POST',
                          'url' => 'approve/donation',
                          'class' => 'displayInline'
                        ]) !!}
                     {!! Form::hidden('id',$data->id ); !!}
                     {!! Form::submit(trans('misc.approve_donation'), ['class' => 'btn btn-success pull-right']) !!}

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

@section('javascript')
  <script type="text/javascript">

$(".actionDelete").click(function(e) {
   	e.preventDefault();

   	var element = $(this);
	var id     = element.attr('data-url');

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
		    	 	$('#formDeleteDonation').submit();
		    	 	//$('#form' + id).submit();
		    	 	}
		    	 });

		 });
</script>


@endsection
