@extends('layouts.master')

@section('title')
    Admin - Team Roles
@stop

@section('pagetitle')
    Edit {!! $member->firstname !!}'s Role
@stop

@section('breadcrumbs')
  <li><a href="/admin"><i class="fa fa-home"></i> Admin Dashboard</a></li>
  <li><a href="/teams">View all Teams</a></li>
  <li class="active"><a href="">{!! $member->firstname !!} Edit Role</a></li>
@stop

@section('content')
<div class="box box-warning">

    <div class="box-body table-responsive">
        @if (Session::has('message'))
        <div class="alert alert-danger">{!! Session::get('message') !!}</div>
        @endif
        @if ($errors->has())
            <div class="alert alert-danger">
              <i><strong>Whoops!</strong> There were some problems with your input.</i><br><br>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>        
                @endforeach
            </div>
        @endif

    {!! Form::model($member, array('route' => array('teams.updateRole', $member->id), 'method' => 'PUT')) !!}

        <div class="form-group">
            {!! Form::label('role', 'Role') !!}
            {!! Form::select('role', array('' => 'Select a role', 'manager' => 'Manager', 'member' => 'Member'), Input::old('role'), array('class' => 'form-control')) !!}
        </div>

        {!! Form::submit('Save changes', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

  </div><!-- /.box-body -->
</div><!-- /.box -->
@stop