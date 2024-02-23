@extends('backend.admin-layouts.app')

@section('admin_title', 'Dashboard | MediTips')
@section('header', 'Dashboard')

@section('admin_content')


@php
   $post = DB::table('posts')->where('status', 1)->where('is_approved', 1)->get();
   $pendingPost = DB::table('posts')->where('status', 0)->where('is_approved', 0)->count();
   $NewPost = DB::table('posts')->where('status', 1)->where('is_approved', 1)->latest()->take(20)->count();
   $totalUser = DB::table('users')->where('role', 2)->count();
@endphp

@if (Auth::user()->role == 1)
<!-- Small boxes (Stat box) -->
<div class="row mt-5">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$NewPost}}</h3>

          <p>New Post</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{$post->count(); }}</h3>

          <p>Total Post</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{$pendingPost}}</h3>

          <p>Pending Post</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{$totalUser}}</h3>

          <p>Total User</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
</div>

@endif

@php
   $post = DB::table('posts')->where('user_id', Auth::user()->id)->where('status', 1)->where('is_approved', 1)->count();
   $pendingPost = DB::table('posts')->where('user_id', Auth::user()->id)->where('status', 0)->where('is_approved', 0)->count();
   $topPost = DB::table('post_counts')->where('count')->count();
   $latestPost = DB::table('posts')->where('id', Auth::user()->id)->where('status', 1)->latest()->take(10)->get();
@endphp
@if (Auth::user()->role == 2)
<!-- Small boxes (Stat box) -->
<div class="row mt-5">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$post}}</h3>

          <p>All Post</p>
        </div>
        <div class="icon">
          <i class="fa-regular fa-file " ></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{$pendingPost}}</h3>

          <p>Pending Post</p>
        </div>
        <div class="icon">
          <i class="fa-regular fa-file-excel"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{$topPost}}</h3>

          <p>Top Post</p>
        </div>
        <div class="icon">
          <i class="fa-regular fa-circle-check"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $latestPost->count() }}</h3>

          <p>Latest Post</p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-signal"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
</div>

@endif
  <!-- /.row -->
  <!-- Main row -->
  
  <!-- /.row (main row) -->

@endsection
