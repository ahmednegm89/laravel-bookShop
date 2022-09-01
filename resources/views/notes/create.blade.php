@extends('layout')
@section('title')
    ADD note
@endsection

@section('content')
<div class="container mt-3">
    <form method="POST" action="{{ route('notes.store') }}" >
        @csrf
        <div class="form-floating">
            <textarea name="content" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea">note</label>
          </div>
        @if ($errors->any())
            @foreach ($errors->get('content') as $error)
            <p class="" style="color: red">
               <strong> {{$error}} </strong> 
              </p>
            @endforeach
        @endif
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
      </form>
</div>
@endsection
