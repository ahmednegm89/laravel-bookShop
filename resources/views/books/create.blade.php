@extends('layout')
@section('title')
    ADD
@endsection

@section('content')
<div class="container mt-3">
    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="Name" class="form-label">Name</label>
          <input type="text" name="title" class="form-control" id="Name" aria-describedby="emailHelp" value="{{ old('title') }}" >
        </div>
        @if ($errors->any())
            @foreach ($errors->get('title') as $error)
            <p class="" style="color: red">
                {{$error}}
              </p>
            @endforeach
        @endif
        <div class="form-floating">
            <textarea class="form-control" name="desc" placeholder="Desciption" id="floatingTextarea2" style="height: 250px" >{{ old('desc') }}</textarea>
            <label for="floatingTextarea2">Desciption</label>
        </div>
        @if ($errors->any())
            @foreach ($errors->get('desc') as $error)
            <p class="" style="color: red">
                {{$error}}
              </p>
            @endforeach
        @endif
        <div class="my-3">
            <label for="formFile" class="form-label">book cover</label>
            <input class="form-control" name="img" type="file" id="formFile">
        </div>
        @if ($errors->any())
            @foreach ($errors->get('img') as $error)
            <p class="" style="color: red">
                {{$error}}
              </p>
            @endforeach
        @endif
        <h4>select categories:</h4>
        @foreach ($categories as $category)
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="category_ids[]" value="{{$category->id}}" id="">
          <label class="form-check-label" for="">
            {{$category->name}}
          </label>
        </div>
        @endforeach
        @if ($errors->any())
            @foreach ($errors->get('category_ids') as $error)
            <p class="" style="color: red">
                {{$error}}
              </p>
            @endforeach
        @endif
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
      </form>
</div>
@endsection
