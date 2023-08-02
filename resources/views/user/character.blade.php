@extends('.user.template')

@section('title')
    بازیگر
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/character.css') }}">
@endsection


@section('content')
    <section>
        <div class="w-full flex flex-row gap-4   w-full h-64 z-10 blur-container actor-banner"
            style="background-image: url({{ asset('images/actor-banner.webp') }})">
            <div class="blur-overlay"></div>
        </div>
    </section>


    <div class="w-full absolute">
        <div class="w-8/12 mx-auto relative">

            <div class="w-full flex flex-row absolute z-20 -top-56 right-12">
                <div class=" md:flex  md:flex-row md:justify-end">
                    <img class="w-20 h-20 bg-cover rounded-full drop-shadow-2xl shadow-lg " src="{{ url($actor->avatar) }}"
                        alt="">
                </div>

                <div class="block mr-4 mt-3">
                    <h1 class="text-white font-semibold text-lg">{{ $actor->name }}</h1>
                    <h1 class="text-white font-normal text-sm  mt-4">بازیگر</h1>
                </div>
            </div>


            <div class="block  w-full z-20 absolute -mt-28 px-12">
                <h1 class="text-white font-normal text-md">
                    متولد {{ $actor->birthday }}
                </h1>

                <h1 class="text-white font-normal text-sm mt-2 xl:pl-96">
                    {{ $actor->description }}
                </h1>
            </div>
        </div>

    </div>


    <section>
        <div class="p-5 w-full block">
            <div class="bg-white w-8/12 block mx-auto rounded-md relative">
                <h1 class="text-black font-normal text-md relative right-5 top-5">
                    آثار هنرمند
                </h1>

                <div class="w-full sm:mb-16 py-5">
                    <div class="flex flex-wrap w-full z-10  rounded-2xl">
                        @foreach ($actorMovies as $movie)
                            <a href="{{ route('movie.show', ['slug' => $movie['slug']]) }}"
                                class="2xl:w-1/5 xl:w-1/5 lg:w-1/4 md:w-1/4 sm:w-1/3 w-1/3 relative released-div mt-4 px-3">
                                <div class="flex justify-center">
                                    <img class="object-cover transition delay-500 hover:blur-sm w-full max-w-xs rounded-lg drop-shadow-2xl shadow-lg inline-block content released-img"
                                        src="{{ url($movie['main_banner']) }}" title="{{ $movie['title'] }}"
                                        alt="{{ $movie['title'] }}">
                                    <div
                                        class="absolute bottom-14 z-20 justify-center sm:text-xs text-center released-score-view">
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
                                                <span class="font-thin">{{ $movie['director'] }}</span>
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
        </div>

    </section>
@endsection
