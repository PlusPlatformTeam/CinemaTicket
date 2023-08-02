@extends('.user.template')

@section('title')
    بازیگر
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/character.css') }}">
@endsection


@section('content')
    <section>
        <div class="w-full flex flex-row gap-4 bg-responsive px-6 py-8 w-full h-64 z-10 blur-container "
            {{-- style="background-image: url({{ url($movie->second_banner) }})"> --}}
            <div class="blur-overlay"></div>
        </div>
    </section>


    {{-- <div class="w-full flex flex-row absolute z-20 top-32">
        <div class="hidden lg:flex lg:basis-3/12 lg:flex-row lg:justify-end">
            <img class="h-64 rounded-lg drop-shadow-2xl shadow-lg inline-block content" src="{{ url($movie->main_banner) }}"
                title="{{ $movie->title }}" alt="{{ $movie->title }}">
        </div>


        <div class="basis-full lg:basis-9/12 px-6">
            <h2 class="text-white text-2xl pb-8 content">{{ $movie->title }} |
                {{ $movie->director }}</h2>
            <span class="text-right text-white text-xl pb-8 content ">{{ $movie->category->name }}</span>
            <div class=" flex flex-row text-right mt-2">
                <span class="text-right text-white text-xl pb-8 content">
                    <i class="fa-solid fa-heart text-red-600"></i>
                    {{ convertDigitsToFarsi('5 / ' . $movie->score) }}
                </span>
                <span class="text-right text-white text-xl pb-8 content mx-4">
                    <i class="float-nav fa-solid fa-user"></i>
                    {{ convertDigitsToFarsi('120') }}
                </span>
                <span class="text-center text-white text-xl pb-8 content ">
                    |
                </span>
                <button class="text-right text-white text-xl pb-8 content mx-4">
                    <i class="fa-regular fa-heart "></i>
                    امتیاز شما
                </button>
            </div>
            <div class="flex flex-row lg:justify-between justify-end items-center -mt-5">
                <div class="flex text-right">
                    @foreach ($movie->characters as $actor)
                    <a  href="{{ route('actor.show', ['id' => $actor->id]) }}">
                          <div class="flex items-center ">
                            <img src="{{ $actor->avatar }}" alt="{{ $actor->name }}"
                                class="w-12 h-12 rounded-lg object-cover">
                            <div class="ml-4 mr-1">
                                <div class="font-medium text-lg text-white">{{ $actor->name }}</div>
                                <div class="text-gray-500">{{ $actor->role }}</div>
                            </div>
                        </div>
                    </a>
                      
                    @endforeach
                </div>
            </div>

            <div class="flex flex-row lg:justify-start mt-5 right-0">
                <button type="button"
                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center  mb-2">
                    <i class="fa-solid fa-ticket-simple" style="color: #ffffff;"></i>
                    انتخاب سالن تئاتر و خرید بلیط
                </button>
                <button data-modal-target="trailerModal" data-modal-toggle="trailerModal" type="button"
                    class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    <i class="fa-solid fa-play px-2"></i>
                    تیزر فیلم
                </button>

            </div>
        </div>
    </div> --}}

    <section>


    </section>
   
    @endsection
