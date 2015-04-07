@extends('layouts.master')

@section('title')
    Manager - View Members
@stop

@section('pagetitle')
    Your Team Members
@stop
	
@section('breadcrumbs')
    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">All Members</li>
@stop

@section('content')
<div class="row">
@foreach($manager->members as $member)
    <div class="col-md-4 col-sm-5 col-xs-12">
    <div class="box box-warning">
                <div class="box-body chat" id="chat-box">
                  <!-- chat item -->
                  <div class="item" style="padding-top:5px">
                    @if($member->gender == 'M')
                    @if($member->role == 'admin')
                      <img src="/theme/dist/img/avatar.png" class="online" alt="User Image"/>
                    @elseif($member->role == 'director')
                      <img src="/theme/dist/img/avatar3.png" class="online" alt="User Image"/>
                    @else
                      <img src="/theme/dist/img/avatar5.png" class="online" alt="User Image"/>
                    @endif
                  @else
                    <img src="/theme/dist/img/avatar2.png" class="online" alt="User Image"/>
                  @endif
                    <p class="message">
                        <a href="" class="name">
                        <b style="color: black">Team Name: </b>
                        <small class="text-muted pull-right" style="color:#c5c5c5"><i class="fa fa-clock-o"></i> {!! date("M d, Y",strtotime($member->created_at)) !!}</small>
                            {!! $member->team->team_name !!}
                        </a>
                      <b>Name: </b>{!! $member->firstname . ' ' . $member->lastname  !!}  
                      <br>
                      <b>Role: </b>
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
                        <br>
                        <b>Date Hired: </b>{!! date("M d, Y",strtotime($member->date_hired)) !!}
                        <br>
                        <b>Leave Balances: </b>{{ $member->sl_bal }} SL / {{ $member->vl_bal }} VL

                    </p>
                  </div><!-- /.item -->
                  <!-- chat item -->
                </div><!-- /.chat -->
                
                
              </div><!-- /.box (chat box) -->
    </div><!-- /.col -->  
@endforeach
</div><!--row -->

@stop
