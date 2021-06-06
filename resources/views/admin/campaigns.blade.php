@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans('misc.campaigns') }} ({{$data->total()}})
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
                  <h3 class="box-title">
                  		{{ trans('misc.campaigns') }}
                  	</h3>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>

               	@if( $data->total() !=  0 && $data->count() != 0 )
                   <tr>
                      <th class="active">ID</th>
                      <th class="active">{{ trans('misc.title') }}</th>
                      <th class="active">{{ trans('admin.user') }}</th>
                      <th class="active">{{ trans('misc.goal') }}</th>
                      <th class="active">{{ trans('misc.funds_raised') }}</th>
                      <th class="active">{{ trans('admin.status') }}</th>
                      <th class="active">{{ trans('admin.date') }}</th>
                      <th class="active">{{ trans('misc.date_deadline') }}</th>
                      <th class="active">{{ trans('admin.actions') }}</th>
                    </tr><!-- /.TR -->

                  @foreach( $data as $campaign )
                    <tr>
                      <td>{{ $campaign->id }}</td>
                      <td><img src="{{asset('public/campaigns/small').'/'.$campaign->small_image}}" width="20" />

                      	@if( $campaign->status == 'active' )
                      	<a title="{{$campaign->title}}" href="{{ url('campaign',$campaign->id) }}" target="_blank">
                      		{{ str_limit($campaign->title,20,'...') }} <i class="fa fa-external-link-square"></i>
                      		</a>
                      		@else
                      		<span title="{{$campaign->title}}" class="text-muted">
                      		{{ str_limit($campaign->title,20,'...') }}
                      		@endif

                      	</td>
                      <td>
                      	{{$campaign->user()->name ?? trans('misc.user_not_available')}}
                      	</td>
                      <td>{{ App\Helper::amountFormat($campaign->goal) }}</td>
                      <td>{{ App\Helper::amountFormat($campaign->donations()->sum('donation')) }}</td>
                      <td>
                      	@if( $campaign->status == 'active' && $campaign->finalized == 0 )
                      	<span class="label label-success">{{trans('misc.active')}}</span>
                      	@elseif( $campaign->status == 'pending' && $campaign->finalized == 0 )
                      	<span class="label label-warning">{{trans('admin.pending')}}</span>
                      	@else
                      	<span class="label label-default">{{trans('misc.finalized')}}</span>
                      	@endif
                      </td>
                      <td>{{ date($settings->date_format, strtotime($campaign->date)) }}</td>
                      <td>
                      	@if( $campaign->deadline != '' )
                      	{{ date($settings->date_format, strtotime($campaign->deadline)) }}
                      	@else
                      	 -
                      	@endif
                      	</td>
                      <td> <a href="{{ url('panel/admin/campaigns/edit',$campaign->id) }}" class="btn btn-success btn-xs padding-btn">
                      		{{ trans('admin.edit') }}
                      	</a> </td>
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
