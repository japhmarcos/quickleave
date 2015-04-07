@extends('layouts.master')

@section('title')
    @if((Auth::user()->role) == 'manager')
    Manager - Edit Pending request
    @else
    User - Edit Pending request
    @endif
@stop

@section('pagetitle')
    Edit your <b>{!! $leave->type !!}</b> request from <b>{!! date("M d, Y",strtotime($leave->from_dt)) !!}</b> to <b>{!! date("M d, Y",strtotime($leave->to_dt)) !!}</b>
@stop

@section('breadcrumbs')
    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="/leaves/pending">{{$leave->id}}</a></li>
    <li class="active"><a href="">Edit Request</a></li>
@stop

@section('content')


          <div class="row">
            <div class="col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-black"><i class="fa fa-car"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">VL Balance</span>
                  <span class="info-box-number">{!! Auth::user()->vl_bal !!}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
        

           
              <div class="info-box">
                <span class="info-box-icon bg-black"><i class="fa fa-heart"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">SL Balance</span>
                  <span class="info-box-number">{!! Auth::user()->sl_bal !!}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-9">
            <div class="box box-warning">
            <div class="box-header with-border">
                    Fill out the form. Choose between Sl/VL leave type. Reason/Note is required for Manager's decision.
            <div class="box-tools pull right"></div>
            </div>

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

                {!! Form::model($leave, array('route' => array('leaves.update', $leave->id), 'method' => 'PUT')) !!}

                <div class="form-group">
                {!! Form::label('type', 'LEAVE TYPE') !!}
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                {!! Form::select('type', array('' => 'Select leave type ', 'SL' => 'Sick Leave', 'VL' => 'Vacation Leave'), Input::old('type'), array('class' => 'form-control', 'required' => 'required')) !!}
                </div>
            
            </div>
            
            <div class="form-group">
                {!! Form::label('from_dt', 'FROM DATE') !!}
                    <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                    {!! Form::text('from_dt', Input::old('from_dt'), array('class' => 'form-control', 'id' => 'from_dt',
                    'placeholder' => 'Pick a date','required' => 'required' )) !!} 
                    </div>
                  
            </div>

            <div class="form-group">
                {!! Form::label('to_dt', 'TO DATE') !!}
                    <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                    {!! Form::text('to_dt', Input::old('to_dt'), array('class' => 'form-control','id' => 'to_dt', 
                    'placeholder' => 'Pick a date', 'required' => 'required')) !!}
                    </div>
            </div>

            <div class="form-group">
                {!! Form::label('note', 'REASON/NOTE') !!}
                {!! Form::textarea('note', Input::old('note'), array('class' => 'form-control', 'size'=> '30x3','placeholder' => 'Additional note', 'required' => 'required')) !!}
            </div>

                {!! Form::submit('Submit changes', array('class' => 'btn btn-primary')) !!}

                {!! Form::close() !!}

        </div>

        </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@stop

    
