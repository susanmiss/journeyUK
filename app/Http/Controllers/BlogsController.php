<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Blog;
use App\Models\Categories;
use Session;
use App\Models\User;
use App\Mail\BlogPublished;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class BlogsController extends Controller
{
    //will excecute before others:
    public function __construct(){
        // $this->middleware('author', ['only' => ['create', 'store','edit', 'update' ]]);
        $this->middleware('admin', ['only' => ['delete', 'trash','restore', 'permanentDelete' ]]);
    }


    public function index()
    {
        //Display all blogs just for admin?
        // $blogs = Blog::where('status', 1)->latest()->get();
        //get the latests posts from the DB:

        $blogs = Blog::latest()->get();
        //To get the blog with paginatios:
        // $blogs = Blog::latest()->paginate(1);
        return view('blogs.index', compact('blogs'));
    }

    public function create(){
        $categories = Categories::latest()->get();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request){
        //dd($request); //tipo console.log no browser
        //dd($request->title);

        // $blog = new Blog();
        // $blog->title = $request->title;
        // $blog->body = $request->body;
        // $blog->save();
        //OR: 
        $rules = [
            'title'=> ['required', 'min:5', 'max:160'],
            'body'=> ['required'],
        ];

        $this->validate($request, $rules);

        $input = $request->all();
         // To use slug and not Id:
        $input['slug'] =Str::slug($request->title);
        $input['meta_title'] =Str::limit($request->title, 55);
        $input['meta_description'] = Str::limit($request->body, 155);

        //image upload
        if($file = $request->file('featured_image')){
            //dd('yes');
            //dd($file->getClientOriginalName());
            //getClientOriginalExtension() and getSize() are available
            $name = uniqid() . $file->getClientOriginalName();
            $name = strtolower(str_replace(' ', '-', $name));
            $file->move('images/featured_image/', $name);
            $input['featured_image'] = $name;
        }
         $blog = Blog::create($input);
        // $blogByUser = $request->user()->blogs()->create($input);
        //sync with cathegories:
        if($request->category_id){
            $blogByUser->category()->sync($request->category_id);
        }

        //mail
        // $users = User::all();
        // foreach($users as $user){
        //     Mail::to($user->email)->queue(new BlogPublished($blogByUser, $user));
        // }

        Session::flash('blog_created_message', 'Congratulations on creating a great blog!');

        return redirect('/blogs');
    }

    public function show($slug){
        // $blog = Blog::findOrFail($id);
        $blog = Blog::whereSlug($slug)->first();
        return view('blogs.show', compact('blog'));
    }

    public function edit($id){
        $categories = Categories::latest()->get();
        $blog = Blog::findOrFail($id);

        // $bc = array();
        // foreach($blog->category as $c){
        //     $bc[] = $c->id -1;
        // }

        // $filtered = array_except($categories, $bc);

        //If we dont want to use the compact method above:
        // return view('blogs.edit', ['blog' => $blog, 'categories' => $categories, 'filtered' => $filtered]); 
        return view('blogs.edit', ['blog' => $blog, 'categories' => $categories]); 
    }

    public function update(Request $request, $id){
         //dd($request);
        $input = $request->all();
        $blog = Blog::findOrFail($id);

        if($file = $request->file('featured_image')){
            if($blog->featured_image){
                unlink('images/featured_image/' . $blog->featured_image);
            }
            $name = uniqid() . $file->getClientOriginalName();
            $name = strtolower(str_replace(' ', '-', $name));
            $file->move('images/featured_image/', $name);
            $input['featured_image'] = $name;

        }

        $blog->update($input);
        //sync with categories:
        if($request->category_id){
            $blog->category()->sync($request->category_id);
        }
        return redirect('blogs');
    }

    public function delete($id){
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect('blogs');
    }

    public function trash(){
        $trashedBlogs = Blog::onlyTrashed()->get();
        return view('blogs.trash', compact('trashedBlogs'));
    }

    public function restore($id){
        $restoredBlog = Blog::onlyTrashed()->findOrFail($id);
        $restoredBlog->restore($restoredBlog);
        return redirect('blogs');
    }

    public function permanentDelete($id){
        $permanentDeleteBlog = Blog::onlyTrashed()->findOrFail($id);
        $permanentDeleteBlog->forceDelete($permanentDeleteBlog);
        return back(); //same as redirect to keep the same page
    }
    
}
