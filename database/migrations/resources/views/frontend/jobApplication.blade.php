@extends('frontend.layouts.main')
@section('content')
    <section class="slice slice-lg">
        <div class="container">
            <h3>Job Application From</h3>
            @include('frontend.includes.message')
            <form action="{{route('job.apply', $job->slug)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Your Name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Contact Number" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="number" class="form-control" id="no_of_days" name="no_of_days" placeholder="No Of Days Available Per Week" required>
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-control" id="drive" name="drive" required>
                            <option value="" disabled selected>Do You Drive?</option>
                            <option value="1">Yes</option>
                            <option value="0">no</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-control" id="car" name="car" required>
                            <option value="" disabled selected>Do You Have access to a car?</option>
                            <option value="1">Yes</option>
                            <option value="0">no</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Postcode" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="cv">Resume</label>
                        <input type="file" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/png,image/jpeg" class="form-control" id="cv" name="cv" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
@endsection
