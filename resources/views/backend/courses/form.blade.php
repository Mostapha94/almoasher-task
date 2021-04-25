@extends('layouts.main_admin')
@section('content')
<!-- Page Headline -->
<div class="page-headline">
    @if(empty($course))
        <h1>{{__('Add Course')}}</h1>
    @else
        <h1>{{__('Update Course').' '.$course->name}}</h1>
        <a href="{{route('course.create')}}" class="btn green-grade small">{{__('Add Course')}}</a>
    @endif
</div>
<!-- // Page Headline -->

<!-- Grid -->
<form action="{{ empty($course)? route('course.store') : route('course.update', $course->id) }}" id="addCourseForm" class="row form-ui" method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($course)&&!empty($course))
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
                <label>{{ __('Course Name') }}</label>
                @if($errors->has('name'))
                    <span class="error">{{$errors->first('name')}}</span>
                @endif
                <input name="name" value="{{ old('name', (empty($course))? null : $course->name) }}"  type="text" class="{{($errors->has('name'))?'error':''}} form-control" placeholder="{{ __('Course Name')}}" >
            </div>
            <div class="form-group">
                <label>{{ __('Course Description')}}</label>
                @if($errors->has('description'))
                    <span class="error">{{$errors->first('description')}}</span>
                @endif
                <textarea name="description" value="{{ old('description', (empty($course))? null : $course->description) }}"  type="text" class="{{($errors->has('description'))?'error':''}} form-control" placeholder="{{ __('Course Description')}}" >{{ old('description', (empty($course))? null : $course->description) }}</textarea>
            </div>
            @if($errors->has('image'))
            <span class="help-block error">{{$errors->first('image')}}</span>
            @endif
            <div class="file-input {{($errors->has('image'))?'error':''}}" data-text="{{__('Image')}}" data-btn="{{__('Upload Image')}}">
                <input name="image" type="file" class="{{($errors->has('image'))?'error':''}}">
            </div>
            @if(!empty($course))
            <div>
                <img width="300" src="{{MAINUPLOADS}}/courses/{{$course->image}}" >
                <br>
                <br>
            </div>
            @endif
            <div class="from-group">
                <label>{{ __('Select Category')}}</label>
                <select name="category_id">
                    <option value="" >{{ __('please select')}}</option>
                    @foreach ($categories as $category) 
                        <option value="{{$category->id}}"  @if((old('category_id')==$category->id)||(!empty($course) && ($course->category_id==$category->id)))selected @endif>{{$category->name}} </option>
                    @endforeach    
                </select>
                @if($errors->has('category_id'))
                    <span class="error">{{$errors->first('category_id')}}</span>
                @endif
            </div>
            <div class="from-group">
                <label>{{ __('Select Rating')}}</label>
                <select name="rating">
                    <option value="" >{{ __('please select')}}</option>
                    @foreach ($ratings as $rating) 
                        <option value="{{$rating}}"  @if((old('rating')==$rating)||(!empty($course) && ($course->rating==$rating)))selected @endif>{{$rating}} Stars</option>
                    @endforeach    
                </select>
                @if($errors->has('rating'))
                    <span class="error">{{$errors->first('rating')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label>{{ __('Views') }}</label>
                @if($errors->has('views'))
                    <span class="error">{{$errors->first('views')}}</span>
                @endif
                <input name="views" value="{{ old('views', (empty($course))? null : $course->views) }}"  type="number" class="{{($errors->has('views'))?'error':''}} form-control" placeholder="{{ __('Views')}}" >
            </div>
            <div class="from-group">
                <label>{{ __('Select Level')}}</label>
                <select name="levels">
                    <option value="" >{{ __('please select')}}</option>
                    @foreach ($levels as $level) 
                        <option value="{{$level}}"  @if((old('levels')==$level)||(!empty($course) && ($course->levels==$level)))selected @endif>{{$level}} </option>
                    @endforeach    
                </select>
                @if($errors->has('levels'))
                    <span class="error">{{$errors->first('levels')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label>{{ __('Hours') }}</label>
                @if($errors->has('hours'))
                    <span class="error">{{$errors->first('hours')}}</span>
                @endif
                <input name="hours" value="{{ old('hours', (empty($course))? null : $course->hours) }}"  type="number" class="{{($errors->has('hours'))?'error':''}} form-control" placeholder="{{ __('Hours')}}" >
            </div>
            <label class="radio-button">
                <input type="radio" name="active" value="1" {{ (!empty($course) && old('active', $course->active == 1)) ? 'checked' : '' }}>
                <span>{{ __('Active') }}</span>
            </label>
            <label class="radio-button">
                <input type="radio" name="active" value="0" {{ (!empty($course) && old('active', $course->active == 0)) ? 'checked' : '' }}>
                <span>{{ __('Not Active') }}</span>
            </label>
        </div>
    </div>
  
    <!-- Controls Group -->
    <div class="col-12 col-m-12 widget-block">
        <div class="content-box">
            <!-- Button -->
            <input type="submit" value="{{empty($course)? __('Submit') : __('Update')}}" class="btn green-grade block-lvl">
        </div>
    </div>
    <!-- // Controls Group -->
</form>
<!-- // Grid -->
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function () {                                
    $("#addCourseForm").validate({
        errorElement: 'span', //default input error message container
        errorClass: 'error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        rules: {
            name: {
                required: true,
                maxlength: 150,
            },
            category_id: {
                required: true,
            },
            description: {
                required: true,
            },
            rating: {
                required: true,
            },
            views: {
                required: true,
            },
            levels: {
                required: true,
            },
            hours: {
                required: true,
            },
            image: {
                required: true,
            }
        }
    });
});
</script>
@endsection
