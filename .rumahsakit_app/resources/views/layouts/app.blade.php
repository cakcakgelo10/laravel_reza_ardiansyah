<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Tambahkan jQuery dari CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Skrip custom untuk AJAX Hapus dan Filter -->
        <script>
        $(document).ready(function() {
            
            // --- FUNGSI HAPUS VIA AJAX ---
            $('body').on('click', '.delete-btn', function(e) {
                e.preventDefault();

                var deleteUrl = $(this).data('url');
                var row = $(this).closest('tr');

                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            row.fadeOut(400, function() {
                                $(this).remove();
                            });
                            // Optional: Tampilkan notifikasi sukses
                            // alert(response.success);
                        },
                        error: function(xhr) {
                            alert('Gagal menghapus data. Coba lagi.');
                        }
                    });
                }
            });

            // --- FUNGSI FILTER PASIEN VIA AJAX ---
            $('#filter-rs').on('change', function() {
                var rumahSakitId = $(this).val();
                
                $.ajax({
                    url: '{{ route("pasien.filter") }}',
                    type: 'GET',
                    data: {
                        'rumah_sakit_id': rumahSakitId
                    },
                    success: function(response) {
                        $('#pasien-table-body').html(response);
                    },
                    error: function(xhr) {
                        alert('Gagal memuat data pasien.');
                    }
                });
            });

        });
        </script>
    </body>
</html>
