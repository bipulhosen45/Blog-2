<div class="col-lg-4">
    <div class="sidebar">
        <div class="row">
            <div class="col-lg-12">
                <form id="search_form" name="search" method="GET" action="{{route('front.search')}}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control searchText" id="search" name="search"  placeholder="Type to search...">
                            <button class="input-group-text btn btn-success btn sm" id="search" type="submit" name="submit"><i class="fa fa-search"></i></button>
                          </div>
                </form>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                        <h2>{{__('Recent Posts')}}</h2>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach ($recent_posts as $post)
                                <li><a href="{{ route('front.single', $post->slug) }}">
                                        <h5>{{ $post->post_title }}</h5>
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                    </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                        <h2>{{__('Categories')}}</h2>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="{{ route('front.category', $category->slug) }}">{{ $category->name }}</a>
                                    <ul class="sub-category">
                                        @foreach ($category->sub_categories as $sub_category)
                                            <li><a
                                                    href="{{ route('front.sub_category', [$category->slug, $sub_category->slug]) }}">-
                                                    {{ $sub_category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                        <h2>{{__('Tag Clouds')}}</h2>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach ($tags as $tag)
                                <li><a href="{{ route('front.tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
