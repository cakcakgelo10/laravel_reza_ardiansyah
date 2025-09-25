<table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3">Nama Pasien</th>
            <th scope="col" class="px-6 py-3">Alamat</th>
            <th scope="col" class="px-6 py-3">Telepon</th>
            <th scope="col" class="px-6 py-3">Rumah Sakit</th>
            <th scope="col" class="px-6 py-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pasiens as $pasien)
            {{-- Tambahkan ID unik untuk setiap baris --}}
            <tr id="pasien-row-{{ $pasien->id }}" class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $pasien->nama_pasien }}
                </td>
                <td class="px-6 py-4">{{ $pasien->alamat }}</td>
                <td class="px-6 py-4">{{ $pasien->telepon }}</td>
                <td class="px-6 py-4">{{ $pasien->rumahSakit->nama_rs ?? 'N/A' }}</td>
                <td class="px-6 py-4">
                    <div class="flex space-x-2">
                        <a href="{{ route('pasien.edit', $pasien->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs">
                            Edit
                        </a>
                        {{-- Gunakan data-id agar lebih mudah diakses oleh JavaScript --}}
                        <button data-id="{{ $pasien->id }}" class="delete-btn bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs">
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                    Tidak ada data pasien yang ditemukan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Render pagination links jika ada --}}
<div class="mt-4" id="pagination-links">
    @if($pasiens instanceof \Illuminate\Pagination\LengthAwarePaginator && $pasiens->hasPages())
        {{ $pasiens->links() }}
    @endif
</div>