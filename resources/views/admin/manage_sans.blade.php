@extends('admin.template')

@section('title')
    مدیریت  سانس ها
@endsection
<link type="text/css" rel="stylesheet" href="{{ url('datePicker/jalalidatepicker.min.css') }}" />
<script type="text/javascript" src="{{ url('datePicker/jalalidatepicker.min.js') }}"></script>
@section('content')
    <section class="p-4">
        <div class="mb-6">
            <button data-modal-target="create-option-modal" data-modal-toggle="create-option-modal" type="button"
                class="flex jusify-between items-center px-5 py-2 rounded-lg bg-green-500 hover:bg-green-600 text-white">
                <i class="fa-solid fa-square-plus mx-3"></i>
                <span class="mt-1">ایجاد</span>
            </button>
            @if (session('success'))
                <div id="alert-border-3"
                    class="flex items-center p-4 my-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 "
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div class="mr-3 pt-2 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button"
                        class="mr-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-border-3" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            @php
                Session::forget('success');
            @endphp
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex flex-col-reverse">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            سینما
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            فیلم
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            سالن
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            تاریخ شروع
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            قیمت هر صندلی
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            ظرفیت باقی مانده
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            عملیات
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $pageNumber = ($sans->currentPage() - 1) * $sans->perPage();
                    @endphp
                    @foreach ($sans as $key => $item)
                        <tr id="option-{{ $item['id'] }}" class="bg-white border-b  hover:bg-gray-50 ">
                            <td class="px-6 py-3 text-center">
                                {{ ++$pageNumber }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $item['cinema']['title'] }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $item['movie']['title'] }}
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ $item['hall']['title'] }}
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ $item['started_at']['date'] . ' ' . $item['started_at']['clock'] }}
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ convertDigitsToFarsi($item['price']) }}
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ convertDigitsToFarsi($item['capacity']) }}
                            </td>
                            <td class="py-3 text-center">
                                <a data-tooltip-target="tooltip-edit-cinema{{ $item['id'] }}" href="#"
                                    class="font-medium text-lg text-blue-600 hover:underline mx-2"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <div id="tooltip-edit-cinema{{ $item['id'] }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opaoption duration-300 bg-gray-900 rounded-lg shadow-sm opaoption-0 tooltip">
                                    ویرایش
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <button data-modal-target="delete-modal-cinema{{ $item['id'] }}"
                                    data-modal-toggle="delete-modal-cinema{{ $item['id'] }}" type="button"
                                    data-tooltip-target="tooltip-delete-cinema{{ $item['id'] }}" href="#"
                                    class="font-medium text-lg text-red-600 hover:underline mx-2"><i
                                        class="fa-regular fa-trash-can"></i></button>
                                <div id="tooltip-delete-cinema{{ $item['id'] }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opaoption duration-300 bg-gray-900 rounded-lg shadow-sm opaoption-0 tooltip">
                                    حذف
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </td>
                        </tr>
                        <div id="delete-modal-cinema{{ $item['id'] }}" tabindex="-1"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-5 border-b rounded-t">
                                        <h3 class="text-xl font-medium text-gray-900 ">
                                            حذف آیکون
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center"
                                            data-modal-hide="delete-modal-cinema{{ $item['id'] }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <p class="text-base leading-relaxed text-gray-500 ">
                                            آیا از حذف کردن آیکون <b>{{ $key }}</b> مطمین هستید ؟؟
                                        </p>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                        <a href="{{route('admin.manage.option.delete', ['id' =>$item['id']])}}" data-modal-hide="delete-modal-cinema{{ $item['id'] }}"
                                            
                                            class="ml-4 text-white bg-rose-500 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">حذف</a>
                                        <button data-modal-hide="delete-modal-cinema{{ $item['id'] }}" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                <tfoot>
                    {{ $sans->links() }}
                </tfoot>
            </table>
        </div>
    </section>
    <div id="create-option-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        ایجاد سانس جدید
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="create-option-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form id="create-option-form" enctype="multipart/form-data"
                        action="{{ route('admin.manage.sans.create') }}" method="POST">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="cinema"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">سینما</label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('cinema') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror" name="cinema" id="cinema-select-create">
                                    <option value="" selected>اتخاب کنید ...</option>
                                    @foreach ($cinemas as $cinema)
                                        <option value="{{$cinema->id}}">{{$cinema->title}}</option>
                                    @endforeach
                                </select>
                                @error('cinema')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="movie"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">فیلم</label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('movie') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror" name="movie" id="movie-select-create">
                                    <option value="" selected>اتخاب کنید ...</option>
                                    @foreach ($movies as $movie)
                                        <option value="{{$movie->id}}">{{$movie->title}}</option>
                                    @endforeach
                                </select>
                                @error('movie')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="hidden" id="hall-create-container">
                                <label for="hall"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">سالن</label>
                                <select id="hall-select-option" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('hall') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror" name="hall" id="hall-select-create">
                                </select>
                                @error('hall')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="price"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">قیمت</label>
                                <input value="{{ old('price') }}" name="price" step="1000" min="10000" type="number" id="price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('price') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror
                                    " required>
                                @error('price')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="">
                                <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 ">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    تاریخ شروع
                                </label>
                                <input data-jdp
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="" required value="{{ old('started_at') }}" name="started_at">
                            </div>
                            <div>
                                <label for="timeInput" class="text-sm font-medium text-gray-700">
                                    <i class="fa-solid fa-clock text-xs"></i>                                    
                                    زمان شروع
                                </label>
                                <input type="time" id="timeInput" class="mt-2 p-2 block w-full bg-gray-50 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex flex-row-reverse items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="create-option-modal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">بستن</button>
                    <button form="create-option-form" type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        ایجاد</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        jalaliDatepicker.startWatch();

        const hallContainer = $('#hall-create-container');
        const hallSelectOption = $('#hall-select-option');

        $('#cinema-select-create').on('change', (event) => {
            $.ajax({
                url: "{{ route('hall.get') }}",
                data: {
                    cinema: event.target.value,
                    _token: "{{ csrf_token() }}"
                },
                dataType:'json',
                type:"POST",
                success: (response) => {
                    if (response[0])
                    {
                        hallContainer.removeClass('hidden');
                        hallSelectOption.html('');
                        hallSelectOption.append('<option selected>انتخاب کنید...</option>')
                        response.forEach(hall => {
                            let element = `
                                <option value='${hall.id}'>${hall.title} - ظرفیت : ${hall.capacity}</option>
                            `;
                            hallSelectOption.append(element)
                        });
                    }
                    else{
                        hallContainer.addClass('hidden');
                        hallSelectOption.html('');
                    }
                },
                error: (xhr, status, err) => {
                    hallContainer.addClass('hidden');
                    hallSelectOption.html('');
                }
            })
        });
    </script>
@endsection
