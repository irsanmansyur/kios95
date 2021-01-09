<x-backend-layout>
  <x-slot name="header_right">
    <button class="btn btn-info rounded-lg" id="btnPrint">Print</button>
  </x-slot>
  <x-slot name="header">
    <div class="page-header-icon">
      <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
      </svg>
      Admin - Invoice
    </div>
  </x-slot>
  <div class="w-50 mx-auto">
    <div class="container">
      <div id="printThis">
        <div class="row mb-2 pb-2">
          <div class="col-md-12">
            <div class="card mb-4 mx-auto   border-top-primary h-100">
              <div class="card-body ">
                <div class="d-flex justify-content-between align-items-end">
                  <div class="klinik">
                    <h1 class="card-title">{{config('app.name')}}</h1>
                    <span>{{ config("app.alamat")}}</span> <br>
                    <span>Telp . 00099</span>
                  </div>
                  <div class="w-50">
                    <ul class="mb-0">
                      <li class="d-flex justify-content-between">
                        <span> No. Pesanan</span>
                        <span class="ml-2">{{$pesanan->no_pesanan ?? "PSN_0393837"}}</span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <span> No. Pendaftaran</span>
                        <span class="ml-2">{{$pesanan->id}}</span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <span> Tanggal Pemesanan</span>
                        <span class="ml-2">{{$pesanan->created_at->format("d F Y")}}</span>
                      </li>
                    </ul>
                  </div>
                </div>

                <hr />
                <div class="row my-2">
                  <div class="col-md-6">
                    <div class="table-responsive table-billing-history">
                      <table class="mb-0 table-sm">
                        <tbody>
                          <tr>
                            <td class="mr-2">Nama</td>
                            <td>{{ $pesanan->pelanggan->user->name}}</td>
                          </tr>
                          <tr>
                            <td class="mr-2">Alamat</td>
                            <td>{{ $pesanan->pelanggan->alamat}}</td>
                          </tr>
                          <tr>
                            <td class="mr-2">No HP</td>
                            <td>{{ $pesanan->pelanggan->no_hp}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="table-responsive table-billing-history">
                      <table class="mb-0 table-sm">
                        <tbody>
                          <tr>
                            <td class="mr-2">Nama Undangan</td>
                            <td>{{ $pesanan->undangan->nama_undangan}}</td>
                          </tr>
                          <tr>
                            <td class="mr-2">Kode Undangana</td>
                            <td>{{ $pesanan->undangan->kode_undangan}}</td>
                          </tr>
                          <tr>
                            <td class="mr-2">Jumlah Pesanan</td>
                            <td>{{ $pesanan->jumlah_pesanan}}</td>
                          </tr>
                          <tr>
                            <td class="mr-2">Harga / Lembar</td>
                            <td>{{ rupiah($pesanan->harga_satuan)}}</td>
                          </tr>
                          <tr>
                            <td class="mr-2">Total Harga</td>
                            <td>{{rupiah($pesanan->jumlah_harga)}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Billing history table-->
            </div>
          </div>
        </div>
      </div>
      <button class="btn btn-info w-100" id="btnPrint">Print</button>
    </div>
  </div>

  <center>
    <div id="printSection" class="row">
    </div>

  </center>
  @push("styles")
  <style>
    @media screen {
      #printSection {
        display: none;
      }
    }

    @media print {
      body {
        width: 500px;
        height: 500px;
      }

      body * {
        visibility: hidden;
      }

      #printSection,
      #printSection * {
        visibility: visible;
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
      var domClone = elem.cloneNode(true);

      var $printSection = document.getElementById("printSection");

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