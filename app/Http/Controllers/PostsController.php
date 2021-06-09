<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    
    public function __construct()  // If you are not signed in you will not be able to see the ADD POST page.
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {

        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
        ]);

        $imagePath = (request('image')->store('uploads','public'));

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

    // Only a authenticated user can save a post.You cannot create a post in somebody else's username.

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]); 
        
        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(Post $post)
    {
        //return view('posts.show',['post' => $post]);
        return view('posts.show',compact('post'));
        
    }
}