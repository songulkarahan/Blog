@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if(request()->route()->named('tag.blogs'))
                            <strong>{{$tag->tag}}</strong> etiketli makaleler
                        @elseif(request()->route()->named('tag.blogs'))
                            <strong>{{$user->name}}</strong> kişinin makaleleri
                        @else
                        Tüm Makaleler
                        @endif
                        <a href="{{route('blogs.create')}}" class="float-right btn btn-sm ">Yeni Makale Ekle</a>
                    </div>

                          <div class="list-group">
                            @foreach($blogs as $blog)
                              <a href="{{route('blogs.detail', $blog->id)}} " class="list-group-item list-group-item-action">
                                    {{$blog->title}}
                              </a>

                        @endforeach
                          </div>

                </div>
            </div>
        </div>
    </div>

@endsection