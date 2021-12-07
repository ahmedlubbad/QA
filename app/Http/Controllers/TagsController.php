<?php

namespace App\Http\Controllers;


use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagsController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth')->except('index','create');
//$this->middleware('auth')->only('index', 'create')
//    }

    public function index()
    {

        $tags = Tag::all();//return all tags are store in the table as collection object can use as array contain object of tag
        return view('tags.index', ['title' => 'Tag List', 'tags' => $tags]);
    }

    public function create()
    {
        return view('tags.create', ['title' => 'Create New Tag']);
    }

    public function store(TagRequest $request)
    {
//        $this->validateRequest($request);
//        $request->all(); //return array contain token & data was sent from form
        $request->merge(['slug' => Str::slug($request->name)]);
        Tag::create($request->all());
        return redirect('/tags')->with('success', 'Tag created!');
    }

    public function edit($id)
    {
        $tag = Tag::findOrfail($id);
        return view('tags.edit', ['tag' => $tag, 'title' => 'Edit Tag']);
    }

    public function update(TagRequest $request, $id)
    {
//        $this->validateRequest($request, $id);
        $tag = Tag::findOrfail($id);
        $tag->update(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect('/tags')->with('success', 'Tag updated!');
    }

    public function destroy($id)
    {
        Tag::destroy($id);
        return redirect('/tags')->with('success', 'Tag deleted!');

    }

//    protected function validateRequest(Request $request, $id = 0)
//    {
//        $request->validate(['name' => ['required', 'string', 'max:255', "unique:tags,name,$id"],]);
//    }
}
