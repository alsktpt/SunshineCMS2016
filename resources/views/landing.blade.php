@extends('app')
@section('content')
    @if(SAuth::user())
        <h2>{{ SAuth::user()->nickname }}</h2>
    @else
        <h2><a href="/login">未登录</a></h2>
    @endif
    <h5>Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</h5>
    <hr>
    <ul>
    @foreach ($posts as $post)
        <li>
            <a href="{{ url('article', $post->id) }}">{{ $post->title }}</a>
            <em>({{ $post->published_at }})</em>
            <p>
                {{ str_limit($post->content) }}
            </p>
        </li>
    @endforeach
    </ul>
    <hr>
    {!! $posts->render() !!}
    <hr>
    <ul>
    @foreach ($activities as $act)
        <li>
            <p>{{ $act->name }}</p>
            <em>({{ $act->start_at }})</em>
        </li>
    @endforeach
    </ul>
@endsection

