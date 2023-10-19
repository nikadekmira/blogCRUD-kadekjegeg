@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>

                <div class="card-body">
                    <p>{{ $post->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection