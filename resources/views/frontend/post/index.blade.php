@extends('layouts.app')
@section('title', 'PT. Atrans Autoparts Indonesia')
@section('content')

<div class="container my-5">
    <div class="col-md-12 mx-auto">
        <div class="row">
            <div class="col-md-9">
                <div class="row">

                    @foreach($posts as $post)


                    <div class="col-md-6">
                        <div class="card border-0 p-3">
                            <div class="post-img-cover rounded">
                                <div class="post-img-frame">
                                    <img src="{{asset('uploads/posts/' .$post->image)}}" class="rounded" alt="...">
                                </div>
                            </div>

                            <h4 class="card-title my-3">
                                <a class="link-dark text-decoration-none"
                                    href="{{url(LaravelLocalization::getCurrentLocale() .'/news/'. $post->slug)}}">
                                    {{$post->postTranslations->first()->title}}
                                </a>
                            </h4>
                            <p class="card-text text-muted">
                                {{Str::limit(strip_tags($post->postTranslations->first()->content),80)}}</p>
                            <div class="d-flex justify-content-between align-items-start text-muted">
                                <div class="date">
                                    <i class='bx bx-calendar'></i> <small>{{date('j M Y',
                                        strtotime($post->created_at))}}</small>
                                </div>
                                <div class="view">
                                    <i class='bx bx-show'></i> <small>{{$post->views}} View </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-md-12 mt-5">
                        {{$posts->links()}}
                    </div>


                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0">
                    <img src="https://tf01.themeruby.com/recipe/wp-content/uploads/sites/2/2019/07/f137-370x250.jpg"
                        class="rounded" alt="...">

                    <h4 class="card-title my-3">How to Make Cappuccino without a Machine</h4>
                    <p class="card-text text-muted">Some quick example text to build on the card title and make up
                        the bulk
                        of the card's content.</p>
                    <div class="d-flex justify-content-between align-items-start text-muted">
                        <div class="date fs-6">
                            <i class='bx bx-calendar'></i> 17 Dec 2023
                        </div>
                        <div class="view">
                            <i class='bx bx-bar-chart-alt-2'></i> 1432 View
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection