@extends('layout')
@section('title')
    ADD Category
@endsection

@section('content')
<div class="container mt-3">
    <form method="POST" action="{{ route('categories.store') }}" >
        @csrf
        <div class="mb-3">
          <label for="Name" class="form-label">Category Name</label>
          <input type="text" name="name" class="form-control" id="Name" aria-describedby="emailHelp" value="{{ old('title') }}" >
        </div>
        @if ($errors->any())
            @foreach ($errors->get('name') as $error)
            <p class="" style="color: red">
               <strong> {{$error}} </strong> 
              </p>
            @endforeach
        @endif
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
      </form>
</div>
@endsection
