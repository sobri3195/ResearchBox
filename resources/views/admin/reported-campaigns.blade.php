@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans('misc.campaigns_reported') }} ({{$data->total()}})
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                  		{{ trans('misc.campaigns_reported') }}
                  	</h3>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>

               	@if( $data->total() !=  0 && $data->count() != 0 )
                   <tr>
                      <th class="active">ID</th>
                      <th class="active">{{ trans('admin.user') }}</th>
                      <th class="active">{{ trans_choice('misc.campaigns_plural', 1) }}</th>
                      <th class="active">{{ trans('admin.date') }}</th>
                      <th class="active">{{ trans('admin.actions') }}</th>
                    </tr><!-- /.TR -->

                  @foreach( $data as $report )
                    <tr>
                      <td>{{ $report->id }}</td>
                      <td>{{ $report->user()->name }}</td>
                      <td><a href="{{url('campaign',$report->campaigns_id)}}" target="_blank">{{ str_limit($report->campaigns()->title, 10, '...') }} <i class="fa fa-external-link-square"></i></a></td>
                      <td>{{ date($settings->date_format, strtotime($report->created_at)) }}</td>
                      <td> <a href="{{ url('panel/admin/campaigns/edit',$report->id) }}" class="btn btn-success btn-xs padding-btn">
                      		{{ trans('admin.view') }}
                      	</a>

                 {!! Form::open([
			            'method' => 'POST',
			            'url' => 'panel/admin/campaigns/reported/delete',
			            'class' => 'displayInline'
				        ]) !!}
				        {!! Form::hidden('id',$report->id ); !!}
	            	{!! Form::submit(trans('misc.delete'), ['class' => 'btn btn-xs btn-danger actionDelete']) !!}
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
              @if( $data->lastPage() > 1 )
             {{ $data->links() }}
             @endif
            </div>
          </div>

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
