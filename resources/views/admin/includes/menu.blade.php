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
                    <li class="site-menu-category">booking</li>
                    @can('dcps')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.dcps') }}">
                                <i class="site-menu-icon fa fa-user-nurse" aria-hidden="true"></i>
                                <span class="site-menu-title">DCP's</span>
                            </a>
                        </li>
                    @endcan
                    @can('practices')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.practices') }}">
                                <i class="site-menu-icon fa fa-hospital" aria-hidden="true"></i>
                                <span class="site-menu-title">Practice's</span>
                            </a>
                        </li>
                    @endcan
                    @can('bookings')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.bookings') }}">
                                <i class="site-menu-icon fa fa-address-card" aria-hidden="true"></i>
                                <span class="site-menu-title">Booking</span>
                            </a>
                        </li>
                    @endcan
                    @can('invoices')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.invoices') }}">
                                <i class="site-menu-icon fa fa-credit-card" aria-hidden="true"></i>
                                <span class="site-menu-title">Practice Billing</span>
                            </a>
                        </li>
                    @endcan
                    @can('dcpInvoices')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.dcpInvoice') }}">
                                <i class="site-menu-icon fa fa-credit-card" aria-hidden="true"></i>
                                <span class="site-menu-title">DCP Billing</span>
                            </a>
                        </li>
                    @endcan
                    @can('timesheets')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.timesheets') }}">
                                <i class="site-menu-icon fa fa-clipboard-list" aria-hidden="true"></i>
                                <span class="site-menu-title">Time Sheet</span>
                            </a>
                        </li>
                    @endcan
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon icon wb-check" aria-hidden="true"></i>
                            <span class="site-menu-title">Review Documents</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            @can('user_comps')
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{route('admin.user_comps')}}">
                                    <span class="site-menu-title">Compliance</span>
                                </a>
                            </li>
                            @endcan
                            @can('user_identities')
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{route('admin.user_identities')}}">
                                    <span class="site-menu-title">Identity</span>
                                </a>
                            </li>
                            @endcan
                            @can('user_immunizations')
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{route('admin.user_immunizations')}}">
                                    <span class="site-menu-title">Immunization</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
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
                    @can('logos')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.logos') }}">
                                <i class="site-menu-icon fa fa-certificate" aria-hidden="true"></i>
                                <span class="site-menu-title">Logo</span>
                            </a>
                        </li>
                    @endcan
                    @can('staff')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.staff') }}">
                                <i class="site-menu-icon fa fa-user" aria-hidden="true"></i>
                                <span class="site-menu-title">Staff Type</span>
                            </a>
                        </li>
                    @endcan
                    @can('work_withs')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.work_withs') }}">
                                <i class="site-menu-icon fa fa-question" aria-hidden="true"></i>
                                <span class="site-menu-title">Work With?</span>
                            </a>
                        </li>
                    @endcan
                    @can('compliances')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.compliances') }}">
                                <i class="site-menu-icon fa fa-id-card" aria-hidden="true"></i>
                                <span class="site-menu-title">Compliance</span>
                            </a>
                        </li>
                    @endcan
                    @can('identities')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.identities') }}">
                                <i class="site-menu-icon fa fa-id-card" aria-hidden="true"></i>
                                <span class="site-menu-title">Identity</span>
                            </a>
                        </li>
                    @endcan
                    @can('immunizations')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.immunizations') }}">
                                <i class="site-menu-icon fa fa-file-medical" aria-hidden="true"></i>
                                <span class="site-menu-title">Immunization</span>
                            </a>
                        </li>
                    @endcan
                    @can('experiences')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.experiences') }}">
                                <i class="site-menu-icon fa fa-file-signature" aria-hidden="true"></i>
                                <span class="site-menu-title">Experience</span>
                            </a>
                        </li>
                    @endcan
                    @can('parkings')
                        <li class="site-menu-item">
                            <a href="{{ route('admin.parkings') }}">
                                <i class="site-menu-icon fa fa-car" aria-hidden="true"></i>
                                <span class="site-menu-title">Parking Type</span>
                            </a>
                        </li>
                    @endcan
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
