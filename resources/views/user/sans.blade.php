@extends('.user.template')

@section('title')
    انتخاب صندلی | سینما تیکت
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/sans.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/sans.js') }}"></script>
@endsection

@section('content')
    <section class="min-h-screen m-0 p-0 bg-gray-700">
        <nav class="flex flex-row justify-between bg-gray-800 px-2 py-3">
            <div class="basis-6/12 flex items-center pr-3">
                <img width="20%" src="{{ url('images/typography_light.svg') }}" alt="">
            </div>
            <div class="basis-6/12 flex justify-end items-center pl-3">
                <button id="dropdownProfileButton" data-dropdown-toggle="dropdownProfile"
                    class="p-2 pl-2.5 flex items-center justify-between text-sm font-medium text-gray-900 rounded-lg hover:bg-gray-700"
                    type="button">
                    <span class="sr-only"></span>
                    <img class="w-8 h-8 ml-2 rounded-full" src="{{ url('images/profile-mine.svg') }}" alt="پروفایل">
                    <span class="text-white">پروفایل</span>
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
                            class="cursor-pointer flex items-center p-4 text-sm text-gray-700 rounded-lg text-gray-200 hover:bg-gray-50">
                            <i class="fas fa-arrow-right-from-bracket ml-3"></i>
                            <span class="pt-1">خروج از حساب کاربری</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="scroll-dark h-96 bg-gray-700 px-3 pt-20 overflow-y-auto">
            <div class="w-full flex justify-center">
                <div
                    class="p-1 pt-1.5 rounded-lg text-gray-300 xl:w-2/5 lg:w-3/5 md:w-5/6 w-full border-2 boeder-gray-300 text-center">
                    <span>صحنه اجرا</span>
                </div>
            </div>
            <div class="w-full flex justify-center">
                <div
                    class="flex flex-wrap flex-row-reverse justify-center mt-6 p-1 pt-1.5 xl:w-2/5 lg:w-3/5 md:w-5/6 w-full">
                    @for ($i = 1; $i <= $seats['maxRow']; $i++)
                        @for ($j = 1; $j <= $seats['maxCol']; $j++)
                            <span data-tooltip-target="tooltip-seat{{ $i . '-' . $j }}" data-tooltip-style="light"
                                class="cursor-pointer block m-1 w-8 h-8 rounded-full {{ $sans->seats[0]->row == $i && $sans->seats[0]->col == $j ? 'bg-gray-950 border-2 border-gray-300' : 'bg-gray-300' }}"></span>
                            <div id="tooltip-seat{{ $i . '-' . $j }}" role="tooltip"
                                class="p-5 absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                                <div>
                                    <div class="flex justify-between mt-3">
                                        <div class="text-xs text-center w-14">
                                            <p class="text-gray-600">ردیف</p>
                                            <p>{{ convertDigitsToFarsi($i) }}</p>
                                        </div>
                                        <div class="border-[0.5px] border-gray-400"></div>
                                        <div class="text-xs text-center w-14">
                                            <p class="text-gray-600">صندلی</p>
                                            <p>{{ convertDigitsToFarsi($j) }}</p>
                                        </div>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        {{ convertDigitsToFarsi(number_format($sans->price)) }}</p>
                                </div>
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        @endfor
                    @endfor
                    {{-- @for ($k = 1; $k <= $seats['reminder']; $k++)
                        <span data-tooltip-target="tooltip-seat{{$k + $i . "-" . $j + $seats['maxCol']}}" data-tooltip-style="light" class="cursor-pointer block m-1 w-8 h-8 rounded-full {{ $sans->seats[0]->row == $i && $sans->seats[0]->col == $j ? 'bg-red-500' : 'bg-gray-300' }}"></span>
                        <div id="tooltip-seat{{ $k + $seats['maxRow'] . "-" . $j + $seats['maxCol']}}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                            Tooltip content
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    @endfor --}}
                </div>
            </div>
        </div>
        <div class="block">
            <header class="bg-gray-800 text-xs text-white flex justify-between items-center py-3 px-4">
                <div class="flex jstify-between items-center">
                    <div class="flex jstify-between items-center mx-1">
                        <span class="block m-1 w-6 h-6 rounded-full bg-gray-300"></span>
                        <span>صندلی خالی</span>
                    </div>
                    <div class="flex jstify-between items-center mx-1">
                        <span class="block m-1 w-6 h-6 rounded-full bg-red-500"></span>
                        <span>انتخاب شما</span>
                    </div>
                    <div class="flex jstify-between items-center mx-1">
                        <span class="block m-1 w-6 h-6 rounded-full bg-gray-950 border-2 border-gray-300"></span>
                        <span>فروخته شده</span>
                    </div>
                </div>
                <div class="font-bold">
                    <span>ظرفیت سالن: 87</span>
                </div>
            </header>
            <main class="h-full w-full bg-gray-700 flex justify-between text-white py-6 px-1">
                <div class="pl-5 border-l-2 border-dashed text-xs flex pr-5 items-center">
                    <img class="w-20 rounded-lg ml-3" src="{{ url($sans->movie[0]->main_banner) }}" alt="">
                    <div class="flex flex-col justify-between h-full mt-1 pt-3">
                        <h2 class="text-sm font-bold">{{ $sans->movie[0]->title }}</h2>
                        <p class="flex items-center">
                            <i class="fa-solid fa-location-dot ml-2"></i>
                            <span class="text-bold ml-2">{{ $sans->cinema[0]->title }}</span>
                            <span>({{ $sans->hall[0]->title }})</span>
                        </p>
                        <p class="flex items-center">
                            <i class="fa-regular fa-clock ml-2"></i> 
                            <span class="text-bold ml-2 ">{{ $time['date'] }}</span>
                            <span>- سانس  {{ convertDigitsToFarsi($time['clock']) }}</span>
                        </p>
                    </div>
                </div>
                <div class="flex justify-end text-white items-center pl-3">
                    <div class="text-end text-sm">
                        <p class="text-end font-bold">هنوز بلیتی را انتخاب نکرده اید!</p>
                        <button type="button" class="text-center py-2 px-4 bg-gray-400 rounded-lg mt-3"> ثبت صندلی و نمایش جزییات </button>
                    </div>
                </div>
            </main>
        </div>
    </section>
@endsection
