<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Produk') }}
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
                <button onclick="openCreateProductModal()" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-1.5 text-center mr-2">Add  Produk</button>
              </div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table id="product-table" class="w-full table-auto w-full text-sm text-left pt-4 text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-blue-50 dark:bg-blue-700 dark:text-blue-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                   No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Kode Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Harga Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Stok Produk
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


   

    @include('product.create')
    @include('product.edit')


    <script>
        $(document).ready(function() {

        //ajax edit

       



            $('#product-table').DataTable({
                processing: true,
                info: true,
                serverSide: true,

                ajax: {
                    url: '{{ route('product.table') }}',
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'desc',
                        name: 'desc'
                    },
                   
                    {
                    data: null,
                    render: function(data, type, row) {
                        var destroyUrl = '{{ route("products.destroy", ":id") }}';
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
    console.log(productId);
    $.ajax({
        url: '/api/product/' + productId,
        type: 'GET',
        success: function(response) {
            console.log(response.data.name);
            $('#editProductModal').removeClass('hidden'); 
            $('#editProductForm').attr('onsubmit', 'updateProduct(event, ' + productId + ')'); 
            
        
            $('#editProductName').val(response.data.name);
            $('#editProductCode').val(response.data.code);
            $('#editProductDesc').val(response.data.desc);
            $('#editProductPrice').val(response.data.price);
            $('#editProductStock').val(response.data.stok);

         
            $.ajax({
                url: '/api/category-product',
                type: 'GET',
                success: function(categories) {
                    var categoryOptions = '';
                    categories.data.forEach(function(category) {
                     
                        var selected = '';
                        if (category.id === response.data.category_product_id) {
                            selected = 'selected';
                        }
                        categoryOptions += '<option value="' + category.id + '" ' + selected + '>' + category.nama + '</option>';
                    });

                   
                    $('#editProductCategory').html(categoryOptions);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}


function updateProduct(event, productId) {
    
    event.preventDefault();

  
    var formData = {
        name: $('#editProductName').val(),
        code: $('#editProductCode').val(),
        category_product_id: $('#editProductCategory').val(),
        desc: $('#editProductDesc').val(),
        price: $('#editProductPrice').val(),
        stok: $('#editProductStock').val(),
    };

    // Kirim permintaan Ajax untuk melakukan update
    $.ajax({
        url: '/api/product/' + productId,
        type: 'PUT',
        data: formData,
        success: function(response) {
           Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Produk Berhasil di Update: ' + JSON.stringify(response.data.name),
                showConfirmButton: false,
                timer: 2500
            });

            closeEditProductModal();
            $('#product-table').DataTable().ajax.reload();
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('Failed to update category product');
        }
    });
}


function closeEditProductModal() {
        $('#editProductModal').addClass("hidden"); 
    }


function openCreateProductModal() {
    $.ajax({
        url: '/api/category-product',
        type: 'GET',
        success: function(response) {
            var selectElement = $('#newProductCategory');

            selectElement.empty();

          
            response.data.forEach(function(category) {
                selectElement.append($('<option>', {
                    value: category.id,
                    text: category.nama
                }));
            });

         
            $('#createProductModal').removeClass('hidden');
            
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('Gagal Load data Kategori Produk');
        }
    });

    $('#newProductCategory').select2({
            width: '100%', // Set lebar menjadi 100%
            placeholder: 'Pilih Role', // Menambahkan placeholder
        });
}

function saveProduct() {
    // Ambil data dari form
    var formData = {
        name: $('#newProductName').val(),
        code: $('#newProductCode').val(),
        category_product_id: $('#newProductCategory').val(),
        desc: $('#newProductDesc').val(),
        price: $('#newProductPrice').val(),
        stok: $('#newProductStock').val()
    };

    // Kirim permintaan Ajax untuk menyimpan data baru
    $.ajax({
        url: '/api/product',
        type: 'POST',
        data: formData,
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: ' Produk Berhasil di Buat: ' + JSON.stringify(response.data.name),
                showConfirmButton: false,
                timer: 2500
            }).then(function() {
               
                $('#newProductName').val('');
                $('#newProductCode').val('');
                $('#newProductCategory').val('');
                $('#newProductDesc').val('');
                $('#newProductPrice').val('');
                $('#newProductStock').val('');

                
            });
            closeCreateProductModal()
                $('#product-table').DataTable().ajax.reload();
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('Failed to create  product');
        }
    });
}



function closeCreateProductModal() {
    $('#createProductModal').addClass('hidden');
}
        </script>
</x-app-layout>