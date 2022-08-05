@extends('back.layouts.master')
@section('title', 'Sayfa Oluştur')

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

                                    <form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">Sayfa Başlığı</label>
                                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Sayfa Görseli</label>
                                            <input type="file" name="image" value="{{ old('image') }}" class="form-control" id="image" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="summernote">Sayfa İçeriği</label>
                                             <textarea class="form-control" name="content" id="summernote" rows="3">{{ old('content') }}</textarea>
                                        </div>
                                        <button class="btn btn-primary btn-block" type="submit">Sayfayı Oluştur</button>
                                    </form>
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