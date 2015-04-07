@extends('layouts.master')

@section('title')
    Manager - Pending Leave Request(s)
@stop

@section('pagetitle')
    Pending Requests from your Team Members
@stop

@section('breadcrumbs')
    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Pending Requests</li>
@stop

@section('content')
@if (Session::has('message'))
                <div class="alert alert-info">{!! Session::get('message') !!}</div>
                @endif
                @if ($errors->has())
                    <div class="alert alert-danger">
                      <center><strong>WARNING!</strong></center><br>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>        
                        @endforeach
                    </div>
                @endif
<div class="row">
@foreach($team->leaves as $leaves)
@if($leaves->status == 'pending' && $leaves->user->role <> 'manager')
    <div class="col-md-4 col-sm-5 col-xs-12">
    <div class="box box-warning">
                <div class="box-body chat" id="chat-box">
                  
                  <!-- chat item -->
                  <div class="item">
                    @if($leaves->user->gender == 'M')
                      <img src="/theme/dist/img/avatar5.png" alt="user image" class="online"//>
                    @else
                        <img src="/theme/dist/img/avatar2.png" alt="user image" class="online"//>
                    @endif
                    <p class="message">
                      <a href="" class="name">
                        <small class="text-muted pull-right" style="color:#c5c5c5"><i class="fa fa-clock-o"></i> {!! date("M d, Y",strtotime($leaves->created_at)) !!}</small>
                        {!!$leaves->user->firstname!!} {!!$leaves->user->lastname!!}
                      </a>
                      <b>On leave: </b><b style="color: green">{!!$leaves->duration!!} 
                      {{$leaves->duration == 1 ? 'day' : 'days'}} </b> from {!! date("M d",strtotime($leaves->from_dt)) !!} - {!! date("M d",strtotime($leaves->to_dt)) !!}
                      <br>
                      <b>Leave Type: </b> @if($leaves->type == 'SL')
                                <span class="label label-primary ">SICK LEAVE</span> 
                              @else
                                <span class="label label-success">VACATION LEAVE</span> 
                              @endif
                              <br>
                      <b>Reason: </b>{!!$leaves->note!!}
                    </p>
                  </div><!-- /.item -->
                  <!-- chat item -->
                </div><!-- /.chat -->
                <div class="box-footer bg-navy">
                   <center> <a class="btn btn-sm btn-primary" href="{!! URL::to('leaves/pending/' . $leaves->id . '/edit') !!}">Change Status</a></center>
                </div>
                
              </div><!-- /.box (chat box) -->
    </div><!-- /.col -->  
@endif
@endforeach
</div> <!--row-->
@stop
