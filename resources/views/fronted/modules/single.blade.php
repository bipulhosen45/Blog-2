@extends('fronted.layouts.master')
@section('page_title', 'Welcome')

@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Post Details</h4>
                            <h2>Single blog post</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="blog-post">
            <div class="blog-thumb">
                <img src="{{ $posts->image }}" alt="{{ $posts->post_title }}">
            </div>
            <div class="down-content">
                <span>{{ $posts->category?->name }} <sub class="text-dark">{{ $posts->sub_category?->name }}</sub></span>
                <a href="{{ route('front.single', $posts->slug) }}">
                    <h4>{{ $posts->post_title }}</h4>
                </a>
                <ul class="post-info">
                    <li><a href="#">{{ $posts->user?->name }}</a></li>
                    <li><a href="#">{{ $posts->created_at->format('M d, Y') }}</a></li>
                    <li><a href="#">{{$posts->comment?->count()}} Comments</a></li>
                    <li><a href="#">{{$posts->post_read_count?->count}} Read</a></li>
                </ul>
                <div class="post-descriptions">
                    <p>
                        {!! $posts->description !!}
                    </p>
                </div>
                <div class="post-options">
                    <div class="row">
                        <div class="col-6">
                            <ul class="post-tags">
                                <li><i class="fa fa-tags"></i></li>
                                @foreach ($posts->tags as $tag)
                                    <li><a href="{{ route('front.tag', $tag->slug) }}">{{ $tag->name }}</a>, </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="sidebar-item comments">
            <div class="sidebar-heading">
                <h2>{{$posts->comment?->count()}} comment</h2>
            </div>
            <div class="content">
                <ul>
                    @foreach ($posts->comment as $comment)
                        <li class="d-block">
                            <div class="author-thumb">
                                <img src="{{ asset('fronted') }}/assets/images/comment-author-01.jpg" width="65" alt="" style="border-radius:50%">
                            </div>
                            <div class="right-content">
                                <h4>{{ $comment->user?->name }}<span>{{ $comment->created_at->format('M d, Y') }}</span>
                                </h4>
                                <p>{{ $comment->comment }}</p>
                                <h6>Write Reply</h6>
                                <form action="{{ route('comment.store') }}" method="POST">
                                    @csrf
                                    <div class="mt-2">
                                        <textarea name="comment" class="form-control form-control-sm" id="comment" placeholder="Write your reply" null></textarea>
                                        <input type="hidden" name="post_id" id="post_id" value="{{ $posts->id }}">
                                        <input type="hidden" name="comment_id" id="comment_id"
                                            value="{{ $comment->id }}">
                                    </div>
                                    <button type="submit" class="btn btn-outline-success btn-sm mt-2">Reply</button>
                                </form>
                            </div>
                        </li>
                        @foreach ($comment->reply as $reply)
                            <li class="replied">
                                <div class="author-thumb">
                                    <img src="{{ asset('fronted') }}/assets/images/comment-author-02.jpg" width="65" alt="" style="border-radius:50%">
                                </div>
                                <div class="right-content">
                                    <h5>{{ $reply->user?->name }}<span class="mx-2 text-">{{ $reply->created_at->format('M d, Y') }}</span></h5>
                                        <p>{{ $reply->comment }}</p>
                                </div>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <br>
    <div class="col-lg-12">
        <div class="sidebar-item submit-comment">
            <div class="sidebar-heading">
                <h2>
                    @auth()
                        Write your comment
                    @endauth
                    @guest()
                        Please <a href="{{route('login')}}">Login</a> to comment
                    @endguest
                </h2>
            </div>
            @auth()
            <div class="content">
                <form id="comment" action="{{ route('comment.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="post_id" id="post_id" value="{{ $posts->id }}">
                                {{-- <div class="col-md-6 col-sm-12">
                                    <input name="name" class="form-control" type="text" id="name" placeholder="Your name">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                    <input name="email" class="form-control" type="text" id="email" placeholder="Your email">
                            </div>
                            <div class="col-md-12 col-sm-12">
                                    <input name="subject" class="form-control" type="text" id="subject" placeholder="Your subject">
                            </div> --}}
                                <div class="col-lg-12">
                                    <textarea name="comment" class="form-control" rows="2" id="comment" placeholder="Type your comment"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="submit" id="submit" class="btn text-white" style="background: #f48840"
                                    value="Submit">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            @endauth
        </div>
    </div>


@endsection


@push('js')
<script src="https://cdn.jsdelivr.net/npm/axios@1.6.2/dist/axios.min.js"></script>
    <script>
        const readCount = () =>{
            axios.get(window.location.origin+'/post-count/'+{{$posts->id}})
        }

        setTimeout(() => {
            readCount()
        }, 10000)
    </script>
@endpush
