@extends('app')

@section('content')
<div class="container">
  <div class="row">
    @if($user)
        <h2>{{ $user->nickname }}</h2>
    @endif
  </div>
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">新增 Page</div>

        <div class="panel-body">

          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif


          {!! Form::open(['url'=>'/post']) !!}
            {!! Form::text('title', null, [
              'class'=>'form-control', 
              ]) !!}
            <br>
            {!! Form::textarea('content', null, [
              'class'=>'form-control',
              'rows'=>'10'
              ]) !!}
            <br>
            {!! Form::checkbox('define_published_at', null, null, []) !!}
            {!! Form::input('date','published_date',date('Y-m-d'),['class'=>'form-control']) !!}
            {!! Form::input('time','published_time',date('H:i'),['class'=>'form-control']) !!}
            <br>
            <br>
            {!! Form::submit('新增 Page',['class'=>'btn btn-success']) !!}
          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>
@endsection