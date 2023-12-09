<x-app-layout>

    @slot('content')
    <div class="container-fluid py-2">
        <div class="row">

            <div class="card col-12 p-4">
                @include('sweetalert::alert')
                <h4 class="mb-2">Daftar Divisi</h4 class="mb-2">
                <div class="col-12">
                    <button type="button" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#createModal">
                        Tambah Divisi
                    </button>
                </div>
                <table class="table  border">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" style="width:5%">No</th>
                            <th scope="col" style="width:30%">Nama</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($divisions as $division)
                        <tr class="text-center">
                            <th scope="row">{{$loop->index+1}}</th>
                            <td>{{$division->name}}</td>
                            <td>
                                <span class="badge text-white text-bg-warning edit-link" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $division->id }}">
                                    Edit
                                </span> |
                                <span class="badge text-white text-bg-danger delete-link" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $division->id }}">
                                    Delete
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>{!! $originalData->links() !!}</div>
            </div>
        </div>
    </div>

    {{-- create division  --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('division.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Divisi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control border px-2" id="" name="name" required>
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

    {{-- edit division  --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Divisi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label for="" class="form-label">Nama Divisi</label>
                            <input type="text" class="form-control border px-2" id="name" name="name">
                            <input type="hidden" class="form-control border px-2" id="id_division" name="id_division">
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

    {{-- delete division  --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id_division" id="deleteIdInput">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModal2Label">Hapus Divisi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Hapus Divisi ?
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
        $("[type='number']").keypress(function(evt) {
            evt.preventDefault();
        });

        $('.delete-link').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#deleteIdInput').val(id);
            var formAction = "{{ route('division.destroy', ['id' => ':id']) }}";
            formAction = formAction.replace(':id', id);

            $('#deleteModal form').attr('action', formAction);
        });


        $('.edit-link').click(function(e) {
            let id = $(this).data('id');
            var formAction = "{{ route('division.update', ['id' => ':id']) }}";
            var formAction = formAction.replace(':id', id);
            $('#editModal form').attr('action', formAction);

            var url = "{{ route('division.edit', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    let division = response.division
                    $('#id_division').val(division.id);
                    $('#name').val(division.name);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    });
</script>