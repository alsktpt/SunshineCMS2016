@extends('app')
@section('content')

    <h5>{{ $article->title }}</h5>
    <hr>
        {!! html_entity_decode($article->content) !!}
    <hr>
@endsection

