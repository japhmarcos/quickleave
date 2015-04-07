@extends('layouts.master')

@section('title')
    Admin - Create a Team
@stop

@section('pagetitle')
    Create a Team
@stop

@section('breadcrumbs')
    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="/teams"> Teams</a></li>
    <li class="active">Create Team</li>
@stop

@section('content')
<div class="box box-warning">
    <div class="box-header with-border">
            Create a team and designate the code to the members
    <div class="box-tools pull right"></div>
    </div>

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


        {!! Form::open(array('url' => 'teams')) !!}

            <div class="form-group">
                {!! Form::label('team_name', 'Team Name') !!}
                {!! Form::text('team_name', Input::old('team_name'), array('class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('team_code', 'Team Code') !!}
                {!! Form::text('team_code', Input::old('team_code'), array('class' => 'form-control')) !!}
            </div>

            {!! Form::submit('Create the Team', array('class' => 'btn btn-primary')) !!}

        {!! Form::close() !!}
 
  </div><!-- /.box-body -->
          </div><!-- /.box -->
             @stop