@php
    $cinemas = collect($cinemas);
    $topCinema = $cinemas->sortByDesc('score')->first();
@endphp
@extends('.user.template')

@section('title')
    سینماها | سینما تیکت
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cinema.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/cinema.js') }}"></script>
@endsection

@section('content')
    <section class="mt-12 lg:px-5">
        <div class="flex flex-row w-full justify-between">
            <div class="lg:basis-9/12 md:w-full sm:w-full pl-3">
                <div class="w-full bg-white py-5 px-2 rounded-lg">
                    <div class="w-full flex flex-row justify-between items-center">
                        <div class="text-sm">
                            <span class="p-2 hover:bg-gray-100 transition delay-300 cursor-pointer rounded-lg">همه
                                سینماها</span>
                            <span class="p-2 hover:bg-gray-100 transition delay-300 cursor-pointer rounded-lg">محبوب ترین
                                ها</span>
                            <span class="p-2 hover:bg-gray-100 transition delay-300 cursor-pointer rounded-lg">نزدیک ترین
                                ها</span>
                        </div>
                        <div class="flex flex-row p-2 hover:bg-gray-100 ml-2 rounded-lg cursor-pointer">
                            <i class="fa-solid fa-bars-staggered mx-1"></i>
                            <span>فیلتر امکانات</span>
                            <i class="fas fa-sort-down mx-1"></i>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row w-full mt-6 bg-white rounded-lg lg:p-6 ">
                    <div class="basis-3/12">
                        <img class="rounded-xl w-full" src="{{ url($topCinema['poster']) }}"
                            title="{{ $topCinema['title'] }}" alt="{{ $topCinema['title'] }}">
                    </div>
                    <div class="basis-9/12 mr-4">
                        <h2 class="text-lg text-gray-800 font-bold">{{ $topCinema['title'] }}</h2>
                        <p class="text-sm text-gray-500 mt-6 mb-3">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>{{ $topCinema['address'] }}</span>
                        </p>
                        <div class="mb-4">
                            @foreach ($topCinema['options'] as $option)
                                <span class="text-xs text-gray-800 ml-3 text-center">
                                    <i class="{{ $option['icon'] }} px-2.5 py-1.5 rounded-lg bg-gray-200"></i>
                                </span>
                            @endforeach
                        </div>
                        <a href="cinema/detail/{{ $topCinema['id'] }}"
                            class="text-white bg-red-500 px-3 py-2 rounded-lg text-xs">خرید بلیت</a>
                    </div>
                </div>
                <div class="flex flex-row w-full">
                    @foreach ($cinemas as $key => $cinema)
                        <div class="w-1/3">
                            <div class="rounded-2xl {{ ($key + 1 % 3 == 2) ? 'mx-3' : ''}}">
                                <div class="w-full h-24 relative" style="background-image: url({{ url($cinema['banner']) }})">
                                    <h2 class="absolute bottom-2 text-white font-bold right-3">{{ $cinema['title'] }}</h2>
                                </div>
                                <div>
                                    df
                                </div>
                            </div>
                        </div>
                    @endforeach
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
