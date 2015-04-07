@extends('layouts.master')

@section('title')
    Admin - Edit a Team
@stop

@section('pagetitle')
    Edit <b>{!! $team->team_name !!}</b>'s Information
@stop

@section('breadcrumbs')
  <li><a href="/admin"><i class="fa fa-home"></i> Admin Dashboard</a></li>
  <li><a href="">{!! $team->team_name !!}</a></li>
  <li class="active"><a href="">Edit Team</a></li>
@stop

@section('content')
<div class="box box-warning">

    <div class="box-body table-responsive">
        @if (Session::has('message'))
        <div class="alert alert-info">{!! Session::get('message') !!}</div>
        @endif
        @if ($errors->has())
            <div class="alert alert-danger">
              <i><strong>Whoops!</strong> There were some problems with your input.</i><br><br>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>        
                @endforeach
            </div>
        @endif

    {!! Form::model($team, array('route' => array('teams.update', $team->id), 'method' => 'PUT')) !!}

        <div class="form-group">
            {!! Form::label('team_name', 'Team Name') !!}
            {!! Form::text('team_name', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('team_code', 'Team Code') !!}
            {!! Form::text('team_code', null, array('class' => 'form-control')) !!}
        </div>

        {!! Form::submit('Submit Changes', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

  </div><!-- /.box-body -->
</div><!-- /.box -->
@stop