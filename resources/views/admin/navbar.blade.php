<style>
    #dropdownProfile {
        margin: 9px 30px !important;
    }
</style>

<nav class="sticky top-0 z-50">
    <div class="navbar-desktop">
        <nav class="bg-white text-xs light:bg-gray-900 ">
            <div class="flex flex-wrap justify-between items-center py-4 px-2">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.svg') }}" class="h-7 mr-3" alt="سینما تیکت" />
                    <img src="https://cinematicket.org/v3.17.6/assets/images/typography_dark.svg"
                        class="h-6 self-center text-2xl font-semibold whitespace-nowrap light:text-black" />
                </a>
                <form class="hidden md:block lg:block basis-3/12">
                    <div class="flex w-full">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="search-navbar" data-dropdown-toggle="mega-menu-dropdown"
                                class="block w-full p-2 pl-10 h-12 text-xs text-gray-900 border-none outline-0 rounded-xl bg-gray-50 focus:ring-0"
                                placeholder="جستجو ...">
                        </div>
                    </div>
                </form>
                <div >
                    <button id="dropdownProfileButton" data-dropdown-toggle="dropdownProfile"
                    class="p-1 pl-2 flex items-center justify-between text-sm font-medium text-gray-900 rounded-lg hover:bg-gray-50"
                    type="button">
                    <span class="sr-only"></span>
                    <img class="w-8 h-8 ml-2 rounded-full" src="{{ url('images/profile-mine.svg') }}"
                        alt="پروفایل">
                    <span class="hidden md:inline-block lg:inline-block">پروفایل</span>
                </button>

                <!-- dropdownProfile menu -->
                <div id="dropdownProfile"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-b-lg shadow-2xl origin-center mx-12 w-96 p-4 "
                    style="margin: 10px 30px !important">

                    <ul class="py-2 text-sm text-gray-700 text-gray-200 "
                        aria-labelledby="dropdownInformdropdownProfileButtonationButton">
                        <li class="p-2">
                            <a href="{{ route('user.profile') }}"
                                class="flex items-center p-4 hover:bg-gray-50 rounded-lg ">
                                <i class="fa-regular fa-pen-to-square ml-3"></i>
                                <span class="pt-1">اطلاعات کاربری</span>
                                <i class="fa-solid fa-angle-left mr-3"></i>
                            </a>
                        </li>
                        <li class="p-2">
                            <a href="{{ route('user.transaction') }}"
                                class="flex items-center p-4 hover:bg-gray-50 rounded-lg ">
                                <i class="fas fa-clipboard-check ml-3"></i>
                                <span class="pt-1">تراکنش های من</span>
                                <i class="fa-solid fa-angle-left mr-3"></i>
                            </a>
                        </li>
                        <li class="p-2">
                            <a href="{{ route('user.tickets') }}"
                                class="flex items-center p-4 hover:bg-gray-50 rounded-lg ">
                                <i class="fas fa-ticket ml-3"></i>
                                <span class="pt-1">بلیط های من</span>
                                <i class="fa-solid fa-angle-left mr-3"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="p-2">
                        <a id="logout-btn"
                            class="cursor-pointer flex items-center p-4 text-sm text-gray-700 rounded-lg hover:bg-gray-50 text-gray-200">
                            <i class="fas fa-arrow-right-from-bracket ml-3"></i>
                            <span class="pt-1">خروج از حساب کاربری</span>
                        </a>
                    </div>
                </div>
                </div>

            </div>
        </nav>
    </div>
</nav>

<div id="mega-menu-continer"class="hidden w-screen h-full t-0 relative flex z-50">
    <div class="blur-overlay-light"></div>
</div>

