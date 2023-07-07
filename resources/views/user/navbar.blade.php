<style>
    .float-nav {
        color: #9CA3AF;
    }

    .navbar-desktop {
        display: none;
    }

    .navbar-mobile {
        display: block;
    }

    .float-nav:hover {
        color: #878a8e;
    }

    @media only screen and (min-width: 1190px) {
        /* Show navbar-desktop on screens wider than 768px */

        .navbar-desktop {
            display: block;
        }

        /* Hide navbar-mobile on screens wider than 768px */
        .navbar-mobile {
            display: none;
        }
    }
</style>

<nav class="sticky top-0 z-20">
    <div class="navbar-desktop">
        <nav class="bg-white text-sm white-gray-200 light:bg-gray-900 ">
            <div class="max-w-screen-xxl flex flex-wrap items-center  mx-auto py-4 px-2">
                <a href="https://flowbite.com/" class="flex items-center">
                    <img src="{{ asset('images/logo.svg') }}" class="h-8 mr-3" alt="Flowbite Logo" />
                    <img src="https://cinematicket.org/v3.17.6/assets/images/typography_dark.svg"
                        class="self-center text-2xl font-semibold whitespace-nowrap light:text-black" />
                </a>


                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 md:flex-row md:space-x-4 md:mt-0 md:border-0">
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-black md:bg-transparent md:text-black-700 md:dark:bg-transparent"
                            aria-current="page">
                            <i class="w-5 h-5 inline-block mr-2 fa-solid fa-clapperboard" /></i>
                            فیلم و تئاتر
                        </a>
                    </li>
                    <li>
                        <a href="{{route('cinema.index')}}"
                            class="block py-2 px-4 text-black rounded-xl hover:bg-red-50 hover:text-red-500 transition delay-400"
                            aria-current="page">
                            <i class="w-5 h-5 inline-block mr-2 fa-solid fa-film" /></i>
                            سینما
                        </a>
                    </li>
                </ul>


                <form>
                    <div class="flex px-2">
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only light:text-gray-100">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="search-navbar"
                            id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown"
                                class="block w-full p-2 pl-10 text-sm text-gray-900 border-none rounded-xl bg-white-50 dark:bg-gray-50 dark:placeholder-gray-600 dark:text-gray"
                                placeholder="جست و جوی فیلم و سینما">
                        </div>
                    </div>
                </form>





                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 md:flex-row md:space-x-4 md:mt-0 md:border-0 absolute left-1">

                    <li>
                        <!-- Modal toggle -->

                        <a href="#" aria-current="page" data-modal-target="defaultModal"
                            data-modal-toggle="defaultModal"
                            class="block py-2 pl-3 pr-4 text-black md:bg-transparent md:text-black-700 md:dark:bg-transparent">

                            <i class="w-5 h-5 inline-block mr-2 fa-solid fa-location-dot" /></i>
                            شهر خود را انتخاب کنید
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-black md:bg-transparent md:text-black-700 md:dark:bg-transparent"
                            aria-current="page">
                            <i class="w-5 h-5 inline-block mr-2 fa-solid fa-ticket" /></i>
                            بلیط های من
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-black md:bg-transparent md:text-black-700 md:dark:bg-transparent"
                            aria-current="page">
                            <i class="w-5 h-5 inline-block mr-2 fa-regular fa-user" /></i>
                            ورود یا ثبت نام
                        </a>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</nav>

<div class="navbar-mobile">



