@extends('app')
@section('content')

    <h5>{{ $article->title }}</h5>
    <hr>
        {!! $article->content !!}
    <hr>
@endsection

