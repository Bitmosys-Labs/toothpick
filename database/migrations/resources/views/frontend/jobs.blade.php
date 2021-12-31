@extends('frontend.layouts.main')
@section('content')
    <section class="slice slice-lg">
        <div class="container">
            @if($jobs->first())
                @foreach($jobs as $job)
                    <div class="card">
                        <div class="card-header">
                            {{$job->number}} Vacancy
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$job->position}}</h5>
                            <p class="card-text"><b>Requirements:</b></p>
                            <p class="card-text">{!! $job->requirements !!}</p>
                            <a href="{{route('job.apply', $job->slug)}}" class="btn btn-primary">Apply</a>
                        </div>
                    </div>
                @endforeach
            @else
                <h3>There are no current vacancies. Please drop your resume at email! We will reach out to you if something comes up.</h3>
            @endif
        </div>
    </section>
@endsection
