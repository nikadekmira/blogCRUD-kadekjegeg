<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    public function index ()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('admin.post.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    public function simpanpost(Request $request)
    {
        $post_name = $request->input('title');
        $category_id = $request->input('category_id');
        $description = $request->input('description');
        $status = $request->input('status');
        $image = $request->file('image');
        if($image==""){
            $gbr = "";
            $gbrr = "";
        }else{
            $gbr = $image->getClientOriginalName();
            $gbrr = $image->move(public_path('uploads/post'), $gbr);
        }
        $kecilin = strtolower($post_name);
        $slug = str_replace(" ","-",$kecilin);
        $htg = Post::where('title', $post_name)->count();
        $posto = new Post;
        if($htg > 0){
            return redirect('admin/posts')->with('message', 'postingan dengan judul' . $post_name . 'sudah ada!');
        }else {
        $posto->title = $post_name;
        $posto->category_id = $category_id;
        $posto->description = $description;
        $posto->status = $status;
        $posto->image = $gbr;
        $posto->slug = $slug;

        $posto->save();
        return redirect('admin/posts')->with('message', 'Post berhasil ditambah');
        }

    }

    public function detail(Request $request, $slug){
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('frontend.show', compact('post'));
    }

    public function edit(Request $request, $slug)
{
    $post = Post::where('slug', $slug)->firstOrFail();
    $categories = Category::all();
    return view('admin.post.edit', compact('post', 'categories'));
}

    public function update(Request $request, $id)
    {
        $posto = Post::where('id', $id)->firstOrFail();
        
        $post_name = $request->input('title');
        $category_id = $request->input('category_id');
        $description = $request->input('description');
        $status = $request->input('status');
        $image = $request->file('image');
        if($image==""){
            $gbr = $posto->image;
            $gbrr = "";
        }else{
            $gbr = $image->getClientOriginalName();
            $gbrr = $image->move(public_path('uploads/post'), $gbr);
        }
        $kecilin = strtolower($post_name);
        $slug = str_replace(" ","-",$kecilin);
        
        $posto->title = $post_name;
        $posto->category_id = $category_id;
        $posto->description = $description;
        $posto->status = $status;
        $posto->image = $gbr;
        $posto->slug = $slug;

        $posto->save();
        return redirect('admin/posts')->with('message', 'Post berhasil di update');
    }
    
    public function hapus(Request $request, $id)
{
    $post = Post::where('id', $id)->firstOrFail();
    $path = 'uploads/post/'. $post->image;
    if(File::exists($path)){
        File::delete($path);
    }
    $post->delete();
    return redirect()->back()->with('message', "Post berhasil di Hapus");    
}


}    

