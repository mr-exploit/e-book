@extends('template.app')

@section('title', 'User List')

@section('content')
{{-- Side Menu --}}
<div class="mt-5">
    <div class="container p-5">
        <h2 class="mb-5">User List</h2>

        <table id="UserList" class="display">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>email</th>
                    <th>jenis_kelamin</th>
                    <th>agama</th>
                    <th>TTL</th>
                    <th>no_hp</th>
                    <th>alamat</th>
                    <th>status</th>
                    <th>bergabung</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email ?? 'N/A' }}</td>
                    <td>{{ $user->jenis_kelamin ?? 'N/A' }}</td>
                    <td>{{ $user->agama ?? 'N/A' }}</td>
                    <td>{{ $user->TTL ?? 'N/A' }}</td>
                    <td>{{ $user->no_hp ?? 'N/A' }}</td>
                    <td>{{ $user->alamat ?? 'N/A' }}</td>
                    <td>{{ $user->status == 1 ? 'Active' : 'Non-Active' }}</td>
                    <td>{{ $user->created_at}}</td>
                    <td>
                        <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editUserModal" onclick="openEditUserModal({{ $user->id }}, '{{ $user->nama }}', '{{ $user->status }}')">
                            <i class="fas fa-edit fa-fw"></i>
                        </button>
                        <!-- Form untuk Hapus Data -->
                        <form id="deleteUser-form-{{ $user->id }}" action="{{ route('deleteUser', ['id' => $user->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDeleteUser({{ $user->id }})">
                                <i class="fas fa-trash fa-fw"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editNamaUser" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNamaUser" name="nama" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus" name="status">
                            <option value="Active">Active</option>
                            <option value="non-Active">non-Active</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#UserList').DataTable();
    });

    /// User
    // Function untuk menampilkan modal Delete kategori
    function confirmDeleteUser(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini tidak dapat dikembalikan setelah dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form untuk menghapus data
                document.getElementById('deleteUser-form-' + id).submit();
            }
        });
    }

    // Function untuk menampilkan modal Edit kategori
    function openEditUserModal(id, nama, status) {
        // Set action URL pada form edit
        var formUser = document.getElementById('editUserForm');
        formUser.action = '/admin/userlist/' + id;

        // Isi input pada form dengan data yang ada
        document.getElementById('editNamaUser').value = nama;
        document.getElementById('editStatus').value = status;

        // Buka modal
        $('#editKategoriModal').modal('show');
    }
    /// User
</script>
@endsection