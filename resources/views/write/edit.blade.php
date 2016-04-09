@extends('app')

@section('content')
<div class="container">
  <div class="row">
    @if(Auth::user())
        <h2>{{ Auth::user()->nickname }}</h2>
    @endif

  </div>
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">修改 Page</div>

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

          {!! Form::open(['url'=>'/post/update']) !!}
            {!! Form::hidden('id', base64_encode($article->id)) !!}
            {!! Form::text('title', $article->title, [
              'class' => 'form-control', 
              ]) !!}
            <br>
            {!! Form::textarea('content', $article->content, [
              'class'=>'form-control',
              'rows'=>'10'
              ]) !!}
            <br>
            {!! Form::checkbox('define_published_at', null, null, []) !!}
            {!! Form::input('date','published_date',$article->published_at->format('Y-m-d'),['class'=>'form-control']) !!}
            {!! Form::input('time','published_time',$article->published_at->format('H:i'),['class'=>'form-control']) !!}
            <br>
            <br>
            {!! Form::submit('提交修改',['class'=>'btn btn-success']) !!}
          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>
@endsection