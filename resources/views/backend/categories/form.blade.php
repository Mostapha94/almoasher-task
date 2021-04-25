@extends('layouts.main_admin')
@section('content')
<!-- Page Headline -->
<div class="page-headline">
    @if(empty($category))
        <h1>{{__('Add Category')}}</h1>
    @else
        <h1>{{__('Update Category')}}</h1>
        <a href="{{route('category.create')}}" class="btn green-grade small">{{__('Add Category')}}</a>
    @endif
</div>
<!-- // Page Headline -->

<!-- Grid -->
<form action="{{ empty($category)? route('category.store') : route('category.update', $category->id) }}" id="addCategoryForm" class="row form-ui" method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($category)&&!empty($category))
        @method('put')
    @endif
    <div class="col-12 col-m-12 widget-block">
        @if ($errors->any())
            <div class="row alert danger">
                <b></b> {{__('Pleas make sure the your data is correct')}}
                <a href="#" class="ti-close remove-item"></a>
            </div>
        @endif
        <div class="content-box">
            <div class="form-group">
                <label>{{ __('Category Name') }}</label>
                @if($errors->has('name'))
                    <span class="error">{{$errors->first('name')}}</span>
                @endif
                <input name="name" value="{{ old('name', (empty($category))? null : $category->name) }}"  type="text" class="{{($errors->has('name'))?'error':''}} form-control" placeholder="{{ __('Category Name')}}" >
            </div>
                
            <label class="radio-button">
                <input type="radio" name="active" value="1" {{ (!empty($category) && old('active', $category->active == 1)) ? 'checked' : '' }}>
                <span>{{ __('Active') }}</span>
            </label>
            <label class="radio-button">
                <input type="radio" name="active" value="0" {{ (!empty($category) && old('active', $category->active == 0)) ? 'checked' : '' }}>
                <span>{{ __('Not Active') }}</span>
            </label>
        </div>
    </div>
  
    <!-- Controls Group -->
    <div class="col-12 col-m-12 widget-block">
        <div class="content-box">
            <!-- Button -->
            <input type="submit" value="{{empty($category)? __('Submit') : __('Update')}}" class="btn green-grade block-lvl">
        </div>
    </div>
    <!-- // Controls Group -->
</form>
<!-- // Grid -->
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function () {                                
    $("#addCategoryForm").validate({
        errorElement: 'span', //default input error message container
        errorClass: 'error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        rules: {
            name: {
                required: true,
                maxlength: 100,
            }
        }
    });
});
</script>
@endsection
