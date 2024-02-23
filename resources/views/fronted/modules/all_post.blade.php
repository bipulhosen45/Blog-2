@extends('fronted.layouts.master')
@section('page_title', $post_title)

@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>{{$sub_title}}</h4>
                            <h2>{{$post_title}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('content')


@foreach ($posts as $post)
<div class="col-lg-12">
  <div class="blog-post">
    <div class="blog-thumb">
      <img src="{{$post->image}}" alt="{{$post->post_title}}">
    </div>
    <div class="down-content">
      <span>{{$post->category?->name}} <sub class="text-dark">{{$post->sub_category?->name}}</sub></span>
      <a href="{{route('front.single', $post->slug)}}"><h4>{{$post->post_title}}</h4></a>
      <ul class="post-info">
        <li><a href="#">{{$post->user?->name}}</a></li>
        <li><a href="#">{{$post->created_at->format('M d, Y')}}</a></li>
        <li><a href="#">{{$post->comment?->count()}} Comments</a></li>
      </ul>
      <p>{{strip_tags(substr($post->description, 0, 800)).'...'}}
        <a href="{{route('front.single', $post->slug)}}"><button type="button" class="btn btn-outline-secondary btn-sm readmore">Read More</button></a>
      </p>
      <div class="post-options">
        <div class="row">
          <div class="col-6">
            <ul class="post-tags">
              <li><i class="fa fa-tags"></i></li>
              @foreach ($post->tags as $tag)
              <li><a href="{{route('front.tag', $tag->slug)}}">{{$tag->name}}</a>, </li>
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
@endforeach

@if (count($posts) < 1 )
    <h3 class="text-center text-danger">No Post Found</h3>
@endif

<div class="col-lg-12">
 {{$posts->links()}}
</div>

@endsection
