@extends('admin.template')

@section('title')
    مدیریت بازیگران
@endsection
<link type="text/css" rel="stylesheet" href="{{ url('datePicker/jalalidatepicker.min.css') }}" />
<script type="text/javascript" src="{{ url('datePicker/jalalidatepicker.min.js') }}"></script>
<style>
    .overlay{
        width: 100%;
        height: 100%;
        position: absolute;
        background-color: #00000026;
        border-radius: 50%;
    }
</style>
@section('content')
    <section class="p-4">
        <div class="mb-6">
            <button data-modal-target="create-character-modal" data-modal-toggle="create-character-modal" type="button"
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
                            نام
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            بیوگرافی
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            شهر
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            تاریخ تولد
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            عملیات
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($characters as $character)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-3 text-center font-medium text-gray-900 whitespace-nowrap ">
                                <img class="w-28 h-24 object-cover rounded-lg  drop-shadow-md"
                                    src="{{ url("$character->avatar") }}" alt="{{ $character->name }}">
                            </th>
                            <td class="px-6 py-3 text-center">
                                {{ $character->name }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $character->description }}
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ $character->city->title }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $character->birthday }}
                            </td>
                            <td class="py-3 text-center">
                                <a data-tooltip-target="tooltip-edit-cinema{{ $character->id }}" href="#"
                                    class="font-medium text-lg text-blue-600 hover:underline mx-2"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <div id="tooltip-edit-cinema{{ $character->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    ویرایش
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <button data-modal-target="delete-modal-cinema{{ $character->id }}" data-modal-toggle="delete-modal-cinema{{ $character->id }}" type="button" data-tooltip-target="tooltip-delete-cinema{{ $character->id }}" href="#"
                                    class="font-medium text-lg text-red-600 hover:underline mx-2"><i
                                        class="fa-regular fa-trash-can"></i></button>
                                <div id="tooltip-delete-cinema{{ $character->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    حذف
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </td>
                        </tr>
                        <div id="delete-modal-cinema{{ $character->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-5 border-b rounded-t">
                                        <h3 class="text-xl font-medium text-gray-900 ">
                                            حذف سینما
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center" data-modal-hide="delete-modal-cinema{{ $character->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <p class="text-base leading-relaxed text-gray-500 ">
                                            آیا از حذف کردن سینما <b>{{ $character->name }}</b> مطمین هستید ؟؟
                                        </p>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                        <button data-modal-hide="delete-modal-cinema{{ $character->id }}" type="button" class="ml-4 text-white bg-rose-500 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">حذف</button>
                                        <button data-modal-hide="delete-modal-cinema{{ $character->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                <tfoot>
                    <div class="bg-gray-50 pl-1 py-3">
                        {{ $characters->links() }}
                    </div>
                </tfoot>
            </table>
        </div>
        <div id="create-character-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-7xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            ایجاد بازیگر جدید
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="create-character-modal">
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
                        <form id="create-character-form" enctype="multipart/form-data"
                            action="{{ route('admin.manage.character.create') }}" method="POST">
                            @csrf
                            <div class="w-full flex justify-enter">
                                <div class="relative">
                                    <div class="overlay">
                                        
                                    </div>
                                    <img class="rounded-full w-24" src="{{ asset('images/profile-mine.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام</label>
                                    <input value="{{ old('name') }}" name="name" type="text" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror
                                    "
                                        required>
                                    @error('name')
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
                                <div class="">
                                    <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        تاریخ تولد
                                    </label>
                                    <input data-jdp autocomplete='false'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="" required value="{{ old('birthday') }}" name="birthday">
                                </div>
                                <div class="w-full">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">درباره
                                        بازیگر</label>
                                    <textarea required name="description" id="description" rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  @error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                        placeholder="درباره بازیگر...">{{ old('description') }}</textarea>
                                    @error('description')
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
                        <button form="create-movie-form" type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            ایجاد</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        jalaliDatepicker.startWatch();
        function deleteUser(userID) {
            $.ajax({
                url: "{{ route('admin.manage.user.delete') }}",
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    user: userID
                },
                success: (data) => {
                    $(`#user-${userID}`).hide();
                    Swal.fire({
                        title: 'عملیات موفق !',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'بستن'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
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
    </script>
@endsection
