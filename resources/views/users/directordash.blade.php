@extends('layouts.master')

@section('title')
    Director Dashboard
@stop

@section('breadcrumbs')
  <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
  <li class="active">All Pending Requests</li>
@stop

@section('pagetitle')
    Dashboard 
    <small>Page</small>
@stop

@section('content')
  <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-md-3 col-sm-5 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>
                    <script>
                    /*Current date script credit: 
                    JavaScript Kit (www.javascriptkit.com)
                    Over 200+ free scripts here!
                    */

                    var mydate=new Date()
                    var year=mydate.getYear()
                    if (year < 1000)
                    year+=1900
                    var day=mydate.getDay()
                    var month=mydate.getMonth()
                    var daym=mydate.getDate()
                    if (daym<10)
                    daym="0"+daym
                    //var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
                    var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
                    document.write("<small><font color='ffffff'><b>"+montharray[month]+" "+daym+", "+year+"</b></font></small>")
                    </script>
                  </h3>
                  <p id="clockbox"></p>
                </div>
                <div class="icon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div>
            </div><!-- ./col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-black"><i class="ion ion-person-add"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Teams Created</span>
                  <span class="info-box-number">{{ $teams->count() }}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-black"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Users Registered</span>
                  <span class="info-box-number">{{ $users->count() }}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-black"><i class="fa fa-check-circle"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"> Pending Requests</span>
                  <span class="info-box-number">{{ $leaves->count() }} </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

          </div><!-- /.row -->


<div class="row">
@foreach($leaves as $leaves)
@if($leaves->status == 'pending')


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
                      <b>Role: </b> @if($leaves->user->role == 'manager')
                                <span class="label label-primary ">MANAGER</span> 
                              @else
                                <span class="label label-success">MEMBER</span> 
                              @endif
                              of {!!$leaves->user->team->team_name!!}
                              <br>
                      <b>On leave: </b><b style="color: blue">{!!$leaves->duration!!}
                        {{$leaves->duration == 1 ? 'day' : 'days'}}</b> from {!! date("M d",strtotime($leaves->from_dt)) !!} - {!! date("M d",strtotime($leaves->to_dt)) !!}
                      <br>
                      <b>Leave Type: </b> @if($leaves->type == 'SL')
                                Sick Leave
                              @else
                                Vacation Leave
                              @endif
                              <br>
                      <b>Reason: </b>{!!$leaves->note!!}
                    </p>
                  </div><!-- /.item -->
                  <!-- chat item -->
                </div><!-- /.chat -->
                <div class="box-footer box-solid bg-navy">
                   <center> <a class="btn btn-xs btn-primary" href="{!! URL::to('leaves/pending/' . $leaves->id . '/edit') !!}">Change Status</a></center>
                </div>
                
              </div><!-- /.box (chat box) -->
    </div><!-- /.col -->  
       
@endif
@endforeach
</div> <!--row-->
  
@stop