<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Blog;
use App\Tag;
use App\User;


class BlogController extends Controller
{
    public function index(){
        $blogs =  Blog::all();

        return view('blogs.index')->with('blogs',$blogs);//compact a bak
    }

    public function create(){
        return view('blogs.create');

    }
    public function store(Request $request){//request mahmut da oolabilir
        $request->validate(array(
            'title'=> 'required|string|min:3|max:100',
            'content'=> 'required|string|min:5',
            'tags' => 'nullable|string'
            'photo' =>'nullable|image|max:300' //kilobyte

        ));

        if ($request->hasFile('photo')) {
          $path  = $request->file('photo')->store('public/photos');
          $blog->photo = $path;
        }
        $blog = new Blog;
        $blog->user_id = $request->user()->id;
        $blog->title =$request->input('title');
        $blog->content =$request->input('content');

        $blog->save();

        if ($request->input('tags')){
            $tags = explode(',',$request->input('tags'));
            foreach ($tags as $tag ){
                $t = Tag::firstOrCreate(['tag'=>$tag]);
                $blog->tags()->attach($t);
            }
        }

        return redirect()->route('blogs.index');
    }
    public function detail(Blog $blog ){
      //dd($blog);
        return view('blogs.detail', compact('blog'));


    }

    public function edit(Blog $blog, Request $request){
        //dd($blog);
        if($request->user()->id!== $blog->user->id) return redirect()->route('home');
        return view('blogs.edit', compact('blog'));
    }

    public function update(Blog $blog, Request $request){

        if ($request->user()->id !== $blog->user->id) return redirect()->route('home');

        $request->validate(array(
            'title'=> 'required|string|min:3|max:100',
            'content'=> 'required|string|min:5'

        ));

        $blog->title =$request->input('title');
        $blog->content =$request->input('content');
        $blog->save();
        $tagsToSync = [];//senkronize edilecek id lerin atıldığı dizin
        if ($request->input('tags')){
            $tags = explode(',',$request->input('tags'));
            foreach ($tags as $tag ){
                $t = Tag::firstOrCreate(['tag'=>$tag]);
                $tagsToSync[] = $t->id;

            }

        }
        $blog->tags()->sync($tagsToSync);
        return redirect()->route('blogs.detail' ,$blog->id);
    }

   public function addComment(Blog $blog, Request $request){
       // dd($blog);
        $request->validate([
            'comment'=> 'required|string|min:5'
            ]); //error kısmı forma yazılmadı

        $comment = new Comment;
        $comment->blog_id = $blog->id;
        $comment->user_id = $request->user()->id;
        $comment->body = $request->input('comment');
        if ($request->input('parent_id')) $comment->parent_id = $request->input('parent_id');
        $comment->save();
        return redirect()->route('blogs.detail', $blog);

   }



   public function tagBlogs(Tag $tag){
       // dd($tag);
        $blogs = $tag ->blogs()->latest()->get();
        return view('blogs.index',compact('blogs', 'tag'));

   }

    public function userBlogs(User $user){

        $blogs = $user ->blogs()->latest()->get();
        return view('blogs.index',compact('blogs', 'user'));

    }

}
