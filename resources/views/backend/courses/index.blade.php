@extends('layouts.main_admin')
@section('content')
<!-- Page Headline -->
<div class="page-headline">
    <h1>{{__('Courses')}}</h1>
    @if(Auth::check())
    <a href="{{route('course.create')}}" class="btn green-grade small">{{__('Add Course')}}</a>
    @endif
</div>
<!-- // Page Headline -->
<div class="row responsive-table">
    <div class="col-12 col-m-12">
        <table  class="table striped bordered" id="section">
            <thead>
                <tr class="primary-bg">
                    <th>{{__('Name')}}</th>
                    <th>{{__('Activation')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
        </thead>
        </table>
    </div>   
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{MAINASSETS}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $("#section").DataTable({
            fixedHeader: true,
            orderCellsTop: false,
            "scrollX": true,
            "lengthMenu": [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
            "proccessing": true,
            "serverSide": true,
            "order": [[ 0, "asc" ]],
            "ajax": {
                url: "{{ route('course.datatable') }}",
                type: "POST",
                dataType: "JSON",
                data:function(d) {
                    d._token ="{{ csrf_token() }}";
                }
            },
            "columns": [
                {"data": "name", "searchable": true, "orderable": true},
                {"data": "active", "searchable": false, "orderable": true},
                {"data": "action", "searchable": false, "orderable": false}

            ],
            @if(app()->isLocale('ar'))
            "language": {
                "sProcessing":   "جارٍ التحميل...",
                "sLengthMenu":   "أظهر _MENU_ مدخلات",
                "sZeroRecords":  "لم يعثر على أية سجلات",
                "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix":  "",
                "sSearch":       "ابحث:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "الأول",
                    "sPrevious": "السابق",
                    "sNext":     "التالي",
                    "sLast":     "الأخير"
                }
            },
            @endif
        });
    })

</script>
@endsection





















