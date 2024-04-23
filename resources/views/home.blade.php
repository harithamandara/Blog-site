<x-app-layout title="Home Page">
    <head>
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">

    </head>
    @section('hero')
        {{--        <div class="w-full py-32 text-center" style="background-image: url('/img/bg.jpg'); background-size: cover; background-position: center;">--}}
        {{--            <h1 class="text-2xl font-bold text-center text-white md:text-3xl lg:text-5xl">--}}
        {{--                {{ ('home.hero.title') }} <span class="text-white-500">APIIT</span> <span class="text-white-900">--}}
        {{--                    Blogs</span>--}}
        {{--            </h1>--}}
        {{--            <p class="mt-1 text-lg text-white">{{ ('home.hero.desc') }}</p>--}}
        {{--            <a class="inline-block px-3 py-2 mt-5 text-lg text-white bg-gray-800 rounded" href="{{ route('posts.index') }}">--}}
        {{--                {{ ('home.hero.cta') }}</a>--}}
        {{--        </div>--}}

        <div class="banner">
            <!-- Add your banner image here -->
            <img src="{{ asset('img/banner.png') }}" alt="background">
            <div class="animated-text">
                <div class="apiit">APIIT</div>
                <div class="blogs">Blogs</div>
            </div>
        </div>
        <div class="wrapper">
            <div class="container1">
                <input type="radio" name="slider" id="c1" checked>
                <input type="radio" name="slider" id="c2">
                <input type="radio" name="slider" id="c3">
                <input type="radio" name="slider" id="c4">

                <label for="c1" class="card" id="card1">
                    <div class="row">
                        <div class="icon">1</div>
                        <div class="description">
                            <h4>Card 1</h4>
                            <p>Description for card 1.</p>
                        </div>
                    </div>
                </label>

                <label for="c2" class="card" id="card2">
                    <div class="row">
                        <div class="icon">2</div>
                        <div class="description">
                            <h4>Card 2</h4>
                            <p>Description for card 2.</p>
                        </div>
                    </div>
                </label>

                <label for="c3" class="card" id="card3">
                    <div class="row">
                        <div class="icon">3</div>
                        <div class="description">
                            <h4>Card 3</h4>
                            <p>Description for card 3.</p>
                        </div>
                    </div>
                </label>

                <label for="c4" class="card" id="card4">
                    <div class="row">
                        <div class="icon">4</div>
                        <div class="description">
                            <h4>Card 4</h4>
                            <p>Description for card 4.</p>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    @endsection

    <div class="w-full mb-10">
        <div class="mb-16">
            <h2 class="mt-16 mb-5 text-3xl font-bold text-yellow-500">{{ ('Featured Posts') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Big Post (Left Side) -->
                <div class="col-span-1 md:col-span-1 flex justify-center">
                    <x-posts.post-card :post="$featuredPosts->first()" class="w-full" />
                </div>
                <!-- Small Posts (Right Side) -->
                <div class="col-span-1 md:col-span-1 md:flex md:flex-col md:justify-between">
                    @foreach ($featuredPosts->skip(1) as $post)
                        <div class="mb-4 md:mb-1">
                            <x-posts.post-card :post="$post" class="w-1/2 mx-auto" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <a class="block mt-10 text-lg font-semibold text-center text-yellow-500" href="{{ route('posts.index') }}">
            {{ ('home.more_posts') }}</a>
        <hr>

        <h2 class="mt-16 mb-5 text-3xl font-bold text-yellow-500">{{ ('Latest Posts') }}</h2>
        <div class="w-full mb-5">
            <div class="owl-carousel owl-theme" data-slideby="3"> <!-- Set slideBy option to 3 -->
                @foreach ($latestPosts as $post)
                    <div class="item">
                        <x-posts.post-card :post="$post" />
                    </div>
                @endforeach
            </div>
        </div>
        <a class="block mt-10 text-lg font-semibold text-center text-yellow-500" href="{{ route('posts.index') }}">
            {{ __('home.more_posts') }}</a>
    </div>

    <!-- Owl Carousel JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/home/home.js') }}"></script>

    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                loop:true,
                margin:10,
                autoplay:true,
                autoplayTimeout:3000,
                slideBy:3, // Slide by 3 posts
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:3
                    }
                }
            });
        });
    </script>
</x-app-layout>
