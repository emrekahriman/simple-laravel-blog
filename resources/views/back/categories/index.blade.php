@extends('back.layouts.master')
@section('title', 'Tüm Kategoriler')

@section('specificCss')
<link href="{{ asset('back') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    .modal-window {
    position: fixed;
    background-color: rgba(0, 0, 0, 0.75);
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 999;
    visibility: hidden;
    opacity: 0;
    transition: all 0.3s;
    }

    .modal-window > div {
    width: 400px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 2em;
    background: white;
    }
    .modal-window header {
    font-weight: bold;
    }
    .modal-window h1 {
    font-size: 150%;
    margin: 0 0 15px;
    }

    .modal-close {
    line-height: 50px;
    font-size: 80%;
    position: absolute;
    right: 0;
    text-align: center;
    top: 0;
    width: 70px;
    text-decoration: none;
    }
    .modal-close:hover {
    color: black;
    }

    .modal-window > div {
    border-radius: 1rem;
    }

    .modal-window div:not(:last-of-type) {
    margin-bottom: 15px;
    }
</style>
@endsection

@section('main')
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <span class="m-0 font-weight-bold text-primary">Kategori Oluştur</span>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.categories.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Kategori Adı</label>
                                            <input type="text" name="name" class="form-control" id="title" required>
                                        </div>
                                        <button class="btn btn-primary btn-block" type="submit">Ekle</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8">
                            <!-- Content Row -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <span class="m-0 font-weight-bold text-primary">@yield('title')</span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Kategori Adı</th>
                                                    <th>Makale Sayısı</th>
                                                    <th>Durum</th>
                                                    <th>İşlemler</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                <tr id="cat-{{ $category->id }}">
                                                    <td class="align-middle">{{ $category->name }}</td>
                                                    <td class="align-middle">{{ $category->articlesWithDisable->count() }}</td>
                                                    <td class="align-middle">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" @if ($category->status == 1) checked @endif class="custom-control-input" data-id="{{ $category->id }}" id="{{ "switch-" . $category->id }}">
                                                            <label style="cursor: pointer;" class="custom-control-label" for="{{ "switch-" . $category->id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a data-id="{{ $category->id }}" class="cat-edit-btn btn btn-primary btn-circle btn-sm p-0" title="Düzenle">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a id="cat-del-btn-{{ $category->id }}" onclick="deleteCategory({{ $category->id }}, {{ $category->articlesWithDisable->count() }})" class="cat-del-btn btn btn-danger btn-circle btn-sm p-0" title="Sil">
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



                                <div id="open-modal" class="modal-window">
                                    <div>
                                        <a href="#" onclick="$('#open-modal').css('visibility', 'hidden');$('#open-modal').css('opacity', '0');" title="Close" class="modal-close">Close</a>
                                        <div>
                                            <form method="POST" action="{{ route('admin.categories.update') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="catName">Kategori Adı</label>
                                                    <input type="text" name="name" class="form-control" id="catName" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="catSlug">Kategori Slug</label>
                                                    <input type="text" class="form-control" id="catSlug" disabled required>
                                                    <small id="catSlugHelp" class="form-text text-muted">Bilgi amaçlıdır değiştirilemez.</small>
                                                </div>
                                                <input id="catId" type="hidden" name="id">
                                                <div class="d-flex">
                                                    <button type="button" onclick="$('#open-modal').css('visibility', 'hidden');$('#open-modal').css('opacity', '0');" class="btn btn-secondary mr-2" >İptal</button>
                                                    <button class="btn btn-primary btn-block" type="submit">Güncelle</button>
                                                </div>
                                            </form>
                                        </div>
                                        <br>
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
    function deleteCategory(id, articleCount) {
        var infoMessage = `Bu kategoriye ait ${articleCount} makale bulunuyor! Yine de silmek istediğinize emin misiniz?`;
        
        if (articleCount == 0) {
            infoMessage = `Kategoriyi silmek istediğinize emin misiniz?`;
        }

        if (confirm(infoMessage)) {
            var delBtn = $('#cat-del-btn-' + id);
            var newHtml = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

            $.ajax({
                type: "GET",
                url: "{{ route('admin.categories.delete') }}",
                data: {id: id},
                beforeSend: function () {
                    delBtn.html(newHtml);
                },
                success: function () {
                    location.reload();
                }
            });

        }
    }
    

    $(function () {
        
        function slugify(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆĞÍÌÎÏİŇÑÓÖÒÔÕØŘŔŠŞŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇğíìîïıňñóöòôõøðřŕšşťúůüùûýÿžþÞĐđßÆa·/_,:;";
            var to   = "AAAAAACCCDEEEEEEEEGIIIIINNOOOOOORRSSTUUUUUYYZaaaaaacccdeeeeeeeegiiiiinnooooooorrsstuuuuuyyzbBDdBAa------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

            return str;
        };


        // Kategori guncelleme
        $('.cat-edit-btn').click(function() {
            var editBtn = $(this);
            var id = editBtn.attr("data-id");
            var oldHtml = `<i class="fas fa-pen"></i>`;
            var newHtml = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

            $.ajax({
                type: "GET",
                url: "{{ route('admin.categories.getCategory') }}",
                data: {id: id},
                beforeSend: function () {
                    editBtn.html(newHtml);
                },
                success: function (response) {
                    
                    $('#open-modal').css('visibility', 'visible');
                    $('#open-modal').css('opacity', '1');

                    var nameInput = $('#catName');
                    var slugInput = $('#catSlug');

                    nameInput.val(response.name);
                    slugInput.val(response.slug);
                    $('#catId').val(response.id);

                    nameInput.keyup(function (e) { 
                        slugInput.val(slugify(nameInput.val()));
                    });

                    // Butonu eski haline getir
                    editBtn.html(oldHtml);
                }
            });
        });

        // Kategori durum guncelleme
        $('.custom-control-input').change(function() {
            var id = $(this).attr("data-id");
            var newState = $(this).is(':checked');
            $.get( "{{ route('admin.categories.switchStatus') }}", {id: id, newState: newState});
        });
    });
    
</script>
@endsection
