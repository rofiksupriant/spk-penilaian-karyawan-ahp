<x-app-layout>

    @slot('content')
    <div class="container-fluid py-2">
        <div class="row">

            <div class="card col-12 p-4">
                <h4 class="mb-2">List Subkriteria</h4>

                <div class="col-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        Tambah Subkriteria
                    </button>
                    <a href="{{ route('subcriteria.matrix', ['criteriaId' => $criteria_id]) }}" class="btn btn-success">
                        Matrix
                    </a>
                    <a href="{{ route('criteria') }}" class="btn btn-warning">
                        Kembali
                    </a>
                </div>

                <table class="table  border">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" style="width:5%">No</th>
                            <th scope="col" style="width:65%">Nama Kriteria</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcriterias as $subcriteria)
                        <tr class="text-center">
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{$subcriteria->name}}</td>
                            <td>
                                <span class="badge text-white text-bg-warning edit-link" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $subcriteria->id }}" data-idNama="{{$subcriteria->name}}">
                                    Edit
                                </span> |
                                <span class="badge text-white text-bg-danger delete-link" data-bs-toggle="modal" data-bs-target="#deletModal" data-id="{{ $subcriteria->id }}">
                                    Delete
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>{!! $subcriterias->links() !!}</div>
            </div>
        </div>
    </div>

    {{-- create subkriteria  --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('subcriteria.store') }}">
                @csrf
                <input type="hidden" name="criteria_id" id="criteria-id" value="{{ $criteria_id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createModalLabel">Tambah Subkriteria</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Kriteria</label>
                            <input type="text" class="form-control border px-2" id="" name="name">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
            </form>
        </div>
    </div>
    </div>

    {{-- edit subkriteria  --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Subkriteria</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Kriteria</label>
                            <input type="text" class="form-control border px-2" id="name-edit" name="name">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- delete subkriteria  --}}
    <div class="modal fade" id="deletModal" tabindex="-1" aria-labelledby="deletModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deletModalLabel">Hapus Subkriteria</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Hapus Subkriteria ?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endslot

</x-app-layout>

<script>
    $(document).ready(function() {
        $('.delete-link').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var formAction = "{{ route('subcriteria.destroy', ['id' => ':id']) }}"
            formAction = formAction.replace(':id', id);
            $('#deletModal form').attr('action', formAction);
        });

        $('.edit-link').click(function(e) {
            var id = $(this).data('id');

            var url = "{{ route('subcriteria.edit', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $('#name-edit').val(response.name);
                },
                error: function(err) {
                    console.log(err);
                }
            });

            var formActionEdit = "{{ route('subcriteria.update', ['id' => ':id']) }}";
            formActionEdit = formActionEdit.replace(':id', id);
            $('#editModal form').attr('action', formActionEdit);
        });
    });
</script>