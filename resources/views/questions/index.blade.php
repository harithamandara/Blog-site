<x-app-layout title="Q&A">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .answer-container {
            display: none;
        }
        .answer-actions {
            display: flex;
            align-items: center;
        }
        .delete-answer-btn {
            background: none;
            border: none;
            color: #ff0000; /* Red color for delete button */
            cursor: pointer;
        }
    </style>

    <div class="container mx-auto mt-5 px-4 sm:px-6 lg:px-8">
        <div class="flex">
            <div class="w-full">
                <h2 class="mb-5 text-4xl font-semibold text-gray-900">Questions and Answers</h2>
                <!-- Your questions and answers content here -->
            </div>
            <div class="w-1/2 flex justify-end items-end mb-4">
                <a href="{{ route('questions.create') }}" class="inline-block px-4 py-2 rounded bg-gray-500 text-white" style="text-decoration: none;">Create Question</a>
            </div>
        </div>
        <!-- List of Questions and their Answers -->
        @foreach ($questions as $question)
            <div class="py-5 mb-4 border-b border-gray-200">
                <div class="flex justify-between items-center cursor-pointer" onclick="toggleAnswers({{ $question->id }})">
                    <div class="mb-2 font-semibold text-lg text-gray-800">{{ $question->title }}</div>
                    <span class="arrow">&#9660;</span>
                </div>
                <div class="answer-container" id="answer-{{ $question->id }}">
                    <div class="text-sm text-justify text-gray-700 mb-4">{{ $question->description }}</div>

                    <!-- List Answers -->
                    @forelse ($question->answers as $answer)
                        <div class="ml-4 p-2 border-l-4 border-blue-300 bg-gray-50">
                            <div class="text-sm text-gray-600">{{ $answer->content }}</div>
                            <div class="answer-actions">
                                @can('delete', $answer)
                                    <form method="POST" action="{{ route('answers.destroy', $answer) }}" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Dustbin Icon -->
                                        <button type="submit" class="delete-answer-btn">
                                            <i class="fas fa-trash-alt"></i> <!-- FontAwesome Trash Icon -->
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @empty
                        <p class="ml-4 text-sm text-gray-500">No answers yet.</p>
                    @endforelse

                    <!-- Form to Add an Answer -->
                    <form method="POST" action="{{ route('answers.store', $question) }}" class="ml-4 mt-2">
                        @csrf
                        <textarea name="content" rows="2" class="w-full rounded border-gray-300" placeholder="Type your answer here..."></textarea>
                        <button type="submit" class="mt-2 px-4 py-1 bg-white-500 text-black rounded">Submit Answer</button>
                    </form>

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="ml-4 mt-2 text-red-500">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $questions->links() }}
        </div>
    </div>

    <script>
        function toggleAnswers(questionId) {
            const answerContainer = document.getElementById('answer-' + questionId);
            const arrow = document.querySelector(`#answer-${questionId} .arrow`);

            if (answerContainer.style.display === 'none' || answerContainer.style.display === '') {
                answerContainer.style.display = 'block';
                arrow.innerHTML = '&#9650;'; // Up arrow
            } else {
                answerContainer.style.display = 'none';
                arrow.innerHTML = '&#9660;'; // Down arrow
            }
        }
    </script>
</x-app-layout>
