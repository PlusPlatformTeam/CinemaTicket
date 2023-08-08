
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
    <h1 class="text-black font-bold text-2xl">اطلاعات بلیت و پرداخت</h1>
    <div class="bg-gray-300 rounded-xl flex flex-row justify-between p-2 mr-4 -mt-1">
        <i class="fa-solid fa-ticket ml-2"></i>
        <h1 class="text-black font-normal text-md">{{convertDigitsToFarsi(2)}} بلیت</h1>
    </div>
</header>


<div class="w-full flex flex-row">
    
<div class="w-8/12 pr-4 py-4 pl-2">

    <div class="bg-white rounded-lg w-full h-96">

        {{-- <div class="pl-5 border-l-2 border-dashed text-xs flex pr-5 items-center w-3/12">
            <img class="w-20 rounded-lg ml-3" src="{{ url($sans->movie[0]->main_banner) }}" alt="">
            <div class="flex flex-col justify-between h-full mt-1 pt-3">
                <h2 class="text-sm font-bold">{{ $sans->movie[0]->title }}</h2>
                <p class="flex items-center">
                    <i class="fa-solid fa-location-dot ml-2"></i>
                    <span class="text-bold ml-2">{{ $sans->cinema[0]->title }}</span>
                    <span>({{ $sans->hall[0]->title }})</span>
                </p>
                <p class="flex items-center">
                    <i class="fa-regular fa-clock ml-2"></i>
                    <span class="text-bold ml-2 ">{{ $time['date'] }}</span>
                    <span>- سانس {{ convertDigitsToFarsi($time['clock']) }}</span>
                </p>
            </div>
        </div> --}}

    </div>

</div>


<div class="w-4/12 pl-4 py-4 pr-2 block">

    <div class="bg-white rounded-lg w-full h-96">


    </div>

    <div class="bg-white rounded-lg w-full  mt-3 p-4">

        <button id="submit-button" class="w-full bg-red-500 h-12 rounded-lg text-white font-semibold">خرید</button>

    </div>

</div>


</div>


</section>


<script>
    // $(document).ready(function() {


    //     $('#submit-button').click(function() {

    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });

    //         $.ajax({
    //             url: '{{ route('sans.preFactor') }}',
    //             method: 'POST',
    //             data: {
    //                 selectedItems: selectedItems,
    //                 sansSlug: {{ $sans['slug'] }}
    //             },
    //             success: function(response) {
    //                 console.log('AJAX request succeeded:', response);
    //             },
    //             error: function(xhr, status, error) {
    //                 console.log('AJAX request failed:', error);
    //             }
    //         });
    //     });

    // });
</script>

@endsection
