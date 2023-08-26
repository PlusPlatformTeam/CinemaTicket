@extends('admin.template')

@section('title')
    مدیریت سالن ها
@endsection

@section('content')
    <section class="p-4">
        <div class="mb-6">
            <button data-modal-target="create-hall-modal" data-modal-toggle="create-hall-modal" type="button"
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
                            عنوان
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            سینما
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            ظرفیت
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            تعداد ردیف
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            تاریخ ایجاد
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            آخرین ویرایش
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            عملیات
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($halls as $hall)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-3 text-center font-medium text-gray-900 whitespace-nowrap">
                                {{ $hall->title }}
                            </th>
                            <td class="px-6 py-3 text-center">
                                {{ $hall->cinema->title }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $hall->capacity }}
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ $hall->maxRow }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $hall->created_at }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $hall->updated_at }}
                            </td>
                            <td class="py-3 text-center">
                                <a data-tooltip-target="tooltip-edit-hall{{ $hall->id }}" href="#"
                                    data-modal-toggle="update-hall{{ $hall->id }}-modal" data-tooltip-target="tooltip-edit-hall{{ $hall->id }}" class="font-medium text-lg text-blue-600 hover:underline mx-2"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <div id="tooltip-edit-hall{{ $hall->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    ویرایش
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <button data-modal-target="delete-modal-hall{{ $hall->id }}" data-modal-toggle="delete-modal-hall{{ $hall->id }}" type="button" data-tooltip-target="tooltip-delete-hall{{ $hall->id }}" href="#"
                                    class="font-medium text-lg text-red-600 hover:underline mx-2"><i
                                        class="fa-regular fa-trash-can"></i></button>
                                <div id="tooltip-delete-hall{{ $hall->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    حذف
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </td>
                        </tr>
                        <div id="delete-modal-hall{{ $hall->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-5 border-b rounded-t">
                                        <h3 class="text-xl font-medium text-gray-900 ">
                                            حذف سالن
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center" data-modal-hide="delete-modal-hall{{ $hall->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <p class="text-base leading-relaxed text-gray-500 ">
                                            آیا از حذف کردن سالن <b>{{ $hall->name }}</b> مطمین هستید ؟؟
                                        </p>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                        <a href="{{ route('admin.manage.hall.delete', ['id' => $hall->id]) }}" data-modal-hide="delete-modal-hall{{ $hall->id }}" type="button" class="ml-4 text-white bg-rose-500 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">حذف</a>
                                        <button data-modal-hide="delete-modal-hall{{ $hall->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="update-hall{{ $hall->id }}-modal" tabindex="-1"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-7xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                            ویرایش سالن 
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="update-hall{{ $hall->id }}-modal">
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
                                        <form id="update-hall{{ $hall->id }}-form"
                                            action="{{ route('admin.manage.hall.update') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="hall" value="{{ $hall->id }}">
                                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                                <div>
                                                    <label for="title"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">عنوان</label>
                                                    <input value="{{ $hall->title }}" name="title" type="text"
                                                        id="title"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                                         required>
                                                    @error('title')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label for="cinema"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">سینما</label>
                                                    <select name="cinema" required id="cinema"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('cinema') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror">
                                                        @foreach ($cinemas as $cinema)
                                                            <option {{ $cinema->id == $hall->cinema_id ? 'selected' : '' }} value="{{ $cinema->id }}">{{ $cinema->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('cinema')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="">
                                                    <label for="capacity" class="block mb-2 text-sm font-medium text-gray-900 ">
                                                        ظرفیت                                        
                                                    </label>
                                                    <input type="number" autocomplete='false'
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                                        min="30" max="600" placeholder="" required value="{{ $hall->capacity }}" name="capacity">
                                                    @error('capacity')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="w-full">
                                                    <label for="maxRow"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        تعداد ردیف</label>
                                                    <input min="5" max="20" type="number"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                                        placeholder="" required value="{{ $hall->maxRow }}" name="maxRow">
                                                    @error('maxRow')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Modal footer -->
                                    <div
                                        class="flex flex-row-reverse items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button data-modal-hide="update-hall{{ $hall->id }}-modal" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">بستن</button>
                                        <button form="update-hall{{ $hall->id }}-form" type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            ویرایش</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                <tfoot>
                    <div class="bg-gray-50 pl-1 py-3">
                        {{ $halls->links() }}
                    </div>
                </tfoot>
            </table>
        </div>
        <div id="create-hall-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-7xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            ایجاد سالن جدید
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="create-hall-modal">
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
                        <form id="create-hall-form"
                            action="{{ route('admin.manage.hall.create') }}" method="POST">
                            @csrf
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">عنوان</label>
                                    <input value="{{ old('title') }}" name="title" type="text" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror
                                    "
                                        required>
                                    @error('title')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="cinema"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">سینما</label>
                                    <select name="cinema" required id="cinema"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('cinema') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror">
                                        <option selected>انتخاب کنید ...</option>
                                        @foreach ($cinemas as $cinema)
                                            <option value="{{ $cinema->id }}">{{ $cinema->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('cinema')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="capacity" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        ظرفیت                                        
                                    </label>
                                    <input type="number" autocomplete='false'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        min="30" max="600" placeholder="" required value="{{ old('capacity') }}" name="capacity">
                                    @error('capacity')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="maxRow"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        تعداد ردیف</label>
                                    <input min="5" max="20" type="number"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="" required value="{{ old('maxRow') }}" name="maxRow">
                                    @error('maxRow')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex flex-row-reverse items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="create-movie-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">بستن</button>
                        <button form="create-hall-form" form="create-movie-form" type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            ایجاد</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
