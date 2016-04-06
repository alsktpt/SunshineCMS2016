@extends('app')

@section('content')
    <div class="content">
        <div class="title">login</div>
        @if (count($errors) > 0) 
              <div class="alert alert-danger"> 
                  <strong>啊噢？！</strong> 您输入的信息出了点问题：<br><br> 
                  <ul> 
                      @foreach ($errors->all() as $error) 
                          <li>{{ $error }}</li> 
                      @endforeach 
                  </ul> 
              </div> 
          @endif 

        <div class="form">
            {!! Form::open(['url'=>'/loginpost']) !!}
                <div class="form-group">
                    {!! Form::label('sid','学号:') !!}
                    {!! Form::text('sid',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password','密码:') !!}
                    {!! Form::password('password',['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('remember', null) !!} Remember Me
                </div>
                <div class="form-group">
                    {!! Form::submit('登陆',['class'=>'btn btn-success form-control']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
