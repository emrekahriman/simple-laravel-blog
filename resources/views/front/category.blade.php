@extends ('front.layouts.master')
@section('title', "$category->name Yazıları | Emrekhrmn")
@section('main')
    <div class="col-lg-7">
        @if (!$articles->isEmpty())
        @foreach ($articles as $article)
        <div class="card post-item bg-transparent border-0 mb-5">
            <a href="{{ route('singleArticle', [$article->category->slug, $article->slug]) }}">
                <img class="card-img-top rounded-0" src="{{ Str::startsWith($article->image, ['Http', 'http']) ? $article->image : asset('') . $article->image }}" alt="">
            </a>
            <div class="card-body px-0">
                <h2 class="card-title">
                    <a class="text-white opacity-75-onHover" href="{{ route('singleArticle', [$article->category->slug, $article->slug]) }}">{{ $article->title }}</a>
                </h2>
                <ul class="post-meta mt-3">
                    <li class="d-inline-block mr-3">
                        <span class="fas fa-clock text-primary"></span>
                        <a class="ml-1" href="">{{ $article->created_at->diffForHumans() }}</a>
                    </li>
                    <li class="d-inline-block mr-3">
                        <span class="fas fa-list-alt text-primary"></span>
                        <a class="ml-1" href="#">{{ $article->category->name }}</a>
                    </li>
                    <li class="d-inline-block">
                        <span class="fas fa-eye text-primary"></span>
                        <a class="ml-1" href="#">{{ $article->hit }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end of post-item -->
        @endforeach

        <!-- Page links -->
        {{ $articles->links('pagination::bootstrap-4') }}

        @else
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    Bu kategoriye ait yazı bulunamadı.
                </div>
            </div>
        @endif
    </div>
    <div class="col-lg-4">
        @include('front.widgets.categoryWidget')
    </div>
@endsection