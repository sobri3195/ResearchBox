@extends('admin.layout')

@section('css')
<link href="{{ asset('public/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {{{ trans('misc.categories') }}}
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{{ url('panel/admin') }}}"><i class="fa fa-dashboard"></i> {{{ trans('admin.home') }}}</a></li>
            <li class="active">{{{ trans('misc.categories') }}}</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        	
        	
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('javascript')
	
	<!-- Morris -->
	<script src="{{ asset('public/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>

@endsection
