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

    <title>@yield('title') | داشبورد ادمین سینماتیکت</title>

    <!-- css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link type="text/css" rel="stylesheet" href="{{ url('datePicker/jalalidatepicker.min.css') }}" />
    <script type="text/javascript" src="{{ url('datePicker/jalalidatepicker.min.js') }}"></script>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.css" rel="stylesheet" />
    @yield('styles')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">


    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body dir="rtl" class="bg-gray-200 overflow-x-hidden">


    @include('.admin.navbar')

    <div class="w-full flex flex-row">
        <div class="w-[20%] bg-white w-full p-7">
            <ul class="block text-sm">
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.dashboard') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="w-full flex flex-row items-center">

                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-brands fa-microsoft"></i>
                            <h1 class="text-black text-md font-normal mr-3">پیشخوان</h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>

                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.cinemas.show') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.cinemas.show') }}" class="w-full flex flex-row items-center">

                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fas fa-film"></i>
                            <h1 class="text-black text-md font-normal mr-3">سینماها </h1>
                        </div>
                        <div>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>

                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.movies.show') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.movies.show') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fas fa-video "></i>
                            <h1 class="text-black text-md font-normal mr-3">فیلم ها</h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.users') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.users') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-solid fa-user-group"></i>
                            <h1 class="text-black text-md font-normal mr-3">کاربران </h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.characters') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.characters') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-solid fa-users-rectangle"></i>
                            <h1 class="text-black text-md font-normal mr-3">بازیگران </h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.categories') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.categories') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-solid fa-list"></i>
                            <h1 class="text-black text-md font-normal mr-3">ژانر ها </h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.cities') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.cities') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-solid fa-city"></i>
                            <h1 class="text-black text-md font-normal mr-3">شهر ها </h1>
                        </div>
                        <div>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.provinces') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.provinces') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-solid fa-map-location-dot"></i>
                            <h1 class="text-black text-md font-normal mr-3">استان ها </h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.comments') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.comments') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-solid fa-comments"></i>
                            <h1 class="text-black text-md font-normal mr-3">نظرات </h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.factors') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.factors') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                            <h1 class="text-black text-md font-normal mr-3">فاکتور ها </h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.halls') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.halls') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-regular fa-id-badge"></i>
                            <h1 class="text-black text-md font-normal mr-3">سالن ها </h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.options') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.options') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-solid fa-table-list"></i>
                            <h1 class="text-black text-md font-normal mr-3"> امکانات </h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.sans') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.sans') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fa-solid fa-braille"></i>
                            <h1 class="text-black text-md font-normal mr-3"> سانس ها </h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <li
                    class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 {{ url()->current() === route('admin.manage.tickets') ? 'bg-red-50 text-red-500 ' : '' }}">
                    <a href="{{ route('admin.manage.tickets') }}" class="w-full flex flex-row items-center">
                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fas fa-ticket "></i>
                            <h1 class="text-black text-md font-normal mr-3"> بلیط ها </h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
                <hr />
                <li class="w-full flex flex-row hover:bg-gray-100 rounded-md relative p-2 my-3 mt-16">
                    <a id="logout-btn" class="w-full flex flex-row cursor-pointer">

                        <div class="text-start flex flex-row items-center w-full mt-1">
                            <i class="fas fa-arrow-right-from-bracket ml-3"></i>
                            <h1 class="text-black text-md font-normal mr-3">خروج</h1>
                        </div>
                        <div w-full>
                            <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="w-10/12">
            @yield('content')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.js"></script>
    <script src="{{ asset('/js/sweet-alert.js') }}"></script>
    {{-- <script src="{{ asset('/admin/admin_rtl.js') }}"></script>
    <script src="{{ asset('/admin/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admin/dashboard.js') }}"></script> --}}

    @yield('js')
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
    </script>

</body>

</html>
