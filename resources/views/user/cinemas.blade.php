@php
    $cinemas = collect($cinemas);
    $topCinema = $cinemas->sortByDesc('score')->first();
@endphp
@extends('.user.template')

@section('title')
    سینماها | سینما تیکت
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cinemas.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/cinema.js') }}"></script>
@endsection

@section('content')
    <section class="mt-12 lg:px-5">
        <div class="flex flex-row w-full justify-between">
            <div class="lg:basis-9/12 md:w-full sm:w-full pl-3">
                <div class="w-full bg-white py-5 px-2 rounded-lg">
                    <div class="w-full flex-row justify-between items-center hidden lg:flex md:flex sm:flex">
                        <div id="sortOptionContainer" class="text-sm">
                            <span onclick="SortCinemas(this, 'all', '{{ route('cinema.sort') }}')"
                                class="active p-2 hover:bg-gray-50 transition duration-300 cursor-pointer rounded-lg">همه
                                سینماها</span>
                            <span onclick="SortCinemas(this, 'top', '{{ route('cinema.sort') }}')"
                                class="p-2 hover:bg-gray-50 transition duration-300 cursor-pointer rounded-lg">محبوب ترین
                                ها</span>
                            <span onclick="SortCinemas(this, 'near', '{{ route('cinema.sort') }}')"
                                class="p-2 hover:bg-gray-50 transition duration-300 cursor-pointer rounded-lg">نزدیک ترین
                                ها</span>
                        </div>
                        <div id="option-filter"
                            class="flex flex-row items-center p-2 hover:bg-gray-100 ml-2 rounded-lg cursor-pointer transition duration-400">
                            <i class="fa-solid fa-bars-staggered mx-1"></i>
                            <span>فیلتر امکانات</span>
                            <i class="fas fa-sort-down mx-1 pb-2"></i>
                        </div>
                    </div>
                    <div class="w-full flex flex-row justify-between items-center lg:hidden md:hidden sm:hidden">
                        <div class="relative basis-11/12 ml-2">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text"
                                class="block w-full focus:ring-0 p-3 pl-10 text-sm text-gray-900 border-none rounded-lg bg-gray-100"
                                placeholder="جستجو ...">
                        </div>
                        <div
                            class="basis-1/12 p-4 flex flex-row justify-center items-center text-center text-red-500 rounded-full hover:bg-gray-100 transition duration-400">
                            <button data-tooltip-target="tooltip-default" type="button"
                                class="fa-solid fa-filter cursor-pointer"></button>
                            <div id="tooltip-default" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                فیلتر
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>
                    <div id="options-container" class="w-full flex flex-row flex-wrap mt-3 hidden">
                        @foreach ($options as $option)
                            <span
                                class="cursor-pointer flex ml-4 rounded-lg p-2 transition duration-400 hover:bg-gray-200 text-gray-700 text-xs text-thin">
                                <i class="{{ $option['icon'] }} ml-2"></i>
                                <span>{{ $option['title'] }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-wrap flex-row w-full mt-6 bg-white rounded-lg lg:p-6 ">
                    <div class="lg:basis-3/12 md:basis-4/12 basis-12/12">
                        <img class="rounded-xl w-full" src="{{ url($topCinema['poster']) }}"
                            title="{{ $topCinema['title'] }}" alt="{{ $topCinema['title'] }}">
                    </div>
                    <div class="lg:basis-8/12 md:basis-7/12 basis-12/12 mr-4 relative">
                        <h2 class="text-xl text-gray-800 font-bold">{{ $topCinema['title'] }}</h2>
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
                            class="text-white bg-red-500 px-3 py-2 relative bottom-0 rounded-lg text-xs">خرید بلیت</a>
                    </div>
                </div>
                <section class="p-0 mt-8">
                    <header class="my-2 text-lg">
                        <h2>همه سینماها</h2>
                    </header>
                    <div id="cinemasContainer" class="flex flex-row w-full flex-wrap">
                        @foreach ($cinemas as $cinema)
                            <a href="{{ route('cinema.show', ['cinema' => $cinema->id]) }}"
                                class="basis-6/12 lg:basis-4/12 md:basis-4/12 mb-5 rounded-b-2xl">
                                <div class="mx-1">
                                    <div class="blur-container w-full h-40 rounded-t-3xl relative bg-responsive"
                                        style="background-image: url({{ url($cinema['banner']) }})">
                                        <div class="blur-overlay"></div>
                                        <h2 class="absolute bottom-2 text-white font-bold right-3">{{ $cinema['title'] }}
                                        </h2>
                                    </div>
                                    <div class="bg-white rounded-b-2xl">
                                        <p class="pr-4 pt-3"><i
                                                class="fa-solid fa-location-dot ml-3"></i>{{ $cinema['address'] }}</p>
                                        <p
                                            class="text-gray-400 pt-2 pr-4 {{ $cinema['score'] > 4.0 ? 'text-green-400' : '' }}">
                                            <span
                                                class="font-bold">{{ convertDigitsToFarsi($cinema['score'] . '/5') }}</span>
                                            <i class="fas fa-star"></i>
                                        </p>
                                        <p class="pr-4 text-xs text-gray-900 pt-3 pb-5">
                                            @foreach ($cinema['options'] as $option)
                                                <i class="{{ $option['icon'] }} ml-2.5"></i>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
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
    <script>
        const baseUrl = "{{ route('home') }}";
        const cinemaUrl = `${baseUrl}/cinema/detail/`;

        function convertDigitsToFarsi(number) {
            const persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            const englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

            return number.replaceAll(new RegExp(englishDigits.join('|'), 'g'), (match) => {
                return persianDigits[englishDigits.indexOf(match)];
            });
        }

        function SortCinemas(element, val) {
            $("#sortOptionContainer").find("span.active").removeClass("active");
            $(element).addClass("active");

            $.ajax({
                url: "{{ route('cinema.sort') }}",
                data: {
                    sortValue: val,
                    _token: "{{ csrf_token() }}"
                },
                type: "POST",
                success: (response) => {
                    const cinemaContainer = $('#cinemasContainer');
                    const cinemas = response.cinemas;
                    $(cinemaContainer).html('');

                    if (cinemas) {
                        cinemas.forEach(cinema => {
                            let options = cinema.options;
                            let optionElement = '';

                            options.forEach(option => {
                                optionElement += `
                                    <i class="${option.icon} ml-2.5"></i>
                                `;
                            });

                            let is_top = cinema.score > 4.0 ? 'text-green-400' : '';
                            let score = convertDigitsToFarsi(`${cinema.score}/5`);
                            let element = `
                                <a href="${cinemaUrl}${cinema.id}"
                                    class="basis-6/12 lg:basis-4/12 md:basis-4/12 mb-5 rounded-b-2xl">
                                    <div class="mx-1">
                                        <div class="blur-container w-full h-40 rounded-t-3xl relative bg-responsive"
                                            style="background-image: url(${baseUrl}/${cinema.banner})">
                                            <div class="blur-overlay"></div>
                                            <h2 class="absolute bottom-2 text-white font-bold right-3">${cinema.title}
                                            </h2>
                                        </div>
                                        <div class="bg-white rounded-b-2xl">
                                            <p class="pr-4 pt-3"><i
                                                    class="fa-solid fa-location-dot ml-3"></i>${cinema.address}</p>
                                            <p
                                                class="text-gray-400 pt-2 pr-4 ${is_top}">
                                                <span
                                                    class="font-bold">${score}</span>
                                                <i class="fas fa-star"></i>
                                            </p>
                                            <p class="pr-4 text-xs text-gray-900 pt-3 pb-5">
                                                ${optionElement}
                                            </p>
                                        </div>
                                    </div>
                                </a>          
                                `;
                                cinemaContainer.append(element);
                        });
                    }
                },
                error: (xhr, status, err) => {
                    console.log(xhr);
                }
            })
        }
    </script>
@endsection
