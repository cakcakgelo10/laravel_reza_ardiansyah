@forelse ($pasiens as $pasien)
        <tr id="pasien-row-{{ $pasien->id }}">
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $pasien->nama_pasien }}</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $pasien->alamat }}</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $pasien->telepon }}</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $pasien->rumahSakit->nama_rs }}</td>
            <td class="whitespace-nowrap px-4 py-2">
                <a href="{{ route('pasien.edit', $pasien->id) }}" class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">Edit</a>
                <button data-url="{{ route('pasien.destroy', $pasien->id) }}" class="delete-btn inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700">Hapus</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center text-gray-500 py-4">Tidak ada data.</td>
        </tr>
    @endforelse
