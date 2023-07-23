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
                        @foreach ($tickets as $ticket)
                            <tr class="bg-white border-b ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    <a href="{{ route('movie.show', ['slug' => $ticket['sans']['movie']['slug']]) }}">
                                        {{ $ticket['sans']['movie']['title'] }}
                                        <i class="  fa-solid fa-chevron-left text-end justify-end  "></i>
                                    </a>

                                </th>
                                <td class="px-6 py-4">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $ticket['created_at_jalali'] }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($ticket['state'] === 'Valid')
                                        <span
                                            class="bg-green-700 text-green-50 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">موفق</span>
                                    @else
                                        <span
                                            class="bg-red-700 text-red-50 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">ناموفق</span>
                                    @endif

                                </td>
                                <td class="px-6 py-4">
                                    {{ convertDigitsToFarsi(number_format($ticket['total_price'])) }} تومان
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>



        </div>



    </section>
@endsection
