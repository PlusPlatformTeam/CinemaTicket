@extends('admin.template')

@section('title')
    پیشخوان
@endsection
<link rel="stylesheet" href="{{ asset('css/multi_select.css') }}" />
<script src="{{ asset('js/multi_select.js') }}"></script>
<link type="text/css" rel="stylesheet" href="{{ url('datePicker/jalalidatepicker.min.css') }}" />
<script type="text/javascript" src="{{ url('datePicker/jalalidatepicker.min.js') }}"></script>
@section('content')
    <section class="p-4">
        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4 w-full">
            <div class="bg-white flex justify-between p-4 rounded-lg shadow-md items-center">
                <span class="flex items-center bg-green-500 rounded-lg py-4 px-5 text-white text-xl text-center ml-3">
                    <i class="fa-solid fa-film"></i>
                </span>
                <p>سینماها : {{ $cinemasCount }}</p>
            </div>
            <div class="bg-white flex justify-between p-4 rounded-lg shadow-md items-center">
                <span class="flex items-center bg-rose-500 rounded-lg py-4 px-5 text-white text-xl text-center ml-3">
                    <i class="fa-solid fa-video"></i>
                </span>
                <p>فیلم ها : {{ $moviesCount }}</p>
            </div>
            <div class="bg-white flex justify-between p-4 rounded-lg shadow-md items-center">
                <span class="flex items-center bg-purple-500 rounded-lg py-4 px-5 text-white text-xl text-center ml-3">
                    <i class="fas fa-users-rectangle"></i>
                </span>
                <p>بازیگران : {{ $actorsCount }}</p>
            </div>
            <div class="bg-white flex justify-between p-4 rounded-lg shadow-md items-center">
                <span class="flex items-center bg-amber-400 rounded-lg py-4 px-5 text-white text-xl text-center ml-3">
                    <i class="fa-solid fa-comments"></i>
                </span>
                <p>نظرات : {{$commentsCount}}</p>
            </div>
        </div>

        <header class="mt-6">
            <h1 class="bg-blue-400 px-4 py-3 rounded-t-lg text-xl text-gray-50">
                گزارش فروش پیشرفته
            </h1>
        </header>
        <main class="w-full py-5 px-3 grid grid-cols-3 gap-2 bg-gray-50">
            <div class="my-3">
                <label for="">شهر :</label>
                <select multiple id="cities-select">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-3">
                <label for="">فیلم :</label>
                <select multiple id="movies-select">
                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-3">
                <label for="">سینما :</label>
                <select multiple id="cinemas-select">
                    @foreach ($cinemas as $cinema)
                        <option value="{{ $cinema->id }}">{{ $cinema->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-3">
                <label for="">سالن :</label>
                <select multiple id="halls-select">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-3">
                <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 ">
                    <i class="fa-solid fa-calendar-days"></i>
                    از تاریخ :
                </label>
                <input data-jdp
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    id="started_at">
            </div>
            <div class="my-3">
                <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 ">
                    <i class="fa-solid fa-calendar-days"></i>
                    تا تاریخ :
                </label>
                <input data-jdp
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    id="end_at">
            </div>
        </main>
        <footer class="bg-gray-50 pb-4 flex justify-center">
            <button id="submit-search" class="px-8 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg text-white">جستجو</button>
        </footer>
    </section>
    <script>
        jalaliDatepicker.startWatch();
        new SlimSelect({
            select: '#cities-select',
            placeholder: 'شهرها را انتخاب کنید',
            showSearch: true,
            searchText: 'متاسفانه پیدا نشد',
        });
        new SlimSelect({
            select: '#cinemas-select',
            placeholder: 'شهرها را انتخاب کنید',
            showSearch: true,
            searchText: 'متاسفانه پیدا نشد',
        });
        new SlimSelect({
            select: '#halls-select',
            placeholder: 'شهرها را انتخاب کنید',
            showSearch: true,
            searchText: 'متاسفانه پیدا نشد',
        });
        new SlimSelect({
            select: '#movies-select',
            placeholder: 'شهرها را انتخاب کنید',
            showSearch: true,
            searchText: 'متاسفانه پیدا نشد',
        });

        $('#submit-search').on('click', (event) => {
            const city       = $('#cities-select').val();
            const cinema     = $('#cinemas-select').val();
            const hall       = $('#halls-select').val();
            const movie      = $('#movies-select').val();
            const started_at = $('#started_at').val();
            const end_at     = $('#end_at').val();

            console.log(city, cinema, hall, movie, started_at, end_at)
        });

    </script>
@endsection
