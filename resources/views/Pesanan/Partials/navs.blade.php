<nav class="nav nav-borders mb-2">
  <a class="nav-link{{ request()->fullUrl() == route('tambah.pesanan.undangan') ? ' active ml-0' : '' }}" href="{{route('tambah.pesanan.undangan')}}">Undangan</a>
  <a class="nav-link{{request()->fullUrl() == route('tambah.pesanan.foto-pengantin') ? ' active ml-0' : '' }}" href="{{route('tambah.pesanan.foto-pengantin')}}">Foto Pengantin</a>
</nav>