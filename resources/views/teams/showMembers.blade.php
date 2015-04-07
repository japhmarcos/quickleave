@extends('layouts.master')

@section('title')
    Admin - Team Members
@stop

@section('pagetitle')
    View {!! $team->team_name !!}'s Members
@stop
    
@section('breadcrumbs')
  <li><a href="/admin"><i class="fa fa-home"></i> Admin Dashboard</a></li>
  <li><a href="">{!! $team->team_name !!}</a></li>
  <li class="active"><a href="">All Members</a></li>
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

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Username</th>
            <th>Role</th>
            <th>Registration Date Time</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($team->user as $member)
        <tr>
            <td>{!! $member->firstname !!}</td>
            <td>{!! $member->lastname !!}</td>
            <td>{!! $member->username !!}</td>
            <td>
                @if(($member->role) == 'manager')
                    <span class="label label-warning">Manager</span>
                @elseif(($member->role) == 'member')
                    <span class="label label-success">Member</span>
                @elseif(($member->role) == 'admin')
                    <span class="label label-danger">Admin</span>
                @elseif(($member->role) == 'director')
                    <span class="label label-danger">Director</span>
                @else
                    <span class="label label-danger">No specified role</span>
                @endif
            </td>
            <td>
                {!! $member->created_at !!}
            </td>
            
            <td>
                <a class="btn btn-small btn-info" href="{{ URL::to('admin/' . $member->id . '/editemployee') }}">Edit Employee Info</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>    
  </div><!-- /.box-body -->
</div><!-- /.box -->
@stop