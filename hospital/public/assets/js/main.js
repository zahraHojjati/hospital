function confirmDelete(formId) {
    swal({
        title: 'آیا مطمئن هستید؟',
        text: 'بعد از حذف این آیتم دیگر قابل بازیابی نخواهد بود!',
        icon: 'warning',
        buttons: ["انصراف", "حذف کن"],
        dangerMode: true
    })
        .then((willDelete) => {
            if (willDelete) {
                document.getElementById(formId).submit();
                swal('آیتم با موفقیت حذف شد.', {
                    icon: 'success',
                });
            }
        });
}



    //select2
    $(".js-example-tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' ']
});



    //datetimepicker
    $('#published_at_date_show').MdPersianDateTimePicker({
    targetDateSelector: '#published_at_date',
    targetTextSelector: '#published_at_date_show',
    englishNumber: false,
    toDate: true,
    enableTimePicker: false,
    dateFormat: 'yyyy-MM-dd',
    textFormat: 'yyyy-MM-dd',
    groupId: 'rangeSelector1',
});


$('#surgeried_at_date_show').MdPersianDateTimePicker({
    targetDateSelector: '#surgeried_at_date',
    targetTextSelector: '#surgeried_at_date_show',
    englishNumber: false,
    toDate: true,
    enableTimePicker: false,
    dateFormat: 'yyyy-MM-dd',
    textFormat: 'yyyy-MM-dd',
    groupId: 'rangeSelector1',
});
$('#released_at_date_show').MdPersianDateTimePicker({
    targetDateSelector: '#released_at_date',
    targetTextSelector: '#released_at_date_show',
    englishNumber: false,
    toDate: true,
    enableTimePicker: false,
    dateFormat: 'yyyy-MM-dd',
    textFormat: 'yyyy-MM-dd',
    groupId: 'rangeSelector1',
});


$('#from_date_show').MdPersianDateTimePicker({
    targetDateSelector: '#from_date',
    targetTextSelector: '#from_date_show',
    englishNumber: false,
    toDate: true,
    enableTimePicker: false,
    dateFormat: 'yyyy-MM-dd',
    textFormat: 'yyyy-MM-dd',
    groupId: 'rangeSelector1',
});
$('#to_date_show').MdPersianDateTimePicker({
    targetDateSelector: '#to_date',
    targetTextSelector: '#to_date_show',
    englishNumber: false,
    toDate: true,
    enableTimePicker: false,
    dateFormat: 'yyyy-MM-dd',
    textFormat: 'yyyy-MM-dd',
    groupId: 'rangeSelector1',
});
$('#from_surgeried_at_show').MdPersianDateTimePicker({
    targetDateSelector: '#from_surgeried_at',
    targetTextSelector: '#from_surgeried_at_show',
    englishNumber: false,
    toDate: true,
    enableTimePicker: false,
    dateFormat: 'yyyy-MM-dd',
    textFormat: 'yyyy-MM-dd',
    groupId: 'rangeSelector1',
});
$('#to_surgeried_at_show').MdPersianDateTimePicker({
    targetDateSelector: '#to_surgeried_at',
    targetTextSelector: '#to_surgeried_at_show',
    englishNumber: false,
    toDate: true,
    enableTimePicker: false,
    dateFormat: 'yyyy-MM-dd',
    textFormat: 'yyyy-MM-dd',
    groupId: 'rangeSelector1',
});
    //datetimepicker
    $('#created_at_show').MdPersianDateTimePicker({
    targetDateSelector: '#created_at',
    targetTextSelector: '#created_at_show',
    englishNumber: false,
    toDate: true,
    enableTimePicker: false,
    dateFormat: 'yyyy-MM-dd',
    textFormat: 'yyyy-MM-dd',
    groupId: 'rangeSelector1',
});
$('#due_date_show').MdPersianDateTimePicker({
    targetDateSelector: '#due_date',
    targetTextSelector: '#due_date_show',
    englishNumber: false,
    toDate: true,
    enableTimePicker: false,
    dateFormat: 'yyyy-MM-dd',
    textFormat: 'yyyy-MM-dd',
    groupId: 'rangeSelector1',
});

//comma
    $(document).ready(function () {
    $('input.comma').on('keyup', function (event) {
        if (event.which >= 37 && event.which <= 40) return;
        $(this).val(function (index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });

    //select2 این سلکت تو قابلیت انتخاب چند آپشن را از دیتا بیس دارد

            $(".js-example-basic-multiple-limit").select2({
            maximumSelectionLength: 100
        });


    // select2 این سلکت تو قابلیت خواندن آپشن ها هم از دیتا بیس و هم قابلیت اضافه کردن را دارد
        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
});
