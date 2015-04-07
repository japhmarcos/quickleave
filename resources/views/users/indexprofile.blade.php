@extends('layouts.master')

@section('title')
    User - Profile Info
@stop

@section('pagetitle')
    {!! Auth::user()->firstname !!}'s Profile Information
@stop

@section('breadcrumbs')
    <li><a href=""><i class="fa fa-user"></i> {!! Auth::user()->firstname !!}</a></li>
    <li class="active"><a href="">Profile</a></li>
@stop


@section('content')

        @if (Session::has('message'))
        <div class="alert alert-info">{!! Session::get('message') !!}</div>
        @endif

<div class="row">

    <section class="col-lg-3 connectedSortable">
        <div class="box box-solid ">
            <div class="box-body">
                @if(Auth::user()->gender == 'M')
                    @if(Auth::user()->role == 'admin')
                        <center><img style="width=100%" align="center" src="/theme/dist/img/avatar.png"></center>
                    @elseif(Auth::user()->role == 'director')
                        <center><img style="width=100%" align="center" src="/theme/dist/img/avatar3.png"></center>
                    @else
                        <center><img style="width=100%" align="center" src="/theme/dist/img/avatar5.png"></center>
                    @endif
                @else
                    <center><img style="width=100%" align="center" src="/theme/dist/img/avatar2.png"></center>
                @endif
            </div>
        </div>
    </section>

    <section class="col-lg-5 connectedSortable">
        <div class="box box-warning ">
            <div class="box-body ">
                <dl class="dl-horizontal">
                <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">PERSONAL INFORMATION</h3>
                </div><!-- /.box-header -->
                    <dt>Username:</dt>
                    <dd>{!! Auth::user()->username !!}</dd>
                    <dt>Email:</dt>
                    <dd>{!! Auth::user()->email !!}</dd>
                    <dt>First Name:</dt>
                    <dd>{!! Auth::user()->firstname !!}</dd>
                    <dt>Last Name:</dt>
                    <dd>{!! Auth::user()->lastname !!}</dd>
                    <dt>Date Hired:</dt>
                    <dd>{!! Auth::user()->date_hired !!}</dd>
                    
                </dl>
            </div><!-- /.box-body -->

            @if((Auth::user()->role) <> 'admin')
            <div class="box-header">
                <i class="fa fa-edit"></i>
                <h3 class="box-title">LEAVE INFORMATION</h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>Sick Leave Balance:</dt>
                    <dd>{!! Auth::user()->sl_bal !!}</dd>
                    <dt>Vacation Leave Balance:</dt>
                    <dd>{!! Auth::user()->vl_bal !!}</dd>
                </dl>
            </div><!-- /.box-body -->

            <div class="box-header">
                <i class="fa fa-users"></i>
                <h3 class="box-title">TEAM INFORMATION</h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <dl class="dl-horizontal">
                        <dt>Team:<dt>
                        <dd>{!! Auth::user()->team->team_name !!}</dd>
                        <dt>Manager:</dt>
                    @if((Auth::user()->role) == 'manager')
                        <dd>You are the manager of the team</dd>
                    @elseif ((Auth::user()->role) == 'member')
                        @if($team_manager->first())
                            <dd>{!! Auth::user()->manager->firstname !!}</dd>
                        @else
                            <dd>None</dd>
                        @endif
                    @endif
                    
                </dl>
            </div><!-- /.box-body -->
            @endif

            <div class="box-footer">
                  <div class="row">
                    <center>
                    <a class="btn bg-orange" href="{{ URL::to('user/' . Auth::user()->id . '/edit') }}">Edit Information</a>
                    &nbsp;
                    <a class="btn bg-maroon" href="{{ URL::to('user/' . Auth::user()->id . '/changepassword') }}">Change Password</a>
                    </center>
                  </div><!-- /.row -->
            </div>

            </div>
        </div>
    </section>


</div><!-- row -->
@stop