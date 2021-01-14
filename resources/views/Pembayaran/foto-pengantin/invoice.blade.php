<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg></div>
    Invoice - Pembayaran Foto Pengantin
  </x-slot>
  <div id="printSection">
  </div>
  <div class="row">
    <div class="col-md-7 mx-auto">
      <div class="card mb-4 border-top-primary" id="printThis">
        <div class="card-header">
          <h3 class="card-title text-center">Detail Invoice</h3>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-end">
            <div class="klinik">
              <h1 class="card-title">{{config('app.name')}}</h1>
              <span>{{ config("app.alamat")}}</span> <br>
              <span>Telp . 00099</span>
            </div>
            <div class="w-50">
              <ul class="mb-0">
                <li class="d-flex justify-content-between">
                  <span> No. Invoice</span>
                  <span class="ml-2 text-primary">{{$pembayaran->no_invoice ?? "PMB_0393837"}}</span>
                </li>
                <li class="d-flex justify-content-between">
                  <span> No. Pesanan</span>
                  <span class="ml-2">{{$pembayaran->pesanan->no_pesanan}}</span>
                </li>
                <li class="d-flex justify-content-between">
                  <span>Tanggal Pembayaran</span>
                  <span class="ml-2">{{$pembayaran->created_at->format("d F Y")}}</span>
                </li>
              </ul>
            </div>
          </div>
          <hr>
          <h3 class="text-center">Detail Pembayar</h3>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <table class="w-100">
                <tbody>
                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $pembayaran->pesanan->pelanggan->user->name}}</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $pembayaran->pesanan->pelanggan->alamat}}</td>
                  </tr>
                  <tr>
                    <td>Handphone</td>
                    <td>:</td>
                    <td>{{ $pembayaran->pesanan->pelanggan->mo_hp}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-6">
              <table class="w-100">
                <tbody>
                  <tr>
                    <td>Jenis Pesanan</td>
                    <td>:</td>
                    <td>Foto Pengantin</td>
                  </tr>
                  <tr>
                    <td>Jumlah Roll</td>
                    <td>:</td>
                    <td>{{ $pembayaran->pesanan->fotopengantin->jumlah_roll}}</td>
                  </tr>
                  <tr>
                    <td>Harga / Roll</td>
                    <td>:</td>
                    <td>{{ $pembayaran->pesanan->fotopengantin->biaya_per_roll}}</td>
                  </tr>
                  <tr>
                    <td>Jumlah Biaya</td>
                    <td>:</td>
                    <td>{{ $pembayaran->pesanan->fotopengantin->jumlah_biaya}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <hr>
          <div>
            <table class="w-100">
              <tbody>
                <tr>
                  <td colspan="4">Detail Pembayaran</td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3">
                    Jumlah Bayar
                  </td>
                  <td></td>
                  <td align="right">
                    <span class="float-left">Rp. </span>
                    {{ number_format($pembayaran->jumlah_bayar, 2, ',', '.')}}
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    Uang Bayar
                  </td>
                  <td></td>
                  <td align="right">
                    <span class="float-left">Rp. </span>
                    {{ number_format($pembayaran->uang_bayar, 2, ',', '.')}}
                  </td>
                </tr>
                <tr class="border-top">
                  <td colspan="3">
                    Uang Kembalian
                  </td>
                  <td></td>
                  <td align="right"> <span class="float-left">Rp. </span> {{ number_format($pembayaran->kembalian, 2, ',', '.')}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-7 mx-auto my-3">
      <button class="btn btn-info w-100" id="btnPrint">Print</button>
    </div>
  </div>


  @push("styles")
  <style>
    @media screen {
      #printSection {
        display: none;
      }
    }

    @media print {

      body * {
        visibility: hidden;
        max-height: 800px !important;

      }

      body {
        margin: 0;
        width: 500px;
        height: 500px;
        max-height: 600px !important;
      }

      #printSection,
      #printSection * {
        visibility: visible;
        max-height: 600px !important;

      }

      #printSection {
        display: block;
      }
    }
  </style>
  @endpush
  @push("scripts")
  <script>
    document.getElementById("btnPrint").onclick = function() {
      printElement(document.getElementById("printThis"));
    }

    function printElement(elem) {
      let domClone = elem.cloneNode(true);

      let $printSection = document.getElementById("printSection");

      if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
      }
      $printSection.innerHTML = "";
      $printSection.appendChild(domClone);
      window.print();
    }

    function PrintElem(elem) {
      var mywindow = window.open('', 'PRINT', 'height=600,width=800');

      var domClone = elem.cloneNode(true);

      mywindow.document.body.appendChild(domClone); // necessary for IE >= 10
      mywindow.document.close(); // necessary for IE >= 10
      mywindow.focus(); // necessary for IE >= 10*/

      mywindow.print();
      // mywindow.close();

      return true;
    }
  </script>

  @endpush
</x-backend-layout>