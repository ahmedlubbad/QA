<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => ['required', 'int', 'exists:questions,id'],
            'description' => ['required', 'string', 'min:5']
        ]);
        $question = Question::findOrFail($request->input('question_id'));
        $request->merge(['user_id' => Auth::id()]);
        $question->answers()->create($request->all());
        return redirect(route('questions.show', ['question' => $question->id]))->with('success', 'Answer add!');
    }

    public function best(Request $request, $id)
    {
        $answer = Answer::findOrFail($id);
        $question = $answer->question;
        if ($question->user_id != Auth::id()) {
            abort(403);
        }
        $question->answers()->update([
            'best_answer' => 0
        ]);
        $answer->forceFill([
            'best_answer' => 1
        ])->save();

        return redirect()->route('questions.show', ['question' => $answer->question_id])
            ->with('success', 'Answer marked as best!');
    }
}
