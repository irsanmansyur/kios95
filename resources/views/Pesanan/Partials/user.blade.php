<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title my-0">User Pemesan</h3>
    <div>
      <button type="button" class="btn btn-sm btn-primary" id="userBaru">User Baru</button>
      <button type="button" class="btn btn-sm btn-info" data-toggle="modal" id="userTerdaftar" data-target="#modalListUser">User Terdaftar</button>
    </div>
  </div>
  <div class="card-body" id="form-user">
    <div class="form-group">
      <label class="small mb-1" for="name">Nama Lengkap</label>
      <input class="form-control" name="name" id="name" type="text" placeholder="Nama Pemesan" value="{{old('name')}}">
      <input class="form-control @error('name') is-invalid @enderror" name="id_user" id="id_user" type="text" hidden>
      @error("name")
      <span class="text-danger d-block">{{$message}}</span>
      @enderror

    </div>
    <div class="form-group">
      <label class="small mb-1" for="name">Email Address</label>
      <input class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" id="email" type="email" placeholder="@email">
      @error("email")
      <span class="text-danger d-block">{{$message}}</span>
      @enderror
    </div>
    <div class="form-group">
      <label class="small mb-1" for="name">No Handphone</label>
      <input class="form-control @error('no_hp') is-invalid @enderror" value="{{old('no_hp')}}" name="no_hp" id="no_hp" placeholder="08xx xxxx xxxx">
      @error("no_hp")
      <span class="text-danger d-block">{{$message}}</span>
      @enderror
    </div>
    <div class="form-group">
      <label class="small mb-1" for="name">Alamat Lengkap</label>
      <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{old("alamat")}}</textarea>
      @error("alamat")
      <span class="text-danger d-block">{{$message}}</span>
      @enderror
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalListUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="modalListUserLabel">Daftar User</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <div id="table-user-pemesan" endpoint="{{route('user.pemesan')}}">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" id="tindakan-table" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No Hp</th>
                  <th>Alamat</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push("scripts")
<script>
  $(function() {
    const formUser = $("#form-user"),
      MyModal = $("#modalListUser"),
      btnUserTerdaftar = document.querySelector("#userTerdaftar"),
      btnUserBaru = document.querySelector("#userBaru");
    btnUserBaru.addEventListener("click", function(e) {
      e.preventDefault();
      setSelected();
    })
    const dataTableUserPemesan = MyModal.find('table').DataTable({
      processing: true,
      "searching": false,
      serverSide: true,
      ajax: {
        url: $('#table-user-pemesan').attr('endpoint'),
        "dataSrc": function(json) {
          return json.data;
        }
      },
      columns: [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'name',
          name: 'name'
        },

        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: null,
          "defaultContent": "<button type='button' class='pilih btn btn-primary btn-sm'>Pilih</button>",
          orderable: false,
          searchable: false
        }
      ]
    });
    $('#table-user-pemesan').on('click', function(e) {
      let Me = e.target;
      if (Me.classList.contains("pilih")) {
        let elTR = Me.closest("tr");
        let dt = dataTableUserPemesan.row(elTR).data();
        setSelected(dt);
        MyModal.modal('toggle');
      }
    });

    function setSelected(user = {}) {
      btnUserBaru.disabled = $.isEmptyObject(user) ? true : false;
      btnUserTerdaftar.disabled = $.isEmptyObject(user) ? false : true;

      formUser.find("#name").val(user.name ?? '').prop("readonly", user.name ? true : false);
      formUser.find("#email").val(user.email ?? '').prop("readonly", user.email ? true : false);
      formUser.find("#no_hp").val(user.pelanggan ? user.pelanggan.no_hp ?? '' : '').prop("readonly", user.pelanggan ? true : false);
      formUser.find("#alamat").val(user.pelanggan ? user.pelanggan.alamat ?? '' : '').prop("readonly", user.pelanggan ? true : false);
      formUser.find("#id_user").val(user.id ?? '').prop("disabled", $.isEmptyObject(user) ? true : false);
    }
    let tindakanSelected = null;
    MyModal.on('click', function(e) {
      let Me = e.target;
      if (Me.classList.contains("lanjut")) {
        let endpoint = MyModal.find("#tambahTindakan").attr("endpoint");
        let elTR = Me.closest("tr");
        let tindakan = dataTableTindakans.row(elTR).data();
        try {
          (async () => {
            let data = {
              tindakan_id: tindakan.id
            }
            let res = await axios.post(endpoint, data);
            await dataTableTindakans.ajax.reload();
            dataTableTindakanPasien.ajax.reload();
          })();
        } catch (error) {
          console.log(error);
        }
        MyModal.modal('toggle');
      }
    });
    MyModal.on('hidden.bs.modal', function(e) {
      dataTableUserPemesan.search('').draw();
    })

  });
</script>
@endpush