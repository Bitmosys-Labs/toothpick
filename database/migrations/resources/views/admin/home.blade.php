@extends('admin.layout.main')
@section('content')

    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <div class="col-xl-3 col-md-6" style="height: 209px;">
                <!-- Widget Linearea One-->
                <div class="card card-shadow" id="widgetLineareaOne">
                    <div class="card-block p-20 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-left py-10">
                                <i class="icon md-account green-600 font-size-24 vertical-align-bottom mr-5"></i>                    All Contacts
                            </div>
                            <span class="float-right grey-700 font-size-30">{{$contact_count??'0'}}</span>
                        </div>
                        <div class="mb-20 grey-500">
                            {{--<i class="icon md-long-arrow-up green-500 font-size-16"></i>                  15% From this yesterday--}}
                        </div>
                        <div class="ct-chart h-50"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C15.893,45.833,31.786,43.056,47.679,37.5C63.571,31.944,79.464,12.5,95.357,12.5C111.25,12.5,127.143,25,143.036,25C158.929,25,174.821,6.25,190.714,6.25C206.607,6.25,222.5,35,238.393,35C254.286,35,270.179,31.25,286.071,31.25C301.964,31.25,317.857,43.75,333.75,50L333.75,50Z" class="ct-area"></path></g></g><g class="ct-labels"></g></svg></div>
                    </div>
                </div>
                <!-- End Widget Linearea One -->
            </div>
            <div class="col-xl-3 col-md-6" style="height: 209px;">
                <!-- Widget Linearea Two -->
                <div class="card card-shadow" id="widgetLineareaTwo">
                    <div class="card-block p-20 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-left py-10">
                                <i class="icon md-home blue-600 font-size-24 vertical-align-bottom mr-5"></i>                    Total Villa
                            </div>
                            <span class="float-right grey-700 font-size-30">{{$villa_count??'0'}}</span>
                        </div>
                        <div class="mb-20 grey-500">
                            {{--<i class="icon md-long-arrow-up green-500 font-size-16"></i>                  34.2% From this week--}}
                        </div>
                        <div class="ct-chart h-50"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C13.906,47.917,27.813,46.97,41.719,43.75C55.625,40.53,69.531,22.5,83.438,22.5C97.344,22.5,111.25,25,125.156,25C139.063,25,152.969,15,166.875,15C180.781,15,194.688,21.25,208.594,21.25C222.5,21.25,236.406,8.75,250.313,8.75C264.219,8.75,278.125,13.699,292.031,18.75C305.938,23.801,319.844,39.583,333.75,50L333.75,50Z" class="ct-area"></path></g></g><g class="ct-labels"></g></svg></div>
                    </div>
                </div>
                <!-- End Widget Linearea Two -->
            </div>
            <div class="col-xl-3 col-md-6" style="height: 209px;">
                <!-- Widget Linearea Three -->
                <div class="card card-shadow" id="widgetLineareaThree">
                    <div class="card-block p-20 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-left py-10">
                                <i class="icon md-chart orange-600 font-size-24 vertical-align-bottom mr-5"></i>                    Total Bookings
                            </div>
                            <span class="float-right grey-700 font-size-30">{{$booking_count??'0'}}</span>
                        </div>
                        <div class="mb-20 grey-500">
                            {{--<i class="icon md-long-arrow-down red-500 font-size-16"></i>                  15% From this yesterday--}}
                        </div>
                        <div class="ct-chart h-50"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C15.893,41.667,31.786,25,47.679,25C63.571,25,79.464,31.25,95.357,31.25C111.25,31.25,127.143,6.25,143.036,6.25C158.929,6.25,174.821,22.5,190.714,22.5C206.607,22.5,222.5,12.5,238.393,12.5C254.286,12.5,270.179,35.111,286.071,40C301.964,44.889,317.857,46.667,333.75,50L333.75,50Z" class="ct-area"></path></g></g><g class="ct-labels"></g></svg></div>
                    </div>
                </div>
                <!-- End Widget Linearea Three -->
            </div>
            <div class="col-xl-3 col-md-6" style="height: 209px;">
                <!-- Widget Linearea Four -->
                <div class="card card-shadow" id="widgetLineareaFour">
                    <div class="card-block p-20 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-left py-10">
                                <i class="icon md-view-list red-600 font-size-24 vertical-align-bottom mr-5"></i>                    Total Reviews
                            </div>
                            <span class="float-right grey-700 font-size-30">{{$review_count??'0'}}</span>
                        </div>
                        <div class="mb-20 grey-500">
                            {{--<i class="icon md-long-arrow-up green-500 font-size-16"></i>                  18.4% From this yesterday--}}
                        </div>
                        <div class="ct-chart h-50"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,50L0,50C13.906,45,27.813,40,41.719,35C55.625,30,69.531,20.769,83.438,20C97.344,19.231,111.25,19.508,125.156,18.75C139.063,17.992,152.969,6.25,166.875,6.25C180.781,6.25,194.688,25,208.594,25C222.5,25,236.406,18.75,250.313,18.75C264.219,18.75,278.125,29.8,292.031,35C305.938,40.2,319.844,45,333.75,50L333.75,50Z" class="ct-area"></path></g></g><g class="ct-labels"></g></svg></div>
                    </div>
                </div>
                <!-- End Widget Linearea Four -->
            </div>

            <div class="col-md-6" style="height: 475px;">
                <!-- Panel Watchlist -->
                <div class="card card-shadow" id="widgetTable">
                    <div class="" style="padding: 20px 30px;">
                        <h3 class="card-title">
                            <span class="text-truncate">Recent Bookings</span>
                        </h3>
                    </div>
                    <div class="h-350 scrollable is-enabled scrollable-vertical" data-plugin="scrollable"
                         style="position: relative;">
                        <div data-role="container" class="scrollable-container"
                             style="height: 350px; width: 438px;">
                            <div data-role="content" class="scrollable-content" style="width: 423px;">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <td> <b>Customer Name</b> </td>
                                        <td> <b> Villa </b> </td>
                                        <td> <b> Total </b> </td>
                                        <td> <b> Booking Date</b> </td>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @foreach($rows as $key=>$row)--}}
{{--                                    <tr>--}}

