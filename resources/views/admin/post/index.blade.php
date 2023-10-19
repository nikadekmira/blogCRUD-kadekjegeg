@extends('layouts.app')

@section('content')

<div class="container">
  @if(session('message'))
  <div class="alert alert-success">{{session('message')}}</div>
  @endif
  
<div class="card">
  <div class="card-header d-flex justify-content-between align-item-center">
      <h4>Post</h4>
      <a href="{{url('admin/posts/create')}}" class="btn btn-primary">Tambah Post</a>
  </div>    
<table class="table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Title</th>
      <th scope="col">slug</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      @forelse($posts as $key => $data)
      <tr>
        <td>{{$key+1}}</td>
        <td>{{$data->title}}</td>
        <td>{{$data->slug}}</td>
        <td>
          <a href="{{url('admin/posts/' . $data->slug . '/edit')}}" class="btn btn-primary">Edit</a>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusData{{$data->id}}">
          Delete
          </button>
          @include('admin.post.delete')
        </td>
      </tr>
      @empty
        <td colspan="4" class="text-center">Tidak ada data Post</td>
      @endforelse  
  </tbody>
</table>
 </div>
</div>

@endsection