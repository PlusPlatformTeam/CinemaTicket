@php
    $cinemas = [];
    foreach ($sans as $key => $value) {
        $cinema = $value['cinema'][0];
    
        if (array_key_exists($cinema['id'], $cinemas)) {
            $cinemas[$cinema['id']]['sans'][] = [
                'id' => $value['id'],
                'slug' => $value['slug'],
                'time' => convertDigitsToFarsi(date('H:i', strtotime($value['started_at']))),
                'name' => $value['hall'][0]['title'],
                'price' => $value['price'],
            ];
        } else {
            $cinema['sans'][] = [
                'id' => $value['id'],
                'slug' => $value['slug'],
                'time' => convertDigitsToFarsi(date('H:i', strtotime($value['started_at']))),
                'name' => $value['hall'][0]['title'],
                'price' => $value['price'],
            ];
    
            $cinemas[$cinema['id']] = $cinema;
        }
    }
@endphp
@extends('.user.template')

@section('title')
    فیلم {{ $movie->title }} | سینما تیکت
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
            <h2 class="text-white pb-8 content">
                <span class="text-lg text-bold">فیلم {{ $movie->title }}</span>
                |
                <span class="text-xs">{{ $movie->director }}</span>
            </h2>
            <span class="text-right text-white text-xs pb-8 content ">{{ $movie->category->name }}</span>
            <div class=" flex items-center flex-row text-right mt-2 mb-8">
                <span class="text-right text-white text-sm content">
                    <span id="score">{{ convertDigitsToFarsi('5 / ' . $movie->score) }}</span>
                    <i class="fa-solid fa-heart text-red-600"></i>
                </span>
                <span class="text-right text-white text-sm content mx-4">
                    <i class="float-nav fa-solid fa-user"></i>
                    {{ convertDigitsToFarsi('120') }}
                </span>
                <span class="text-center text-white text-sm content ">
                    |
                </span>
                @auth
                    <button data-modal-target="score-modal" data-modal-toggle="score-modal"
                        class="flex items-center text-right text-white text-xs py-1 px-2 content mx-4 bg-glass-dark rounded-lg">
                        <i class="{{ $userScore > 0 ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                        <span class="pt-1 mr-2">امتیاز شما</span>
                    </button>
                @else
                    <a href="{{ route('user.login') }}"
                        class="flex items-center text-right text-white text-xs py-1 px-2 content mx-4 bg-glass-dark rounded-lg">
                        <i class="fa-regular fa-heart "></i>
                        <span class="pt-1 mr-2">امتیاز شما</span>
                    </a>
                @endauth
            </div>
            <div class="flex flex-row lg:justify-between justify-end items-center -mt-3">
                <div class="flex text-right">
                    @foreach ($movie->characters as $actor)
                        <a href="{{ route('actor.show', ['character' => $actor->id]) }}">
                            <div class="flex items-center ">
                                <img src="{{ $actor->avatar }}" alt="{{ $actor->name }}"
                                    class="w-12 h-12 rounded-lg object-cover">
                                <div class="ml-4 mr-1">
                                    <div class="font-medium text-lg text-white">{{ $actor->name }}</div>
                                    <div class="text-gray-500">{{ $actor->role }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-row lg:justify-start mt-5 right-0">
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
    @if ($movie->trailer)
        <div id="trailerModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <video class="w-full h-auto max-w-full border border-gray-200 rounded-lg" controls>
                        <source src="{{ url($movie->trailer) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    @endif

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
                            <a href="{{ route('actor.show', ['character' => $actor->id]) }}">

                                <div class="flex items-center mr-8">
                                    <img src="{{ $actor->avatar }}" alt="{{ $actor->name }}"
                                        class="w-12 h-12 rounded-lg object-cover">
                                    <div class="ml-4 mr-1">
                                        <div class="font-medium text-lg">{{ $actor->name }}</div>
                                        <div class="text-gray-500">{{ $actor->role }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white w-full rounded-lg mt-16 mb-16">

                    <div class="flex flex-row justify-between">

                        <div class="block">
                            <h1 class="text-gray-400 text-xl font-semibold	 mx-4 my-4">انتخاب و سانس</h1>

                            <div class="flex mt-6 text-sm font-light mb-5 px-8">
                                @if (!empty($cinemas))
                                    @foreach ($daysOfWeek as $key => $day)
                                        <div class="text-center ml-3 cursor-pointer">
                                            <p
                                                class="px-3.5 py-1.5 rounded-full {{ $key == 0 ? 'bg-gray-100' : '' }} mb-2.5 text-center">
                                                {{ $day[0] }}</p>
                                            <p class="text-center text-xs text-gray-700">{{ $day[1] . ' ' . $day[2] }}</p>
                                        </div>
                                    @endforeach
                                @endif
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
                                        class="block w-full text-gray-300 p-2 pl-10 text-sm text-gray-900 border-none rounded-xl bg-white-50"
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
                                        <div class="w-5/6 flex flex-row">
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
                                        </div>
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
                                            <a href="{{ route('cinema.show', ['cinema' => $cinema['id']]) }}" class="flex flex-row w-full">
                                                <h1 class="ml-1">درباره {{ $cinema['title'] }}</h1>
                                                <i class="fa-solid fa-chevron-left font-sm text-gray-500"></i>
                                            </a>
                                            <div class="flex flex-wrap flex-row w-full">
                                                @foreach ($cinema['sans'] as $cinemaSession)
                                                    <div class="basis-6-12 md:basis-8/12 sm:basis-8/12 my-2">
                                                        <h5>{{ $cinemaSession['name'] }}</h5>
                                                        <div
                                                            class="flex justify-between items-center border-2 rounded-xl p-3 bg-gray-50">
                                                            <div class="flex flex-col">
                                                                <p class="hover:text-red-500">
                                                                    <i
                                                                        class="fa-regular fa-clock text-gray-400 hover:text-red-500"></i>
                                                                    <span>سانس {{ $cinemaSession['time'] }}</span>
                                                                </p>
                                                                <span
                                                                    class="text-center font-thin text-sm mt-2">{{ convertDigitsToFarsi(number_format($cinemaSession['price'])) }}
                                                                    تومان</span>
                                                            </div>
                                                            <a href="{{ route('sans.show', ['sans' => $cinemaSession['slug']] ) }}"
                                                                class="hidden lg:flex px-3 py-2 items-center bg-red-500 text-sm text-gray-50 rounded-lg">
                                                                <i class="fas fa-ticket ml-2"></i>
                                                                <span>خرید بلیت</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="w-full flex justify-center items-center mt-8">
                            <div class="flex flex-col ">
                                <div class="flex justify-center mb-4">
                                    <img src="{{ url('images/session.svg') }}" alt="سینما تیکت">
                                </div>
                                <div>
                                    <a href="{{ route('movie.all') }}"
                                        class="py-3 px-4 text-white bg-red-500 rounded-lg">
                                        <i class="fa-solid fa-clapperboard ml-3"></i>
                                        <span>فیلم های دیگر</span>
                                    </a>
                                    <button id="city-btn-modal" data-modal-target="defaultModal"
                                        data-modal-toggle="defaultModal"
                                        class="mr-3 py-3 px-4 text-red-500 bg-white border-[1px] border-red-500 hover:bg-red-50 rounded-lg">
                                        <i class="fa-solid fa-location-dot ml-3"></i>
                                        <span>تغییر شهر (مشهد)</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="more-info-movie ">
                    <h2 class="font-bold text-gray-500 text-2xl ">سایر اطلاعات {{ $movie->title }}</h2>
                    <h3 class="font-medium text-base mt-3	">
                        سال ساخت :
                        {{ $formattedDateString}}
                    </h3>
                </div>


                <div class="bg-white w-full rounded-lg mt-16 mb-16 ">

                    <div class="flex flex-row ">

                        <h1 class="text-gray-400 text-xl font-semibold mx-4 my-4">دیدگاه های فیلم {{ $movie['title'] }}
                        </h1>
                        <p class="text-gray-400 text-sm font-normal	mx-4 mt-5">({{ convertDigitsToFarsi($commentCount) }}) دیدگاه ثبت شده</p>

                    </div>

                    <hr class="bg-gray-200 w-full" style="height: 1px" />


                    <form class="w-full p-5" method="POST" action="{{ route('comment.add') }}" >
                        @csrf
                        <div class="w-9/12 flex flex-col mx-auto mt-3">
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                            <textarea class="resize-none bg-gray-50 border-none border-gray-200 focus:border-gray-400 rounded-md p-2"
                                rows="4" maxlength="500" name="message" id="message" placeholder="دیدگاه شما ..."></textarea>
                            <div class="flex flex-row justify-between">
                                <p class="text-sm text-right text-gray-500 mt-6"><span id="message-counter">0</span>/500
                                </p>
                                @auth
                                    <button type="submit"
                                        class=" mt-2 bg-gray-400 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded mt-2">ارسال
                                        دیدگاه
                                    </button>
                                @else
                                       <a href="{{ route('user.login') }}"
                                        class=" mt-2 bg-gray-400 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded mt-2">ارسال
                                        دیدگاه
                                    </a> 
                            
                                @endauth

                            </div>
                        </div>
                    </form>


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
                                    <hr class="bg-gray-200 w-full mt-2" style="height: 1px" />
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
    @auth
        <!-- score Modal -->
        <div id="score-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white text-xs rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex flex-row-reverse items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center"
                            data-modal-hide="score-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            امتیاز شما به فیلم {{ $movie->title }}
                        </h3>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div onclick="selectScore(this, 1)"
                            class="{{ $userScore == 1 ? 'bg-slate-100 ' : '' }}flex cursor-pointer rounded-lg border-[1px] p-3 border-gray-200 my-2 hover:bg-gray-50 text-center justify-center itmes-center">
                            <span>۱/۵</span>
                            <i class="{{ $userScore == 1 ? 'text-rose-500 ' : '' }}mx-1 fas fa-heart"></i>
                            <span>اصلا فیلم خوبی نبود</span>
                        </div>
                        <div onclick="selectScore(this, 2)"
                            class="{{ $userScore == 2 ? 'bg-slate-100 ' : '' }}flex cursor-pointer rounded-lg border-[1px] p-3 border-gray-200 my-2 hover:bg-gray-50 text-center justify-center itmes-center">
                            <span>۲/۵</span>
                            <i class="{{ $userScore == 2 ? 'text-rose-500 ' : '' }}mx-1 fas fa-heart"></i>
                            <span>فیلم خوبی نبود ولی قابل تحمل بود</span>
                        </div>
                        <div onclick="selectScore(this, 3)"
                            class="{{ $userScore == 3 ? 'bg-slate-100 ' : '' }}flex cursor-pointer rounded-lg border-[1px] p-3 border-gray-200 my-2 hover:bg-gray-50 text-center justify-center itmes-center">
                            <span>۳/۵</span>
                            <i class="{{ $userScore == 3 ? 'text-rose-500 ' : '' }}mx-1 fas fa-heart"></i>
                            <span>فیلم متوسطی بود. نه خیلی خوب نه بد</span>
                        </div>
                        <div onclick="selectScore(this, 4)"
                            class="{{ $userScore == 4 ? 'bg-slate-100 ' : '' }}flex cursor-pointer rounded-lg border-[1px] p-3 border-gray-200 my-2 hover:bg-gray-50 text-center justify-center itmes-center">
                            <span>۴/۵</span>
                            <i class="{{ $userScore == 4 ? 'text-rose-500 ' : '' }}mx-1 fas fa-heart"></i>
                            <span>فیلم خوبی بود. میتونست بهتر باشه</span>
                        </div>
                        <div onclick="selectScore(this, 5)"
                            class="{{ $userScore == 5 ? 'bg-slate-100 ' : '' }}flex cursor-pointer rounded-lg border-[1px] p-3 border-gray-200 my-2 hover:bg-gray-50 text-center justify-center itmes-center">
                            <span>۵/۵</span>
                            <i class="{{ $userScore == 5 ? 'text-rose-500 ' : '' }}mx-1 fas fa-heart"></i>
                            <span>عالی بود ! انتظاراتم برآورده شد</span>
                        </div>
                        @csrf
                        <input type="hidden" id="movie_id" value="{{ $movie->id }}">
                        <input type="hidden" id="url" value="{{ route('movie.score') }}">
                    </div>
                    <!-- Modal footer -->
                    <div class="block p-6 w-full">
                        <button id="submit-score-btn" data-modal-hide="score-modal" type="button"
                            class="text-md text-white rounded-lg bg-red-500 py-3 px-4 w-full">ثبت امتیاز</button>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
