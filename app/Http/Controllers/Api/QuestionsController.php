<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::paginate();
        return response()->json($questions);
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

        $request->merge(['user_id' => Auth::id()]);

        //DB Transaction
        DB::beginTransaction();
        try {
            $question = Question::create($request->all());
            $question->tags()->attach($request->tags);

            DB::commit();

        } catch (\Throwableable $e) {
            DB::rollBack();
            throw $e;
        }
        return response()->json($question, 201);

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
        return $question;
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
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'status' => ['in:open,closed'],
            'tags.*' => ['sometimes', 'required', 'int', 'exists:tags,id']
            /*لفحص كل قيمة داخل المصفوفة هل هي ضمن البيانات المخزنة في الجدول*/

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

        return [
            'message' => 'Question Updated',
            'question' => $question
        ];
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
        return ['message' => 'Question deleted'];
    }
}
