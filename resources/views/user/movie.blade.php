@extends('.user.template')

@section('title')
    صفحه فیلم
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/home.js') }}"></script>
@endsection

@section('content')
    <section>
        <div class="w-full flex flex-row gap-4 bg-responsive px-6 py-8 w-full h-64 z-10 blur-container "
            style="background-image: url({{ url($movie->second_banner) }})">
            <div class="blur-overlay"></div>
        </div>
    </section>

    <div class="w-full flex flex-row absolute z-20 top-32">
        <div class="hidden lg:flex lg:basis-3/12 lg:flex-row lg:justify-end">
            <img class="h-64 rounded-lg drop-shadow-2xl shadow-lg inline-block content" src="{{ url($movie->main_banner) }}"
                title="{{ $movie->title }}" alt="{{ $movie->title }}">
        </div>


        <div class="basis-full lg:basis-9/12 px-6">
            <h2 class="text-white text-2xl pb-8 content">{{ $movie->title }} |
                {{ $movie->director }}</h2>
            <span class="text-right text-white text-xl pb-8 content ">{{ $movie->category->name }}</span>
            <div class=" flex flex-row text-right mt-2">
                <span class="text-right text-white text-xl pb-8 content">
                    <i class="fa-solid fa-heart text-red-600"></i>
                    {{ convertDigitsToFarsi('5 / ' . $movie->score) }}
                </span>
                <span class="text-right text-white text-xl pb-8 content mx-4">
                    <i class="float-nav fa-solid fa-user"></i>
                    {{ convertDigitsToFarsi('120') }}
                </span>
                <span class="text-center text-white text-xl pb-8 content ">
                    |
                </span>
                <button class="text-right text-white text-xl pb-8 content mx-4">
                    <i class="fa-regular fa-heart "></i>
                    امتیاز شما
                </button>
            </div>
            <div class="flex flex-row lg:justify-between justify-end items-center mt-3">
                <p style="width: 30ch" class="text-white movie-description">{{ $movie->info }}
                    ...
                </p>
            </div>

            <div class="flex flex-row lg:justify-start mt-3">
                <button type="button"
                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <i class="fa-solid fa-ticket-simple" style="color: #ffffff;"></i>
                    انتخاب سالن تئاتر و خرید بلیط
                </button>
                <button type="button"
                    class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    <i class="fa-solid fa-play px-2"></i>
                    تیزر فیلم
                </button>

            </div>
        </div>
    </div>





    <section class="mt-12 lg:px-6" id="content">

        <div class="w-full flex flex-row ">
            <div class="lg:basis-8/12 md:w-full sm:w-full mt-24">
                <div class="info-movie">
                    <h2 class="font-bold text-2xl ">درباره فیلم سینمایی {{ $movie->title }}</h2>
                    <h3 class="font-medium	 text-base mt-6	">
                        {{ $movie->info }}
                    </h3>
                </div>

                <div class="actors-movie mt-12">
                    <h2 class="font-bold text-2xl ">بازیگران «{{ $movie->title }}»</h2>


                    <div class="flex text-right mt-6">
                        @foreach ($movie->characters as $actor)
                            <div class="flex items-center mr-8">
                                <img src="{{ $actor->avatar }}" alt="{{ $actor->name }}"
                                    class="w-12 h-12 rounded-lg object-cover">
                                <div class="ml-4 mr-1">
                                    <div class="font-medium text-lg">{{ $actor->name }}</div>
                                    <div class="text-gray-500">{{ $actor->role }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white w-full rounded-lg mt-16">


                    <div class="flex flex-row justify-between">

                        <h1 class="text-gray-400 text-xl font-semibold	 mx-4 my-4">انتخاب و سانس</h1>


                        <form>
                            <div class="flex px-2 mt-3 w-96	">
                                <label for="default-search"
                                    class="mb-2 text-sm font-medium text-gray-900 sr-only light:text-gray-100">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="search-navbar"
                                    id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown"
                                        class="block w-full text-gray-300 p-2 pl-10 text-sm text-gray-900 border-none rounded-xl bg-white-50 dark:bg-gray-50 dark:placeholder-gray-600 dark:text-gray"
                                        placeholder="جست و جوی فیلم و سینما">
                                </div>
                            </div>
                        </form>


                    </div>

                    <div class="week">
                    </div>

                    <div class="week">
                    </div>


                </div>



            </div>


            <div class="hidden lg:block lg:basis-4/12">
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
                                    <img class="w-16 rounded-lg" src="{{ url($tMovies->main_banner) }}"
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
