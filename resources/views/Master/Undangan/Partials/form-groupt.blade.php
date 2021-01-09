<div class="form-group">
  <label for="kode_undangan">Kode Undangan</label>
  <input type="text" readonly id="kode_undangan" name="kode_undangan" value="{{ old('kode_undangan')?? $undangan->kode_undangan}}" class="form-control @error('kode_undangan') is-invalid @enderror">
  @error("kode_undangan")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="nama_undangan">Nama Undangan</label>
  <input type="text" id="nama_undangan" name="nama_undangan" value="{{ old('nama_undangan')?? $undangan->nama_undangan}}" class="form-control @error('stock') is-invalid @enderror">
  @error("nama_undangan")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="harga">Harga Beli / Lembar</label>
  <input type="number" id="harga_beli" name="harga_beli" value="{{ old('harga_beli')?? $undangan->harga_beli}}" class="form-control @error('harga_beli') is-invalid @enderror">
  @error("harga_beli")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="harga">Harga Jual / Lembar</label>
  <input type="number" id="harga_jual" name="harga_jual" value="{{ old('harga_jual')?? $undangan->harga_jual}}" class="form-control @error('harga_jual') is-invalid @enderror">
  @error("harga_jual")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="stock">Stock</label>
  <input type="number" id="stock" name="stock" value="{{ old('stock')?? $undangan->stock}}" class="form-control @error('stock') is-invalid @enderror">
  @error("stock")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group"><input type="submit" value="{{$submit ?? 'Tambah'}}" class="btn btn-primary"></div>