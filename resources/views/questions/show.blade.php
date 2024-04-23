<x-app-layout>
    <div>
        <h1>{{ $question->title }}</h1>
        <!-- Display the question description -->
        <p>{{ $question->description }}</p>
        <hr>
        <h2>Answers:</h2>
        <!-- Loop through each answer of the question -->
        @foreach ($question->answers as $answer)
            <div>{{ $answer->content }}</div>
        @endforeach
        <form method="POST" action="{{ url('questions/' . $question->id . '/answers') }}">
            @csrf
            <textarea name="content"></textarea>
            <!-- Submit button for posting the answer -->
            <button type="submit">Post Answer</button>
        </form>
    </div>
</x-app-layout>
