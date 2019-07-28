@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$blog->title}}
                        <a href="{{route('blogs.index')}}" class="float-right btn btn-sm ">Geri Dön</a>
                        @auth
                        @if (Auth::user()->id === $blog->user->id)
                        <a href="{{route('blogs.edit', $blog->id)}}" class="float-right btn btn-sm ">Düzenle</a>
                        @endif
                        @endauth
                    </div>
                    <div class="card-body">
                      @if($blog->photo)
                      <img src="{{asset(Storage::url($blog->photo))}}"><br>

                    {{$blog->content}}
                        <hr>
                        @foreach($blog->tags as $tag)
                         <a href="{{route('tag.blogs', $tag->id)}}">  {{$tag->tag}}</a>
                        @endforeach
                        <hr>
                        <small><a href="{{route('user.blogs',$blog->user)}}">{{$blog->user->name}} </a>{{$blog->created_at->locale('tr')->diffForHumans()}} oluşturdu.</small>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Yorumlar{{$blog->comments()->count()}}</div>
                    <div class="card-body">

                        @guest
                        <p>Yorum yapmak için üye girişi yapmalısınız </p>
                            @else
                            <form action="{{route('blogs.addComment', $blog->id)}}" method="post">
                                @csrf
                              <textarea name="comment" class="form-control" placeholder="Yorum yazın"></textarea><br>
                                <button class="btn btn-primary">Yorum Ekle</button>
                            </form><br>
                        @endguest
                      @include('helpers.comments', ['comments'=>$blog->topLevelComments])

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
