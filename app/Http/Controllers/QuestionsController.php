<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $questions = Question::leftJoin('users', 'questions.user_id', '=', 'users.id')
//            ->select(['questions.*', 'users.name as user_name'])
//            ->latest()//orderBy('created_at', 'DESC')
//            ->paginate(3);
        $search = request('search');
        $tag_id = request('tag_id');
        $questions = Question::with('user', 'tags')
            ->withCount('answers')
            ->latest()
            ->when($search, function ($query, $search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })->when($tag_id, function ($query, $tag_id) {
                /*$query->whereRaw('questions.id IN (
                    SELECT question_id FROM question_tag WHERE tag_id = ?
                )', [$tag_id]);*/
                $query->whereHas('tags'/*name of relation*/, function ($query) use ($tag_id)/*Scope*/ {
                    $query->where('id'/*id of tag*/, '=', $tag_id);
                });
            })
            ->paginate(3);
        return view('questions.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('questions.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tags' => ['required', 'array']
        ]);
        $request->merge(['user_id' => $request->user()->id]);
        //DB Transaction
        DB::beginTransaction();
        try {
            $question = Question::create($request->all());
            $question->tags()->attach($request->tags);

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }


        return redirect()->route('questions.index')->with('success', 'Question added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $question = Question::findOrFail($id);
        $answers = $question->answers()->with('user')->latest()->get();
        return view('questions.show', ['question' => $question, 'answers' => $answers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $question_tags = $question->tags()->pluck('id')->toArray();
        $tags = Tag::all();
        return view('questions.edit', ['question' => $question, 'tags' => $tags, 'question_tags' => $question_tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['in:open,closed'],
            'tags' => ['required', 'array']

        ]);
        //DB Transaction
        DB::beginTransaction();
        try {
            $question->update($request->all());
            $question->tags()->sync($request->tags);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('questions.index')->with('success', 'Question updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::destroy($id);
        return redirect()->route('questions.index')->with('success', 'Question deleted!');
    }
}
