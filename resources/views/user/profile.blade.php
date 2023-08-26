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

            <div class="circle-image mr-4" id="avatar-container">
                @if ($user->avatar)
                    <img id="preview-image" src="{{ asset('storage/' . $user->avatar) }}" alt="Profile Image">
                @else
                    <img id="preview-image" src="{{ url('images/profile-mine.svg') }}" alt="Profile Image">
                    <i class="icon fas fa-camera"></i>
                    <div class="overlay"></div>

                @endif
                <input type="file" id="image-upload" accept="image/*" />
            </div>


            <form id="myform" class=" w-full flex flex-wrap" method="POST" action="{{ route('user.profile.update') }}">
                @csrf
                <div class="w-6/12 p-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                        <i class="fa-solid fa-user-large"></i>
                        نام و نام خانوادگی
                    </label>
                    <input type="text" id="email" value="{{ $user->name }}" name="user-name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="اصغر فرهادی" required>
                </div>

                <div class="w-6/12 p-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                        <i class="fa-solid fa-mobile-screen"></i>
                        شماره موبایل </label>
                    <input type="number" value="{{ $user->mobile }}" name="mobile"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="" required>
                </div>

                <div class="w-6/12 p-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                        <i class="fa-solid fa-envelope"></i>
                        ایمیل
                    </label>
                    <input type="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="name@company.com" value="{{ $user->email }}" name="email" required>
                </div>

                <div class="w-6/12 p-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                        <i class="fa-solid fa-calendar-days"></i>
                        تاریخ تولد
                    </label>
                    <input data-jdp
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="" required value="{{ $user->birthday }}" name="birthday">
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
                        <i class="fa-solid fa-chevron-left text-end justify-end  ml-2 mt-4"></i>
                    </div>
                </a>

            </div>


            <hr class="my-6" />

            <button type="submit" form="myform"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">ثبت
                تغییرات</button>
        </div>


    </section>

    <script>
$(document).ready(function() {
    const avatarContainer = $('#avatar-container');
    const imageUpload = $('#image-upload');
    const previewImage = $('#preview-image');
    const overlay = $('.overlay');
    const cameraIcon = $('.icon');

    avatarContainer.on('click', function() {
        imageUpload.click();
    });

    imageUpload.on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                uploadAvatar(file); 
            };
            reader.readAsDataURL(file);
        }
    });

    function uploadAvatar(file) {
        const formData = new FormData();
        formData.append('avatar', file);
        formData.append('_token', "{{ csrf_token() }}");

        $.ajax({
            url: '{{ route('user.profile.update.avatar') }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              
                if (response.avatar_url) {
                    previewImage.attr('src', response.avatar_url);
                    overlay.hide();
                    cameraIcon.hide();
                }
            },
            error: function(error) {
                console.error(error); 
            }
        });
    }
});

    </script>
@endsection
