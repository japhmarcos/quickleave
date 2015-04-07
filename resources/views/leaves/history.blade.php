@extends('layouts.master')

@section('title')
    Manager - All Request(s) from team
@stop

@section('pagetitle')
    Approved/Rejected Leave Request(s) of your Team Members
@stop

@section('breadcrumbs')
    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">History</li>
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
    @foreach($leaves as $leave)
        @if($leave->status <> 'pending' && $leave->user->id <> Auth::id())
            @if((Auth::user()->team->team_name) == $leave->user->team->team_name)
            <tr>
                <td>{!! $leave->user->firstname . ' ' . $leave->user->lastname !!}
                <td>{!! $leave->type !!}</td>
                <td>{!! date("m/d",strtotime($leave->from_dt)) . ' - ' . date("m/d",strtotime($leave->to_dt)) !!} </td>
                <td>{!! $leave->duration !!}</td>
                <td>{!! $leave->note !!}</td>
                <td>{!! $leave->remark !!}</td>
                <td>
                    @if(($leave->status) == 'approved')
                        <span class="label label-primary">Approved</span>
                    @else
                        <span class="label label-primary">Rejected</span>
                    @endif

                </td>
                <td>{!! $leave->updated_at !!}</td>
            </tr>
            @endif
        @endif
    @endforeach
    </tbody>
</table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
@stop
