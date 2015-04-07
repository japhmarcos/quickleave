@extends('layouts.master')

@section('title')
    Admin - Edit Employee Info
@stop

@section('pagetitle')
    Edit {!! $employee->firstname !!}'s Information
@stop

@section('breadcrumbs')
  <li><a href="/admin"><i class="fa fa-home"></i> Admin Dashboard</a></li>
  <li><a href="/admin/showemployees">View All Employees</a></li>
  <li class="active"><a href="">{!! $employee->firstname !!} Edit Info</a></li>
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


    {!! Form::model($employee, array('route' => array('admin.updateEmployee', $employee->id), 'method' => 'PUT')) !!}

    <div class="container-fluid">

        <div class= "row">
            <div class="col-md-6" class="form-group">
                {!! Form::label('date_hired', 'Date Hired') !!}
            <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
            {!! Form::text('date_hired', Input::old('date_hired'), array('class' => 'form-control', 'id' => 'date_hired',
            'placeholder' => 'Pick a date','required' => 'required' )) !!} 
            </div>
            </div>

            <div class="col-md-6" class="form-group">
                {!! Form::label('role', 'Role') !!}
                <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-chevron-down"></i>
                </div>
                {!! Form::select('role', array('' => 'Select a role', 'manager' => 'Manager', 'member' => 'Member'), Input::old('role'), array('class' => 'form-control')) !!}
            </div>
            </div>
        </div>
        <br>
        <div class="row">

            <div class="col-md-6" class="form-group">
                {!! Form::label('sl_bal', 'SL Balance') !!}
                {!! Form::input('number','sl_bal', null, array('class' => 'form-control')) !!}
            </div>

            <div class="col-md-6" class="form-group">
                {!! Form::label('vl_bal', 'VL Balance') !!}
                {!! Form::input('number','vl_bal', null, array('class' => 'form-control')) !!}
            </div>

        </div>
        <br>
        {!! Form::submit('Submit changes', array('class' => 'btn btn-primary')) !!}
 </div> <!-- container fluid -->
    {!! Form::close() !!}
  </div><!-- /.box-body -->
</div><!-- /.box -->
@stop
