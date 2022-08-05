@extends('back.layouts.master')
@section('title', 'Makale Düzenle')

@section('specificCss')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('main')
                    <div class="row">
                        <div class="col-12">
                            <!-- Content Row -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <span class="m-0 font-weight-bold text-primary">@yield('title')</span>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            @foreach ($errors->all() as $error)
                                                <li class="bg-transparent border-0 p-0 list-group-item d-flex  align-items-center"><span
                                                        class="badge badge-danger badge-pill mr-3">!</span>
                                                    {{ $error }}
                                                </li>
                                            @endforeach
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">Makale Başlığı</label>
                                            <input type="text" name="title" value="{{ $article->title }}" class="form-control" id="title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Kategori</label>
                                            <select class="custom-select" name="category" id="category" required>
                                                @foreach ($categories as $category)
                                                <option @if ($article->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Makale Görseli</label><br>
                                            <input type="file" name="image" class="form-control" id="image">
                                            <small class="form-text text-muted">Mevcut görseli görüntülemek için <a href="" class="font-weight-bold" data-toggle="modal" data-target="#articleImage">tıklayın</a></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="summernote">Makale İçeriği</label>
                                             <textarea class="form-control" name="content" id="summernote" rows="3">{{ $article->content }}</textarea>
                                        </div>
                                        <button class="btn btn-primary btn-block" type="submit">Makaleyi Güncelle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Modal-->
                    <div class="modal fade" id="articleImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"Naria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Mevcut Görsel</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ Str::startsWith($article->image, ['Http', 'http']) ? $article->image : asset('') . $article->image }}" style="max-width:100%; object-fit:cover" alt="Article Image">
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('specificJs')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#summernote').summernote({
            'height': 200,
        });
    });
    </script>
@endsection