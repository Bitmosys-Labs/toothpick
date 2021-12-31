@extends('frontend.layouts.main')
@section('content')

    <section class="slice slice-lg">
        <div class="container">
            {!! $term->body !!}
        </div>
    </section>

@endsection
