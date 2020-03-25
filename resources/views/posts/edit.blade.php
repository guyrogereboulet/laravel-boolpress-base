<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create</title>
</head>
<body>
  @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
    </div>
  @endif
  {{-- <form class="" action="{{route("posts.store")}}" method="post">
    @csrf
    @method('POST')
    <input type="text" name="title" value="" placeholder="title">
    <input type="text" name="subtitle" value="" placeholder="subtitle">
    <input type="text" name="description" value="" placeholder="description">
    <input type="text" name="author" value="" placeholder="author">
    <input type="date" name="date" value="" placeholder="date">
    <input type="submit" name="" value="INSERT">
  </form>
</body> --}}
<form action=" {{(!empty($post)) ? route('posts.update', $post->id) : route('posts.store')}}" method='post'>
      {{-- è importante che questi token siano dentro il form --}}
      @csrf
      @if(!empty($post))
       @method('PATCH')
       @else
       @method('POST')
      @endif
      <div class="">
        <input type="text" name="title" value="{{(!empty($post)) ? $post->title : ''}}" placeholder="title">
      </div>
      <div class="">
        <input type="text" name="subtitle" value="{{(!empty($post)) ? $post->subtitle : ''}}" placeholder="subtitle">
      </div>
      <div class="">
        <input type="text" name="description" value="{{(!empty($post)) ? $post->description : ''}}" placeholder="description">
      </div>
      <div class="">
        <input type="text" name="author" value="{{(!empty($post)) ? $post->author : ''}}" placeholder="author">
      </div>
      <div class="">
        <input type="text" name="date" value="{{(!empty($post)) ? $post->date : ''}}" placeholder="date">
      </div>
      @if(!empty($post))
      <input type="hidden" name="id" value="{{$post->id}}">
      @endif
      <button type="submit" name="button">
          Save
      </button>
  </form>
</html>
  
