@extends('admin.template')

@section('title')
    مدیریت بازیگران
@endsection

@section('content')
    <section class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex flex-col-reverse">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            نام
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
                    @foreach ($provinces as $province)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <td class="px-6 py-3 text-center">
                                {{ $province->title }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $province->created_at }}
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ $province->updated_at }}
                            </td>
                            <td class="py-3 text-center">
                                <a data-tooltip-target="tooltip-edit-cinema{{ $province->id }}" href="#"
                                    class="font-medium text-lg text-blue-600 hover:underline mx-2"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <div id="tooltip-edit-cinema{{ $province->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opaprovince duration-300 bg-gray-900 rounded-lg shadow-sm opaprovince-0 tooltip">
                                    ویرایش
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <button data-modal-target="delete-modal-cinema{{ $province->id }}" data-modal-toggle="delete-modal-cinema{{ $province->id }}" type="button" data-tooltip-target="tooltip-delete-cinema{{ $province->id }}" href="#"
                                    class="font-medium text-lg text-red-600 hover:underline mx-2"><i
                                        class="fa-regular fa-trash-can"></i></button>
                                <div id="tooltip-delete-cinema{{ $province->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opaprovince duration-300 bg-gray-900 rounded-lg shadow-sm opaprovince-0 tooltip">
                                    حذف
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </td>
                        </tr>
                        <div id="delete-modal-cinema{{ $province->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-5 border-b rounded-t">
                                        <h3 class="text-xl font-medium text-gray-900 ">
                                            حذف سینما
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 mr-auto inline-flex justify-center items-center" data-modal-hide="delete-modal-cinema{{ $province->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <p class="text-base leading-relaxed text-gray-500 ">
                                            آیا از حذف کردن سینما <b>{{ $province->title }}</b> مطمین هستید ؟؟
                                        </p>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                        <button data-modal-hide="delete-modal-cinema{{ $province->id }}" type="button" class="ml-4 text-white bg-rose-500 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">حذف</button>
                                        <button data-modal-hide="delete-modal-cinema{{ $province->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                <tfoot>
                    <div class="bg-gray-50 pl-1 py-3">
                        {{ $provinces->links() }}
                    </div>
                </tfoot>
            </table>
        </div>

    </section>
@endsection
