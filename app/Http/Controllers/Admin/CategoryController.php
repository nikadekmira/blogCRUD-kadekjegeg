<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Str;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    function simpan(Request $request)
{

    $category_name = $request->input('name');
    $kecilin = strtolower($category_name);
    $slug = str_replace(" ","-", $kecilin);

    $category = new Category;
    $category->name = $category_name;
    $category->slug = $slug;
    $category->save();
    return redirect('admin/categories')->with('message', 'category berhasil di tambahkan');
}

    public function edit(category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
{
    $name = $request->input('name');
    $kecilin = strtolower($name);
    $slug = str_replace(" ","-",$kecilin);

    $category = Category::findOrFail($id);
    $category->name = $name;
    $category->slug = $slug;
    $category->save();

    return redirect('admin/categories')->with('message', 'Category berhasil di Update');
    
}
    public function destory(int $category_id){
        $category = Category::FindOrFail($category_id);
        if($category){

        $category->delete();
        return redirect()->back()->with('message', 'category berhasil di hapus');
        }
    }
}
