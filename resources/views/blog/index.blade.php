@extends('layouts.app')

@section('title', 'Blog')


@section('content')

    @component('partials.head')
        Articles
    @endcomponent

    <div class="container py-3">

        <div class="row">

            <div class="col-md-8">

                <div class="container mb-2">

                    @foreach($posts as $post)

                        <div class="row mb-3 app-blog-post" onclick="window.location.href = '{{ url()->current() . '/' . $post->slug }}'">

                            <div class="col-sm-4 p-0 app-blog-post-left">
                                <img class="bd-placeholder-img" src="{{ optional($post)->thumbnail }}"></img>
                            </div>

                            <div class="col-sm-8 p-2 app-blog-post-right">
                                <h2 class="pl-2 mb-1"><a href="{{ url()->current() . '/' . $post->slug }}">{{ $post->title }}</a></h2>
                                <p class="pl-2 mb-1 tags">{{ $post->tags->pluck('name')->toUpper()->implode(', ') }}</p>
                                <p class="pl-2">{{ str_limit($post->body, 150) }}</p>
                                <img src="{{ $post->user->gravatar }}" title="{{ $post->user->name }}" alt="{{ $post->user->name }}">
                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

            <div class="col-md-4" style="background:#eaeaea;">



            </div>

        </div>

        <div class="row justify-content-center align-items-center mt-3">
            {{ $posts->links() }}
        </div>

    </div>

@endsection
