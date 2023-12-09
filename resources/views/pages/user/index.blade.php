<x-app-layout>

    @slot('content')
    <div class="container-fluid py-2">
        <div class="row">

            <div class="card col-12 p-4">
                <h4 class="mb-2">List User</h4 class="mb-2">
                <div class="col-12">
                    <button type="button" id="buttonCreate" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#modal">
                        Tambah User
                    </button>
                </div>
                <table class="table  border">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" style="width:5%">No</th>
                            <th scope="col" style="width:30%">Nama</th>
                            <th scope="col" style="width:30%">Email</th>
                            <th scope="col" style="width:30%">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="text-center">
                            <th scope="row">{{$loop->index+1}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                <span class="badge text-white text-bg-warning edit-link" data-bs-toggle="modal" data-bs-target="#modal" data-id="{{ $user->id }}">
                                    Edit
                                </span> |
                                <span class="badge text-white text-bg-danger delete-link" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $user->id }}">
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

    {{-- create user  --}}
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLabel">Label Modal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control border px-2" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control border px-2" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control border px-2" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select px-2 border" aria-label="Default select example" name="role" id="role" required>
                                <option selected>Pilih Role</option>
                            </select>
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

    <!-- {{-- edit user  --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label for="" class="form-label">Nama User</label>
                            <input type="text" class="form-control border px-2" id="name" name="name">
                            <input type="hidden" class="form-control border px-2" id="id_user" name="id_user">
                        </div>
                    </div>             
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->

    {{-- delete user  --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id_user" id="deleteIdInput">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModal2Label">Hapus User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Hapus User ?
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
            var formAction = "{{ route('user.destroy', ['id' => ':id']) }}";
            formAction = formAction.replace(':id', id);

            $('#deleteModal form').attr('action', formAction);
        });


        $('.edit-link').click(function(e) {
            var modalLabel = $("#modalLabel");
            modalLabel.text("Edit User");

            let id = $(this).data('id');
            var formAction = "{{ route('user.update', ['id' => ':id']) }}";
            var formAction = formAction.replace(':id', id);
            var form = $('#modal form')
            form.attr('action', formAction);
            form.find('input[name="_method"]').val('PUT');

            var password = $("#password");
            password.removeAttr("required");

            var url = "{{ route('user.edit', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    let user = response.user
                    $('#name').val(user.name);
                    $('#email').val(user.email);

                    var roles = response.roleDropdown;
                    var el = $("#role");
                    el.empty();
                    $.each(roles, function(i, role) {
                        el.append($("<option></option>").attr("value", role.value).text(role.label));
                    });
                    $('#role').val(user.role);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        $('#buttonCreate').click(function(e) {
            var modalLabel = $("#modalLabel");
            modalLabel.text("Tambah User");

            let id = $(this).data('id');
            var formAction = "{{ route('user.store') }}";
            $('#modal form').attr('action', formAction);

            var url = "{{route('user.create')}}"
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    var roles = response.roleDropdown;
                    var el = $("#role");
                    el.empty();
                    $.each(roles, function(i, role) {
                        el.append($("<option></option>").attr("value", role.value).text(role.label));
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    });
</script>