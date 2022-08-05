@extends ('front.layouts.master')
@section('title', "$article->title | Emrekhrmn")
@section('main')
                        <div class="col-lg-10">
                            <img
                                class="img-fluid"
                                src="{{ Str::startsWith($article->image, ['Http', 'http']) ? $article->image : asset('') . $article->image }}"
                                alt="Article Image"
                            />
                            <h1 class="text-white add-letter-space mt-4">
                                {{$article->title}}
                            </h1>
                            <ul class="post-meta mt-3 mb-4">
                                <li class="d-inline-block mr-3">
                                    <span
                                        class="fas fa-clock text-primary"
                                    ></span>
                                    <a class="ml-1" href="#">{{ $article->created_at->diffForHumans() }}</a>
                                </li>
                                <li class="d-inline-block mr-3">
                                    <span
                                        class="fas fa-list-alt text-primary"
                                    ></span>
                                    <a class="ml-1" href="#">{{ $article->category->name }}</a>
                                </li>
                                <li class="d-inline-block">
                                    <span class="fas fa-eye text-primary"></span>
                                    <a class="ml-1" href="#">{{ $article->hit }}</a>
                                </li>
                            </ul>

                            <p>
                                {{ $article->content }}
                            </p>

                            <div class="blockquote bg-dark my-5">
                                <p class="blockquote-text pl-2">
                                    A wise girls knows her limit to touch
                                    sky.Rpelat sapiesd praesentium adipisci.The
                                    question me an idea so asered
                                </p>
                                <span class="blockquote-footer text-white h4 mt-3">James Hopkins</span>
                            </div>
                        </div>
@endsection