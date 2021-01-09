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
  <div class="card border-top-info">
    <div class="card-header">
      Daftar Pesanan Undangan
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" endpoint="{{route('pesanan.undangan.datatable')}}" width="100%" id="pesanan-undangan" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>No Pesanan</th>
              <th>Nama Pemesan</th>
              <th>Alamat</th>
              <th>Handphone</th>
              <th>Kode Undangan</th>
              <th>Nama Undangan</th>
              <th>Harga Satuan</th>
              <th>Jumlah Pesanan</th>
              <th>Total Harga</th>
              <th>Action</th>
            </tr>

          </thead>
        </table>
      </div>
    </div>
  </div>

  @push("styles")
  @endpush
  @push("scripts")
  <script>
    (() => {
      const dataTablePesanan = $("#pesanan-undangan").DataTable({
        processing: true,
        "searching": false,
        serverSide: true,
        ajax: {
          url: $("#pesanan-undangan").attr('endpoint'),
          "dataSrc": function(json) {
            const data = json.data.map(psn => {
              let btn = `<a href="/admin/pembayaran/undangan/${psn.no_pesanan}" class="btn btn-primary">Pembayaran</a>`;
              if (psn.status === 1) {
                btn = `<a href="/admin/pembayaran/undangan/${psn.pembayaran.no_invoice}/invoice" class="btn btn-info">Invoice Pesanan</a>`;
              }
              psn.button = btn;
              return psn;
            })
            return data;
          }
        },
        columns: [{
            data: 'id',
            name: 'id'
          },
          {
            data: 'no_pesanan',
            name: 'no_pesanan'
          },

          {
            data: 'pelanggan.user.name',
            name: 'name',
            orderable: false,
            searchable: false
          },
          {
            data: 'pelanggan.alamat',
            name: 'alamat',
            orderable: false,
            searchable: false
          },
          {
            data: 'pelanggan.no_hp',
            name: 'no_hp',
            orderable: false,
            searchable: false
          },
          {
            data: 'undangan.kode_undangan',
            name: 'kode_undangan',
            orderable: false,
            searchable: false
          },
          {
            data: 'undangan.nama_undangan',
            name: 'nama_undangan',
            orderable: false,
            searchable: false
          },
          {
            data: 'harga_satuan',
            name: 'harga_satuan',
            searchable: false
          },
          {
            data: 'jumlah_pesanan',
            name: 'jumlah_pesanan',
            searchable: false
          },
          {
            data: 'jumlah_harga',
            name: 'jumlah_harga',
            searchable: false
          },
          {
            data: 'button',
            orderable: false,
            searchable: false
          }
        ]
      });
    })()
  </script>
  @endpush
</x-backend-layout>