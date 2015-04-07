@extends('layouts.master')

@section('title')
    Manager Dashboard
@stop

@section('pagetitle')
    Dashboard 
    <small>Page</small>
@stop

@section('breadcrumbs')
  <li><a href="/manager"><i class="fa fa-home"></i> Manager Dashboard</a></li>
  <li class="active"><a href="/manager">Manager Dashboard</a></li>
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
                <span class="info-box-icon bg-black"><i class="fa fa-car"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">VL Balance</span>
                  <span class="info-box-number">{!! Auth::user()->vl_bal !!}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-black"><i class="fa fa-heart"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">SL Balance</span>
                  <span class="info-box-number">{!! Auth::user()->sl_bal !!}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-black"><i class="fa fa-question-circle"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pending Requests</span>
                  <span class="info-box-number">{{ $team->leaves->where('status','pending')->count() }}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

          </div><!-- /.row -->
          
          <!-- Main row -->
          <div class="row">

            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
            <!-- Chat box -->
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-users"></i>
                  <h3 class="box-title">Who's on leave?</h3>
                  <div class="box-tools pull-right">
                    <span class="label label-warning">
                      {{ $team->leaves->where('status','approved')->count() }}
                    </span>
                  </div>
                </div>
                <div class="box-body chat" id="chat-box">
                  @if($team->leaves->where('status','approved')->count() >= 1)
                  @foreach($team->leaves as $leaves)
                  <!-- chat item -->
                  @if($leaves->status == 'approved' && $leaves->from_dt >= date("Y-m-d"))
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
                  @endif
                @endforeach
                @else
                        <center><h2>No approved leaves from your team as of the moment.
                        </h2></center>
                @endif
                  <!-- chat item -->
                </div><!-- /.chat -->
                
              </div><!-- /.box (chat box) -->

            </section><!-- /.Left col -->

<!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Team Members</h3>
                  <div class="box-tools pull-right">                    
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                  @foreach($team->members as $member)
                    @if($member->role <> null)
                      <li>
                        @if($member->gender == 'M')
                          <img src="/theme/dist/img/avatar5.png" alt="user image" class="online"//>
                        @else
                          <img src="/theme/dist/img/avatar2.png" alt="user image" class="online"//>
                        @endif
                        @if($member->username == Auth::user()->username)
                          <center><small style="color:red">You</small></center>
                        @else
                          <center><small>{{$member->firstname}}</small></center>
                        @endif
                        <!--<span class="users-list-date">Today</span>-->
                      </li>
                    @endif
                  @endforeach

                  </ul><!-- /.users-list -->
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{ URL::to('manager/' . $managerview . '/members') }}" class="uppercase">View Your Members</a>
                </div><!-- /.box-footer -->
              </div><!--/.box -->
            </section><!-- right col -->
            
          </div><!-- /.row (main row) -->
@stop