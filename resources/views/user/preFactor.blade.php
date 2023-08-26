@extends('.user.template')

@section('title')
    پیش فاکتور | سینما تیکت
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preFactor.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/preFactor.js') }}"></script>
@endsection

@section('content')
    <section class="h-screen">
        <header class="justify-start text-start p-4 flex flex-row">
            <h1 class="text-black font-bold md:text-2xl text-lg">اطلاعات بلیت و پرداخت</h1>
            <div class="bg-gray-300 rounded-xl flex flex-row justify-between p-2 mr-4 -mt-1">
                <i class="fa-solid fa-ticket ml-2"></i>
                <h1 class="text-black font-normal text-md">{{ convertDigitsToFarsi(2) }} بلیت</h1>
            </div>
        </header>


        <div class="w-full lg:flex lg:flex-row block">

            <div class="w:full lg:w-8/12 lg:pr-4 lg:py-4 lg:pl-2 p-3">

                <div class="bg-white rounded-lg w-full h-96 p-8 block">

                    <div class="text-md flex  w-full justify-start">
                        <img class="w-24 rounded-lg ml-3" src="{{ url($sans->movie[0]->main_banner) }}" alt="">
                        <div class="flex flex-col justify-between h-full pt-3">
                            <h2 class="text-xl font-bold -mt-2">{{ $sans->movie[0]->title }}</h2>
                            <p class="flex items-center mt-6">
                                <i class="fa-solid fa-location-dot ml-2"></i>
                                <span class="text-bold ml-4">{{ $sans->cinema[0]->title }}</span>
                                <span>سالن {{ $sans->hall[0]->title }}</span>
                            </p>
                            <p class="flex items-center mt-6">
                                <i class="fa-regular fa-clock ml-2"></i>
                                <span class="text-bold ml-2 ">{{ $time['date'] }}</span>
                                <span>- سانس {{ convertDigitsToFarsi($time['clock']) }}</span>
                            </p>
                        </div>
                    </div>


                    <div class="block mt-12 ">
                        <p class="font-bold md:text-lg text-md">
                            {{ convertDigitsToFarsi(count($seatsDetail)) }} صندلی برای شما
                        </p>
                        <div class="flex flex-wrap w-full text-center">

                            @foreach ($seatsDetail as $item)
                                <div class="bg-gray-200 rounded-lg p-3 mt-2 lg:w-4/12 w-full m-1">
                                    <p class="text-sx text-gray-700">
                                        ردبف {{ convertDigitsToFarsi($item->row) }} . صندلی
                                        {{ convertDigitsToFarsi($item->col) }}
                                    </p>
                                </div>
                            @endforeach

                        </div>

                    </div>

                </div>

            </div>


            <div class="lg:w-4/12 lg:pl-4 lg:py-4 lg:pr-2 w-full p-3">

                <div class="bg-white rounded-lg w-full  block p-7">
                    <p class="text-balck text-lg font-semibold ">
                        جزئیات پرداخت
                    </p>
                    <div class="flex flex-row justify-between text-md text-gray-600 mt-12">
                        <p>
                            بلیت به ارزش {{ convertDigitsToFarsi(number_format($sans["price"])) }} تومان
                        </p>
                        <p>
                            {{ convertDigitsToFarsi(count($seatsDetail)) }} عدد
                        </p>
                        <p>
                            {{ convertDigitsToFarsi(number_format($totalPriceCount)) }} تومان
                        </p>
                    </div>

                    <div class="flex flex-row justify-between text-md text-gray-600 mt-12">
                        <p>
                            کارمزد خرید آنلاین
                        </p>
                        <p>
                            4%
                        </p>
                        <p >
                            {{ convertDigitsToFarsi(number_format($taksPrice)) }} تومان
                        </p>
                    </div>

                    <hr class="bg-gray-200 mt-6" />

                    <div class="flex flex-row justify-between font-semibold text-gray-800 mt-6">
                        <p>
                            مبلغ قابل پرداخت
                        </p>

                        <p>
                            {{ convertDigitsToFarsi(number_format($totalPrice)) }} تومان
                        </p>
                    </div>


                </div>

                <div class="bg-white rounded-lg w-full mt-3 p-3">
                    <form method="POST" action="{{ route('sans.buy') }}">
                        @csrf
                        <input type="hidden" name="selected_items" id="selected-items-input">
                        <input type="hidden" name="sansId" value={{ $sans['id'] }}>
                        <button id="submit-button"
                            class="w-full flex flex-row bg-red-500  rounded-lg text-white font-semibold justify-between items-center p-4">
                            <p>
                                پرداخت و دریافت بلیت
                            </p>
                            <p>
                                {{ convertDigitsToFarsi(number_format($totalPrice)) }} تومان
                            </p>
                        </button>
                    </form>
                </div>

            </div>


        </div>


    </section>


    <script>
        $(document).ready(function() {
            var selectedItems = <?php echo json_encode($seatsDetail); ?>;
            $('#selected-items-input').val(JSON.stringify(selectedItems));
        });
    </script>
@endsection
