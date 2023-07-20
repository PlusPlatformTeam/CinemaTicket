@extends('.user.template_profile')

@section('title')
    تراکنش های کاربر
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/transaction.css') }}">
@endsection


@section('content')
    <section class="w-full flex h-fit p-12 ">


        <div class="w-full p-4 ">


            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                توضیح </th>
                            <th scope="col" class="px-6 py-3">
                                تاریخ
                            </th>
                            <th scope="col" class="px-6 py-3">
                                وضعیت
                            </th>
                            <th scope="col" class="px-6 py-3">
                                مبلغ
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <a href="">
                                    بخارست
                                    <i class="  fa-solid fa-chevron-left text-end justify-end  "></i>
                                </a>

                            </th>
                            <td class="px-6 py-4">
                                <i class="fa-regular fa-clock"></i>
                                1398/11/12
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-green-700 text-green-50 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">موفق</span>

                            </td>
                            <td class="px-6 py-4">
                             {{convertDigitsToFarsi(number_format("33600"))}} تومان
                            </td>
                        </tr>

                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <a href="">
                                    بخارست
                                    <i class="  fa-solid fa-chevron-left text-end justify-end  "></i>
                                </a>

                            </th>
                            <td class="px-6 py-4">
                                <i class="fa-regular fa-clock"></i>
                                1398/11/12
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-green-700 text-green-50 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">موفق</span>

                            </td>
                            <td class="px-6 py-4">
                             {{convertDigitsToFarsi(number_format("33600"))}} تومان
                            </td>
                        </tr>

                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <a href="">
                                    بخارست
                                    <i class="  fa-solid fa-chevron-left text-end justify-end  "></i>
                                </a>

                            </th>
                            <td class="px-6 py-4">
                                <i class="fa-regular fa-clock"></i>
                                1398/11/12
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-green-700 text-green-50 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">موفق</span>

                            </td>
                            <td class="px-6 py-4">
                             {{convertDigitsToFarsi(number_format("33600"))}} تومان
                            </td>
                        </tr>
             
                    </tbody>
                </table>
            </div>



        </div>



    </section>
@endsection
