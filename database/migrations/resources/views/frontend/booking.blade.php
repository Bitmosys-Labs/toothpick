@extends('frontend.layouts.main')
@section('content')

    <section class="slice slice-lg">
        <div class="container">
            @include('frontend.includes.message')
            <h2>Book Staff</h2>
            <h2><small>Personal Detail</small></h2>
            <form action="{{route('booking')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Your Name" required>
                    </div>
                </div>
                <h2><small>Organization Details</small></h2>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Organization Name" required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode" required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="tel" class="form-control" id="contact" name="contact" placeholder="Contact Number" required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <h2><small>Booking Details</small></h2>
                <div id="furtherDetails">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Choose Required Staff</label>
                            <select id="staff" name="staff[]" class="form-control" required>
                                <option value="" selected disabled>-- Select Staff --</option>
                                @foreach($staffs as $staff)
                                    <option value="{{$staff->id}}">{{$staff->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Choose Date</label>
                            <input type="date" class="form-control" name="date[]" id="date" placeholder="Choose Date" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Time From</label>
                            <input type="time" class="form-control" name="from[]" id="email" placeholder="Time From" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Time To</label>
                            <input type="time" class="form-control" name="to[]" id="contact" placeholder="Time To" required>
                            <small id="passwordHelpInline" class="text-muted">
                            </small>
                        </div>
                    </div>
                </div>
                <a class="btn btn-success" onclick="addNewDate()" style="color: white">Add Date</a>
                <h2><small>Additional Information</small></h2>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <textarea type="text" class="form-control" id="special_requirement" name="special_requirement" placeholder="Special Requirements"></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <select id="staff" name="parking_id" class="form-control" required>
                            <option value="" selected disabled>-- Select Parking Information --</option>
                            @foreach($parking_info as $parking)
                                <option value="{{$parking->id}}">{{$parking->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <textarea type="text" class="form-control" name="other" id="other" placeholder="If Other Please Specify"></textarea>
                    </div>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                    <label class="form-check-label" for="exampleCheck1">By boking the service you agree to the Lifeline Recruitment booking
                        <a href="{{route('terms')}}">Terms and Condition</a>.</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>

    <script>
        function addNewDate() {
            $('#furtherDetails').append('<div class="form-row"><div class="form-group col-md-3"> <label for="">Choose Required Staff</label> <select id="staff" name="staff[]" class="form-control" required> <option value="" disabled selected>-- Select Staff --</option> @foreach($staffs as $staff) <option value="{{$staff->id}}">{{$staff->type}}</option>  @endforeach </select> </div> <div class="form-group col-md-3"> <label for="">Choose Date</label> <input type="date" class="form-control" name="date[]" id="date" placeholder="Choose Date" required> </div> <div class="form-group col-md-3"> <label for="">Time From</label> <input type="time" class="form-control" name="from[]" id="email" placeholder="Time From" required> </div> <div class="form-group col-md-3"> <label for="">Time To</label> <input type="time" class="form-control" name="to[]" id="contact" placeholder="Time To" required> <small id="passwordHelpInline" class="text-muted"></small> <a onclick="removeMe(this)" style="float: right; color: red;">Remove Date!</a> </div>  </div>');
        }
        function removeMe(remove) {
            let row = remove.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
@endsection
