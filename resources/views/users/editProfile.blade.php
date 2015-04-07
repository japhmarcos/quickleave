@extends('layouts.master')

@section('title')
    Edit Profile
@stop

@section('pagetitle')
    Edit {!! Auth::user()->username !!}'s Profile Information
@stop
    
@section('breadcrumbs')
    <li><a href=""><i class="fa fa-user"></i> {!! Auth::user()->username !!}</a></li>
    <li class="active"><a href="">Edit Profile</a></li>
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
            <div class="box-footer">
                  <div class="row">
                    <center>
                        <button class="btn btn-primary>"><a href="">Browse Image</a></button>
                        </center>
                  </div><!-- /.row -->
            </div>
        </div>
    </section>

    <section class="col-lg-5 connectedSortable">
        <div class="box box-warning ">
            <div class="box-body ">
                <br>
            {!! Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) !!}
                    {!! Form::label('username', 'Username:') !!}
                    {!! Form::text('username', Input::old('username'), array('class' => 'form-control',
        'placeholder' => 'Username')) !!} <br>
                {!! Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) !!}
                    {!! Form::label('email', 'Email Address:') !!}
                    {!! Form::text('email', Input::old('email'), array('class' => 'form-control',
        'placeholder' => 'Email Address')) !!} <br>
                    {!! Form::label('firstname', 'Firstname:') !!}
                    {!! Form::text('firstname', Input::old('firstname'), array('class' => 'form-control',
        'placeholder' => 'Firstname')) !!} <br>
                    {!! Form::label('lastname', 'Lastname:') !!}
                    {!! Form::text('lastname', Input::old('lastname'), array('class' => 'form-control',
        'placeholder' => 'Lastname')) !!}
            </div><!-- /.box-body -->
          

            <div class="box-footer">
                  <div class="row">
                    <center>{!! Form::submit('Save changes', array('class' => 'btn btn-primary')) !!} </center>
                  </div><!-- /.row -->
            </div>

    {!! Form::close() !!}

            </div>
        </div>
    </section>


</div><!-- row -->
@stop
