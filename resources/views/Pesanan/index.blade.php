<x-backend-layout>
  @push("styles")
  <!-- Custom styles for this page -->
  <link href="/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  @endpush
  @push("scripts")
  <!-- Page level plugins -->
  <script src="/sb-admin2/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  @endpush
  <x-slot name="header">
    <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg></div>
    Pesanan - {{ $type ?? "Undangan"}}
  </x-slot>
  @include("Pesanan.Partials.navs")
  @if($type === "foto-undangan")
  @include("Pesanan.foto-pengantin.tambah")
  @else
  @include("Pesanan.Undangan.tambah")
  @endif
</x-backend-layout>