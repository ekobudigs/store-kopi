
<div id="editCategoryProductModal" class="fixed inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="editCategoryProductModalLabel">
                    Edit Kategori Produk
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