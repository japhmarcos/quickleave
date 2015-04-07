@extends('layouts.master')

@section('title')
    Admin - Teams
@stop

@section('pagetitle')
    View All Employees
@stop

@section('breadcrumbs')
    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">All Employees</li>
@stop

@section('content')
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
<div class="row">
@foreach($employees as $employee)
    <div class="col-md-4 col-sm-5 col-xs-12">
    <div class="box box-solid">
                <div class="box-body chat" id="chat-box">
                  <!-- chat item -->
                  <div class="item" style="padding-top:5px">
                    @if($employee->gender == 'M')
                    @if($employee->role == 'admin')
                      <img src="/theme/dist/img/avatar.png" class="online" alt="User Image"/>
                    @elseif($employee->role == 'director')
                      <img src="/theme/dist/img/avatar3.png" class="online" alt="User Image"/>
                    @else
                      <img src="/theme/dist/img/avatar5.png" class="online" alt="User Image"/>
                    @endif
                  @else
                    <img src="/theme/dist/img/avatar2.png" class="online" alt="User Image"/>
                  @endif
                    <p class="message">
                        <a href="{{ URL::to('teams/' . $employee->team->id . '/showmembers') }}" class="name">
                        <b style="color: black">Team Name: </b>
                        <small class="text-muted pull-right" style="color:#c5c5c5"><i class="fa fa-clock-o"></i> {!! date("M d, Y",strtotime($employee->created_at)) !!}</small>
                            {!! $employee->team->team_name !!}
                        </a>
                      <b>Name: </b>{!! $employee->firstname . ' ' . $employee->lastname  !!}  
                      <br>
                      <b>Role: </b>
                        @if(($employee->role) == 'manager')
                            <span class="label label-warning">Manager</span>
                        @elseif(($employee->role) == 'member')
                            <span class="label label-success">Member</span>
                        @elseif(($employee->role) == 'admin')
                            <span class="label label-danger">Admin</span>
                        @elseif(($employee->role) == 'director')
                            <span class="label label-danger">Director</span>
                        @else
                            <span class="label label-danger">No specified role</span>
                        @endif
                        <br>
                        <b>Date Hired: </b>{{$employee->date_hired == null ? 'No specified date hired' : date("M d, Y",strtotime($employee->date_hired))}}
                        <br>
                        <b>Leave Balances: </b>{{ $employee->sl_bal }} SL / {{ $employee->vl_bal }} VL

                    </p>
                  </div><!-- /.item -->
                  <!-- chat item -->
                </div><!-- /.chat -->
                <div class="box-footer bg-navy">
                   <center> 
                        <a class="btn btn-sm btn-info" href="{{ URL::to('admin/' . $employee->id . '/editemployee') }}"><i class="fa fa-pencil"></i></a>
                         {!! Form::open(array('url' => 'admin/' . $employee->id . '/delete', 'class' => 'btn', 'method' => 'DELETE')) !!}
                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>

                        {!! Form::close() !!}
                   </center>
                </div>
                
              </div><!-- /.box (chat box) -->
    </div><!-- /.col -->  
@endforeach
</div><!--row -->

@stop
