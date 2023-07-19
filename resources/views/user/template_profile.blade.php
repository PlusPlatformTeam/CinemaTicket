<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="cinematicket, سینما تیکت, بلیط سینما, رزرو بلیط سینما, سینما و تیاتر" name="keywords">
    <meta content="سینما تیکت بزرگترین مرج رزرو و خرید بلیط سینما سراسر کشور" name="description">

    <link href="{{ asset('images/logo.png') }}" rel="icon">

    <title>@yield('title')</title>

    <!-- css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    @yield('styles')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body dir="rtl" class="bg-gray-200">


    @include('.user.navbar')

    <div class="w-full h-screen">

        <div class="w-3/12 bg-white w-full h-screen p-7">

            <ul class="block">
                <li class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2">
                    <a href="#" class="w-full flex flex-row">

                    <div class="text-start justify-start flex flex-row w-full mt-3">
                        <i class="fa-regular fa-address-card"></i>
                        <h1 class="text-black text-md font-normal mr-3">اطلاعات کاربری</h1>
                    </div>
                    <div w-full>
                        <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                    </div>
                </a>

                </li>

                <li class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2">
                    <a href="#" class="w-full flex flex-row">

                    <div class="text-start justify-start flex flex-row w-full mt-3">
                        <i class="fas fa-clipboard-check"></i>
                        <h1 class="text-black text-md font-normal mr-3">تراکنش ها</h1>
                    </div>
                    <div w-full>
                        <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                    </div>
                </a>

                </li>

                <li class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2">
                    <a href="#" class="w-full flex flex-row">
                    <div class="text-start justify-start flex flex-row w-full mt-3">
                        <i class="fas fa-ticket "></i>
                        <h1 class="text-black text-md font-normal mr-3">بلیت های من</h1>
                    </div>
                    <div w-full>
                        <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                    </div>
                </a>
                </li>

                <hr/>

                <li class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 mt-16">
                    <a href="#" class="w-full flex flex-row">

                    <div class="text-start justify-start flex flex-row w-full mt-3">
                        <i class="fas fa-arrow-right-from-bracket ml-3"></i>
                        <h1 class="text-black text-md font-normal mr-3">خروج از حساب کاربری</h1>
                    </div>
                    <div w-full>
                        <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                    </div>
                </a>

                </li>

            </ul>


        </div>


        <div class="w-9/12">
            @yield('content')
        </div>

    </div>





    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.js"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    @yield('js')

</body>

</html>
