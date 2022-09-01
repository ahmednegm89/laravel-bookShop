@extends('layout')
@section('title')
    Edit {{$Category->name}}
@endsection

@section('content')
@include('inc.errors')
<div class="container mt-3">
    <form method="POST" action="{{ route('categories.update',$Category->id) }}">
        @csrf
        <div class="mb-3">
          <label for="Name" class="form-label">Category Name</label>
          <input type="text" name="name" class="form-control" id="Name" aria-describedby="emailHelp"  value="{{old('name') ?? $Category->name}}">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
      </form>
</div>
@endsection