<script>
    $(document).ready(function() {
        $('#logout-btn').click(function() {
            const formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                type: 'POST',
                url: '{{ route('user.logout') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.href = '/';
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });


    $(document).ready(() => {
        const baseUrl = "{{ route('home') }}";
        const moviesUrl = baseUrl + "/movie/";
        const cinemasUrl = baseUrl + "/cinema/detail/";

        $('#search-navbar').on('click', (event) => {
            $.ajax({
                url: "{{ route('search') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    value: event.target.value
                },
                success: (response) => {
                    const topMovies = response.topMovies;
                    const topCinemas = response.topCinemas;
                    const movieItemContainer = $('#movie-item-container');
                    const cinemaItemContainer = $('#cinema-item-container');

                    $(movieItemContainer).html('');
                    $(cinemaItemContainer).html('');

                    if (topMovies) {
                        topMovies.forEach(movie => {
                            const element = `
                                    <div class="basis-4/12 p-3">
                                        <a href="${moviesUrl}${movie.slug}" class="movie-item relative block mx-auto" style="margin-bottom: 1rem;">
                                            <div class="flex justify-center">
                                                <img class="object-cover w-full h-full max-w-xs rounded-lg inline-block content"
                                                    src="${baseUrl}/${movie.main_banner}" title="${movie.title}" alt="${movie.title}">
                                            </div>
                                            <div class="w-full text-center text-xs mt-3">
                                                <span>${movie.title}</span>
                                            </div>
                                        </a>
                                    </div>
                                `;
                            movieItemContainer.append(element);
                        });
                    }

                    if (topCinemas) {
                        topCinemas.forEach(cinema => {
                            const element = `
                                    <div class="basis-4/12 p-3">
                                        <a href="${cinemasUrl}${cinema.id}" class="movie-item relative block mx-auto" style="margin-bottom: 1rem;">
                                            <div class="flex justify-center">
                                                <img class="object-cover w-full h-full max-w-xs rounded-lg inline-block content"
                                                    src="${baseUrl}/${cinema.poster}" title="${cinema.title}" alt="${cinema.title}">
                                            </div>
                                            <div class="w-full text-center text-xs mt-3">
                                                <span>${cinema.title}</span>
                                            </div>
                                        </a>
                                    </div>
                                `;
                            cinemaItemContainer.append(element);
                        });
                    }
                },
                error: (xhr, status, error) => {
                    console.error(xhr); //TODO Handle it
                }
            })
        });

        let timeoutSearchInput;
        $('#search-navbar').on('keyup', (event) => {
            clearTimeout(timeoutSearchInput);

            timeoutSearchInput = setTimeout(() => {
                const searchValue = event.target.value;
                $.ajax({
                    url: "{{ route('search') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        value: searchValue
                    },
                    success: (response) => {
                        const topMovies = response.topMovies;
                        const topCinemas = response.topCinemas;
                        const movieItemContainer = $('#movie-item-container');
                        const cinemaItemContainer = $('#cinema-item-container');

                        $(movieItemContainer).html('');
                        $(cinemaItemContainer).html('');

                        if (topMovies) {
                            topMovies.forEach(movie => {
                                const element = `
                                    <div class="basis-4/12 p-3">
                                        <a href="${moviesUrl}${movie.slug}" class="movie-item relative block mx-auto" style="margin-bottom: 1rem;">
                                            <div class="flex justify-center">
                                                <img class="object-cover w-full h-full max-w-xs rounded-lg inline-block content"
                                                    src="${baseUrl}/${movie.main_banner}" title="${movie.title}" alt="${movie.title}">
                                            </div>
                                            <div class="w-full text-center text-xs mt-3">
                                                <span>${movie.title}</span>
                                            </div>
                                        </a>
                                    </div>
                                `;
                                movieItemContainer.append(element);
                            });
                        }

                        if (topCinemas) {
                            topCinemas.forEach(cinema => {
                                const element = `
                                    <div class="basis-4/12 p-3">
                                        <a href="${cinemasUrl}${cinema.id}" class="movie-item relative block mx-auto" style="margin-bottom: 1rem;">
                                            <div class="flex justify-center">
                                                <img class="object-cover w-full h-full max-w-xs rounded-lg inline-block content"
                                                    src="${baseUrl}/${cinema.poster}" title="${cinema.title}" alt="${cinema.title}">
                                            </div>
                                            <div class="w-full text-center text-xs mt-3">
                                                <span>${cinema.title}</span>
                                            </div>
                                        </a>
                                    </div>
                                `;
                                cinemaItemContainer.append(element);
                            });
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error(xhr); //TODO Handle it
                    }
                })
            }, 800);
        });

        $('#city-btn-modal').on('click', (event) => {
            const cityContainer = $('#city-container');
            $(cityContainer).html('');

            $.ajax({
                url: "{{ route('city.all') }}",
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: (response) => {
                    const cities = response.cities;

                    cities.forEach(city => {
                        let elemnt = `
                            <span class=" p-2 rounded-md cursor-pointer hover:text-black hover:bg-gray-100">
                                ${city.title}
                            </span>
                        `;

                        cityContainer.append(elemnt);
                    })
                },
                error: (xhr, status, err) => {
                    console.log(xhr);
                }
            })
        });
    });
</script>
