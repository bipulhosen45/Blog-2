
<style>
  .overlay{
    background: #00000087;
    height: 100%!important;
    width: 100%!important;
    position: absolute!important;
  }



.owl-carousel .owl-item img {
  display: block;
  width: 100%;
  height: 378px;
  object-fit: cover;
  

}
.owl-banner .item .item-content h5 {
  font-size: 20px;
  font-weight: 900;
  color: #fff;
  letter-spacing: 0.5px;
  text-transform: capitalize;
  margin: 10px 0px 12px 0px;
}
</style>
      <!-- Banner Starts Here -->
      <div class="main-banner header-text">
        <div class="container-fluid">
          <div class="owl-banner owl-carousel">
            @foreach ($slider_posts as $post)
            <div class="item">
              <div class="overlay"></div>
              <img src="{{asset($post->image)}}" height="100%" alt="{{$post->post_title}}">
              <div class="item-content">
                <div class="main-content">
                  <div class="meta-category">
                    <span style="font-size: 16px;">{{$post->category->name}}</span>
                  </div>
                  <a href="{{route('front.single', $post->slug)}}"><h5 class="text-white">{{substr($post->post_title, 0, 200)}}..</h5></a>
                  <ul class="post-info" style="margin-bottom: -6%">
                    <li><a href="#">{{$post->user->name}}</a></li>
                    <li><a href="#">{{$post->created_at->format('M d, Y')}}</a></li>
                    <li><a href="#">{{$post->comment?->count()}} Comments</a></li>
                  </ul>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <!-- Banner Ends Here -->
