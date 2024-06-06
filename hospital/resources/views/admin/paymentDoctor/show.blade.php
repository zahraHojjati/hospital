@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1 active"><a style="color: #036262">پرداخت دکتر {{$doctor->name}}</a></li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header border-0 justify-content-between ">
                <div class="d-flex">
                    <p class="card-title ml-2 " style="font-weight: bolder;">پرداخت به دکتر : {{ $doctor->name }} ، از تاریخ {{verta($fromReleasedAt)->format('Y/m/d')}} - تا تاریخ {{verta($toReleasedAt)->format('Y/m/d')}}</p>
                </div>
            </div>
            <div class="card-header d-flex justify-content-end">
                <form action="{{ route('admin.paymentDoctor.store') }}" class="col-12" method="POST"
                      id="doctorSurgeryForm">
                @csrf
                    <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                        <thead class="text-white text-center" style="background-color: #8686ac">
                        <tr>
                            <th class="text-center border-top">
                                <input type="checkbox" id="headerCheckbox">
                            </th>
                            <th class="text-white text-center border-top">شناسه</th>
                            <th class="text-white text-center border-top">نام بیمار</th>
                            <th class="text-white text-center border-top">عمل ها</th>
                            <th class="text-white text-center border-top">تاریخ عمل</th>
                            <th class="text-white text-center border-top">مبلغ عمل (تومان)</th>
                            <th class="text-white text-center border-top">نقش دکتر</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1; ?>
                        @forelse ($doctorSurgeries as $doctorSurgery)
                            <tr>
                                <td class="text-center">
                                    <input
                                        type="checkbox"
                                        name="doctor_surgery_ids[]"
                                        class="rowCheckbox"
                                        value="{{ $doctorSurgery->id }}"
                                    />
                                </td>
                                <td class="text-center">{{ $counter }}</td>
                                <td class="text-center">{{ $doctorSurgery->surgery->patient_name }}</td>
                                <td class="text-center">
                                    @php
                                        $countOfOperations = $doctorSurgery->surgery->operations->count();
                                        $counter = 1;
                                    @endphp
                                    @foreach ($doctorSurgery->surgery->operations as $operation)
                                        <span class="fs-14 mr-1"> {{ $operation->name }} </span>
                                        @if ($counter < $countOfOperations)
                                            <span class="fs-14 mr-1"> - </span>
                                        @endif
                                        @php $counter++; @endphp
                                    @endforeach
                                </td>
                                <td class="text-center">{{verta($doctorSurgery->surgery->surgeried_at)->format('Y/m/d')}}</td>
                                <td class="text-center" data-value="{{ $doctorSurgery->amount }}" data-amount="{{ $doctorSurgery->amount }}">
                                    {{number_format($doctorSurgery->amount)}}
                                </td>
                                <td class="text-center">{{ $doctorSurgery->doctorRole->title }}</td>
                            </tr>
                                <?php $counter++; ?>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="text-center">
                                        <span class="text-danger">هیچ داده ای یافت نشد</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="6">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="font-weight-bold">مبلغ کل (تومان): </span>
                                        <span> {{number_format($totalPrice)}} </span>
                                    </div>
                                    <div>
                                        <span class="font-weight-bold">مبلغ کل جراحی های انتخاب شده: </span>
                                        <span id="totalPrice">  </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>

                    </table>

                    <button class="btn btn-primary col-12">ایجاد صورتحساب</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function number_format(number, decimals =  0, decPoint = '.', thousandsSep = ',') {
            var n = !isFinite(+number) ?  0 : +number;
            var prec = !isFinite(+decimals) ?  0 : Math.abs(decimals);
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
            var s = '';
            var toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length >  3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length +  1).join('0');
            }
            return s.join(dec);
        }


        document.addEventListener('DOMContentLoaded', function () {
            var headerCheckbox = document.getElementById('headerCheckbox');
            var rowCheckboxes = document.querySelectorAll('.rowCheckbox');

            function toggleAllCheckboxes(checked) {
                rowCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = checked;
                });
            }

            function updateTotalPrice() {
                var totalPriceSpan = document.getElementById('totalPrice');
                var checkedRows = document.querySelectorAll('.rowCheckbox:checked');
                var totalAmount =  0;

                checkedRows.forEach(function(checkbox) {
                    var row = checkbox.closest('tr');
                    var amountCell = row.querySelector('[data-amount]');
                    var amount = parseFloat(amountCell.dataset.amount);
                    totalAmount += amount;
                });

                totalPriceSpan.textContent = number_format(totalAmount) + ' ' + 'تومان';
            }

            headerCheckbox.addEventListener('change', function() {
                toggleAllCheckboxes(this.checked);
                updateTotalPrice();
            });

            rowCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', updateTotalPrice);
            });

            updateTotalPrice();
        });
    </script>
@endsection
