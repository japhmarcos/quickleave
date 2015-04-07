@extends('layouts.master')

@section('title')
    Admin - All Requests
@stop

@section('pagetitle')
    All Approved Requests from
@stop

@section('breadcrumbs')
  <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
  <li class="active">All Requests</li>
@stop


@section('content')
<div class="box box-warning">
    <div class="box-body table-responsive">
        @if (Session::has('message'))
        <div class="alert alert-info">{!! Session::get('message') !!}</div>
        @endif
        
<table id="table" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>Leave Type</th>
            <th>Duration</th>
            <th>Days</th>
            <th>Note</th>
            <th>Remarks</th>
            <th>Status</th>
            <th>Date & Time Approved</th>
        </tr>
    </thead>
    <tbody>
    @foreach($leaves as $key => $value)
    @if(($value->status) <> 'pending')
        <tr>
            <td>{!! $value->user->firstname . ' ' . $value->user->lastname!!}</td>
            <td>{!! $value->type !!}</td>
            <td>{!! date("m/d",strtotime($value->from_dt)) . ' - ' . date("m/d",strtotime($value->to_dt)) !!} </td>
            <td>{!! $value->duration !!}</td>
            <td>{!! $value->note !!}</td>
            <td>{!! $value->remark !!}</td>
            <td>
                @if(($value->status) == 'approved')
                    <span class="label label-success">Approved</span>
                @elseif(($value->status) == 'rejected')
                    <span class="label label-danger">Rejected</span>
                @endif
            </td>
            <td>{!! date("M d, Y - H:i",strtotime($value->updated_at)) !!}</td>
        </tr>
    @endif
    @endforeach
    </tbody>
</table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
@stop
