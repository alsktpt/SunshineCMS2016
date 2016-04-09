@extends('app')
@section('content')
    @if(SAuth::user())
        <h2>{{ SAuth::user()->nickname }}</h2>
    @else
        <h2><a href="/login">未登录</a></h2>
    @endif
    
    @can('edit-post')
        <a href="#">网站编辑入口</a>
    @endcan
    <h5>Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</h5>
    <hr>
    <ul>
    @foreach ($posts as $post)
        <li>
            <a href="{{ url('article', base64_encode($post->id)) }}">{{ $post->title }}</a>
            <em>({{ $post->published_at }})</em>
            <b>最后编辑者： {!! \App\User::nickname($post->last_editor_id) !!}</b>
            <em>编辑于： {{ $post->updated_at->diffForHumans() }}</em>
            <p>
                {{ str_limit(strip_tags($post->content)) }}
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

