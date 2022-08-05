@extends ('front.layouts.master')
@section('main')
                <div class="col-lg-7">
                    @if ($articles->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            <strong>Herhangi bir makale bulunamadı.</strong>
                        </div>
                    @else
                        @foreach ($articles as $article)
                        <!-- start post-item -->
                        <div class="card post-item bg-transparent border-0 mb-5">
                            <a href="{{ route('singleArticle',  [$article->category->slug, $article->slug] ) }}">
                                <img class="card-img-top rounded-0" src="{{ Str::startsWith($article->image, ['Http', 'http']) ? $article->image : asset('') . $article->image }}" alt="Article Image" />
                            </a>
                            <div class="card-body px-0">
                                <h2 class="card-title">
                                    <a class="text-white opacity-75-onHover" href="{{ route('singleArticle',  [$article->category->slug, $article->slug] ) }}">
                                        {{ $article->title }}
                                        </a>
                                </h2>
                                <ul class="post-meta mt-3">
                                    <li class="d-inline-block mr-3">
                                        <span class="fas fa-clock text-primary"></span>
                                        <a class="ml-1" href="#">{{ $article->created_at->diffForHumans() }}</a>
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
                                <p class="card-text my-4">
                                    {!! Str::limit(strip_tags($article->content), 140) !!}
                                </p>
                                <a href="{{ route('singleArticle',  [$article->category->slug, $article->slug] ) }}" class="btn btn-primary"
                                    >Devamını Oku <img src="{{ asset('front') }}/images/arrow-right.png" alt=""
                                /></a>
                            </div>
                        </div>
                        <!-- end of post-item -->
                        @endforeach
                    @endif
                    
                </div>

                <div class="col-lg-4 col-md-5">
                    @include('front.widgets.categoryWidget')

                    @include('front.widgets.popularPostWidget')
                </div>
@endsection