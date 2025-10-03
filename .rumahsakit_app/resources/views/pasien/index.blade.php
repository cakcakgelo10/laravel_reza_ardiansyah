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

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const tableContainer = document.getElementById('pasien-table-container');

            const fetchData = (url) => {
                tableContainer.innerHTML = '<p class="text-center py-4">Memuat data...</p>';
                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.text())
                .then(html => {
                    tableContainer.innerHTML = html;
                })
                .catch(error => console.error('Error:', error));
            };

            const filterSelect = document.getElementById('filter_rs');
            filterSelect.addEventListener('change', function () {
                const rumahSakitId = this.value;
                fetchData(`{{ route('pasien.filter') }}?rumah_sakit_id=${rumahSakitId}`);
            });

            tableContainer.addEventListener('click', function(event) {
                const target = event.target;

                if (target.tagName === 'A' && target.closest('.pagination')) {
                    event.preventDefault();
                    const url = target.getAttribute('href');
                    if (url) fetchData(url);
                } 
                else if (target.classList.contains('delete-btn')) {
                    const pasienId = target.getAttribute('data-id');
                    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                        const url = `/pasien/${pasienId}`;
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById(`pasien-row-${pasienId}`).remove();
                                alert(data.success);
                            } else {
                                alert(data.error || 'Gagal menghapus data.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan.');
                        });
                    }
                }
            });
        });
    </script>

</x-app-layout>