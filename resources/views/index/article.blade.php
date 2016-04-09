@extends('app')
@section('content')

@can('canEdit', $article)
	<a href="../post/{!! base64_encode($article->id) !!}">编辑文章</a>
@else
	
@endcan
    <h5>{{ $article->title }}</h5>
    <hr>
        {!! $article->content !!}
    <hr>
@endsection

