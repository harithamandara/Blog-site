<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->paginate(10);
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        // Display the form to create a new question
        return view('questions.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000'
        ]);

        // Create a new question using the validated data
        $question = new Question($validated);

        // Associate the question with the currently authenticated user
        $question->user_id = Auth::id();

        $question->save();

        // Redirect to a specific route, could be the list of questions
        return redirect()->route('home')->with('status', 'Question posted successfully!');
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }
}
