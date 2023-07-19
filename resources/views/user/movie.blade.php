@extends('.user.template')

@section('title')
    {{ $movie->title }} | سینما تیکت
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/movie.js') }}"></script>
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
            <div class="flex flex-row lg:justify-between justify-end items-center -mt-5">
                <div class="flex text-right">
                    @foreach ($movie->characters as $actor)
                        <div class="flex items-center ">
                            <img src="{{ $actor->avatar }}" alt="{{ $actor->name }}"
                                class="w-12 h-12 rounded-lg object-cover">
                            <div class="ml-4 mr-1">
                                <div class="font-medium text-lg text-white">{{ $actor->name }}</div>
                                <div class="text-gray-500">{{ $actor->role }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-row lg:justify-start mt-3 right-0">
                <button type="button"
                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center  mb-2">
                    <i class="fa-solid fa-ticket-simple" style="color: #ffffff;"></i>
                    انتخاب سالن تئاتر و خرید بلیط
                </button>
                <button data-modal-target="trailerModal" data-modal-toggle="trailerModal" type="button"
                    class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    <i class="fa-solid fa-play px-2"></i>
                    تیزر فیلم
                </button>

            </div>
        </div>
    </div>

    <!-- Trailer modal -->
    <div id="trailerModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <video autoplay class="w-full h-auto max-w-full border border-gray-200 rounded-lg" controls>
                    <source src="{{ url($movie->trailer) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>

    <section class="mt-12 lg:px-6" id="content">

        <div class="w-full flex flex-row ">
            <div class="lg:basis-8/12 md:w-full sm:w-full mt-24">
                <div class="info-movie">
                    <h2 class="font-bold text-2xl text-gray-500">درباره فیلم سینمایی {{ $movie->title }}</h2>
                    <h3 class="font-medium	 text-base mt-6	">
                        {{ $movie->info }}
                    </h3>
                </div>

                <div class="actors-movie mt-12">
                    <h2 class="font-bold text-2xl text-gray-500">بازیگران «{{ $movie->title }}»</h2>


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

                <div class="bg-white w-full rounded-lg mt-16 mb-16">

                    <div class="flex flex-row justify-between">

                        <div class="block">
                            <h1 class="text-gray-400 text-xl font-semibold	 mx-4 my-4">انتخاب و سانس</h1>

                            <div class="flex mt-6 text-sm font-light mb-5 px-8">
                                <div class="text-center ml-3">
                                    <p class="px-3.5 py-1.5 rounded-full bg-gray-100 mb-2.5 text-center">جمعه</p>
                                    <p class="text-center">24 تیر</p>
                                </div>
                                <div class="text-center ml-3">
                                    <p class="px-3.5 py-1.5 rounded-full mb-2.5 text-center">شنبه</p>
                                    <p class="text-center">25 تیر</p>
                                </div>
                                <div class="text-center ml-3">
                                    <p class="px-3.5 py-1.5 rounded-full  mb-2.5 text-center">یکشنبه</p>
                                    <p class="text-center">26 تیر</p>
                                </div>
                            </div>
                        </div>






                        <form>
                            <div class="flex px-2 mt-3 w-96	">
                                <label for="default-search"
                                    class="mb-2 text-sm font-medium text-gray-900 sr-only light:text-gray-100">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="search-navbar" id="mega-menu-dropdown-button"
                                        data-dropdown-toggle="mega-menu-dropdown"
                                        class="block w-full text-gray-300 p-2 pl-10 text-sm text-gray-900 border-none rounded-xl bg-white-50 dark:bg-gray-50 dark:placeholder-gray-600 dark:text-gray"
                                        placeholder="جست و جوی فیلم و سینما">
                                </div>
                            </div>
                        </form>


                    </div>

                    <div class="week">
                    </div>

                    @if (!empty($cinemas))
                        <div class="cinema p-4">
                            @foreach ($cinemas as $key => $cinema)
                                <div class="block relative">
                                    <div class="flex flex-row flex-wrap w-full mt-3 ">

                                        <a href="cinema/slug" class="w-5/6 flex flex-row">

                                            <img src="{{ url($cinema['banner']) }}" alt="{{ $cinema['title'] }}"
                                                class=" w-60 h-36 rounded-xl  bg-responsive">

                                            <div class="block">
                                                <h3 class="text-black text-xl font-semibold mx-3">{{ $cinema['title'] }}
                                                </h3>

                                                <div class="flex flex-row mt-4">
                                                    <i class="fa-solid fa-location-dot mr-3"></i>
                                                    <h4 class="text-black text-normal font-normal mx-3">
                                                        {{ $cinema['address'] }}</h4>
                                                </div>

                                                <div class="mt-4">
                                                    <span
                                                        class=" mt-3 mr-3 text-right bg-gray-400 text-white text-sm font-medium px-2.5 pt-2 pb-0.5 rounded-full dark:bg-gray-400 dark:text-gray-300">
                                                        <i class="fa-solid fa-star text-white"></i>
                                                        {{ convertDigitsToFarsi('5 / ' . $cinema['score']) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </a>

                                        <div class="w-1/6 ">

                                            <button type="button" class="flex flex-row text-red-500 dropdown-btn"
                                                onclick="toggleDropdown({{ $cinema['id'] }})">
                                                <h2 class="text-md font-semibold ml-2">سانس ها</h2>
                                                <i class="fa-solid fa-chevron-down  drop-icon-{{ $cinema['id'] }}"></i>
                                            </button>


                                        </div>

                                    </div>

                                    <div class="dropdown-wrapper drop-div-{{ $cinema['id'] }} hidden bg-red w-full my-4">
                                        <div class="mt-2">

                                            <div class="flex flex-row">
                                                <h1 class="ml-1">درباره {{ $cinema['title'] }}</h1>
                                                <i class="fa-solid fa-chevron-left font-sm text-gray-500"></i>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>

                <div class="more-info-movie ">
                    <h2 class="font-bold text-gray-500 text-2xl ">سایر اطلاعات {{ $movie->title }}</h2>
                    <h3 class="font-medium text-base mt-3	">
                        سال ساخت :
                        {{ $movie->created_at->format('Y') }}
                    </h3>
                </div>


                <div class="bg-white w-full rounded-lg mt-16 mb-16">

                    <div class="flex flex-row ">

                        <h1 class="text-gray-400 text-xl font-semibold	 mx-4 my-4">دیدگاه های فیلم {{ $movie['title'] }}
                        </h1>
                        <p class="text-gray-400 text-sm font-normal	mx-4  mt-5">(215) دیدگاه ثبت شده</p>

                    </div>

                    <div class="bg-gray-200 w-full" style="height: 1px"></div>

                    @if (!empty($comments))
                        <div class="cinema p-4">
                            @foreach ($comments as $key => $comment)
                                <div class="flex flex-row mt-3">
                                    <div class="w-1/12">
                                        <img src="{{ asset('images/profile-mine.svg') }}" alt="user avatar"
                                            class="w-12">
                                    </div>

                                    <div class="w-11/12 block mr-2  right-0">
                                        <p class="text-gray-400">{{ $comment['name'] }}</p>
                                        <h1 class="">{{ $comment['body'] }}</h1>
                                        <p class="text-gray-400">{{ $comment['created_at'] }}</p>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <div class="bg-gray-200 w-full mt-2" style="height: 1px"></div>
                                @endif
                            @endforeach
                        </div>
                    @endif



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
                                    <p class="text-gray-600">{{ convertDigitsToFarsi(number_format($tMovies->sale)) }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection
