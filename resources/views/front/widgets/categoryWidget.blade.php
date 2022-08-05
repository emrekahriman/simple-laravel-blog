@isset($categories)    
                    <div class="widget bg-dark p-4 text-center">
                        <div class="mb-5 text-center">
                            <h2 class="widget-title text-white d-inline-block">Tüm Kategoriler</h2>
                        </div>
                        <div class="categores-links text-capitalize">
                            @foreach ($categories as $category)
                            <a class="border @if (Request::segment(2) == $category->slug) cat-active @endif" href="{{ route('category', $category->slug) }}">{{ $category->name }} ( {{ $category->articles->count() }} )</a>                                
                            @endforeach
                        </div>
                    </div>
                    <!-- end of categories-widget -->
@endisset