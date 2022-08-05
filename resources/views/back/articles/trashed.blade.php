@extends('back.layouts.master')
@section('title', 'Silinen makaleler')

@section('specificCss')
<link href="{{ asset('back') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('main')
                    <div class="row">
                        <div class="col-12">
                            <!-- Content Row -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <span class="m-0 font-weight-bold text-primary">@yield('title')</span>
                                    <span class="float-right">
                                        <a class="ml-2 btn btn-sm btn-primary" href="{{ route('admin.articles.index') }}">Tüm Makaleler</a>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Görsel</th>
                                                    <th>Makale Başlığı</th>
                                                    <th>Kategori</th>
                                                    <th>Görüntülenme</th>
                                                    <th>Silinme Tarihi</th>
                                                    <th>İşlemler</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($articles as $article)
                                                <tr>
                                                    <td class="align-middle"><img src="{{ Str::startsWith($article->image, ['Http', 'http']) ? $article->image : asset('') . $article->image }}" style="width:100px; height:60px; object-fit:cover" alt="Article Image"></td>
                                                    <td class="align-middle">{{ Str::limit($article->title, 25) }}</td>
                                                    <td class="align-middle">{{ $article->category->name }}</td>
                                                    <td class="align-middle">{{ $article->hit }}</td>
                                                    <td class="align-middle">{{ $article->deleted_at->diffForhumans() }}</td>
                                                    <td class="align-middle">
                                                        <a href="{{ route('admin.articles.recover', $article->id) }}" class="btn btn-primary btn-circle btn-sm" title="Kurtar">
                                                            <i class="fas fa-recycle"></i>
                                                        </a>
                                                        <a href="{{ route('admin.articles.hardDelete', $article->id) }}" class="btn btn-danger btn-circle btn-sm" title="Tamamen Sil">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('specificJs')
<script src="{{ asset('back') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('back') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('back') }}/js/demo/datatables-demo.js"></script>
@endsection
