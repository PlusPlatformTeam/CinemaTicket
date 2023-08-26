@php
    $movies = [];
    foreach ($sans as $key => $value) {
        $movie = $value['movie'][0];
    
        if (array_key_exists($movie['slug'], $movies)) {
            $movies[$movie['slug']]['sans'][] = [
                'id' => $value['id'],
                'slug' => $value['slug'],
                'time' => convertDigitsToFarsi(date('H:i', strtotime($value['started_at']))),
                'name' => $value['hall'][0]['title'],
                'price' => $value['price'],
            ];
        } else {
            $movie['sans'][] = [
                'id' => $value['id'],
                'slug' => $value['slug'],
                'time' => convertDigitsToFarsi(date('H:i', strtotime($value['started_at']))),
                'name' => $value['hall'][0]['title'],
                'price' => $value['price'],
            ];
    
            $movies[$movie['slug']] = $movie;
        }
    }
    // echo "<pre style='text-align:left' dir='ltr'>";
    // var_dump($daysOfWeek);
    // echo "</pre>";
    // dd($movies);
@endphp
</div>
@extends('.user.template')
@section('title')
    {{ $cinema->title }} | سینما تیکت
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cinema.css') }}">
@endsection
@section('js')
    <script src="{{ asset('/js/cinema.js') }}"></script>