{{--                                        <td>{{$row->first_name.' '.$row->last_name}}</td>--}}
{{--                                        <td>{{$row->villa->name}}</td>--}}
{{--                                        <td class="green-600">${{$row->total_amount??'0.00'}}</td>--}}
{{--                                        <td>{{$row->booking_date}}</td>--}}

{{--                                    </tr>--}}
{{--                                    @endforeach--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="scrollable-bar scrollable-bar-vertical scrollable-bar-hide" draggable="false">
                            <div class="scrollable-bar-handle"
                                 style="height: 225.849px; transform: translate3d(0px, 0px, 0px);"></div>
                        </div>
                    </div>
                </div>
                <!-- End Panel Watchlist -->
            </div>
            <div class="col-md-6" style="height: 475px;">
                <!-- Panel Watchlist -->
                <div class="card card-shadow" id="widgetTable">
                    <div class="" style="padding: 20px 30px;">
                        <h3 class="card-title">
                            <span class="text-truncate">System Information</span>
                            <span class="badge badge-pill badge-info">4</span>
                        </h3>
                    </div>
                    <div class="h-350 scrollable is-enabled scrollable-vertical" data-plugin="scrollable"
                         style="position: relative;">
                        <div data-role="container" class="scrollable-container"
                             style="height: 350px; width: 438px;">
                            <div data-role="content" class="scrollable-content" style="width: 423px;">
                                <table class="table mb-0">

                                    <tbody>
                                    <tr>
                                        <td> User Registration</td>
                                        <td class="green-600">Online</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Total Members</td>
                                        <td>3</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Laravel Version</td>
                                        <td>6.0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>PHP Version</td>
                                        <td>7.3</td>
                                        <td></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="scrollable-bar scrollable-bar-vertical scrollable-bar-hide" draggable="false">
                            <div class="scrollable-bar-handle"
                                 style="height: 225.849px; transform: translate3d(0px, 0px, 0px);"></div>
                        </div>
                    </div>
                </div>
                <!-- End Panel Watchlist -->
            </div>
        </div>
    </div>

@endsection
