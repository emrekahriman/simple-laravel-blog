@isset($popularArticles)    
                    <div class="widget">
                        <div class="mb-5 text-center">
                            <h2 class="widget-title text-white d-inline-block">Öne çıkan Yazılar</h2>
                        </div>
                        @foreach ($popularArticles as $article)
                        <div class="card post-item bg-transparent border-0 mb-5">
                            <a href="post-details.html">
                                <img class="card-img-top rounded-0" src="{{ $article->image }}" alt="Article Image">
                            </a>
                            <div class="card-body px-0">
                                <h2 class="card-title">
                                    <a class="text-white opacity-75-onHover" href="post-details.html">{{ Str::limit($article->title, 45)}}</a>
                                </h2>
                                <ul class="post-meta mt-3 mb-4">
                                    <li class="d-inline-block mr-3">
                                        <span class="fas fa-clock text-primary"></span>
                                        <a class="ml-1" href="#">{{ $article->created_at->diffForHumans() }}</a>
                                    </li>
                                    <li class="d-inline-block">
                                        <span class="fas fa-list-alt text-primary"></span>
                                        <a class="ml-1" href="#">{{ $article->category->name }}</a>
                                    </li>
                                </ul>
                                <a href="{{ route('singleArticle', [$article->category->slug, $article->slug]) }}" class="btn btn-primary">Devamını Oku <img src="{{ asset('front') }}/images/arrow-right.png"></a>
                            </div>
                        </div>
                        <!-- end of widget-post-item -->
                        @endforeach
                        
                    </div>
                    <!-- end of post-items widget -->
@endisset