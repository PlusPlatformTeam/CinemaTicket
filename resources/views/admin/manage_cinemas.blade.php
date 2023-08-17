@extends('admin.template')

@section('title')
    مدیریت سینماها
@endsection
@php
    $ids = [];
@endphp
@foreach ($cinemas as $cinema)
    @php
        $ids[] = $cinema->id;
    @endphp
@endforeach

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="{{ asset('css/multi_select.css') }}" />
<script src="{{ asset('js/multi_select.js') }}"></script>
@section('content')
    <section class="p-4">
        <div class="mb-6">
            <button data-modal-target="create-cinema-modal" data-modal-toggle="create-cinema-modal" type="button"
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
                            تصویر
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            عنوان
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            شهر
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            آدرس
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            توضیحات
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            تماس
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            امتیاز
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            عملیات
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cinemas as $cinema)
                        <tr id="cinema-{{ $cinema->id }}" class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-3 text-center font-medium text-gray-900 whitespace-nowrap ">
                                <img class="w-28 h-24 object-cover rounded-lg  drop-shadow-md"
                                    src="{{ url($cinema->poster) }}" alt="{{ $cinema->title }}">
                            </th>
                            <td class="px-6 py-3 text-center">
                                {{ $cinema->title }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $cinema->city->title }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $cinema->address }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $cinema->description }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $cinema->phone }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $cinema->score }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                <button type="button" data-modal-target="update-cinema{{ $cinema->id }}-modal"
                                    data-modal-toggle="update-cinema{{ $cinema->id }}-modal"
                                    data-tooltip-target="tooltip-edit-cinema{{ $cinema->id }}" href="#"
                                    class="font-medium text-lg text-blue-600 hover:underline mx-2"><i
                                        class="fa-regular fa-pen-to-square"></i></button>
                                <div id="tooltip-edit-cinema{{ $cinema->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    ویرایش
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <button data-modal-target="delete-modal-cinema{{ $cinema->id }}"
                                    data-modal-toggle="delete-modal-cinema{{ $cinema->id }}" type="button"
                                    data-tooltip-target="tooltip-delete-cinema{{ $cinema->id }}" href="#"
                                    class="font-medium text-lg text-red-600 hover:underline mx-2"><i
                                        class="fa-regular fa-trash-can"></i></button>
                                <div id="tooltip-delete-cinema{{ $cinema->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    حذف
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </td>
                        </tr>
                        <div id="delete-modal-cinema{{ $cinema->id }}" tabindex="-1"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-5 border-b rounded-t">
                                        <h3 class="text-xl font-medium text-gray-900 ">
                                            حذف سینما
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center"
                                            data-modal-hide="delete-modal-cinema{{ $cinema->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <p class="text-base leading-relaxed text-gray-500 ">
                                            آیا از حذف کردن سینما <b>{{ $cinema->title }}</b> مطمین هستید ؟؟
                                        </p>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                        <button onclick="deleteCinema('{{ $cinema->id }}')"
                                            data-modal-hide="delete-modal-cinema{{ $cinema->id }}" type="button"
                                            class="ml-4 text-white bg-rose-500 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">حذف</button>
                                        <button data-modal-hide="delete-modal-cinema{{ $cinema->id }}" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                <tfoot>
                    <div class="bg-gray-50 pl-1 py-3">
                        {{ $cinemas->links() }}
                    </div>
                </tfoot>
            </table>
        </div>
    </section>
    <div id="create-cinema-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-7xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        ایجاد سینما جدید
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="create-cinema-modal">
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
                    <form id="create-cinema-form" enctype="multipart/form-data"
                        action="{{ route('admin.manage.cinemas.create') }}" method="POST">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">عنوان</label>
                                <input value="{{ old('title') }}" name="title" type="text" id="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror
                                    "
                                    placeholder="عنوان" required>
                                @error('title')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="city"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شهر</label>
                                <select name="city" required id="city"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('city') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror">
                                    <option selected>انتخاب کنید ...</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" label="{{ $city->title }}">
                                            {{ $city->title }}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شماره تماس</label>
                                <input value="{{ old('phone') }}" name="phone" type="text" id="phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('phone') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                    placeholder="0218617847" required> <!-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" -->
                                @error('phone')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    آدرس</label>
                                <input value="{{ old('address') }}" type="text" name="address" id="address"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('address') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                    required>
                                @error('address')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror

                            </div>
                            <div>
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">درباره
                                    سینما</label>
                                <textarea required name="description" id="description" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  @error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                    placeholder="درباره سینما...">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="slim-select">امکانات</label>
                                <select placeholder="امکانات را انتخاب کنید" multiple name="option[]"
                                    id="options-select">
                                    @foreach ($options as $option)
                                        <option value="{{ $option->id }}" label="{{ $option->title }}">
                                            <span>{{ $option->title }}</span> <i class="{{ $option->icon }}"></i>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <div id="map" style="height: 400px;"></div>
                                <input type="hidden" id="location" name="location" />
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                            <div class="mb-6">
                                <div class=" w-full">
                                    <label for="">بنر</label>
                                    <label for="banner-file"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  @error('banner') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                                800x400px)</p>
                                        </div>
                                        <input name="banner" id="banner-file" type="file" class="hidden" />
                                    </label>
                                    @error('banner')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div id="banner-container">
                                <img id="preview-banner" src="#" alt="Preview Image"
                                    class="hidden mt-[25px] w-[420px] rounded-lg">
                            </div>
                            <div class="mb-6">
                                <div class=" w-full">
                                    <label for="">پوستر</label>
                                    <label for="poster-file"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  @error('poster') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                                800x400px)</p>
                                        </div>
                                        <input name="poster" id="poster-file" type="file" class="hidden" />
                                    </label>
                                    @error('poster')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div id="poster-container">
                                <img id="preview-poster" src="#" alt="Preview Image"
                                    class="hidden mt-[25px] w-[420px] rounded-lg">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex flex-row-reverse items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="create-cinema-modal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">بستن</button>
                    <button form="create-cinema-form" type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        ایجاد</button>
                </div>
            </div>
        </div>
    </div>
    @foreach ($cinemas as $cinema)
        <div id="update-cinema{{ $cinema->id }}-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-7xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            ویرایش سینما {{ $cinema->title }}
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="update-cinema{{ $cinema->id }}-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form id="update-cinema{{ $cinema->id }}-form" enctype="multipart/form-data"
                            action="{{ route('admin.manage.cinemas.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="cinema" value="{{ $cinema->id }}">
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="title"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">عنوان</label>
                                    <input value="{{ $cinema->title }}" name="title" type="text" id="title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror
                                "
                                        placeholder="عنوان" required>
                                    @error('title')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="city"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شهر</label>
                                    <select name="city" required id="city"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('city') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror">
                                        @foreach ($cities as $city)
                                            <option {{ $cinema->city_id == $city->id ? 'selected' : '' }}
                                                value="{{ $city->id }}" label="{{ $city->title }}">
                                                {{ $city->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="phone"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شماره
                                        تماس</label>
                                    <input value="{{ $cinema->phone }}" name="phone" type="text" id="phone"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('phone') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                        placeholder="0218617847" required> <!-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" -->
                                    @error('phone')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="address"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        آدرس</label>
                                    <input value="{{ $cinema->address }}" type="text" name="address" id="address"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('address') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                        required>
                                    @error('address')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div>
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">درباره
                                        سینما</label>
                                    <textarea required name="description" id="description" rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  @error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                        placeholder="درباره سینما...">{{ $cinema->description }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="slim-select">امکانات</label>
                                    <select placeholder="امکانات را انتخاب کنید" multiple name="option[]"
                                        @php
                                            $i = 0; 
                                        @endphp 
                                        id="options-select{{ $cinema->id }}">
                                        @foreach ($options as $option)
                                            <option
                                                {{ count($cinema->options) && $cinema->options[$i]->id == $option->id ? 'selected' : '' }}
                                                value="{{ $option->id }}" label="{{ $option->title }}">
                                                <span>{{ $option->title }}</span> <i class="{{ $option->icon }}"></i>
                                            </option>
                                            @php
                                                if ($i < count($cinema->options) - 1) {
                                                    $i++;
                                                }
                                            @endphp
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex flex-row-reverse items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="update-cinema{{ $cinema->id }}-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">بستن</button>
                        <button form="update-cinema{{ $cinema->id }}-form" type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            ویرایش</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        function deleteCinema(cinemaID) {
            $.ajax({
                url: "{{ route('admin.manage.cinemas.delete') }}",
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    cinema: cinemaID
                },
                success: (data) => {
                    $(`#cinema-${cinemaID}`).hide();
                    Swal.fire({
                        title: 'عملیات موفق !',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'بستن'
                    });
                },
                error: (xhr, status, err) => {
                    Swal.fire({
                        title: ' خطا !',
                        text: xhr.message,
                        icon: 'error',
                        confirmButtonText: 'بستن'
                    });
                }
            })
        }
        $(document).ready(function() {
            let fileInput = $('#poster-file');
            let previewImagePoster = $('#preview-poster');

            fileInput.on('change', function() {
                if (fileInput[0].files && fileInput[0].files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        previewImagePoster.attr('src', e.target.result);
                        previewImagePoster.css('display', 'block');
                    };

                    reader.readAsDataURL(fileInput[0].files[0]);
                } else {
                    previewImagePoster.css('display', 'none');
                }
            });

            let bannerFileInput = $('#banner-file');
            let previewImageBanner = $('#preview-banner');

            bannerFileInput.on('change', function() {
                if (bannerFileInput[0].files && bannerFileInput[0].files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        previewImageBanner.attr('src', e.target.result);
                        previewImageBanner.css('display', 'block');
                    };

                    reader.readAsDataURL(bannerFileInput[0].files[0]);
                } else {
                    previewImageBanner.css('display', 'none');
                }
            });
        });
    </script>
    <script>
        let map = L.map('map').setView([36.294925, 59.5965], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);


        let marker;
        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('location').value = e.latlng.lat + ',' + e.latlng.lng;
        });
        new SlimSelect({
            select: '#options-select',
            placeholder: 'امکانات را انتخاب کنید',
            showSearch: true,
            searchText: 'متاسفانه پیدا نشد',
        });
        const cinemas = JSON.parse("{{ json_encode($ids) }}");
        cinemas.forEach(cinema => {
            new SlimSelect({
                select: `#options-select${cinema}`,
                placeholder: 'امکانات را انتخاب کنید',
                showSearch: true,
                searchText: 'متاسفانه پیدا نشد',
            });
        });
    </script>
@endsection
