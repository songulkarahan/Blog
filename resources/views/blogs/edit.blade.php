@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Makale Düzenle</div>
                    <div class="card-body">
                        <form action="{{route('blogs.update' ,$blog->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Başlık</label>
                                <input type="text" value="{{$blog->title}}" name="title" class="form-control @error('title') is-invalid @enderror" >
                                @error('title')
                                <div class="alert alert-danger mt-1">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>İçerik</label>
                                <textarea type="text" name="content" value="{{$blog->content}}" class="form-control @error('content') is-invalid @enderror" rows="10"></textarea>
                                @error('content')
                                <div class="alert alert-danger mt-1">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Etiket</label>
                                <input value="{{$blog->tags->implode('tag', ',')}}" name="tag" class="form-control " >
                                @error('title')
                                <div class="alert alert-danger mt-1">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block btn-lg">Kaydet</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection