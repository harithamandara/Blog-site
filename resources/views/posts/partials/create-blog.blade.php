<div class="mb-5">
    <x-button id="createBlogButton">{{ __('Create Blog') }}</x-button>
</div>

<script>
    // Get the button element by its ID
    const createBlogButton = document.getElementById('createBlogButton');

    // Add a click event listener to the button
    createBlogButton.addEventListener('click', redirectToCreatePage);

    // Function to redirect to the create post page
    function redirectToCreatePage() {
        // Assuming the base URL is http://127.0.0.1:8000/
        const baseUrl = window.location.origin;
        const createPostUrl = baseUrl + '/posts/make'; // Update the URL to match your route

        // Redirect to the create post page
        window.location.href = createPostUrl;
    }
</script>
