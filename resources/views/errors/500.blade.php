@extends('layouts.survey-layout')

@section('content')
    <div class="row">
        <div class="col center-height" style="top: 0px;">
            <div class="info-text">
                    {{ __('There is an error, Please try again latter!') }}
                    <br>
                    {{ __('And if the problem persists, please contact technical support:') }} <a href="mailto:support@jodah.org">support@jodah.org</a>
            </div>
        </div>
        <p class="copy-rights">{{ __('Copyright © :year Profilaat.', ['year' => 2021]) }}</p>
    </div>
@endsection