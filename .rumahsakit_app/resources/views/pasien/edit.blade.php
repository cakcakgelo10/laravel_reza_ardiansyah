<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('pasien.update', $pasien->id) }}">
                        @csrf
                        @method('PUT')
                        
                        {{-- Nama Pasien --}}
                        <div>
                            <x-input-label for="nama_pasien" :value="__('Nama Pasien')" />
                            <x-text-input id="nama_pasien" class="block mt-1 w-full" type="text" name="nama_pasien" :value="old('nama_pasien', $pasien->nama_pasien)" required autofocus />
                            <x-input-error :messages="$errors->get('nama_pasien')" class="mt-2" />
                        </div>

                        {{-- Alamat --}}
                        <div class="mt-4">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat', $pasien->alamat)" required />
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        {{-- Telepon --}}
                        <div class="mt-4">
                            <x-input-label for="telepon" :value="__('Telepon')" />
                            <x-text-input id="telepon" class="block mt-1 w-full" type="text" name="telepon" :value="old('telepon', $pasien->telepon)" required />
                            <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="rumah_sakit_id" :value="__('Rumah Sakit')" />
                            <select name="rumah_sakit_id" id="rumah_sakit_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pilih Rumah Sakit --</option>
                                @foreach($rumahSakits as $rs)
                                    <option value="{{ $rs->id }}" @if($pasien->rumah_sakit_id == $rs->id) selected @endif>
                                        {{ $rs->nama_rs }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('rumah_sakit_id')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
