@extends('admin.template')

@section('title')
    مدیریت کاربران
@endsection
<link type="text/css" rel="stylesheet" href="{{ url('datePicker/jalalidatepicker.min.css') }}" />
<script type="text/javascript" src="{{ url('datePicker/jalalidatepicker.min.js') }}"></script>
@section('content')
    <section class="p-4">
        <div class="mb-6">
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
                            ایمیل
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            موبایل
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            تاریخ تولد
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            تاریخ اعتبار سنجی
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            عملیات
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-3 text-center font-medium text-gray-900 whitespace-nowrap ">
                                <img class="w-28 h-24 object-cover rounded-lg  drop-shadow-md"
                                    src="{{ !empty($user->avatar) ? url("storage/{$user->avatar}") : url('images/profile-mine.svg') }}"
                                    alt="{{ $user->name }}">
                            </th>
                            <td class="px-6 py-3 text-center">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-3 text-center movie1-description">
                                {{ $user->mobile }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $user->birthday }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $user->verified_at }}
                            </td>
                            <td class="py-3 text-center">
                                <button data-tooltip-target="tooltip-edit-user{{ $user->id }}"
                                    data-modal-toggle="update-user{{ $user->id }}-modal" data-tooltip-target="tooltip-edit-user{{ $user->id }}"  class="font-medium text-lg text-blue-600 hover:underline mx-2"><i
                                        class="fa-regular fa-pen-to-square"></i></button>
                                <div id="tooltip-edit-user{{ $user->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity email-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    ویرایش
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <button data-modal-target="delete-modal-user{{ $user->id }}"
                                    data-modal-toggle="delete-modal-user{{ $user->id }}" type="button"
                                    data-tooltip-target="tooltip-delete-user{{ $user->id }}" href="#"
                                    class="font-medium text-lg text-red-600 hover:underline mx-2"><i
                                        class="fa-regular fa-trash-can"></i></button>
                                <div id="tooltip-delete-user{{ $user->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity email-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    حذف
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </td>
                        </tr>
                        <div id="delete-modal-user{{ $user->id }}" tabindex="-1"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-5 border-b rounded-t">
                                        <h3 class="text-xl font-medium text-gray-900 ">
                                            حذف کاربر
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center"
                                            data-modal-hide="delete-modal-user{{ $user->id }}">
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
                                            آیا از حذف کردن کاربر <b>{{ $user->name }}</b> مطمین هستید ؟؟
                                        </p>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                        <button onclick="deleteUser({{ $user->id }})"
                                            data-modal-hide="delete-modal-user{{ $user->id }}" type="button"
                                            class="ml-4 text-white bg-rose-500 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">حذف</button>
                                        <button data-modal-hide="delete-modal-user{{ $user->id }}" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="update-user{{ $user->id }}-modal" tabindex="-1"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-7xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                            ویرایش فیلم {{ $user->name }}
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="update-user{{ $user->id }}-modal">
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
                                        <form id="update-user{{ $user->id }}-form"
                                            action="{{ route('admin.manage.user.update') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                                <div>
                                                    <label for="name"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام</label>
                                                    <input value="{{ $user->name }}" name="user-name" type="text"
                                                        id="name"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                                        placeholder="نام" required>
                                                    @error('name')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label for="email"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ایمیل</label>
                                                    <input min="30" max="180" value="{{ $user->email }}"
                                                        name="email" type="text" id="email"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('email') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                                        required>
                                                    @error('email')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="mobile"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        موبایل</label>
                                                    <input value="{{ $user->mobile }}" type="text" name="mobile"
                                                        id="mobile"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  @error('mobile') bg-red-50 border border-red-500 text-red-900 placeholder-red-700  @enderror"
                                                        required>
                                                    @error('mobile')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror

                                                </div>
                                                <div class="">
                                                    <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 ">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                        تاریخ تولد
                                                    </label>
                                                    <input data-jdp
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                                        placeholder="" required value="{{ $user->birthday }}" name="birthday">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Modal footer -->
                                    <div
                                        class="flex flex-row-reverse items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button data-modal-hide="update-user{{ $user->id }}-modal" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">بستن</button>
                                        <button form="update-user{{ $user->id }}-form" type="submit"
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
                        {{ $users->links() }}
                    </div>
                </tfoot>
            </table>
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
