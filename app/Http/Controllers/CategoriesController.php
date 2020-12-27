<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Categories::latest()->get();
        return view('categories.index', ['categories' => $categories]);
    }


    public function create()
    {
        $categories = Categories::latest()->get();

        return view('categories.create', compact('categories') );
    }


    public function store(Request $request)
    {
        $rules = [
            'name'=> ['required', 'min:3', 'max:160'],
       
        ];
        $this->validate($request, $rules);
        $input = $request->all();
        $input['slug'] =Str::slug($request->name);

        //image upload
        if($file = $request->file('featured_image')){
            $name = uniqid() . $file->getClientOriginalName();
            $name = strtolower(str_replace(' ', '-', $name));
            $file->move('images/featured_image/', $name);
            $input['featured_image'] = $name;
        }
         $categories = Categories::create($input);
   
        return redirect('/');
    }







    public function show($id)
    {
        $categories = Categories::where('id', $id)->first();
        return view('categories.show', compact('categories'));
    }


    public function edit($id)
    {
        $categories = Categories::findOrFail($id);
        return view('categories.edit', compact('categories'));

    }


    public function update(Request $request, $id)
    {
        // $categories = Categories::findOrFail($id);
        // $categories->name = $request->name;
        // $categories->slug = $request->name;
        // $categories->save();
        // return redirect('categories');

               //dd($request);
               $input = $request->all();
               $categories = Categories::findOrFail($id);
       
               if($file = $request->file('featured_image')){
                   if($categories->featured_image){
                       unlink('images/featured_image/' . $categories->featured_image);
                   }
                   $name = uniqid() . $file->getClientOriginalName();
                   $name = strtolower(str_replace(' ', '-', $name));
                   $file->move('images/featured_image/', $name);
                   $input['featured_image'] = $name;
       
               }
       
               $categories->update($input);
               //sync with categories:
            //    if($request->category_id){
            //        $blog->category()->sync($request->category_id);
            //    }
               return redirect('categories');
    }


    public function destroy($id)
    {
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect('categories');
    }

}
