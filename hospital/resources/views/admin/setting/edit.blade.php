@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header border-0 d-flex justify-content-between">
                    <p class="card-title ml-2" style="font-weight: bolder;">ویرایش تنظیمات - {{$group}}</p>
                    <a href="{{route('admin.settings.index')}}" class="btn btn-outline-warning ">بازگشت</a>
                </div>
                <div class="card-body">
                    <form action="{{ route("admin.settings.update") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")
                        <div class="row">
                            @foreach ($settingTypes as $type => $settings)
                                @if ($type == 'text' OR $type == "number" OR $type == "email")
                                    @foreach ($settings as $setting)
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label" for="{{ $setting->name }}">{{ $setting->label }}</label>
                                                <input
                                                    id="{{ $setting->name }}"
                                                    type="{{ $type }}"
                                                    name="{{ $setting->name }}"
                                                    class="form-control"
                                                    value="{{ $setting->value }}"
                                                    @if ($type == "number") min="0" @endif
                                                />
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($type == 'image')
                                    @foreach ($settings as $setting)
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label" for="{{ $setting->name }}">{{ $setting->label }}</label>
                                                <input
                                                    id="{{ $setting->name }}"
                                                    value="{{ $setting->value }}"
                                                    type="file"
                                                    name="{{ $setting->name }}"
                                                    class="form-control"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-image-{{ $setting->id }}')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <br>
                                            <figure class="figure">
                                                <img
                                                    src="{{ Storage::url($setting->value) }}"
                                                    class="img-thumbnail"
                                                    width="50" height="50"
                                                    alt="{{ $setting->label }}"
                                                />
                                            </figure>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($type == "textarea")
                                    @foreach ($settings as $setting)
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="{{ $setting->name }}">{{ $setting->label }}</label>
                                                <textarea class="form-control" name="{{ $setting->name }}" id="{{ $setting->name }}">{!! $setting->value !!}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                        <button class="btn btn-warning" type="submit">بروزرسانی</button>
                    </form>
                    @foreach ($settingTypes as $type => $settings)
                        @if ($type == "image")
                            @foreach ($settings as $setting)
                                <form action="{{ route('admin.settings.destroy.file', $setting) }}" id="delete-image-{{$setting->id}}" method="POST" style="display: none;">
                                    @csrf
                                    @method("DELETE")
                                </form>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
