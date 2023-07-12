<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori Produk') }}
        </h2>
    </x-slot>



    <div class="container">
        <div class="mx-auto max-w-s py-12">
            <div class="bg-white rounded-lg shadow-md p-8">
                <h1 class="text-2xl font-semibold mb-6">{{ __('Tambah Kategori Produk') }}</h1>




           
                    <form method="POST" action="{{ route('categoryproducts.store') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="nama"
                                class="block text-gray-700 font-semibold mb-2">{{ __('Nama Kategori') }}</label>
                            <input id="nama" type="text"
                                class="w-full p-2 border border-gray-400 rounded" name="nama"
                                value="{{ old('nama') }}" autocomplete="nama" autofocus>

                            @error('nama')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="desc"
                                class="block text-gray-700 font-semibold mb-2">{{ __('Keterangan') }}</label>
                            {{-- <input id="alamat" type="text" class="w-full p-2 border border-gray-400 rounded" name="alamat" value="{{ old('alamat') }}"  autocomplete="alamat" autofocus> --}}

                            <textarea id="desc" name="desc" rows="2"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukan Keterangan.">{{ old('desc') }}</textarea>

                            @error('desc')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                       

                        <div class="flex items-center justify-end">
                            
                        </div>
                        <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-1.5 text-center mr-2">Simpan</button>


                    </form>
               



            </div>
        </div>
    </div>

    <script>
       


        
    </script>



</x-app-layout>