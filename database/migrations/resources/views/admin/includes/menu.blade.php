<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-category">General</li>
                    <li class="site-menu-item">
                        <a href="{{ route('home') }}">
                            <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    @can('control_panel')
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon icon wb-settings" aria-hidden="true"></i>
                                <span class="site-menu-title">System</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('admin.users') }}">
                                        <span class="site-menu-title">Users</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('admin.roles') }}">
                                        <span class="site-menu-title">Groups</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('admin.permissions') }}">
                                        <span class="site-menu-title">Permissions</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    <li class="site-menu-category">Booking</li>
                    @can('bookings')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.bookings') }}">
                                <i class="site-menu-icon wb-list" aria-hidden="true"></i>
                                <span class="site-menu-title">Booking</span>
                            </a>
                        </li>
{{--                        <li class="site-menu-item">--}}
{{--                            <a href="{{ route('admin.booking_infos') }}">--}}
{{--                                <i class="site-menu-icon wb-list" aria-hidden="true"></i>--}}
{{--                                <span class="site-menu-title">Booking Details</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    @endcan
                    @can('parkings')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.parkings') }}">
                                <i class="site-menu-icon fa fa-parking" aria-hidden="true"></i>
                                <span class="site-menu-title">Parking</span>
                            </a>
                        </li>
                    @endcan
                    @can('staff')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.staff') }}">
                                <i class="site-menu-icon fa fa-user" aria-hidden="true"></i>
                                <span class="site-menu-title">Staff</span>
                            </a>
                        </li>
                    @endcan

                    <li class="site-menu-category">Job</li>
                    @can('jobs')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.jobs') }}">
                                <i class="site-menu-icon fa fa-address-card" aria-hidden="true"></i>
                                <span class="site-menu-title">Job</span>
                            </a>
                        </li>
                    @endcan
                    @can('job_applications')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.job_applications') }}">
                                <i class="site-menu-icon fa fa-check" aria-hidden="true"></i>
                                <span class="site-menu-title">Job Application</span>
                            </a>
                        </li>
                    @endcan
                    <li class="site-menu-category">CMS</li>
                    @can('messages')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.messages') }}">
                                <i class="site-menu-icon fa fa-envelope" aria-hidden="true"></i>
                                <span class="site-menu-title">Message</span>
                            </a>
                        </li>
                    @endcan
                    @can('abouts')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.abouts') }}">
                                <i class="site-menu-icon fa fa-bullhorn" aria-hidden="true"></i>
                                <span class="site-menu-title">About</span>
                            </a>
                        </li>
                    @endcan
                    @can('teams')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.teams') }}">
                                <i class="site-menu-icon fa fa-users" aria-hidden="true"></i>
                                <span class="site-menu-title">Team</span>
                            </a>
                        </li>
                    @endcan
                    @can('privacies')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.privacies') }}">
                                <i class="site-menu-icon fa fa-lock" aria-hidden="true"></i>
                                <span class="site-menu-title">Privacy Policy</span>
                            </a>
                        </li>
                    @endcan
                    @can('terms')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.terms') }}">
                                <i class="site-menu-icon fa fa-check-circle" aria-hidden="true"></i>
                                <span class="site-menu-title">Terms and Conditions</span>
                            </a>
                        </li>
                    @endcan
                </ul>
{{--                <div class="site-menubar-section">--}}
{{--                    <h5>--}}
{{--                        Milestone--}}
{{--                        <span class="float-right">30%</span>--}}
{{--                    </h5>--}}
{{--                    <div class="progress progress-xs">--}}
{{--                        <div class="progress-bar active" style="width: 30%;" role="progressbar"></div>--}}
{{--                    </div>--}}
{{--                    <h5>--}}
{{--                        Release--}}
{{--                        <span class="float-right">60%</span>--}}
{{--                    </h5>--}}
{{--                    <div class="progress progress-xs">--}}
{{--                        <div class="progress-bar progress-bar-warning" style="width: 60%;" role="progressbar"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

{{--    <div class="site-menubar-footer">--}}
{{--        <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"--}}
{{--           data-original-title="Settings">--}}
{{--            <span class="icon wb-settings" aria-hidden="true"></span>--}}
{{--        </a>--}}
{{--        <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">--}}
{{--            <span class="icon wb-eye-close" aria-hidden="true"></span>--}}
{{--        </a>--}}
{{--        <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Logout">--}}
{{--            <span class="icon wb-power" aria-hidden="true"></span>--}}
{{--        </a>--}}
{{--    </div>--}}
</div>
