@foreach($comments as $comment)
<div class="media mt-3">
    <a class="mr-3" href="#">
    <img src="..." class="mr-3" alt=" {{$comment->user->name}}">
    </a>
<div class="media-body">
    <h5 class="mt-0"> {{$comment->user->name}}</h5>
    <p>{{$comment->body}}</p>
    <span class="text-mute">{{$comment->created_at->locale('tr')->diffForHumans()}}</span>
    @auth
        <form action="{{route('blogs.addComment', $blog->id )}}" method="post">
            @csrf
            <input type="hidden" name="parent_id" value="{{$comment->id}}">
            <textarea name="comment" class="form-control" placeholder="Yanıt Yazın">
            </textarea>
            <button class="btn btn-primary mt-2"> Yanıtla</button>
        </form>
    @endauth
    @includeWhen($comment->children, 'helpers.comments' , ['comments'=> $comment->children])
    <!-- includeWhen özelliği eğer ilk veriilen şart varsa istenilen viewi döndürür-->
</div>
</div>
@endforeach