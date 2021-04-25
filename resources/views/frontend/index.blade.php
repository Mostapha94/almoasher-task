@extends('layouts.main_frontend')
@section('content')
<div class="row g-2">
    <div class="col-md-3">
        <div class="t-products p-2">
            <div class="heading d-flex justify-content-between align-items-center">
                <h6 class="text-uppercase">{{ __('Categories') }}</h6> <span>--</span>
            </div>
            @foreach($categories as $category)
            <div class="d-flex justify-content-between mt-2">
                <div class="form-check"> <input id="category_id" name="category_id" class="form-check-input" type="radio" value="{{ $category->id }}" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> {{ $category->name }} </label> </div>
            </div>
            @endforeach
           
        </div>
        <div class="brand p-2">
            <div class="heading d-flex justify-content-between align-items-center">
                <h6 class="text-uppercase">{{ __('Courses Rating') }}</h6> <span>--</span>
            </div>
            @foreach($ratings as $rating)
            <div class="d-flex justify-content-between mt-2">
                <div class="form-check"> <input name="rating" class="form-check-input" type="radio" value="{{ $rating }}" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">  </label>
                    @for($i = 0; $i < $rating; $i++)
                    <span class="fa fa-star checked"></span>
                    @endfor
                </div>
            </div>
            @endforeach
        </div>
        <div class="type p-2 mb-2">
            <div class="heading d-flex justify-content-between align-items-center">
                <h6 class="text-uppercase">{{ __('Levels') }}</h6> <span>--</span>
            </div>
            @foreach($levels as $level)
            <div class="d-flex justify-content-between mt-2">
                <div class="form-check"> <input name="levels" class="form-check-input" type="checkbox" value="{{ $level }}" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> {{ $level }} </div>
            </div>
            @endforeach
        </div>
        <div class="type p-2 mb-2">
            <div class="heading d-flex justify-content-between align-items-center">
                <h6 class="text-uppercase">{{ __('Time') }}</h6> <span>--</span>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <div class="form-check"> <input name="hours" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> {{ __('Less than 4 hours') }} </div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <div class="form-check"> <input name="hours" class="form-check-input" type="checkbox" value="2" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> {{ __('Less than 8 hours') }} </div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <div class="form-check"> <input name="hours" class="form-check-input" type="checkbox" value="3" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> {{ __('More than 8 hours') }} </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row g-2">
            <table id="frontendCourses">
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{MAINASSETS}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $("#frontendCourses").DataTable({
            fixedHeader: true,
            orderCellsTop: false,
            "scrollX": true,
            "lengthMenu": [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
            "proccessing": true,
            "serverSide": true,
            "order": [[ 0, "asc" ]],
            "ajax": {
                url: "{{ route('frontend.course.datatable') }}",
                type: "POST",
                dataType: "JSON",
                data:function(d) {
                    d._token ="{{ csrf_token() }}";
                    d.category_id = $("input[type='radio'][name='category_id']:checked").val();
                    d.levels = $("input[type='checkbox'][name='levels']:checked").val();
                    d.rating = $("input[type='radio'][name='rating']:checked").val();
                    d.hours = $("input[type='checkbox'][name='hours']:checked").val();
                }
            },
            "columns": [
                {"data": "course", "searchable": true, "orderable": true},
                {"data": "name", "searchable": true, "orderable": true},
                {"data": "description", "searchable": true, "orderable": true},
            ],
            "language": {
                "sProcessing":   "Loading...",
                "sLengthMenu":   "<span class='btn btn-primary'>Display _MENU_ Courses</span>",
                "sZeroRecords":  "No courses found",
                "sInfo":         "Display _START_ to _END_ from _TOTAL_ courses",
                "sInfoEmpty":    "Display 0 to 0 from 0 courses",
                "sInfoFiltered": "( from total _MAX_ record)",
                "sInfoPostFix":  "",
                "sSearch":       "<span class='btn btn-primary'>Search in courses:</span>",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "First",
                    "sPrevious": "Prev",
                    "sNext":     "Next",
                    "sLast":     "Last"
                }
            },
        });
    })
    $('input[type=radio][name=category_id]').change(function() {
        $('#frontendCourses').DataTable().draw(true);
    });
    $('input[type=checkbox][name=levels]').change(function() {
        $('#frontendCourses').DataTable().draw(true);
    });
    $('input[type=checkbox][name=hours]').change(function() {
        $('#frontendCourses').DataTable().draw(true);
    });
    $('input[type=radio][name=rating]').change(function() {
        $('#frontendCourses').DataTable().draw(true);
    });
    
</script>
@endsection
