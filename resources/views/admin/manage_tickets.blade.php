@extends('admin.template')

@section('title')
    مدیریت بلیط ها
@endsection

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
                            کاربر
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            سینما
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            سانس
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            وضعیت
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            تعداد صندلی
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            مجموع قیمت
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            تاریخ ایجاد
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            آخرین ویرایش
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <td class="px-6 py-3 text-center">
                                {{ $ticket->user->name }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $ticket->cinema->title }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{ $ticket->sans->id }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                @if ($ticket->state == 'Valid')
                                    <span type="button"
                                        class="font-thin rounded-full text-xs bg-green-200 text-green-600 px-2 py-1">
                                        معتبر
                                    </span>
                                @elseif ($ticket->state == 'Expired')
                                    <span
                                        class="font-thin rounded-full text-xs bg-red-200 text-red-600 px-2 py-1">
                                        منقضی شده
                                    </span>
                                @else
                                    <span
                                        class="font-thin rounded-full text-xs bg-yellow-200 text-yellow-600 px-2 py-1">
                                        باطل شده
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ $ticket->count }}
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ $ticket->total_price }}
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ $ticket->created_at }}
                            </td>
                            <td class="px-6 py-3 text-center movie-description">
                                {{ $ticket->updated_at }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <div class="bg-gray-50 pl-1 py-3">
                        {{ $tickets->links() }}
                    </div>
                </tfoot>
            </table>
        </div>

    </section>
@endsection
