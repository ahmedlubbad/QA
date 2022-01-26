<?php

namespace App\Http\Controllers;


use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Faker\Extension\GeneratorAwareExtensionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        if (!Gate::allows('tags.view')) {
            abort(403);
        }
        $tags = Tag::paginate();//return all tags are store in the table as collection object can use as array contain object of tag
        return view('tags.index', ['title' => 'Tag List', 'tags' => $tags]);
    }

    public function create()
    {
        if (Gate::denies('tags.create')) {
            abort(403);
        }
        return view('tags.create', ['title' => 'Create New Tag']);
    }

    public function store(TagRequest $request)
    {
        if (Gate::denies('tags.create')) {
            abort(403);
        }
//        $this->validateRequest($request);
//        $request->all(); //return array contain token & data was sent from form
        $request->merge(['slug' => Str::slug($request->name)]);
        Tag::create($request->all());
        return redirect('/tags')->with('success', 'Tag created!');
    }

    public function edit($id)
    {
        Gate::authorize('tags.edit');
        $tag = Tag::findOrfail($id);
        return view('tags.edit', ['tag' => $tag, 'title' => 'Edit Tag']);
    }

    public function update(TagRequest $request, $id)
    {
        Gate::authorize('tags.edit');
//        $this->validateRequest($request, $id);
        $tag = Tag::findOrfail($id);
        $tag->update(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect('/tags')->with('success', 'Tag updated!');
    }

    public function destroy($id)
    {
        Gate::authorize('tags.delete');
        Tag::destroy($id);
        return redirect('/tags')->with('success', 'Tag deleted!');

    }

//    protected function validateRequest(Request $request, $id = 0)
//    {
//        $request->validate(['name' => ['required', 'string', 'max:255', "unique:tags,name,$id"],]);
//    }
}
