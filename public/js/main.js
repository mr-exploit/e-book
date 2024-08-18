window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    } else {
        console.error('sidebarToggle element not found');
    }
});

$(document).ready(function() {
    $('#example').DataTable();
});
/// Kategori
    // Function untuk menampilkan modal Delete kategori
    function confirmDelete(id) {
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
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Function untuk menampilkan modal Edit kategori
    function openEditModal(id, nama, deskripsi) {
        // Set action URL pada form edit
        var form = document.getElementById('editKategoriForm');
        form.action = '/kategori/' + id;

        // Isi input pada form dengan data yang ada
        document.getElementById('editNamaKategori').value = nama;
        document.getElementById('editDeskripsiKategori').value = deskripsi;

        // Buka modal
        $('#editKategoriModal').modal('show');
    }
/// Kategori

