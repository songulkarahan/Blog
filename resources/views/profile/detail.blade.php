@extends('layouts.app')
@section('content')
<div class="container">
  <div class="card-columns">
      <div class="card text-center">
        <div class="card-body">
          <img src="{{asset(Storage::url($user->profileImage))}}" class="img-thumbnail w-50 rounded-circle" alt="{{$blog->title}}">
          <h3 class="card-title">{{$user->displayname}}</h3>
          <p class="card-text">{{$user->name}}</p>
          @if(Auth::id()=== $user->id)
          <a href="{{route('blog.create')}}" class="btn btn-primary">Yeni Gönderi</a>
          <a href="#" class="btn btn-primary">Yeni Gönderi</a>
          <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('editProfileForm').classList.toggle('d-none')">Profili Düznele</a>
          <form action="{{route('profile.update')}}" class="my-2 d-none" id= "editProfileForm" method="post" enctype="multipart/form-data">
            @csrf
            <hr>
           <h5> Profili Düzenle</h5>
            <div class="form-group">
              <label>Görünen İsim</label>
              <input type="text" class="form-control" name="displayname" value="{{$user->displayname}}">
            </div>
            <div class="form-group">
              <label>Doğum Tarihi</label>
              <input type="date" class="form-control" name="birth_date" value="{{$user->birth_date->format('Y-m-d')}}">
            </div>
            <div class="form-group">
              <label>Profil Foto</label>
              <input type="file" class="form-control" name="profileImage">
            </div>
            <button class="btn btn-primary">Profili Güncelle</button>
          </form>
         @endif
        </div>
      </div>

      @foreach($user->blogs->latest->get() as $blog)
        <div class="card">
          @if($blog->photo)
          <a href="{{route('blogs.detail' , $blog)}}">  <img src="{{asset(Storage::url($blog->photo))}}" class="card-img-top" alt="{{$blog->title}}"></a>
          @endif
          <div class="card-body">
          <a href="{{route('blog.detail', $blog)}}">  <h5 class="card-title">{{$blog->title}}</h5></a>
            <p class="card-text">{{$blog->content}}</p>
             <a href="{{route('profile')}}"><img src="{{asset(Storage::url($user->profileImage))}}" >{{$user->name}}</a>
            <p class="card-footer text-right">{{$blog->created_at->diffForHumans()}}</p>
          </div>
        </div>

      @endforeach


</div>
</div>
@endsection
