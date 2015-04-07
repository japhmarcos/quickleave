@extends('layouts.master')

@section('title')
    @if((Auth::user()->role) == 'manager')
    Manager - Pending request(s)
    @else
    User - Pending request(s)
    @endif

@stop

@section('pagetitle')
    Pending Requests
@stop

@section('breadcrumbs')
    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Pending Requests</li>
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

<table class="table table-bordered table-hover">
    <thead> 
        <tr>
            <th>Type of Leave</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Duration</th>
            <th>Note</th>
            <th>Date Created</th>
            <th>Last Updated</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($leaves as $leave)
    @if(($leave->status) == 'pending')
        @if((Auth::user()->id) == $leave->user->id)
        <tr>
            <td>{!! $leave->type !!}</td>
            <td>{!! $leave->from_dt !!}</td>
            <td>{!! $leave->to_dt !!}</td>
            <td>{!! $leave->duration !!}</td>
            <td>{!! $leave->note !!}</td>
            <td>{!! date("M d, Y - H:i",strtotime($leave->created_at)) !!}</td>
            <td>{!! date("M d, Y - H:i",strtotime($leave->updated_at)) !!}</td>
            <td>
                <a class="btn btn-small btn-info" href="{!! URL::to('leaves/' . $leave->id . '/edit') !!}">Edit</a>
            
                {!! Form::open(array('url' => 'leaves/' . $leave->id . '/delete', 'class' => 'btn')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete', array('class' => 'btn btn-warning')) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endif
    @endif
    @endforeach
    </tbody>
</table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
@stop
