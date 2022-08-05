@extends('back.layouts.master')
@section('title', 'Tüm Makaleler')

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
                                        <a class="ml-2 btn btn-sm btn-warning" href="{{ route('admin.articles.trashed') }}"><i class="fas fa-trash"></i> Silinenler</a>
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
                                                    <th>Oluşturulma Tarihi</th>
                                                    <th>Durum</th>
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
                                                    <td class="align-middle">{{ $article->created_at->diffForhumans() }}</td>
                                                    <td class="align-middle">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" @if ($article->status == 1) checked @endif class="custom-control-input" data-id="{{ $article->id }}" id="{{ "switch-" . $article->id }}">
                                                            <label style="cursor: pointer;" class="custom-control-label" for="{{ "switch-" . $article->id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a id="goruntule-{{ $article->id }}" @if ($article->status == 1) href="{{ route('singleArticle', [$article->category->slug, $article->slug]) }}" @endif 
                                                        data-href="{{ route('singleArticle', [$article->category->slug, $article->slug]) }}"
                                                        target="_blank" class="btn btn-success btn-circle btn-sm" title="Görüntüle">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-primary btn-circle btn-sm" title="Düzenle">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="{{ route('admin.articles.delete', $article->id) }}" class="btn btn-danger btn-circle btn-sm" title="Sil">
                                                            <i class="fas fa-trash"></i>
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
<script>
    $('.custom-control-input').change(function(){
        var id = $(this).attr("data-id");
        var newState = $(this).is(':checked');
        $.get( "{{ route('admin.articles.switchStatus') }}", {id: id, newState: newState}, function () {
            if (newState) {
                var dataHref = $(`#goruntule-${id}`).attr('data-href');
                $(`#goruntule-${id}`).attr('href', dataHref);
            } else {
                $(`#goruntule-${id}`).removeAttr('href');
            }
        });
    });
</script>
@endsection
