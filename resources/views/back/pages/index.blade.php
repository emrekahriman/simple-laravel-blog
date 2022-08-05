@extends('back.layouts.master')
@section('title', 'Tüm Sayfalar')

@section('specificCss')
<link href="{{ asset('back') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
{{-- Toastr CSS --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Görsel</th>
                                                    <th>Sayfa Başlığı</th>
                                                    <th>Durum</th>
                                                    <th>İşlemler</th>
                                                </tr>
                                            </thead>
                                            <tbody id="pageSort">
                                                @foreach ($pages as $page)
                                                <tr id="page-{{ $page->id }}">
                                                    <td class="handle align-middle" style="width: 30px !important;"><i class="fas fa-arrows-alt"></i></td>
                                                    <td class="align-middle"><img src="{{ Str::startsWith($page->image, ['Http', 'http']) ? $page->image : asset('') . $page->image }}" style="width:100px; height:60px; object-fit:cover" alt="Article Image"></td>
                                                    <td class="align-middle">{{ Str::limit($page->title, 25) }}</td>
                                                    <td class="align-middle">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" @if ($page->status == 1) checked @endif class="custom-control-input" data-id="{{ $page->id }}" id="{{ "switch-" . $page->id }}">
                                                            <label style="cursor: pointer;" class="custom-control-label" for="{{ "switch-" . $page->id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a id="goruntule-{{ $page->id }}" @if ($page->status == 1) href="{{ route('page', [$page->slug]) }}" @endif 
                                                        data-href="{{ route('page', [$page->slug]) }}"
                                                        target="_blank" class="btn btn-success btn-circle btn-sm" title="Görüntüle">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary btn-circle btn-sm" title="Düzenle">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a id="page-del-{{ $page->id }}" class="btn btn-danger btn-circle btn-sm p-0" onclick="deletePage({{ $page->id }})" title="Sil">
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
{{-- ToastrJS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    // new Sortable(pageSort, {
    //     animation: 500,
    //     handle: '.handle',
    // });

    Sortable.create(pageSort, {
        animation: 500,
        handle: '.handle',
        onEnd: function (e) {
            var arr = Array.from(e.to.children);
            var newOrder = new Array();
            arr.forEach(element => {
                newOrder.push(parseInt(element.id.split('-')[1]));
            });
            
            $.get("{{ route('admin.pages.order') }}", {order: newOrder},
                function (data) {
                    if (data == 1) {
                        toastr.success('Sayfa sırası başarıyla güncellendi!')
                    } else {
                        toastr.error('Bir sorun oluştu!');
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    }
                },
            );

        },
    });
</script>



<script>
    // Sayfa durum guncelleme islemi
    $('.custom-control-input').change(function(){
        var id = $(this).attr("data-id");
        var newState = $(this).is(':checked');
        $.get( "{{ route('admin.pages.switchStatus') }}", {id: id, newState: newState}, function () {
            if (newState) {
                var dataHref = $(`#goruntule-${id}`).attr('data-href');
                $(`#goruntule-${id}`).attr('href', dataHref);
            } else {
                $(`#goruntule-${id}`).removeAttr('href');
            }
        });
    });


    // Sayfa silme islemi
    function deletePage(id) {
        var delBtn = $('#page-del-' + id);
        var newHtml = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
        
        if (confirm('Sayfayı silmek istediğinize emin misiniz?')) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.pages.delete', $page->id) }}",
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

</script>
@endsection
