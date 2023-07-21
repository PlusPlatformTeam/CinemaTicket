@php
    $movies = [];
    foreach ($sans as $key => $value) 
    {
        $movie = $value['movie'][0];

        if (array_key_exists($movie['slug'], $movies))
        {
            $movies[$movie['slug']]['sans'][] = [
                'id'   => $value['id'],
                'slug' => $value['slug'],
                'time' => convertDigitsToFarsi(date('H:i', strtotime($value['started_at']))),
                'name' => $value['hall'][0]['title'],
                'price'=> $value['price'],
            ];
        }
        else
        {
            $movie['sans'][] = [
                'id'   => $value['id'],
                'slug' => $value['slug'],
                'time' => convertDigitsToFarsi(date('H:i', strtotime($value['started_at']))),
                'name' => $value['hall'][0]['title'],
                'price'=> $value['price'],
            ];

            $movies[$movie['slug']] = $movie;
        }
        
        // echo "<pre style='text-align:left' dir='ltr'>";
        // var_dump($value['movie'][0]);
        // echo "</pre>";
    }
    // dd($movies);
@endphp 
</div>
@extends('.user.template')

@section('title')
    {{$cinema->title}} | سینما تیکت
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
        <div class="relative w-full flex flex-row flex-wrap lg:p-10 blur-container bg-responsive" style="background-image: url({{ url($cinema->banner) }})">
            <div class="blur-overlay-light"></div>
            <div class="basis-2-5">
                <img class="rounded-xl" src="{{ url($cinema->poster) }}" alt="{{ $cinema->title }}" title="{{ $cinema->title }}">
            </div>
            <div class="basis-9/12 pr-4 py-0.5 flex justify-between flex-col py-0.5">
                <p class="text-gray-800 text-lg mb-1.5">{{ $cinema->title }}</p>
                <p class=" text-gray-600 text-sm mb-1.5"><i class="fas fa-location-dot ml-1"></i> {{ $cinema->address }}</p>
                <p class="mb-2.5">
                    <span class="text-gray-500">{{ convertDigitsToFarsi($cinema->score.'/'.'5') }} <i class="fas fa-star"></i></span>
                    <span class="px-1.5 py-1 text-sm rounded-xl bg-gray-300 inline-flex items-center">
                        <i class="fas fa-star text-green-400"></i>
                        <span class="text-white pt-1 pr-1.5">امتیاز شما</span>
                    </span>
                </p>
                <p class="">
                    @foreach ($cinema->options as $option)
                        <i class="{{$option['icon']}} ml-3"></i>
                    @endforeach
                </p>
            </div>
    </header>
    <main class="mt-5">
        <div class="flex">
            <div class="lg:basis-9/12 md:basis-9/12 basis-full bg-white pt-6 rounded-lg mx-3">
                <div class="flex flex-row justify-between items-center px-8">
                    <p class="text-gray-700">برنامه اکران {{ $cinema->title }}</p>
                    <div class="text-xs">
                        <button class="bg-transparent px-4 py-2 ml-1 hover:bg-gray-100 rounded-full">سانس</button>
                        <button class="bg-transparent px-4 py-2 hover:bg-gray-100 rounded-full">فیلم</button>
                    </div>
                </div>
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
                @foreach ($movies as $movie)
                    <div class="flex flex-wrap my-4 hover:bg-gray-100 cursor-pointer p-3">
                        <div class="basis-2/12">
                            <img class="rounded-lg" src="{{ url($movie['main_banner']) }}" title="{{ $movie['title'] }}" alt="{{ $movie['title'] }}">
                        </div>
                        <div class="basis-1/12"></div>
                        <div class="basis-9/12 flex flex-col justify-between">
                            <div class="flex justify-between items-center">
                                <p class="text-sm">{{ $movie['title'] }} | <span class="text-gray-500">{{ $movie['director'] }}</span></p>
                                <button class="text-red-500 flex items-center hover:bg-red-50 p-2 rounded-lg">
                                    <span>
                                        سانس ها
                                    </span>
                                    <i class="fa-solid fa-angle-down mr-3"></i>
                                </button>
                            </div>
                            <div>
                                <span class="lg:p-2 p-1 rounded-lg text-xs bg-gray-200 ">{{ $movie['category']['name'] }}</span>
                            </div>
                            <div>
                                <span class="ml-3">
                                    <span>{{ convertDigitsToFarsi($movie['score'].'/'.'5') }}</span>
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
                                        <img class="w-8 h-8 rounded-lg object-cover" src="{{$character['avatar']}}" alt="{{$character['name']}}" title="{{$character['name']}}">
                                        <span class="text-xs mr-2">{{$character['name']}}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-3 mt-3 basis-full">
                            <a href="{{ route('movie.show', ['slug' => $movie['slug']]) }}" class="text-xs text-gray-700 mb-8 hover:text-red-600">درباره {{$movie['title']}} <i class="fa-solid fa-angle-left mr-2"></i></a>
                            <div class="flex flex-wrap flex-row w-full">
                                @foreach ($movie['sans'] as $movieSession)
                                    <div class="basis-6-12 md:basis-8/12 sm:basis-8/12 my-2">
                                        <h5>{{ $movieSession['name'] }}</h5>
                                        <div class="flex justify-between items-center border-2 rounded-xl p-3 bg-gray-50">
                                            <div class="flex flex-col">
                                                <p class="hover:text-red-500">
                                                    <i class="fa-regular fa-clock text-gray-400 hover:text-red-500"></i>
                                                    <span>سانس {{ $movieSession['time'] }}</span>
                                                </p>
                                                <span class="text-center font-thin text-sm mt-2">{{ convertDigitsToFarsi(number_format($movieSession['price'])) }} تومان</span>
                                            </div>
                                            <button class="hidden lg:flex px-3 py-2 items-center bg-red-500 text-sm text-gray-50 rounded-lg">
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
            </div>
            <div class="hidden lg:block md:block lg:basis-3/12 md:basis-3/12 mx-3">
                <div class="w-96 mb-6">
                    <iframe class="w-full rounded-lg border-8 border-gray-50" height="270" loading="lazy" allowfullscreen src="https://map.ir/lat/36.3238301/lng/59.5586102/z/17/p/%D9%85%D8%A7%20%D8%A7%DB%8C%D9%86%D8%AC%D8%A7%DB%8C%DB%8C%D9%85 " frameborder="1"></iframe>
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
                                    <p class="text-gray-600">{{ convertDigitsToFarsi(number_format($tMovies->sale)) }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </main>
</section>
@endsection