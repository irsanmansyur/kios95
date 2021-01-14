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
    Pesanan -Undangan
  </x-slot>
  @include("Pesanan.Partials.navs")
  <form action="{{route('tambah.pesanan.undangan')}}" method="post">
    @csrf
    <div class="row mt-4">
      <div class="col-md-5">
        @include("Pesanan.Partials.user")
      </div>
      <div class="col-md-7">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title my-0">Data Pesanan Undangan</h3>
            <div>
              <!-- <button type="button" class="btn btn-sm btn-primary" id="userBaru">User Baru</button>
            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" id="userTerdaftar" data-target="#modalListUser">User Terdaftar</button> -->
            </div>
          </div>
          <div class="card-body" id="form-user">
            <div class="form-group">
              <label class="small mb-1" for="undangan_id">Pilih Undangan</label>
              <select name="undangan_id" endpoint="{{route('undangan.select2')}}" class="select2 undangan_id form-control  @error('undangan_id') is-invalid @enderror" id="undangan_id">
              </select>
              @error("undangan_id")
              <span class="text-danger d-block">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group">
              <label class="small mb-1" for="kode_undangan">Kode Undangana</label>
              <input class="form-control  @error('kode_undangan') is-invalid @enderror" name="kode_undangan" id="kode_undangan" readonly>
              @error("kode_undangan")
              <span class="text-danger d-block">{{$message}}</span>
              @enderror
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="jumlah_pesanan">Jumlah Pesanan</label>
                  <input class="form-control  @error('jumlah_pesanan') is-invalid @enderror" value="0" name="jumlah_pesanan" id="jumlah_pesanan" type="number">
                  @error("jumlah_pesanan")
                  <span class="text-danger d-block">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="harga_satuan">Harga Satuan <span class="default_harga"></span></label>
                  <input class="form-control  @error('harga_satuan') is-invalid @enderror" name="harga_satuan" id="harga_satuan" type="number">
                  @error("harga_satuan")
                  <span class="text-danger d-block">{{$message}}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="small mb-1" for="total_harga">Jumlah Harga <span class="jumlah_harga"> </span></label>
              <input class="form-control @error('total_harga') is-invalid @enderror" name="total_harga" id="total_harga" type="number">
              @error("total_harga")
              <span class="text-danger d-block">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group">
              <input class="form-control btn btn-primary" value="Pesan Sekarang" type="submit">
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  @push("styles")
  <link rel="stylesheet" href="\sb-admin2\vendor\select2\css\select2.min.css">
  @endpush
  @push("scripts")
  <script src="\sb-admin2\vendor\select2\js\select2.min.js"></script>
  <script src="/js/main.js"></script>

  <script>
    $(document).ready(function() {
      const select2Undangan = $(".select2.undangan_id").select2({
        placeholder: "Cari Nama Undangan / Kode Undangan",
        templateSelection: function(data, container) {
          setDataUndangan(data);
          return data.text;
        },
        ajax: {
          url: $(".select2.undangan_id").attr("endpoint"),
          dataType: "json",
          data: function(param) {
            let query = {
              search: param.term
            }
            return query;
          },
          processResults: function(data) {
            let results = data.data.map(undangan => {
              undangan.text = undangan.text || undangan.nama_undangan;
              return undangan;
            })
            return {
              results
            };
          }
        }
      })

      function setDataUndangan(undangan) {
        $("#harga_satuan").val(undangan.harga_jual);
        $("#kode_undangan").val(undangan.kode_undangan);
        $("#total_harga").val(parseInt(undangan.harga_jual) * parseInt($("#jumlah_pesanan").val()));
        $("span.default_harga").text(undangan.harga_jual);
      }
      $("#jumlah_pesanan,#harga_satuan").on("input", (e) => {
        let total = parseInt($("#harga_satuan").val()) * parseInt($("#jumlah_pesanan").val());
        $("span.jumlah_harga").text(total);
        $("#jumlah_harga").text(total);
        $("#total_harga").val(total);
      })
    })
  </script>
  @endpush
</x-backend-layout>