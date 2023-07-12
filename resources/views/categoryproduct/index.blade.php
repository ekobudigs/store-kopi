<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="">
                <div
                  class=" rounded-lg bg-white p-6 shadow-lg dark:bg-neutral-700">

                  @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
              <div class="mb-4">
                <a href="{{ route('categoryproducts.create') }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-1.5 text-center mr-2">Add Kategori Produk</a>
              </div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table id="categoryproduct-table" class="w-full table-auto w-full text-sm text-left pt-4 text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-blue-50 dark:bg-blue-700 dark:text-blue-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                   No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                   Keterangan
                </th>
                <th scope="col" class="px-6 py-3">
                  Action
                </th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>




</div>
</div>

        </div>
    </div>


    <div id="editCategoryProductModal" class="fixed inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
    
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="editCategoryProductModalLabel">
                        Edit Product
                    </h3>
                    <div class="mt-5">
                        <form id="editCategoryProductForm" method="POST" action="">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="editCategoryProductName" class="block text-gray-700 text-sm font-bold mb-2">Name Kategory</label>
                                <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="editCategoryProductName" name="nama">
                            </div>
                            <div class="mb-4">
                                <label for="editCategoryProductDesc" class="block text-gray-700 text-sm font-bold mb-2">Keterangan</label>
                                <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="editCategoryProductDesc" name="desc">
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Save Changes</button>
                                <button type="button" onclick="closeEditCategoryProductModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  


    <script>
        $(document).ready(function() {

        //ajax edit

       



            $('#categoryproduct-table').DataTable({
                processing: true,
                info: true,
                serverSide: true,

                ajax: {
                    url: '{{ route('categoryproduct.table') }}',
                    type: 'GET',
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: 50,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'desc',
                        name: 'desc'
                    },
                   
                    {
                    data: null,
                    render: function(data, type, row) {
                        var editUrl = '{{ route("categoryproducts.edit", ":id") }}';
                        editUrl = editUrl.replace(':id', row.id);
                        var destroyUrl = '{{ route("categoryproducts.destroy", ":id") }}';
                        destroyUrl = destroyUrl.replace(':id', row.id);
                        return `
                        
                        <button class="edit-btn btn btn-warning" onclick="editProduct(${row.id})" >Edit</button>
                        
                        <form id="delete-form-${row.id}" action="${destroyUrl}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button class="delete-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" data-id="${row.id}" type="button">Delete <i class="fa-solid fa-trash-can fa-xl"></i></button>
</form> `;
                        }
                    }
                ],
                error: function (xhr, error, thrown) {
        console.log('Error:', error);
    },
            });


            function deletePost(event, postId) {
    event.preventDefault();
    Swal.fire({
        title: 'Apakah Kamu Yakin?',
        text: 'Anda tidak akan dapat memulihkan Data ini!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Hapus Data!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + postId).submit();
        }
    });
}

// Tempatkan definisi deletePost() sebelum digunakan

$(document).on('click', '.delete-btn', function(event) {
    var data = $(this).data('id');
    deletePost(event, data);
});







        });

        
function editProduct(productId) {
    // Kirim permintaan AJAX untuk mendapatkan data produk berdasarkan ID
    console.log(productId);
    $.ajax({
        url: '/api/category-product/' + productId ,
        type: 'GET',
        success: function(response) {
            console.log(response.data.nama)
            // Tampilkan data produk dalam modal
            $('#editCategoryProductModal').removeClass('hidden'); // Menghapus kelas 'hidden' untuk menampilkan modal
            $('#editCategoryProductForm').attr('onsubmit', 'updateCategoryProduct(event, ' + productId + ')');// Sesuaikan dengan ID formulir Anda
            
            // Isi nilai input dengan data produk yang diterima
            $('#editCategoryProductName').val(response.data.nama);
            $('#editCategoryProductDesc').val(response.data.desc);
        },
        error: function(xhr) {
            // Tangani kesalahan jika terjadi
            console.log(xhr.responseText);
        }
    });
}

function updateCategoryProduct(event, productId) {
    // Menghentikan perilaku default form submit
    event.preventDefault();

    // Ambil data dari form
    var formData = {
        nama: $('#editCategoryProductName').val(),
        desc: $('#editCategoryProductDesc').val(),
    };

    // Kirim permintaan Ajax untuk melakukan update
    $.ajax({
        url: '/api/category-product/' + productId,
        type: 'PUT',
        data: formData,
        success: function(response) {
           // Tampilkan Sweet Alert dengan pesan sukses
           Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Kategori Produk Berhasil di Update: ' + JSON.stringify(response.data.nama),
                showConfirmButton: false,
                timer: 2500
            });

            closeEditCategoryProductModal();
            // Redirect pengguna ke halaman categoryproducts
            $('#categoryproduct-table').DataTable().ajax.reload();
            // Lakukan refresh atau tindakan lain yang sesuai pada halaman
        },
        error: function(xhr) {
            // Tangani kesalahan jika terjadi
            console.log(xhr.responseText);
            alert('Failed to update category product');
        }
    });
}


function closeEditCategoryProductModal() {
        $('#editCategoryProductModal').addClass("hidden"); // Menutup modal
    }
        </script>
</x-app-layout>