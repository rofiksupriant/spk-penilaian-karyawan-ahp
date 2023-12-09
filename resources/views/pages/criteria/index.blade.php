<x-app-layout>

    @slot('content')
    <div class="container-fluid py-2">
        <div class="row">

            <div class="card col-12 p-4">
                <h4 class="mb-2">List Kriteria</h4>
                <div class="col-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Kriteria
                    </button>
                    <a type="button" class="btn btn-success" href="{{ route('criteria.matrix') }}">
                        Matrix Kriteria
                    </a>
                </div>
                <table class="table border">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" style="width:5%">No</th>
                            <th scope="col" style="width:65%">Nama Kriteria</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($criterias as $criteria)
                        <tr class="text-center">
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{$criteria->name}}</td>
                            <td>
                                <a href="{{ route('subcriteria', ['criteriaId' => $criteria->id]) }}" class="badge text-white text-bg-primary">
                                    Sub-kriteria
                                </a> |
                                <span class="badge text-white text-bg-warning edit-link" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-id="{{ $criteria->id }}">
                                    Edit
                                </span> |
                                <span class="badge text-white text-bg-danger delete-link" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-id="{{ $criteria->id }}">
                                    Delete
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>{!! $criterias->links() !!}</div>
            </div>
        </div>
    </div>

    {{-- create kriteria  --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('criteria.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kriteria</h1>
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

    {{-- edit kriteria  --}}
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModal3Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModal3Label">Edit kriteria</h1>
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

    {{-- delete kriteria  --}}
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModal2Label">Hapus kriteria</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Hapus kriteria ?
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
            var formAction = "{{ route('criteria.destroy', ['id' => ':id']) }}";
            formAction = formAction.replace(':id', id);
            $('#exampleModal2 form').attr('action', formAction);
        });

        $('.edit-link').click(function(e) {
            var id = $(this).data('id');

            var url = "{{ route('criteria.edit', ['id' => ':id']) }}";
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

            var formActionEdit = "{{ route('criteria.update', ['id' => ':id']) }}";
            formActionEdit = formActionEdit.replace(':id', id);
            $('#exampleModal3 form').attr('action', formActionEdit);

        });
    });
</script>