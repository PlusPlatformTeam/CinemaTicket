@extends('.user.template')

@section('title')
    صفحه احراز هویت
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register_verification.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/register-verification.js') }}"></script>
@endsection

@section('content')
    <section class="w-full flex  h-screen bg-screen">

        <div class="z-1 relative flex flex-row justify-center text-center items-center w-full px-3">

            <div class="lg:basis-6/12 md:basis-9/12 basis-full">

                <div class="flex justify-center text-center pb-8">
                    <img src="{{ asset('images/logo.svg') }}" class="h-8 mr-3" alt="Flowbite Logo" />
                    <img src="https://cinematicket.org/v3.17.6/assets/images/typography_dark.svg"
                        class="self-center text-2xl font-semibold whitespace-nowrap light:text-black" />
                </div>

                <div class="flex justify-center text-center pb-16 w-full relative">
                    <a
                        @if (session('parent_send') === 'user.register.verify.code') href="{{ route('user.register') }}"
                    @elseif (session('parent_send') === 'user.login.verify.code')
                    href="{{ route('user.login') }}" @endif>
                        <button type="button"
                            class="absolute right-0 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">
                            <i class="fa-solid fa-arrow-right ml-1"></i>
                            بازگشت
                        </button>
                    </a>
                </div>

                <div class="w-full p-6 bg-white border border-gray-100 rounded-lg shadow bg-white border-gray-100 ">

                    <div class="w-full  px-2 block mb-8 ">

                        <div class="md:w-9/12 w-full mt-3">
                            <h1 class="flex w-full text-gray-900 font-bold text-lg relative right-0">کد فرستاده شده را
                                وارد کنید.</h1>
                        </div>


                        <div class="md:flex md:flex-row block mt-7">
                            <form class="relative w-full flex  basis-full" method="POST"
                                @if (session('parent_send') === 'user.register.verify.code') action="{{ route('user.register.verify.code') }}"
                                 @elseif (session('parent_send') === 'user.login.verify.code')
                                 action="{{ route('user.login.verify.code') }}" @endif>
                                @csrf
                                <div dir="ltr" class="w-full md:basis-8/12">
                                    <div class="flex">
                                        <span
                                            class="w-full inline-flex items-center text-sm text-gray-900 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
                                            <a href="#" class="p-2">
                                                <p class="text-gray-800">
                                                    <span id="resend-text">
                                                        ارسال مجدد
                                                    </span>
                                                    <span id="countdown-timer"></span>

                                                </p>
                                            </a>
                                            <input type="text" dir="rtl" name="verified_code"
                                                class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                                placeholder="کد تایید ...">
                                        </span>
                                    </div>
                                </div>

                                <div class="relative w-full flex md:basis-4/12 basis-full mt-5 md:mt-0">
                                    <button type="submit"
                                        class="text-center justify-center flex w-full text-white bg-gray-400 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                                        ادامه
                                    </button>
                                </div>
                            </form>

                        </div>


                    </div>

                </div>

            </div>
        </div>
    </section>


    <script>
        $(document).ready(() => {
            const countdownTimer = document.getElementById("countdown-timer");
            const resendText = document.getElementById("resend-text");
            const counter = 60;
            let intervalId;

            function formatTime(time) {
                const minutes = Math.floor(time / 60);
                const seconds = time % 60;
                const formattedMinutes = minutes.toString().padStart(2, "0");
                const formattedSeconds = seconds.toString().padStart(2, "0");
                return `${formattedMinutes}:${formattedSeconds}`;
            }

            function startCountdown() {
                let count = counter;
                countdownTimer.style.display = "inline";
                resendText.style.display = "none";
                countdownTimer.textContent = `${formatTime(count)}`;

                intervalId = setInterval(() => {
                    count--;
                    if (count >= 0) {
                        countdownTimer.textContent = `${formatTime(count)}`;
                    } else {
                        clearInterval(intervalId);
                        countdownTimer.style.display = "none";
                        resendText.style.display = "inline";
                        intervalId = null; // Reset intervalId to null when the timer ends
                    }
                }, 1000);
            }

            resendText.addEventListener("click", () => {
                startCountdown(); // Start the countdown again
                $.ajax({
                    url: "{{ route('user.resend.code') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Handle the success response here
                        console.log(response);
                        // Example: Start the countdown and update UI
                        startCountdown();
                    },
                    error: function(error) {
                        // Handle the error response here
                        console.error(error);
                        // Example: Show an error message to the user
                        alert('Failed to resend the code. Please try again.');
                    }
                });
            });

            startCountdown();
        });
    </script>
@endsection
