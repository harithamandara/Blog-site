<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'content' => 'required|min:5',
        ]);

        $answer = new Answer([
            'content' => $request->content,
            // Assuming you have 'user_id' for user who answered, if authenticated:
            // 'user_id' => auth()->id(),
        ]);

        $question->answers()->save($answer);

        return back()->with('status', 'Answer posted successfully!');
    }

    public function destroy(Request $request, Answer $answer)
    {
        $this->authorize('delete', $answer);

        // Delete the answer
        $answer->delete();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Answer deleted successfully');
    }
}
