
<div id="editProductModal" class="fixed inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="editProductModalLabel">
                    Edit Product
                </h3>
                <div class="mt-5">
                    <form id="editProductForm" method="POST" action="">
                        @csrf
                            @method('PUT')
                        <div class="mb-4">
                            <label for="editProductName" class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
                            <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="editProductName" name="name">
                        </div>
                        <div class="mb-4">
                            <label for="editProductCode" class="block text-gray-700 text-sm font-bold mb-2">Product Code</label>
                            <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="editProductCode" name="code">
                        </div>
                        <div class="mb-4">
                            <label for="editProductCategory" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                            <select class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="editProductCategory" name="category_product_id">
                                <!-- Render options dynamically here based on categories -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="editProductDesc" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="editProductDesc" name="desc">
                        </div>
                        <div class="mb-4">
                            <label for="editProductPrice" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                            <input type="number" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="editProductPrice" name="price">
                        </div>
                        <div class="mb-4">
                            <label for="editProductStock" class="block text-gray-700 text-sm font-bold mb-2">Stock</label>
                            <input type="number" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="editProductStock" name="stok">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" >Save</button>
                            <button type="button" onclick="closeEditProductModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
