@extends('layout')
@section('title')
    Edit {{$book->title}}
@endsection

@section('content')
@include('inc.errors')
<div class="container mt-3">
    <form method="POST" action="{{ route('books.update',$book->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="Name" class="form-label">Name</label>
          <input type="text" name="title" class="form-control" id="Name" aria-describedby="emailHelp"  value="{{old('title') ?? $book->title}}">
        </div>
        <div class="form-floating">
            <textarea class="form-control" name="desc" placeholder="Desciption" id="floatingTextarea2" style="height: 250px"  >{{ old('desc') ?? $book->desc}}</textarea>
            <label for="floatingTextarea2">Desciption</label>
        </div>
        <div class="mt-3">
          <label for="formFile" class="form-label">book cover</label>
          <input class="form-control" name="img" type="file" id="formFile">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
      </form>
</div>
@endsection
