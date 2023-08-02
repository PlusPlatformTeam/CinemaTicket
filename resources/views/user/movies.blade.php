@php
    $cnt       = 0;
    $movies    = collect($movies);
    $topMovies = $movies->sortByDesc('score')->take(5);
@endphp

@extends('.user.template')

@section('title')
    فیلم های سینمایی درحال اکران | سینما تیکت
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('js')
    {{-- <script src="{{ asset('/js/movie.js') }}"></script> --}}
@endsection

@section('content')
    <section class="lg:px-10 my-12 flex flex-row w-full justify-between">
        <div class="lg:basis-9/12 basis-full">
            <header>
                <h2 class="text-md text-gray-600 font-bold">فیلم های سینمایی درحال اکران روی پرده سینما</h2>
            </header>
            <div class="w-full sm:mb-16">
                <div class="flex flex-wrap w-full z-10 my-2 rounded-2xl">
                    @foreach ($movies as $movie)
                        <a href="{{ route('movie.show', ['slug' => $movie['slug']]) }}"
                            class="2xl:w-1/6 xl:w-1/5 lg:w-1/4 md:w-1/4 sm:w-1/3 w-1/3 relative released-div mt-4 px-3">
                            <div class="flex justify-center">
                                <img class="object-cover transition delay-500 hover:blur-sm w-full max-w-xs rounded-lg drop-shadow-2xl shadow-lg inline-block content released-img"
                                    src="{{ url($movie['main_banner']) }}" title="{{ $movie['title'] }}"
                                    alt="{{ $movie['title'] }}">
                                <div class="absolute bottom-14 z-20 justify-center sm:text-xs text-center released-score-view">
                                    <div>
                                        <span
                                            class="text-right bg-gray-700 text-white text-xs font-medium px-1.5 pt-1 pb-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                            <i class="fa-solid fa-heart text-red-600"></i>
                                            {{ convertDigitsToFarsi('5 / ' . $movie->score) }}
                                        </span>
                                        <span
                                            class="text-right bg-gray-700 text-gray-100 text-xs font-medium mr-2 px-1.5 pt-1 pb-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                            <i class="w-5 h-5 inline-block mr-2 fa-regular fa-user"></i>
                                            <span>{{ convertDigitsToFarsi(rand(50, 999)) }}</span>
                                        </span>
                                        <h5 class="text-white content text-center mt-4 ">
                                            کارگردان : 
                                            <span
                                                class="font-thin">{{ $movie['director'] }}</span>
                                            </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full text-center text-sm mt-3">
                                <span>{{ $movie['title'] }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="hidden lg:block lg:basis-3/12">
            <ul class="w-96 mr-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                    <div class="flex flex-row justify-between items-center">
                        <h1 class="text-lg font-bold text-gray-500">جدول فروش</h1>
                        <h6>بروزرسانی : دیروز</h6>
                    </div>
                </li>
                @foreach ($topMovies as $key => $tMovies)
                    <li
                        class="w-full px-4 py-2 border-b border-gray-200 {{ count($topMovies) == $cnt + 1 ? 'rounded-b-lg' : '' }}">
                        <div class="w-full flex flex-row justify-between">
                            <div class="flex flex-row relative">
                                <img class="w-16 rounded-lg" src="{{ url($tMovies->main_banner) }}"
                                    alt{{ $tMovies->title }}>
                                <div class="flex flex-col justify-between pt-2 mr-2">
                                    <span class="block font-bold text-gray-800">{{ ++$cnt }} .
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
    </section>
@endsection