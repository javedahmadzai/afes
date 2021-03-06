@extends('layouts.app')

@section('title', $post->title)

@section('content')

    @component('partials.head')
        {{ $post->title }}
    @endcomponent

    <div class="container-fluid">

        <div class="row p-4">

            <div class="col-md-8 p-0">

                <div class="container p-0 app-post">

                    <p class="app-post-tags"><b>Posted in</b> {{ $post->tags->pluck('name')->implode(', ') }}</p>

                    <img src="{{ $post->imagePath }}" alt="{{ $post->title }}" class="img-fluid w-100">

                    <div class="row">
                        <div class="col-sm-6 py-3">
                            <div class="container d-flex align-items-center py-3 app-post-first">
                                <a href="{{ url('profile/' . $post->user->id) }}"><img class="app-post-avatar" src="{{ $post->user->gravatar }}"></a>
                                <div>
                                    <p class="ml-3 mb-0 app-post-name">{{ $post->user->name }}</p>
                                    <p class="ml-3 mb-0 text-muted">{{ $post->published_at->toFormattedDateString() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 py-sm-3">
                            <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                            <div class="mt-1"><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Hello%20world" data-size="large">Tweet</a></div>
                        </div>
                    </div>

                    <div class="app-post-body text-justify">{!! html_entity_decode($post->body) !!}</div>

                </div>

                <div id="disqus_thread" class="py-3"></div>

            </div>

            <div class="col-md-4 p-0 pl-md-4">

                <div class="container py-3" style="background:#ededed">
                    <p><b>News</b></p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi ducimus deserunt officia inventore sit doloribus perferendis, itaque eius et, sapiente magnam alias commodi aperiam doloremque quae eaque vero nam tempora.</p>
                </div>

                <div class="container py-3 mt-3" style="background:#ededed">
                    <p><b>Latest Articles</b></p>

                    @foreach($latest as $post)

                        <a class="row" href="{{ url('blog/' . $post->slug ) }}">
                            <div class="col-5">
                                <img src="{{ $post->thumbnailPath }}" alt="{{ $post->title}}" style="width:100%;">
                            </div>

                            <div class="col pl-0">
                                <p class="mb-0" style="font-size:1rem; line-height:18px; font-weight:100; font-family: 'Roboto'; color:#900;">{{ $post->title }}</p>
                                <span style="font-weight:300; font-size:14px; color:#999;">{{ $post->published_at->toFormattedDateString() }}</span>
                            </div>
                        </a>

                        @if(!$loop->last)
                            <hr>
                        @endif

                    @endforeach

                </div>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>
        window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
            t._e.push(f);
        };

        return t;
        }(document, "script", "twitter-wjs"));
    </script>
    <script>
        var disqus_config = function () {
        this.page.url = '{{ url()->current() }}';  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = '{{ $post->id }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://afghanevaluationsociety.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
    </script>
@endpush
