@extends('app')
@section('head')
<title>{{ $collection->title }}</title>
@endsection
@section('content')
    @if(SAuth::user())
        <h2>{{ SAuth::user()->nickname }}</h2>
    @else
        <h2><a href="/login">未登录</a></h2>
    @endif

    @can('edit-'.$collection->uri.'-posts')
        <a href="#">网站编辑入口</a>
    @endcan
    <hr>
    @if (count($posts) > 0)
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
    @endif
    
    <hr>
    <ul>
    @foreach ($anthologies as $anthology)
        <li>
            <a href="{{ url('anthology', base64_encode($anthology->id)) }}">
                {{ $anthology->name }}
            </a>
        </li>
    @endforeach
    </ul>
@endsection

