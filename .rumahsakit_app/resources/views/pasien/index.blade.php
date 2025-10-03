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
        const filterSelect = document.getElementById('filter_rs');
        const tableContainer = document.getElementById('pasien-table-container');

        // Fungsi untuk mengambil data via Fetch API
        const fetchData = (url) => {
            // Tampilkan indikator loading (opsional)
            tableContainer.innerHTML = '<p class="text-center py-4">Memuat data...</p>';

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // Penting untuk deteksi request->ajax() di Laravel
                }
            })
            .then(response => response.text())
            .then(html => {
                tableContainer.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                tableContainer.innerHTML = '<p class="text-center py-4 text-red-500">Gagal memuat data.</p>';
            });
        };

        // --- EVENT LISTENER UNTUK FILTER DROPDOWN ---
        filterSelect.addEventListener('change', function () {
            const rumahSakitId = this.value;
            const url = `{{ route('pasien.filter') }}?rumah_sakit_id=${rumahSakitId}`;
            fetchData(url);
        });

        // --- EVENT LISTENER UNTUK KLIK PAGINASI (BARU) ---
        // Menggunakan event delegation pada container
        tableContainer.addEventListener('click', function(event) {
            // Cek apakah yang diklik adalah link paginasi
            if (event.target.tagName === 'A' && event.target.closest('.pagination')) {
                event.preventDefault(); // Mencegah reload halaman
                const url = event.target.getAttribute('href');
                fetchData(url);
            }
        });

        // --- FUNGSI UNTUK HAPUS DATA ---
        tableContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-btn')) {
                const pasienId = event.target.getAttribute('data-id');
                
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
                        }
                    })
                    .catch(error => console.error('Error deleting data:', error));
                }
            }
        });
    });
    </script>
</x-app-layout>