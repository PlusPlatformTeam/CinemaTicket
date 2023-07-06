@extends('.user.template')

@section('title')
    صفحه اصلی | سینما تیکت
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/home.js') }}"></script>
@endsection

@section('content')
    <section class="m-0 p-0" id="swiper-slider">
        <div class="swiper hidden lg:block md:block">
            <div class="swiper-wrapper">
                @foreach ($lastMovies as $movie)
                    <div class="swiper-slide">
                        <div class="flex flex-row gap-4 bg-responsive px-6 py-8 w-full h-full z-10 blur-container"
                            style="background-image: url({{ url($movie['second_banner']) }})">
                            <div class="blur-overlay"></div>
                            <div class="basis-3/12">
                                <img class="h-full max-w-xs rounded-lg drop-shadow-2xl shadow-lg inline-block content"
                                    src="{{ url($movie['main_banner']) }}" title="{{ $movie['title'] }}"
                                    alt="{{ $movie['title'] }}">
                            </div>
                            <div class="relative basis-9/12 px-6">
                                <h2 class="text-white text-2xl pb-8 content">{{ $movie['title'] }}</h2>
                                <h5 class="text-white text-xs content">کارگردان : {{ $movie['director'] }}</h5>
                                <div class="pt-8">
                                    <span
                                        class="text-right bg-gray-700 text-white text-sm font-medium px-2.5 pt-2 pb-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300"><i
                                            class="fa-solid fa-heart text-red-600"></i>
                                        {{ convertDigitsToFarsi('5 / ' . $movie['score']) }}</span>
                                    <span
                                        class="text-right bg-gray-700 text-gray-50 text-sm font-medium mr-2 px-2.5 pt-2 pb-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300"><i
                                            class="fa-regular fa-clock mx-1"></i>
                                        {{ convertDigitsToFarsi($movie['duration']) }} دقیقه </span>
                                    <span
                                        class="text-right bg-gray-700 text-gray-100 text-sm font-medium mr-2 px-2.5 pt-2 pb-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ $movie->category->name }}</span>
                                </div>
                                <p class="text-white pt-10 movie-description">{{ $movie['info'] }} ...</p>
                                <a href="movie/{{ $movie['slug'] }}"
                                    class="absolute bottom-0 text-gray-900 bg-gray-50 px-6 py-2 rounded-lg text-center flex justify-center items-center">
                                    <i class="fa-solid fa-ticket-simple mx-3"></i>
                                    <span style="padding-top: 5px" class="text-center flex justify-center items-center">خرید
                                        بلیت</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>

            <div class="swiper-button-prev">
                <i class="fas fa-chevron-right"></i>
            </div>
            <div class="swiper-button-next">
                <i class="fas fa-chevron-left"></i>
            </div>
        </div>

        <div class="mobile-swiper-container flex 2xl:hidden xl:hidden lg:hidden md:hidden">
            @foreach ($lastMovies as $movie)
                <div class="items">
                    <div class="items-info absolute bottom-0 p-4">
                        <h2 class="text-white text-2xl pb-8 content">{{ $movie['title'] }}</h2>
                        <h5 class="text-white text-xs content">کارگردان : {{ $movie['director'] }}</h5>
                        <div class="pt-8">
                            <span
                                class="text-right bg-gray-700 text-white text-sm font-medium px-2.5 pt-2 pb-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300"><i
                                    class="fa-solid fa-heart text-red-600"></i>
                                {{ convertDigitsToFarsi('5 / ' . $movie['score']) }}</span>
                            <span
                                class="text-right bg-gray-700 text-gray-50 text-sm font-medium mr-2 px-2.5 pt-2 pb-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300"><i
                                    class="fa-regular fa-clock mx-1"></i>
                                {{ convertDigitsToFarsi($movie['duration']) }}
                                دقیقه </span>
                            <span
                                class="text-right bg-gray-700 text-gray-100 text-sm font-medium mr-2 px-2.5 pt-2 pb-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ $movie->category->name }}</span>
                        </div>
                        <p class="text-white pt-10 movie-description">{{ $movie['info'] }} ...</p>
                        <div class="flex w-full">
                            <a href="movie/{{ $movie['slug'] }}"
                                class="w-11/12 border-2 border-white text-gray-50 bg-inherit px-6 py-2 rounded-lg text-center flex justify-center items-center hover:bg-white hover:text-gray-900 ">
                                <i class="fa-solid fa-ticket-simple mx-3"></i>
                                <span style="padding-top: 5px" class="text-center flex justify-center items-center">خرید
                                    بلیت</span>
                            </a>

                        </div>
                    </div>
                    <img src="{{ $movie['main_banner'] }}" alt="{{ $movie['title'] }}">
                </div>
            @endforeach
        </div>
    </section>
    <section class="mt-12 px-6" id="content">
        <div class="w-full flex flex-row">
            <div class="basis-8/12">
                <div class="flex flex-row gap-4 bg-responsive px-6 py-8 w-full h-64 z-10 blur-container rounded-2xl"
                    style="background-image: url({{ url($topMovies->first()->second_banner) }})">
                    <div class="blur-overlay"></div>
                    <div class="basis-3/12">
                        <img class="h-full max-w-xs rounded-lg drop-shadow-2xl shadow-lg inline-block content"
                            src="{{ url($topMovies->first()->main_banner) }}" title="{{ $topMovies->first()->title }}"
                            alt="{{ $topMovies->first()->title }}">
                    </div>
                    <div class="relative basis-9/12 px-6">
                        <h2 class="text-white text-2xl pb-8 content">{{ $topMovies->first()->title }}</h2>
                        <h5 class="text-white text-xs content">کارگردان : {{ $topMovies->first()->director }}</h5>
                        <div class="pt-8">
                            <span
                                class="text-right bg-gray-700 text-white text-sm font-medium px-2.5 pt-2 pb-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300"><i
                                    class="fa-solid fa-heart text-red-600"></i>
                                {{ convertDigitsToFarsi('5 / ' . $topMovies->first()->score) }}</span>
                            <span
                                class="text-right bg-gray-700 text-gray-100 text-sm font-medium mr-2 px-2.5 pt-2 pb-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ $movie->category->name }}</span>
                        </div>
                        <div class="flex flex-row justify-between items-center mt-5">
                            <p style="width: 30ch" class="text-white movie-description">{{ $topMovies->first()->info }} ...</p>
                            <a href="movie/{{ $topMovies->first()->slug }}"
                                class="text-gray-50 bg-red-500 px-3 py-1 rounded-lg text-center flex justify-center items-center">
                                <i class="fa-solid fa-ticket-simple mx-3"></i>
                                <span style="padding-top: 5px" class="text-center flex justify-center items-center">خرید
                                    بلیت</span>
                                <i class="fas fa-chevron-left mr-3"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="basis-4/12">
                <ul class="w-96 mr-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex flex-row justify-between items-center">
                            <h1 class="text-lg font-bold text-gray-500">جدول فروش</h1>
                            <h6>بروزرسانی : دیروز</h6>
                        </div>
                    </li>
                    @foreach ($topMovies as $key => $tMovies)
                        <li
                            class="w-full px-4 py-2 border-b border-gray-200 {{ count($topMovies) == $key + 1 ? 'rounded-b-lg' : '' }}">
                            <div class="w-full flex flex-row justify-between">
                                <div class="flex flex-row relative">
                                    <img class="w-16 rounded-lg" src="{{ $tMovies->main_banner }}"
                                        alt{{ $tMovies->title }}>
                                    <div class="flex flex-col justify-between pt-2 mr-2">
                                        <span class="block font-bold text-gray-800">{{ $key + 1 }} .
                                            {{ $tMovies->title }}</span>
                                        <span class="block text-gray-500">{{ $tMovies->director }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-row items-center">
                                    <p class="text-gray-600">{{ convertDigitsToFarsi(number_format($tMovies->sale)) }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection
