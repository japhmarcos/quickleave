@extends('layouts.master')

@section('title')
    @if((Auth::user()->role) == 'manager')
        Manager - All request(s)
    @else
        User - All request(s)
    @endif
@stop

@section('pagetitle')
    All Leave Requests
@stop

@section('breadcrumbs')
    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">All Leave Requests</li>
@stop

@section('content')
<!-- START CUSTOM TABS -->
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
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
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Pending</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Approved</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Rejected</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active table-responsive" id="tab_1">
                    <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Leave Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Duration</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Date & Time Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>    
                        @foreach($leaves as $key => $value)
                            <tr>
                                @if(Auth::user()->id == $value->user->id)
                                    @if($value->status == 'pending')
                                        <td>{!! $value->type !!}</td>
                                        <td>{!! $value->from_dt !!}</td>
                                        <td>{!! $value->to_dt !!}</td>
                                        <td>{!! $value->duration !!}</td>
                                        <td>{!! $value->note !!}</td>
                                        <td><span class="label label-warning">Pending</span></td>
                                        <td>{!! date("M d, Y - H:i",strtotime($value->created_at)) !!}</td>
                                        <td>
                                            <a class="btn btn-small btn-info" href="{!! URL::to('leaves/' . $value->id . '/edit') !!}">Edit</a>
                                        
                                            {!! Form::open(array('url' => 'leaves/' . $value->id . '/delete', 'class' => 'btn')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('Delete', array('class' => 'btn btn-warning')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane table-responsive" id="tab_2">
                    <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Leave Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Duration</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Date & Time Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaves as $key => $value)
                            <tr>
                                @if(Auth::user()->id == $value->user->id)
                                    @if($value->status == 'approved')
                                        <td>{!! $value->type !!}</td>
                                        <td>{!! $value->from_dt !!}</td>
                                        <td>{!! $value->to_dt !!}</td>
                                        <td>{!! $value->duration !!}</td>
                                        <td>{!! $value->note !!}</td>
                                        <td><span class="label label-success">Approved</span></td>
                                        <td>{!! date("M d, Y - H:i",strtotime($value->created_at)) !!}</td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane table-responsive" id="tab_3">
                    <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Leave Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Duration</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Date & Time Created</th>
                        </tr>
                    </thead>
                    <tbody>    
                        @foreach($leaves as $key => $value)
                            <tr>
                                @if(Auth::user()->id == $value->user->id)
                                    @if($value->status == 'rejected')
                                        <td>{!! $value->type !!}</td>
                                        <td>{!! $value->from_dt !!}</td>
                                        <td>{!! $value->to_dt !!}</td>
                                        <td>{!! $value->duration !!}</td>
                                        <td>{!! $value->note !!}</td>
                                        <td><span class="label label-danger">Rejected</span></td>
                                        <td>{!! date("M d, Y - H:i",strtotime($value->created_at)) !!}</td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->

          <!-- END CUSTOM TABS -->

@stop
