<x-backend-layout>
  <div class="card mb-2">
    <div class="card-header">{{ $page_title ??  "Edit Undangan"}}</div>
    <div class="card-body">
      <form action="{{ route('mUndangan.edit',$undangan->id)}}" method="post">
        @csrf
        @method('PUT')
        @include("Master.Undangan.Partials.form-groupt",['submit'=> "Update"])
      </form>
    </div>
  </div>
</x-backend-layout>