<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg></div>
    Pembayaran Pesanan Foto Pengantin | {{ $pesanan->no_pesanan}}
  </x-slot>

  <div class="row">
    <div class="col-md-7">
      <div class="card mb-4  border-top-primary h-100">
        <div class="card-header">
          <h3 class="card-title text-center">Detail Pesanan</h3>
        </div>
        <div class="card-body p-0">
          <!-- Billing history table-->
          <div class="table-responsive table-billing-history">
            <table class="table mb-0">
              <tbody>
                <tr>
                  <td class="bg-dark-900">Nomor Pesanan</td>
                  <td><span class="no_pesanan">{{$pesanan->no_pesanan}}</span> </td>
                </tr>
                <tr>
                  <td class="">Nama Pemesan</td>
                  <td><span class="nama_pemesan">{{$pesanan->pelanggan->user->name}}</span></td>
                </tr>
                <tr>
                  <td class="">Tanggal Pesanan</td>
                  <td>Bantaeng <span class="tgl_pesanan">{{$pesanan->created_at->format("d F Y")}}</span></td>
                </tr>
                <tr>
                  <td class="">Jumlah Pesanan</td>
                  <td><span class="jumlah_pesanan">{{$pesanan->jumlah_pesanan}}</span></td>
                </tr>
                <tr>
                  <td class="">Harga Satuan</td>
                  <td><span class="harga_satuan">{{$pesanan->harga_satuan}}</span></td>
                </tr>
                <tr>
                  <td class="">Jumlah Harga</td>
                  <td><span class="jumlah_harga">{{$pesanan->jumlah_harga}}</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card border-top-primary" id="elBayar">
        <div class="card-header">
          <h3 class="card-title text-center">Detail Pembayaran</h3>
        </div>
        <div class="card-body">
          <form action="{{route('pembayaran.foto-pengantin',$pesanan->no_pesanan)}}" method="post">
            @csrf
            <div class="input-group input-group-joined mb-4">
              <label for="jumlahBayar" class="d-block w-100">Jumlah Bayar</label>
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </span>
              </div>
              <input class="form-control" id="jumlahBayar" readonly value="{{$pesanan->jumlah_harga}}">
            </div>
            <div class="input-group input-group-joined mb-4">
              <label for="uangbayar" class="d-block w-100">Uang Bayar</label>
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </span>
              </div>
              <input class="form-control" id="uangbayar" name="uang_bayar" type="number" placeholder="Ex : 500000" aria-label="Bayar">
            </div>
            <div class="input-group input-group-joined mb-4">
              <label for="kemalian" class="d-block w-100">Kembalian</label>
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </span>
              </div>
              <input class="form-control" type="number" name="kembalian" id="kembalian" readonly="" aria-label="Bayar">
            </div>
            <button class="btn btn-primary w-100" id="buttonBayar">Bayar Sekarang</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push("styles")
  <link href="/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
  @endpush
  @push("scripts")
  <script src="/vendor/sweetalert2/sweetalert2.min.js"></script>
  <script>
    $(document).ready(function() {

      const elParentBayar = document.querySelector("#elBayar");
      const inBayar = document.querySelector("#uangbayar"),
        kembalian = document.querySelector("#kembalian"),
        elJumlahBayar = document.querySelector("#jumlahBayar"),
        buttonProses = document.querySelector("#buttonBayar"),
        formBayar = elParentBayar.querySelector("form");

      inBayar.oninput = (e) => {
        const jumlahBayar = parseInt(elJumlahBayar.value);
        let uangBayar = parseInt(inBayar.value);
        kembalian.value = uangBayar - jumlahBayar;
      }
      formBayar.onsubmit = function(e) {
        const jumlahBayar = parseInt(elJumlahBayar.value);
        const uangBayar = parseInt(inBayar.value == "" ? 0 : inBayar.value);
        if (uangBayar < jumlahBayar) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Masukkan Sejumlah uang yang cukup  dan Pilih Pesanan !',
          });
          e.preventDefault();
          inBayar.focus();
        }
      }

    });
    let pesananSelected = null;
  </script>
  @endpush
</x-backend-layout>