<nav class="bg-white white-gray-200 light:bg-gray-900 ">
        <div class="max-w-screen-xxl flex flex-wrap items-center  mx-auto py-4 px-2">
            <a href="https://flowbite.com/" class="flex items-center">
                <img src="{{ asset('images/logo.svg') }}" class="h-8 mr-3" alt="Flowbite Logo" />
                <img src="https://cinematicket.org/v3.17.6/assets/images/typography_dark.svg"
                    class="self-center text-2xl font-semibold whitespace-nowrap light:text-black" />
            </a>

            <ul
                class="flex font-medium p-4 md:p-0 mt-4 md:flex-row md:space-x-4 md:mt-0 md:border-0 absolute left-1 float">

                <li>
                    <!-- Modal toggle -->

                    <a href="#" aria-current="page" data-modal-target="defaultModal"
                        data-modal-toggle="defaultModal"
                        class="block py-2 pl-3 pr-4 text-black md:bg-transparent md:text-black-700 md:dark:bg-transparent">

                        <i class="w-5 h-5 inline-block mr-2 fa-solid fa-location-dot" /></i>
                    </a>
                </li>
                <li>
                    <a href="#"
                   
                        class="block py-2 pl-3 pr-4 text-black md:bg-transparent md:text-black-700 md:dark:bg-transparent"
                        aria-current="page">
                        <i class="w-5 h-5 inline-block mr-2 fa-solid fa-ticket" /></i>
                        بلیط های من
                    </a>
                </li>
            </ul>

        </div>
    </nav>





    <div
        class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
        <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
            <button type="button"
                class=" inline-flex flex-col items-center justify-center px-5 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 group">
                <i class="w-5 h-5 inline-block fa-solid fa-film float-nav" /></i>

                <span
                    class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-blue-500">فیلم
                    ها</span>
            </button>
            <button type="button" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                class=" inline-flex flex-col items-center justify-center px-5 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 group">
                <i class="w-5 h-5 inline-block fa-solid fa-location-dot float-nav" /></i>

                <span
                    class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-blue-500">انتخاب
                    شهر</span>
            </button>
            <button type="button"
                class=" inline-flex flex-col items-center justify-center px-5 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 group">
                <i class="w-5 h-5 inline-block fa-solid fa-ticket float-nav" /></i>

                <span
                    class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-blue-500">بلیط
                    های من</span>
            </button>
            <button type="button"
                class=" inline-flex flex-col items-center justify-center px-5 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 group">
                <i class="float-nav fa-solid fa-user"></i>
                <span
                    class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-blue-500">ورود
                </span>
            </button>
        </div>
    </div>

</div>



<!-- City modal -->
<div id="defaultModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow light:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center p-4 border-b rounded-t dark:border-gray-600 bg-white">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-black">موقعیت مکانی</h3>
                <div class="flex">
                    <form>
                        <div class="flex px-2">
                            <label for="default-search"
                                class="mb-2 text-sm font-medium text-gray-900 sr-only light:text-gray-100">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="search-navbar"
                                    class="block w-full p-2 pl-10 text-sm text-gray-900 border-none rounded-xl bg-white-50 dark:bg-gray-50 dark:placeholder-gray-600 dark:text-gray"
                                    placeholder="جست و جوی نام شهر ...">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="flex items-center ml-auto">
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white absolute left-1"
                        data-modal-hide="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>
            <!-- Modal body -->
            <div class="grid grid-cols-4 gap-4 text-center">
                @foreach ($cities as $city)
                    <div class=" p-2 rounded-md cursor-pointer hover:text-black hover:bg-gray-100">{{ $city['title'] }}
                    </div>
                @endforeach

            </div>

            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600 ">
                <button data-modal-hide="defaultModal" type="button"
                    class="absolute left-1 text-white bg-red-600 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:bg-red-500 focus:z-10 light:bg-red-700  light:hover:text-white my-2">
                    <i class="w-5 h-5 inline-block mr-2 text-white fa-solid fa-location-crosshairs"></i>
                    مکان یابی
                </button>
            </div>
        </div>
    </div>
</div>





<div id="mega-menu-dropdown" class="sticky top-20 z-20 grid hidden w-96  text-sm bg-white border border-gray-100 rounded-lg shadow-md border-gray-700  bg-gray-700">
    <div class="p-4 pb-0 text-gray-900 md:pb-4 text-white">
      <h4 class="font-medium z-20" style="color:black">
          مجبوب ترین فیلم ها
      </h4>
  
      <div class="w-full sm:mb-16 bg-white">
        <div class="flex flex-wrap justify-between max-w-3xl mx-auto">
          @foreach ($lastMovies as $key => $movie)
            <div class="movie-item-container w-1/3 p-3">
              <a href="movies/{{ $movie['slug'] }}" class="movie-item relative block mx-auto" style="margin-bottom: 1rem;">
                <div class="flex justify-center">
                  <img class="object-cover w-full h-full max-w-xs rounded-lg drop-shadow-2xl shadow-lg inline-block content " src="{{ url($movie['main_banner']) }}" title="{{ $movie['title'] }}" alt="{{ $movie['title'] }}">
                </div>
                <div class="w-full text-center text-lg mt-3">
                  <span style="color:black">{{ $movie['title'] }}</span>
                </div>
              </a>
            </div>
          <?php
          
          if ($key==5) {
              break;
          }
          
          ?>
            @endforeach
        </div>
      </div>
    </div>
  </div>