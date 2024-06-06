@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
            <li class="breadcrumb-item" style="color: blue"> پرداخت ها </li>
        </ol>
        <div class="card">
{{--            <div class="card-header d-flex justify-content-end">--}}
{{--                <a href="{{ route('admin.invoices.create')}}" class="btn btn-info btn-group-sm"> ثبت پرداختی جدید </a>--}}
{{--            </div>--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                        <thead class="text-white text-center" style="background-color: #8686ac">
                        <tr>
                            <th class="text-white">ردیف</th>
                            <th class="text-white">شناسه</th>
                            <th class="text-white">دکتر</th>
                            <th class="text-white">مبلغ</th>
                            <th class="text-white">نوع پرداخت</th>
{{--                            <th class="text-white"> تصویر رسید</th>--}}
                            <th class="text-white"> وضعیت </th>
                            <th class="text-white">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="text-center btn-light">
                        @php $counter = 0; @endphp
                        @foreach ($payments as $payment)
                            @php $counter++; @endphp
                            <tr>
                                <td class="text-center">{{ $counter }}</td>
                                <td>{{$payment->id}}</td>
                                <td>{{$payment->invoice->doctor->name}}</td>
                                <td>{{number_format($payment->amount)}}</td>
                                @if($payment->pay_type == 'cash')
                                <td>نقد</td>
                                @else
                                    <td>چک</td>
                                @endif
                                <td>
                                    @if($payment->status == 1)
                                        <span class="badge badge-success" style="width: 80px!important;"> پرداخت شد </span>
                                    @else
                                        <span class="badge badge-danger"> پرداخت نشد </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-5  align-items-baseline">
                                        <a href="{{ route("admin.payments.show", ['payment' => $payment]) }}">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary ml-2">
                                                    <i class="fe fe-eye"></i>
                                                </button>
                                            </div>
                                        </a>
                                        @php $id = $payment->id @endphp
                                        <a href="{{ route('admin.payments.edit',  ['payment' => $payment]) }}">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-warning ml-2">
                                                    <i class="fe fe-edit text-white"></i>
                                                </button>
                                            </div>
                                        </a>

{{--                                        <button class="btn btn-danger ml-2"--}}
{{--                                                onclick="confirmDelete('delete-{{ $payment->id }}')"--}}
{{--                                                style="min-height: 20px"><i--}}
{{--                                                class="fe fe-trash-2 text-white"></i></button>--}}
{{--                                        <form action="{{ route('admin.payments.destroy', $payment->id) }}"--}}
{{--                                              method="post"--}}
{{--                                              id="delete-{{ $payment->id }}" style="display: none">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                        </form>--}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection

