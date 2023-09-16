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
                <p>نظرات : {{ $commentsCount }}</p>
            </div>
        </div>

        <header class="mt-6">
            <h1 class="bg-blue-400 px-4 py-3 rounded-t-lg text-xl text-gray-50">
                گزارش فروش پیشرفته
            </h1>
        </header>
        <main class="w-full py-5 px-3 grid grid-cols-3 gap-2 bg-gray-50">
            <div class="my-3">
                <label class="block mb-2" for="">شهر :</label>
                <select id="cities-select">
                    <option value="0">انتخاب کنید ...</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-3">
                <label class="block mb-2" for="">فیلم :</label>
                <select multiple id="movies-select">
                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: none" id="cinemas-container" class="my-3">
                <label class="block mb-2" for="">سینما :</label>
                <select id="cinemas-select">
                    <option value="0">انتخاب کنید ...</option>
                    @foreach ($cinemas as $cinema)
                        <option value="{{ $cinema->id }}">{{ $cinema->title }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: none" id="halls-container" class="my-3">
                <label class="block mb-2" for="">سالن :</label>
                <select multiple id="halls-select">
                </select>
            </div>
            <div class="my-3">
                <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 ">
                    <i class="fa-solid fa-calendar-days"></i>
                    از تاریخ :
                </label>
                <input autocomplete="off" data-jdp
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    id="started_at">
            </div>
            <div class="my-3">
                <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 ">
                    <i class="fa-solid fa-calendar-days"></i>
                    تا تاریخ :
                </label>
                <input autocomplete="off" data-jdp
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    id="end_at">
            </div>
        </main>
        <footer class="bg-gray-50 pb-4 flex justify-center">
            <button id="submit-search" class="px-8 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg text-white">جستجو</button>
        </footer>

        <div class="relative overflow-x-auto shadow-md rounded-b-lg">
            <div id="totalPriceContainer" style="display:none" class="text-lg text-gray-700 bg-gray-50">
                مجموع : <span id="totalPrice"></span> تومان
            </div>
            <table style="display: none" id="result" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs border border-1 border-gray-100 text-gray-700 uppercase bg-blue-50">
                    <tr>
                        <th scope="col" class="text-center px-6 py-3">
                            کاربر
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            فیلم
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            سینما
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            سالن
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            مبلغ
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            تاریخ پرداخت
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
            <div style="display: none" class="text-center bg-yellow-100 text-yellow-600 py-4 text-lg" id="msg">نتیجه ای یافت نشد</div>
        </div>

    </section>
    <script>
        jalaliDatepicker.startWatch();
        let hallSelect = null;
        let cinemaSelect = null;
        new SlimSelect({
            select: '#cities-select',
            showSearch: true,
            searchText: 'متاسفانه پیدا نشد',
        });

        new SlimSelect({
            select: '#movies-select',
            showSearch: true,
            searchText: 'متاسفانه پیدا نشد',
        });

        $('#cities-select').on('change', (event) => {
            $('#cinemas-container').show();
            $.ajax({
                url: "{{ route('cinema.get.by.city') }}",
                type: "POST",
                data: {
                    city: event.target.value,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: (response) => {
                    $('#cinemas-container select').html('');
                    const cinemas = response.cinemas;
                    cinemas.forEach(cinema => {
                        let element = `<option value = ${cinema.id}>${cinema.title}</option>`;
                        $('#cinemas-container select').append(element);
                    });
                    if (cinemaSelect) {
                        cinemaSelect.destroy();
                    }
                    cinemaSelect = new SlimSelect({
                        select: '#cinemas-select',
                        showSearch: true,
                        searchText: 'متاسفانه پیدا نشد',
                    });
                },
                error: (xhr, status, err) => {
                    console.log(xhr)
                }
            });
        });

        $('#cinemas-select').on('change', (event) => {
            $('#halls-container').show();
            $.ajax({
                url: "{{ route('hall.get') }}",
                type: "POST",
                data: {
                    cinema: event.target.value,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: (response) => {
                    $('#halls-container select').html('');
                    response.forEach(hall => {
                        let element =
                            `<option value = ${hall.id}>${hall.title} - ظرفیت: ${hall.capacity}</option>`;
                        $('#halls-container select').append(element);
                    });
                    if (hallSelect) {
                        hallSelect.destroy();
                    }
                    hallSelect = new SlimSelect({
                        select: '#halls-select',
                        showSearch: true,
                        searchText: 'متاسفانه پیدا نشد',
                    });
                },
                error: (xhr, status, err) => {
                    console.log(xhr)
                }
            });
        });

        $('#submit-search').on('click', (event) => {
            const city = $('#cities-select').val();
            const cinema = $('#cinemas-select').val();
            const hall = $('#halls-select').val();
            const movie = $('#movies-select').val();
            const started_at = $('#started_at').val();
            const end_at = $('#end_at').val();
            console.log(hall)
            $('#tbody').html('');
            $.ajax({
                url: "{{ route('ticket.serach') }}",
                type: "POST",
                data: {
                    hall: hall,
                    movie: movie,
                    started_at: started_at,
                    end_at: end_at,
                    cinema: cinema,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: (response) => {
                    if(response.total)
                    {
                        $('#result').show();
                        $('#msg').hide();
                        $('#totalPriceContainer').show();
                        const payments = response.payments;
                        payments.forEach(payment => {
                            let row = `
                                <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                                    <td scope="row" class="px-6 text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${payment.user.name}</td>
                                    <td scope="row" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">${payment.movie.title}</td>
                                    <td scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">${payment.cinema.title}</td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">${payment.hall.title}</td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center dark:text-white">${payment.factor.price}</td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">${payment.paid_time}</td>
                                </tr>
                            `;

                            $('#tbody').append(row);
                        });
                        $('#totalPriceContainer').show();
                        $('#totalPrice').text(response.totalPrice);
                    }
                    else{
                        $('#totalPriceContainer').hide();
                        $('#result').hide();
                        $('#msg').show();
                        $('#hide').show();
                    }
                },
                error: (xhr, status, err) => {
                    $('#result').hide();
                    $('#msg').show();
                    $('#hide').show();
                }
            });
        });
    </script>
@endsection
