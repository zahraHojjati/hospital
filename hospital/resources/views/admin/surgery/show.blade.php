@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.surgeries.index')}}"> لیست جراحی ها</a></li>
            <li class="breadcrumb-item"><a href=""> جزئیات جراحی </a></li>
        </ol>
        <div class="card-header d-flex justify-content-first" style="background-color: #5dacf2">
            <h2 class="card-title" style="font-family:'2  Koodak'"> مشاهده جزئیات جراحی </h2>
        </div>
        <div class="card">
            <div class="card-header">
                <p class="card-title" style="font-weight: bolder;padding-top: 2%">جراحی شماره : {{ $surgery->id }}
                <hr>
                <div class="d-flex">
                    <a href="{{route("admin.surgeries.edit", ['surgery' => $surgery])}}" class="btn btn-info ml-2">
                        <i class="fe fe-edit text-white"></i>
                    </a>
                    <button onclick="confirmDelete('delete-{{ $surgery->id }}')" class="btn btn-danger ml-2">
                        <i class="fe fe-trash-2 text-white"></i>
                    </button>
                    <form action="{{ route('admin.surgeries.destroy', $surgery) }}" method="POST"
                          id="delete-{{ $surgery->id }}" style="display: none">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="{{route("admin.surgeries.index")}}" class="btn btn-warning ">
                        <i class="fe fe-log-out text-white"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-between">

                    <div class="d-flex flex-column justify-content-between">

                        <div class="d-flex align-items-center">
                            <span class="fs-20 font-weight-bolder">نام بیمار :</span>
                            <span class="fs-18 mr-2">{{ $surgery->patient_name }}</span>
                        </div>
                        <br>
                        <div class="d-flex align-items-center">
                            <span class="fs-20 font-weight-bolder">پزشک جراح ، بیهوشی ، مشاور  :</span>
                            <span class="fs-18 mr-2">{{ implode(', ', $surgery->doctors->pluck('name')->all()) }}</span>
                        </div>
                        <br>
                        <div class="d-flex align-items-center">
                            <span class="fs-20 font-weight-bolder">  عمل ها  :</span>
                            <span
                                class="fs-18 mr-2"> {{ implode(', ', $surgery->operations->pluck('name')->all()) }}</span>
                        </div>
                        <br>
                        <div class="d-flex align-items-center">
                            <span class="fs-20 font-weight-bolder">کدملی :</span>
                            <span class="fs-18 mr-2">{{ $surgery->patient_national_code }}</span>
                        </div>
                        <br>
                        <div class=" d-flex align-items-center ">
                            <span class="fs-20 font-weight-bolder">  بیمه پایه :</span>
                            <span class="fs-18 mr-2">{{ $surgery->basic_insurance_id }} -
                                @foreach($insurances as $insurance)
                                    {{ $insurance->name }}  __ </span>
                            @endforeach
                        </div>
                        <br>
                        <div class=" d-flex align-items-center ">
                            <span class="fs-20 font-weight-bolder">  بیمه تکمیلی :</span>
                            <span class="fs-18 mr-2">{{ $surgery->supp_insurance_id }} -
                               @foreach($insurances as $insurance)
                                    {{ $insurance->name }}  __ </span>
                            @endforeach
                        </div>
                        <br>
                        <div class=" d-flex align-items-center ">
                            <span class="fs-20 font-weight-bolder"> شماره سند  :</span>
                            <span class="fs-18 mr-2">{{$surgery->document_number }}</span>
                        </div>
                        <br>
                        <div class=" d-flex align-items-center ">
                            <span class="fs-20 font-weight-bolder">  توضیحات  :</span>
                            <span class="fs-18 mr-2">{{$surgery->description }}</span>
                        </div>
                        <br>
                        <div class=" d-flex align-items-center ">
                            <span class="fs-20 font-weight-bolder"> تاریخ جراحی  :</span>
                            <span class="fs-18 mr-2">{{verta($surgery->surgeried_at)->format('Y/m/d')  }}</span>
                        </div>
                        <br>
                        <div class=" d-flex align-items-center ">
                            <span class="fs-20 font-weight-bolder"> تاریخ ترخیص  :</span>
                            <span class="fs-18 mr-2">{{verta($surgery->released_at)->format('Y/m/d')  }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

