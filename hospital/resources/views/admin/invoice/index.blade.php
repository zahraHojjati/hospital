@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1 active"><a href="">صورت حساب</a></li>
            </ol>
            @include('admin.invoice.includes.filter')
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('admin.paymentDoctor.index')}}" class="btn btn-info btn-group-sm"> ثبت صورتحساب جدید <i class="fe feather-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                            <thead class="text-white text-center" style="background-color: #8686ac">
                            <tr>
                                <th class="text-white">ردیف</th>
                                <th class="text-white">#</th>
                                <th class="text-white">نام دکتر</th>
                                <th class="text-white">مبلغ </th>
                                <th class="text-white"> باقیمانده </th>
                                <th class="text-white">تاریخ ثبت</th>
                                <th class="text-white"> وضعیت </th>
                                <th class="text-white">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="text-center btn-light">
                            @php $counter = 0; @endphp
                            @forelse ($invoices as $invoice)
                                @php $counter++; @endphp
                                <tr>
                                    <td class="text-center">{{ $counter }}</td>
                                    <td>{{$invoice->id}}</td>
                                    <td>{{$invoice->doctor->name}}</td>
                                    <td>{{number_format($invoice->amount)}}</td>
                                    <td>{{number_format($invoice->getRemainingAmount())}}</td>
                                    <td>{{verta($invoice->created_at)->format('Y/m/d')}}</td>
                                    <td>
                                        @if($invoice->status == 1)
                                            <span class="badge badge-success" style="width: 80px!important;">پرداخت شده</span>
                                        @else
                                            <span class="badge badge-danger">پرداخت نشده </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="ml-2 d-flex justify-content-center align-items-baseline">
                                            <a href="{{route('admin.payments.create',$invoice->id)}}" class="btn btn-cyan ml-1">
                                                <i class="feather feather-dollar-sign " data-toggle="tooltip" data-placement="top" title="پرداخت"></i>
                                            </a>
                                            <a href="{{route('admin.invoices.show',$invoice->id)}}" class="btn btn-primary ml-1">
                                                <i class="feather feather-eye " data-toggle="tooltip" data-placement="top" title="نمایش"></i>
                                            </a>
                                                @php $id = $invoice->id @endphp
                                                <a href="{{ route('admin.invoices.edit', $id) }}">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-warning ml-1 small">
                                                            <i class="fe fe-edit text-white"></i>
                                                        </button>
                                                    </div>
                                                </a>
                                                <button class="btn btn-danger"
                                                        onclick="confirmDelete('delete-{{ $invoice->id }}')"><i
                                                        class="fa fa-trash text-white small"></i></button>
                                                <form action="{{ route('admin.invoices.destroy', $invoice) }}"
                                                      method="post"
                                                      id="delete-{{ $invoice->id }}" style="display: none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-warning ">هیچ محتوایی وجود ندارد...</div>
                            @endforelse
                            </tbody>
                        </table>
                        {{--                {{ $categories->onEachSide(1)->links("vendor.pagination.bootstrap-4") }}--}}
                    </div>
                </div>
            </div>
@endsection

