<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-800 leading-tight">
            Create New Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Post Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea name="body" id="body" rows="6" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">Publish Date</label>
                            <input type="datetime-local" name="published_at" id="published_at" class="form-control">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="featured" id="featured" class="form-check-input">
                            <label for="featured" class="form-check-label">Featured</label>
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Author</label>
                            <select name="user_id" id="user_id" class="form-select">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="categories" class="form-label">Categories</label>
                            <select name="categories[]" id="categories" multiple class="form-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('input', function () {
            const slug = slugify(titleInput.value);
            slugInput.value = slug;
        });

        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }
    });
    </script>
</x-app-layout>
