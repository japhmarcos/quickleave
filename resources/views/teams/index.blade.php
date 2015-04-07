@extends('layouts.master')

@section('title')
    Admin - Teams
@stop

@section('pagetitle')
    View all Teams
@stop

@section('breadcrumbs')
    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">All Teams</li>
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
@foreach($teams as $team)
    <div class="col-md-4 col-sm-5 col-xs-12">
    <div class="box box-solid">
                <div class="box-body chat" id="chat-box">
                  <!-- chat item -->
                  <div class="item" style="padding-top:5px">
                    <img src="/theme/dist/img/photo1.png" alt="user image" class="online"//>
                    <p class="message">
                        <a href="" class="name" style="color:white">
                        <b style="color: black">Team Name: {!! $team->team_name !!}</b>
                        <small class="text-muted pull-right" style="color:#c5c5c5"><i class="fa fa-clock-o"></i> {!! date("M d, Y",strtotime($team->created_at)) !!}</small>
                            
                        </a>
                      <b>Team Code: </b>{!! $team->team_code !!}                      
                    </p>
                  </div><!-- /.item -->
                  <!-- chat item -->
                </div><!-- /.chat -->
                <div class="box-footer bg-navy">
                   <center> 
                    <a class="btn btn-sm btn-success" href="{{ URL::to('teams/' . $team->id . '/showmembers') }}" alt="Show Members"><i class="fa fa-users"></i></a>

                <!-- edit this team (uses the edit method found at GET /teams/{id}/edit -->
                <a class="btn btn-sm btn-info" href="{{ URL::to('teams/' . $team->id . '/edit') }}" alt="Edit this team"><i class="fa fa-pencil"></i></a>

                {!! Form::open(array('url' => 'teams/' . $team->id . '/delete', 'class' => 'btn', 'method' => 'DELETE')) !!}
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>

                {!! Form::close() !!}
                   </center>
                </div>
                
              </div><!-- /.box (chat box) -->
    </div><!-- /.col -->  
@endforeach
</div><!--row -->

@stop
