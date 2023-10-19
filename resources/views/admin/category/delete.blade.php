<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusData{{$data->id}}">
Delete
</button>

<div class="modal fade" tabindex="-1" id="hapusData{{$data->id}}" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white">Hapus Data {{$data->title}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Emang boleh se-menghapus itu?<br/>Anda akan menghapus kategori ini. Apakah Anda yakin?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <form method="CATEGORIES" action="{{url('admin/categories/delete/' . $data->id)}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Ya, Hapus.</button>
        </form>
      </div>
    </div>
  </div>
</div>

