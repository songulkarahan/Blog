@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <p>Sizin yazılarınız</p>
                        <p>
                          {{Auth::user()->birth_date}}
                          {{Auth::user()->age}}
                        </p>

                        <div class="list-group">
                            @foreach($blogs as $blog)
                                <a href="{{route('blogs.detail', $blog->id)}} " class="list-group-item list-group-item-action">
                                    {{$blog->title}}<br>
                                </a>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
