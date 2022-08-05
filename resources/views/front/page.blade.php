@extends ('front.layouts.master')
@section('title', "$page->title | Emrekhrmn")
@section('main')
                    <div class="col-md-10">
                        <img class="img-fluid" src="{{ $page->image }}" alt="">
                        <h1 class="text-white add-letter-space my-4">{{ $page->title }}</h1>
                        {!! $page->content !!}
                        <!--
                        <h2 class="text-white add-letter-space my-5">I’m on a mission to change how software is made by peoples of republic</h2>
                        <ul class="list-unstyled">
                            <li class="bullet-list-item mb-4">
                                <h3 class="text-white mb-3 add-letter-space">Building software shouldn't be so hard</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat quisque aliquam sagittis. Sem turpis sed viverra massa gravida pharetra. Non dui dolor potenti eu dignissim fusce. Ultrices amet, in curabitur a arcu a lectus morbi id. Iaculis erat sagittis in tortor cursus. Molestie urna eu tortor erat.</p>
                            </li>
                        </ul>
                        -->
                    </div>
@endsection