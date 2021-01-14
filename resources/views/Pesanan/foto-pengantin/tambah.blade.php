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
    Pesanan - Foto Pengantin
  </x-slot>
  @include("Pesanan.Partials.navs")
  <form action="{{route('tambah.pesanan.foto-pengantin',$user)}}" method="post">
    @csrf
    <div class="row mt-4">
      <div class="col-md-5">
        @include("Pesanan.Partials.user")
      </div>
      <div class="col-md-7">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title my-0">Data Pesanan Foto Pengantin</h3>
            <div>
              <!-- <button type="button" class="btn btn-sm btn-primary" id="userBaru">User Baru</button>
            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" id="userTerdaftar" data-target="#modalListUser">User Terdaftar</button> -->
            </div>
          </div>
          <div class="card-body" id="form-user">

            <div class="form-group">
              <label class="small mb-1" for="lokasi">Lokasi Pemotretan</label>
              <input class="form-control  @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi">
              @error("lokasi")
              <span class="text-danger d-block">{{$message}}</span>
              @enderror
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="jumlah_roll">Jumlah Roll</label>
                  <select name="jumlah_roll" endpoint="{{route('undangan.select2')}}" class="form-control  @error('jumlah_roll') is-invalid @enderror" id="jumlah_roll">
                    <option selected disabled>Pilih jumlah Roll</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                  @error("jumlah_roll")
                  <span class="text-danger d-block">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="biaya_per_roll">Harga Per Roll <span class="default_harga"></span></label>
                  <input class="form-control  @error('biaya_per_roll') is-invalid @enderror" name="biaya_per_roll" id="biaya_per_roll" type="number" value="0">
                  @error("biaya_per_roll")
                  <span class="text-danger d-block">{{$message}}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="small mb-1" for="jumlah_biaya">Jumlah Biaya <span class="jumlah_harga"> </span></label>
              <input class="form-control @error('jumlah_biaya') is-invalid @enderror" name="jumlah_biaya" id="jumlah_biaya" type="number" value="0" min="0" readonly>
              @error("jumlah_biaya")
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
  <link href="/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
  @endpush

  @push("scripts")
  <script src="/vendor/sweetalert2/sweetalert2.min.js"></script>

  <script>
    $("#jumlah_roll").on("change", (e) => setJumlah());
    $("#biaya_per_roll").on("input", (e) => setJumlah());

    function setJumlah() {
      console.log($("#jumlah_roll").val());
      if ($("#jumlah_roll").val() == '' || $("#jumlah_roll").val() === null) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pilih Jumlah Role !',
          onClose: $("#jumlah_roll").focus()
        });
        return 0;
      }

      let JumlahBiaya = parseInt($("#biaya_per_roll").val()) * parseInt($("#jumlah_roll").val());
      $("#jumlah_biaya").val(JumlahBiaya);
    }
  </script>
  @endpush

</x-backend-layout>