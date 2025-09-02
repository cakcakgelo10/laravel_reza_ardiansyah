<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-4">
                        <a href="{{ route('pasien.create') }}" class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Pasien
                        </a>
                        
                        <!-- Filter Dropdown -->
                        <div>
                            <label for="filter_rs" class="sr-only">Filter Berdasarkan Rumah Sakit</label>
                            <select name="filter_rs" id="filter_rs" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Semua Rumah Sakit</option>
                                @foreach ($rumahSakits as $rs)
                                    <option value="{{ $rs->id }}">{{ $rs->nama_rs }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <div id="pasien-table-container">
                             @include('pasien._table', ['pasiens' => $pasiens])
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
