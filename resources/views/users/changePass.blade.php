@extends('layouts.master')

@section('title')
    Change Password
@stop

@section('pagetitle')
    Change Password
@stop

@section('breadcrumbs')
    <li><a href=""><i class="fa fa-user"></i> {!! Auth::user()->username !!}</a></li>
    <li class="active"><a href="">Change Password</a></li>
@stop

@section('content')

        @if (Session::has('message'))
        <div class="alert alert-info">{!! Session::get('message') !!}</div>
        @endif

<div class="row">

    <section class="col-lg-5 connectedSortable">
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
            <div class="box-body">
                <br>
                {!! Form::model($user, array('route' => array('users.updatePass', $user->id), 'method' => 'PUT')) !!}
                    {!! Form::label('old_password', 'Old Password:') !!}
                    {!! Form::password('old_password', array('class' => 'form-control', 'Placeholder' => 'Input old password')) !!} <br>
                    {!! Form::label('new_password', 'New Password:') !!}
                    {!! Form::password('new_password', array('class' => 'form-control', 'Placeholder' => 'Input new password')) !!} <br>
                    {!! Form::label('retype_password', 'Retype Password:') !!}
                    <dd>{!! Form::password('retype_password', array('class' => 'form-control', 'Placeholder' => 'Retype password')) !!} </dd> 
            </div><!-- /.box-body -->
            

            <div class="box-footer">
                  <div class="row">
                    <center> {!! Form::submit('Save changes', array('class' => 'btn btn-primary')) !!} </center>
                  </div><!-- /.row -->
            </div>
                {!! Form::close() !!}

            </div>
        </div>
    </section>


</div><!-- row -->
@stop