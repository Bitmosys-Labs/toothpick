@extends('frontend.layouts.main')
@section('content')
    <section class="slice slice-lg">
        <div class="container">
            {!! $about->body !!}
        </div>
    </section>
    @if($teams->first())
    <section class="slice slice-lg pb-5">
        <div class="container">
            <!-- Section title -->
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h2 class=" mt-4">The amazing team</h2>
                </div>
            </div>
            <div class="row">
                @foreach($teams as $team)
                    <div class="col-lg-3 col-sm-6 mb-5">
                        <div data-animate-hover="2">
                            <div class="animate-this">
                                <a href="{{$team->link}}">
                                    <img alt="Image placeholder" class="img-fluid rounded shadow" src="{{asset('uploads/team/'.$team->image)}}">
                                </a>
                            </div>
                            <div class="mt-3">
                                <h5 class="h6 mb-0">{{$team->name}}</h5>
                                <p class="text-muted text-sm mb-0">{{$team->designation}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
