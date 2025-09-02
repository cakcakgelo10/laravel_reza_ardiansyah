<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Data Rumah Sakit') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('rumah_sakit.store') }}">
                            @csrf
                            {{-- Nama Rumah Sakit --}}
                            <div>
                                <x-input-label for="nama_rs" :value="__('Nama Rumah Sakit')" />
                                <x-text-input id="nama_rs" class="block mt-1 w-full" type="text" name="nama_rs" :value="old('nama_rs')" required autofocus />
                                <x-input-error :messages="$errors->get('nama_rs')" class="mt-2" />
                            </div>
                            {{-- Alamat --}}
                            <div class="mt-4">
                                <x-input-label for="alamat" :value="__('Alamat')" />
                                <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" required />
                                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                            </div>
                            {{-- Email --}}
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            {{-- Telepon --}}
                            <div class="mt-4">
                                <x-input-label for="telepon" :value="__('Telepon')" />
                                <x-text-input id="telepon" class="block mt-1 w-full" type="text" name="telepon" :value="old('telepon')" required />
                                <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button>
                                    {{ __('Simpan') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
