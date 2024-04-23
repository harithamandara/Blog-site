<?php

namespace App\Livewire;

use App\Models\Question;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class QuestionAnswers extends Component
{
    use WithPagination;

    public Question $question;

    #[Rule('required|min:3|max:200')]
    public string $answer;

    public function questionANswer()
    {
        if (auth()->guest()) {
            return;
        }

        $this->validateOnly('answer');

        $this->post->answers()->create([
            'answer' => $this->answer,
            'user_id' => auth()->id()
        ]);

        $this->reset('answer');
    }

    #[Computed()]
    public function answers()
    {
        return $this?->post?->answers()->with('user')->latest()->paginate(5);
    }

    public function render()
    {
        return view('livewire.question-answer');
    }
}
