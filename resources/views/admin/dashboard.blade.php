@extends('admin.template')

@section('title')
    پیشخوان
@endsection

@section('content')
    <section class="p-4">
        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4 w-full">
            <div class="bg-white flex justify-between p-4 rounded-lg shadow-md items-center">
                <span class="flex items-center bg-green-500 rounded-lg py-4 px-5 text-white text-xl text-center ml-3">
                    <i class="fa-solid fa-film"></i>
                </span>
                <p>سینماها : 2500</p>
            </div>
            <div class="bg-white flex justify-between p-4 rounded-lg shadow-md items-center">
                <span class="flex items-center bg-rose-500 rounded-lg py-4 px-5 text-white text-xl text-center ml-3">
                    <i class="fa-solid fa-video"></i>
                </span>
                <p>فیلم ها : 2500</p>
            </div>
            <div class="bg-white flex justify-between p-4 rounded-lg shadow-md items-center">
                <span class="flex items-center bg-purple-500 rounded-lg py-4 px-5 text-white text-xl text-center ml-3">
                    <i class="fas fa-users-rectangle"></i>
                </span>
                <p>بازیگران : 2500</p>
            </div>
            <div class="bg-white flex justify-between p-4 rounded-lg shadow-md items-center">
                <span class="flex items-center bg-amber-400 rounded-lg py-4 px-5 text-white text-xl text-center ml-3">
                    <i class="fa-solid fa-comments"></i>
                </span>
                <p>نظرات : 2500</p>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">نمودار منطقه‌ای</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="areaChart" style="height:250px"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