@endsection
@section('content')
    <section class="p-0 m-0">
        <header>
            <div class="relative w-full flex flex-row flex-wrap lg:p-10 blur-container bg-responsive"
                style="background-image: url({{ url($cinema->banner) }})">
                <div class="blur-overlay-light"></div>
                <div class="basis-2-5">
                    <img class="rounded-xl" src="{{ url($cinema->poster) }}" alt="{{ $cinema->title }}"
                        title="{{ $cinema->title }}">
                </div>
                <div class="basis-9/12 pr-4 py-0.5 flex justify-between flex-col py-0.5">
                    <p class="text-gray-800 text-lg mb-1.5">{{ $cinema->title }}</p>
                    <p class=" text-gray-600 text-sm mb-1.5"><i class="fas fa-location-dot ml-1"></i> {{ $cinema->address }}
                    </p>
                    <p class="mb-2.5 flex items-center">
                        <span class="text-gray-500 flex items-center justify-between">
                            <span class="pt-2.5" id="score">{{ convertDigitsToFarsi($cinema->score . '/' . '5') }}</span> 
                                <i class="fas fa-star"></i>
                            </span>
                        @auth
                            <button data-modal-target="score-modal" data-modal-toggle="score-modal" type="button"
                                class="px-1.5 py-1 text-sm rounded-xl bg-gray-300 inline-flex items-center">
                                <i class="fas fa-star text-green-400"></i>
                                <span class="text-white pt-1 pr-1.5">امتیاز شما</span>
                            </button>
                        @else
                            <a href="{{ route('user.login') }}"
                                class="flex items-center text-right text-white text-xs py-1 px-2 content mx-4 bg-glass-dark rounded-lg">
                                <i class="fa-regular fa-heart "></i>
                                <span class="pt-1 mr-2">امتیاز شما</span>
                            </a>
                        @endauth
                    </p>
                    <p class="">
                        @foreach ($cinema->options as $option)
                            <i class="{{ $option['icon'] }} ml-3"></i>
                        @endforeach
                    </p>
                </div>
        </header>
        <main class="mt-5">
            <div class="flex">
                <div class="lg:basis-9/12 md:basis-9/12 basis-full bg-white pt-6 rounded-lg mx-3">
                    <div class="flex flex-row justify-between items-center px-8">
                        <p class="text-gray-700">برنامه اکران {{ $cinema->title }}</p>
                        <div class="text-xs {{ empty($movies) ? 'hidden' : '' }}">
                            <button class="bg-transparent px-4 py-2 ml-1 hover:bg-gray-100 rounded-full">سانس</button>
                            <button class="bg-transparent px-4 py-2 hover:bg-gray-100 rounded-full">فیلم</button>
                        </div>
                    </div>
                    <div class="flex mt-6 text-sm font-light mb-5 px-8">
                        @if (!empty($movies))
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
                    @if (empty($movies))
                        
                    @else
                        @foreach ($movies as $movie)
                            <div class="flex flex-wrap my-4 hover:bg-gray-100 cursor-pointer p-3">
                                <div class="basis-2/12">
                                    <img class="rounded-lg" src="{{ url($movie['main_banner']) }}"
                                        title="{{ $movie['title'] }}" alt="{{ $movie['title'] }}">
                                </div>
                                <div class="basis-1/12"></div>
                                <div class="basis-9/12 flex flex-col justify-between">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm">{{ $movie['title'] }} | <span
                                                class="text-gray-500">{{ $movie['director'] }}</span></p>
                                        <button class="text-red-500 flex items-center hover:bg-red-50 p-2 rounded-lg">
                                            <span>
                                                سانس ها
                                            </span>
                                            <i class="fa-solid fa-angle-down mr-3"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <span
                                            class="lg:p-2 p-1 rounded-lg text-xs bg-gray-200 ">{{ $movie['category']['name'] }}</span>
                                    </div>
                                    <div>
                                        <span class="ml-3">
                                            <span>{{ convertDigitsToFarsi($movie['score'] . '/' . '5') }}</span>
                                            <i class="fas fa-heart text-red-400 text-xs"></i>
                                        </span>
                                        <span>
                                            {{ convertDigitsToFarsi(rand(100, 999)) }}
                                            <i class="fa-regular fa-user"></i>
                                        </span>
                                    </div>
                                    <div class="hidden lg:flex md:flex">
                                        @foreach ($movie['characters'] as $character)
                                            <div class="flex items-center ml-3">
                                                <img class="w-8 h-8 rounded-lg object-cover"
                                                    src="{{ $character['avatar'] }}" alt="{{ $character['name'] }}"
                                                    title="{{ $character['name'] }}">
                                                <span class="text-xs mr-2">{{ $character['name'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="p-3 mt-3 basis-full">
                                    <a href="{{ route('movie.show', ['movie' => $movie['slug']]) }}"
                                        class="text-xs text-gray-700 mb-8 hover:text-red-600">درباره {{ $movie['title'] }}
                                        <i class="fa-solid fa-angle-left mr-2"></i></a>
                                    <div class="flex flex-wrap flex-row w-full">
                                        @foreach ($movie['sans'] as $movieSession)
                                            <div class="basis-6-12 md:basis-8/12 sm:basis-8/12 my-2">
                                                <h5>{{ $movieSession['name'] }}</h5>
                                                <div
                                                    class="flex justify-between items-center border-2 rounded-xl p-3 bg-gray-50">
                                                    <div class="flex flex-col">
                                                        <p class="hover:text-red-500">
                                                            <i
                                                                class="fa-regular fa-clock text-gray-400 hover:text-red-500"></i>
                                                            <span>سانس {{ $movieSession['time'] }}</span>
                                                        </p>
                                                        <span
                                                            class="text-center font-thin text-sm mt-2">{{ convertDigitsToFarsi(number_format($movieSession['price'])) }}
                                                            تومان</span>
                                                    </div>
                                                    <button
                                                        class="hidden lg:flex px-3 py-2 items-center bg-red-500 text-sm text-gray-50 rounded-lg">
                                                        <i class="fas fa-ticket ml-2"></i>
                                                        <span>خرید بلیت</span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="bg-white w-full rounded-lg mt-16 mb-16">
                            <div class="flex flex-row p-4">
                                <h1 class="text-gray-400 text-xl font-semibold mx-4 my-4">دیدگاه های کاربران {{ $cinema['title'] }}
                                </h1>
                                <p class="text-gray-400 text-sm font-normal	mx-4 mt-5">({{ convertDigitsToFarsi($commentCount) }}) دیدگاه ثبت شده
                                </p>
                        
                            </div>
                            <hr class="bg-gray-200 w-full" style="height: 1px" />
                            <form class="w-full py-3" method="POST" action="{{ route('comment.add') }}">
                                @csrf
                                <div class="w-9/12 flex flex-col mx-auto mt-3">
                                    <input type="hidden" name="cinema_id" value="{{ $cinema->id }}">
                                    <textarea class="resize-none bg-gray-50 border-none border-gray-200 focus:border-gray-400 rounded-md p-2" rows="4"
                                        maxlength="500" name="message" id="message" placeholder="دیدگاه شما ..."></textarea>
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
                    @endif
                </div>
                <div class="hidden lg:block md:block lg:basis-3/12 md:basis-3/12 mx-3">
                    @php
                        if (!is_array($cinema->location)) // TODO fix 
                            $cinema->location = json_decode($cinema->location, true)
                    @endphp
                    <div class="w-96 mb-6">
                        <iframe class="w-full rounded-lg border-8 border-gray-50" height="270" loading="lazy"
                            allowfullscreen
                            src="https://map.ir/lat/{{ $cinema->location['lat'] }}/lng/{{ $cinema->location['lng'] }}/z/17/p/%D9%85%D8%A7%20%D8%A7%DB%8C%D9%86%D8%AC%D8%A7%DB%8C%DB%8C%D9%85 "
                            frameborder="1"></iframe>
                    </div>
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
        </main>
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
                            امتیاز شما به {{ $cinema->title }}
                        </h3>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 flex justify-between">
                        <button onclick="selectScore(this, 1)" type="button"
                            class="{{ $userScore == 1 ? 'bg-slate-100 ' : '' }}text-bold text-lg border-[1px] border-gray-200 py-2 px-4 rounded-xl text-center hover:bg-gray-100 active:bg-slate-100 focus:bg-slate-100">۱</button>
                        <button onclick="selectScore(this, 2)" type="button"
                            class="{{ $userScore == 2 ? 'bg-slate-100 ' : '' }}text-bold text-lg border-[1px] border-gray-200 py-2 px-4 rounded-xl text-center hover:bg-gray-100 active:bg-slate-100 focus:bg-slate-100">۲</button>
                        <button onclick="selectScore(this, 3)" type="button"
                            class="{{ $userScore == 3 ? 'bg-slate-100 ' : '' }}text-bold text-lg border-[1px] border-gray-200 py-2 px-4 rounded-xl text-center hover:bg-gray-100 active:bg-slate-100 focus:bg-slate-100">۳</button>
                        <button onclick="selectScore(this, 4)" type="button"
                            class="{{ $userScore == 4 ? 'bg-slate-100 ' : '' }}text-bold text-lg border-[1px] border-gray-200 py-2 px-4 rounded-xl text-center hover:bg-gray-100 active:bg-slate-100 focus:bg-slate-100">۴</button>
                        <button onclick="selectScore(this, 5)" type="button"
                            class="{{ $userScore == 5 ? 'bg-slate-100 ' : '' }}text-bold text-lg border-[1px] border-gray-200 py-2 px-4 rounded-xl text-center hover:bg-gray-100 active:bg-slate-100 focus:bg-slate-100">۵</button>
                        @csrf
                        <input type="hidden" id="cinema_id" value="{{ $cinema->id }}">
                        <input type="hidden" id="url" value="{{ route('cinema.score') }}">
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