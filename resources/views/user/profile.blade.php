@extends('.user.template_profile')

@section('title')
    اطلاعات کاربر
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/profile.js') }}"></script>
@endsection

@section('content')
    <section class="w-full flex h-fit p-12 ">


        <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8  h-screen">

            <div class="circle-image">
                <img id="preview-image" src="{{url("images/profile-mine.svg")}}" alt="Profile Image">
                <div class="overlay"></div>
                <input type="file" id="image-upload" accept="image/*" />
                <i class="icon fas fa-camera"></i>
              </div>
              

            <form class=" w-full flex flex-wrap" action="#">
                <div class="w-6/12 p-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                        <i class="fa-solid fa-user-large"></i>
                        نام و نام خانوادگی
                    </label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="اصغر فرهادی" required>
                </div>

                <div class="w-6/12 p-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                        <i class="fa-solid fa-mobile-screen"></i>
                        شماره موبایل </label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="" required>
                </div>

                <div class="w-6/12 p-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                        <i class="fa-solid fa-envelope"></i>
                        ایمیل
                    </label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="name@company.com" required>
                </div>

                <div class="w-6/12 p-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                        <i class="fa-solid fa-calendar-days"></i>
                        تاریخ تولد
                    </label>
                    <input data-jdp  name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="" required>
                </div>

            </form>

            <hr />

            <div class="w-full flex flex-row mt-6 ">
                <a href="#" class="w-3/12 flex flex-row hover:bg-gray-100 rounded-md relative p-2">

                    <div class="text-start justify-start flex flex-row w-full mt-3">
                        <i class="fa-solid fa-lock"></i>
                        <h1 class="text-black text-md font-normal mr-3">انتخاب یا تغییر رمز عبور</h1>
                    </div>
                    <div w-full>
                        <i class="  fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                    </div>
                </a>

            </div>


            <hr class="my-6" />

            <button type="button"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">ثبت
                تغییرات</button>



        </div>





    </section>
@endsection
