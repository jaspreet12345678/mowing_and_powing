a<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href=""><img class="img-fluid for-light" src="{{ asset($company->logo ?? '') }}"
                    alt=""><img class="img-fluid for-dark" src="{{ asset($company->logo ?? '') }}"
                    alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        </div>
        <div class="logo-icon-wrapper"><a href=""><img class="img-fluid" src="{{ asset($company->logo ?? '') }}"
                    alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href=""><img class="img-fluid"
                                src="{{ asset($company->logo ?? '') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"> </i></div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.dashboard.index') }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path d="M9.07861 16.1355H14.8936" stroke="#130F26" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.3999 13.713C2.3999 8.082 3.0139 8.475 6.3189 5.41C7.7649 4.246 10.0149 2 11.9579 2C13.8999 2 16.1949 4.235 17.6539 5.41C20.9589 8.475 21.5719 8.082 21.5719 13.713C21.5719 22 19.6129 22 11.9859 22C4.3589 22 2.3999 22 2.3999 13.713Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg><span class="">Dashboard</span></a>
                    </li>

                    {{-- ****************************** Users ************************************** --}}
                    @permission('users')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M15.7499 9.47167V6.43967C15.7549 4.35167 14.0659 2.65467 11.9779 2.64967C9.88887 2.64567 8.19287 4.33467 8.18787 6.42267V9.47167"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.94995 14.2074C2.94995 8.91344 5.20495 7.14844 11.969 7.14844C18.733 7.14844 20.988 8.91344 20.988 14.2074C20.988 19.5004 18.733 21.2654 11.969 21.2654C5.20495 21.2654 2.94995 19.5004 2.94995 14.2074Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Users</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('admin.users.admins.index') }}">Admins</a></li>
                                {{-- <li><a href="{{ route('admin.users.customers.index') }}">Customers</a></li> --}}
                                {{-- <li><a href="{{ route('admin.users.providers.index') }}">Providers</a></li> --}}

                                <li><a class="submenu-title" href="#">Customers<span class="sub-arrow"><i
                                                class="fa fa-angle-right"></i></span></a>
                                    <ul class="nav-sub-childmenu submenu-content">
                                        <li><a href="{{ route('admin.users.customers.index') }}">Active</a></li>
                                        {{-- <li><a href="{{ url('admin/users/pending_customer') }}">Pending</a>
                                        </li> --}}
                                        <li><a href="{{ url('admin/users/block_customer') }}">Block</a></li>

                                    </ul>
                                </li>


                                <li><a class="submenu-title" href="#">Providers<span class="sub-arrow"><i
                                                class="fa fa-angle-right"></i></span></a>
                                    <ul class="nav-sub-childmenu submenu-content">
                                        <li><a href="{{ url('admin/users/providers/index') }}">Active</a></li>
                                        <li><a href="{{ url('admin/users/pending_providers') }}">Pending</a>
                                        </li>
                                        <li><a href="{{ url('admin/users/block_providers') }}">Block</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endpermission

                    {{-- ***************************** Role And Permissions ************************* --}}
                    @permission('roles_and_permissions')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('admin.roles-and-permissions.index') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M15.596 15.6963H8.37598" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.596 11.9365H8.37598" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11.1312 8.17725H8.37622" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.61011 12C3.61011 18.937 5.70811 21.25 12.0011 21.25C18.2951 21.25 20.3921 18.937 20.3921 12C20.3921 5.063 18.2951 2.75 12.0011 2.75C5.70811 2.75 3.61011 5.063 3.61011 12Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span class="">Roles and Permissions</span></a>
                        </li>
                    @endpermission

                    {{-- ******************************Teams ************************************* --}}
                    @permission('teams')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('admin.teams.index') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M7.30566 14.5743H16.8987" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.5 7.79836C2.5 5.35646 3.75 3.25932 6.122 2.77265C8.493 2.28503 10.295 2.4536 11.792 3.26122C13.29 4.06884 12.861 5.26122 14.4 6.13646C15.94 7.01265 18.417 5.69646 20.035 7.44217C21.729 9.26979 21.72 12.0755 21.72 13.8641C21.72 20.6603 17.913 21.1993 12.11 21.1993C6.307 21.1993 2.5 20.7288 2.5 13.8641V7.79836Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span class="">Teams Members</span></a>
                        </li>
                    @endpermission

                    {{-- *************************Pay Provider menu******************************************************* --}}
                    @permission('payproviders')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M15.7499 9.47167V6.43967C15.7549 4.35167 14.0659 2.65467 11.9779 2.64967C9.88887 2.64567 8.19287 4.33467 8.18787 6.42267V9.47167"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.94995 14.2074C2.94995 8.91344 5.20495 7.14844 11.969 7.14844C18.733 7.14844 20.988 8.91344 20.988 14.2074C20.988 19.5004 18.733 21.2654 11.969 21.2654C5.20495 21.2654 2.94995 19.5004 2.94995 14.2074Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Providers Payment</span></a>
                            <ul class="sidebar-submenu">
                                <li><a
                                        href="{{ route('admin.payproviders.payment-status', ['status' => 'needpayment']) }}">Withdraw
                                        Request</a></li>
                                <li><a href="{{ route('admin.payproviders.paid-providers',['status' => 'transaction_done']) }}">Transaction</a></li>
                                {{-- <li><a href="{{ route('admin.payproviders.payment-status', ['status' => 'needreview']) }}">Need
                                        Review</a></li> --}}
                            </ul>
                        </li>
                    @endpermission

                    {{-- ******************************* Orders menu****************************************************** --}}

                    @permission('orders')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M11.1437 17.8829H4.67114" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M15.205 17.8839C15.205 19.9257 15.8859 20.6057 17.9267 20.6057C19.9676 20.6057 20.6485 19.9257 20.6485 17.8839C20.6485 15.8421 19.9676 15.1621 17.9267 15.1621C15.8859 15.1621 15.205 15.8421 15.205 17.8839Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M14.1765 7.39439H20.6481" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M10.1153 7.39293C10.1153 5.35204 9.43436 4.67114 7.39346 4.67114C5.35167 4.67114 4.67078 5.35204 4.67078 7.39293C4.67078 9.43472 5.35167 10.1147 7.39346 10.1147C9.43436 10.1147 10.1153 9.43472 10.1153 7.39293Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Orders</span></a>
                            <ul class="sidebar-submenu">

                                <li><a href="{{ route('admin.order.orders', ['status' => 1]) }}">View Orders</a></li>
                                <li><a href="{{ route('admin.recurring-jobs.index', ['status' => 'all']) }}">Recurring
                                        Orders</a></li>
                                <li><a class="submenu-title" href="#">Cancel Orders<span class="sub-arrow"><i
                                                class="fa fa-angle-right"></i></span></a>
                                    <ul class="nav-sub-childmenu submenu-content">
                                        <li><a href="{{ route('admin.cancel-jobs.index') }}">View</a></li>
                                        <li><a href="{{ route('admin.cancel-jobs.refunded-job') }}">Refunded</a>
                                        </li>
                                        <li><a href="{{ route('admin.cancel-jobs.reviewed-job') }}">Under Review</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                    @endpermission

                    {{-- ******************************* Plugins *********************************** --}}
                    @permission('plugins')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('admin.plugins.index') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M15.596 15.6963H8.37598" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.596 11.9365H8.37598" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11.1312 8.17725H8.37622" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.61011 12C3.61011 18.937 5.70811 21.25 12.0011 21.25C18.2951 21.25 20.3921 18.937 20.3921 12C20.3921 5.063 18.2951 2.75 12.0011 2.75C5.70811 2.75 3.61011 5.063 3.61011 12Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span class="">Plugins</span>
                            </a>
                        </li>
                    @endpermission

                    {{-- ************************ Cities ************************************* --}}
                    @permission('Cities')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.cities.index') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M7.30566 14.5743H16.8987" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.5 7.79836C2.5 5.35646 3.75 3.25932 6.122 2.77265C8.493 2.28503 10.295 2.4536 11.792 3.26122C13.29 4.06884 12.861 5.26122 14.4 6.13646C15.94 7.01265 18.417 5.69646 20.035 7.44217C21.729 9.26979 21.72 12.0755 21.72 13.8641C21.72 20.6603 17.913 21.1993 12.11 21.1993C6.307 21.1993 2.5 20.7288 2.5 13.8641V7.79836Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Cities</span>
                            </a>
                        </li>
                    @endpermission

                    {{-- ************************* Templets *********************************** --}}
                    @permission('templates')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M15.7499 9.47167V6.43967C15.7549 4.35167 14.0659 2.65467 11.9779 2.64967C9.88887 2.64567 8.19287 4.33467 8.18787 6.42267V9.47167"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.94995 14.2074C2.94995 8.91344 5.20495 7.14844 11.969 7.14844C18.733 7.14844 20.988 8.91344 20.988 14.2074C20.988 19.5004 18.733 21.2654 11.969 21.2654C5.20495 21.2654 2.94995 19.5004 2.94995 14.2074Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Templates</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('admin.templates.email') }}">Email templates</a></li>
                                <li><a href="{{ route('admin.templates.sms') }}">Sms templates</a></li>
                            </ul>
                        </li>
                    @endpermission

                    {{-- *********************** General Setting ********************************* --}}
                    @permission('general_settings')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M17.5449 9.01904C17.5449 9.01904 14.3349 12.8717 11.987 12.8717C9.64016 12.8717 6.39404 9.01904 6.39404 9.01904"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.45215 11.9688C2.45215 5.13075 4.8331 2.85205 11.976 2.85205C19.1188 2.85205 21.4998 5.13075 21.4998 11.9688C21.4998 18.8059 19.1188 21.0856 11.976 21.0856C4.8331 21.0856 2.45215 18.8059 2.45215 11.9688Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>General settings</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('admin.generalsettings.lawnmoving.show-cards') }}">Lawn mowing</a>
                                </li>
                                <li><a href="{{ route('admin.generalsettings.snow-plowing.show-cards') }}">Snow
                                        plowing</a></li>
                                <li><a href="{{ route('admin.edit-profile') }}">Profile</a></li>
                                <li><a href="{{ route('admin.generalsettings.setting.show-setting') }}">settings</a></li>


                            </ul>
                        </li>
                    @endpermission

                   {{-- *********************** Promotions ********************************* --}}
                    @permission('promotions')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M17.5449 9.01904C17.5449 9.01904 14.3349 12.8717 11.987 12.8717C9.64016 12.8717 6.39404 9.01904 6.39404 9.01904"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.45215 11.9688C2.45215 5.13075 4.8331 2.85205 11.976 2.85205C19.1188 2.85205 21.4998 5.13075 21.4998 11.9688C21.4998 18.8059 19.1188 21.0856 11.976 21.0856C4.8331 21.0856 2.45215 18.8059 2.45215 11.9688Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Promotions</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('admin.coupon-code.index') }}">Coupons Code</a>
                                </li>
                                <li><a href="{{ route('admin.refferal-system.index')}}">Refferal System</a></li>
                            </ul>
                        </li>
                    @endpermission

             {{-- *************************** Task Management **************************************** --}}
                    {{-- @permission('task_management')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M17.5449 9.01904C17.5449 9.01904 14.3349 12.8717 11.987 12.8717C9.64016 12.8717 6.39404 9.01904 6.39404 9.01904"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.45215 11.9688C2.45215 5.13075 4.8331 2.85205 11.976 2.85205C19.1188 2.85205 21.4998 5.13075 21.4998 11.9688C21.4998 18.8059 19.1188 21.0856 11.976 21.0856C4.8331 21.0856 2.45215 18.8059 2.45215 11.9688Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Task Management</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="#">Projects</a></li>
                                <li><a href="#">Task</a></li>
                                <li><a href="#">Boards</a></li>
                                <li><a href="#">Priorities</a></li>
                            </ul>
                        </li>
                    @endpermission --}}

                {{-- *************************** Reports **************************************** --}}
                    {{-- @permission('Reports')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M17.5449 9.01904C17.5449 9.01904 14.3349 12.8717 11.987 12.8717C9.64016 12.8717 6.39404 9.01904 6.39404 9.01904"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.45215 11.9688C2.45215 5.13075 4.8331 2.85205 11.976 2.85205C19.1188 2.85205 21.4998 5.13075 21.4998 11.9688C21.4998 18.8059 19.1188 21.0856 11.976 21.0856C4.8331 21.0856 2.45215 18.8059 2.45215 11.9688Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Reports</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="#">Provider Reports</a></li>
                                <li><a href="#">Customer Reports</a></li>
                                <li><a href="#">Income/Expense Reports</a></li>
                                <li><a href="#">OverAll Reports</a></li>
                            </ul>
                        </li>
                    @endpermission --}}

                    {{-- *************************** Finance **************************************** --}}
                    {{-- @permission('finance')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M17.5449 9.01904C17.5449 9.01904 14.3349 12.8717 11.987 12.8717C9.64016 12.8717 6.39404 9.01904 6.39404 9.01904"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.45215 11.9688C2.45215 5.13075 4.8331 2.85205 11.976 2.85205C19.1188 2.85205 21.4998 5.13075 21.4998 11.9688C21.4998 18.8059 19.1188 21.0856 11.976 21.0856C4.8331 21.0856 2.45215 18.8059 2.45215 11.9688Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Finance</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="#">Estimates</a></li>
                                <li><a href="#">Invoices</a></li>
                            </ul>
                        </li>
                    @endpermission --}}

                    {{-- ********************************************** HR *************************************** --}}
                    {{-- @permission('human_resources')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M17.5449 9.01904C17.5449 9.01904 14.3349 12.8717 11.987 12.8717C9.64016 12.8717 6.39404 9.01904 6.39404 9.01904"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.45215 11.9688C2.45215 5.13075 4.8331 2.85205 11.976 2.85205C19.1188 2.85205 21.4998 5.13075 21.4998 11.9688C21.4998 18.8059 19.1188 21.0856 11.976 21.0856C4.8331 21.0856 2.45215 18.8059 2.45215 11.9688Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>HR</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="#">Employees</a></li>
                                <li><a href="#">Leaves</a></li>
                                <li><a href="#">Attendance</a></li>
                                <li><a href="#">Holidays</a></li>
                                <li><a href="#">Department</a></li>
                                <li><a href="#">Designation</a></li>

                            </ul>
                        </li>
                    @endpermission --}}

                    {{-- ******************* Help Cnter ******************************************** --}}
                    @permission('help_center')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M17.5449 9.01904C17.5449 9.01904 14.3349 12.8717 11.987 12.8717C9.64016 12.8717 6.39404 9.01904 6.39404 9.01904"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.45215 11.9688C2.45215 5.13075 4.8331 2.85205 11.976 2.85205C19.1188 2.85205 21.4998 5.13075 21.4998 11.9688C21.4998 18.8059 19.1188 21.0856 11.976 21.0856C4.8331 21.0856 2.45215 18.8059 2.45215 11.9688Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Help Center</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('admin.support.index') }}">Supports</a>
                                <li><a href="{{ route('admin.support.app-flow') }}">App Flow</a></li>

                            </ul>
                        </li>
                    @endpermission

                    {{-- *********************** Pay Roll****************************** --}}
                    {{-- @permission('pay_roll')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M17.5449 9.01904C17.5449 9.01904 14.3349 12.8717 11.987 12.8717C9.64016 12.8717 6.39404 9.01904 6.39404 9.01904"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.45215 11.9688C2.45215 5.13075 4.8331 2.85205 11.976 2.85205C19.1188 2.85205 21.4998 5.13075 21.4998 11.9688C21.4998 18.8059 19.1188 21.0856 11.976 21.0856C4.8331 21.0856 2.45215 18.8059 2.45215 11.9688Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Pay Roll</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="#">Employee Salary</a></li>
                                <li><a href="#">PayRoll</a></li>
                                < </ul>
                        </li>
                    @endpermission --}}

                    {{-- ********************************* Company Setting *************************************** --}}
                    @permission('company_settings')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                href="{{ route('admin.company-settings.index') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M15.9393 12.4131H15.9483" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11.9303 12.4131H11.9393" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M7.92128 12.4131H7.93028" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.071 19.0698C16.0159 22.1264 11.4896 22.7867 7.78631 21.074C7.23961 20.8539 3.70113 21.8339 2.93334 21.067C2.16555 20.2991 3.14639 16.7601 2.92631 16.2134C1.21285 12.5106 1.87411 7.9826 4.9302 4.9271C8.83147 1.0243 15.1698 1.0243 19.071 4.9271C22.9803 8.83593 22.9723 15.1681 19.071 19.0698Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Company settings</span></a>
                        </li>
                    @endpermission

                    {{-- ************************************ CMS Setting ***************************************** --}}
                    @permission('cms_settings')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="M17.5449 9.01904C17.5449 9.01904 14.3349 12.8717 11.987 12.8717C9.64016 12.8717 6.39404 9.01904 6.39404 9.01904"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.45215 11.9688C2.45215 5.13075 4.8331 2.85205 11.976 2.85205C19.1188 2.85205 21.4998 5.13075 21.4998 11.9688C21.4998 18.8059 19.1188 21.0856 11.976 21.0856C4.8331 21.0856 2.45215 18.8059 2.45215 11.9688Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Cms Settings</span></a>
                            <ul class="sidebar-submenu">
                                {{-- <li><a href="{{ route('admin.privacy-policy.index') }}">Privacy policy</a>
                                </li> --}}
                                <li><a class="submenu-title" href="#">Privacy policy<span class="sub-arrow"><i
                                    class="fa fa-angle-right"></i></span></a>
                                    <ul class="nav-sub-childmenu submenu-content">

                                        <li><a
                                                href="{{ route('admin.privacy-policy.index', ['type' => 'customer'])}}">Customer</a>
                                        </li>
                                        <li><a
                                                href="{{ route('admin.privacy-policy.index', ['type' => 'provider']) }}">Provider</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="{{ route('admin.about-us.index') }}">About App</a>
                                <li><a class="submenu-title" href="#">Faqs<span class="sub-arrow"><i
                                                class="fa fa-angle-right"></i></span></a>
                                    <ul class="nav-sub-childmenu submenu-content">

                                        <li><a
                                                href="{{ route('admin.faqs.get_faq', ['type' => 'customer']) }}">Customer</a>
                                        </li>
                                        <li><a
                                                href="{{ route('admin.faqs.get_faq', ['type' => 'provider']) }}">Provider</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="{{ route('admin.footer-script') }}">Footer script code</a>
                                {{-- <li><a href="{{ route('admin.term-and-condition.index') }}">Terms & conditions</a> --}}
                                <li><a class="submenu-title" href="#">Terms & conditions<span class="sub-arrow"><i
                                    class="fa fa-angle-right"></i></span></a>
                                    <ul class="nav-sub-childmenu submenu-content">

                                        <li><a
                                                href="{{ route('admin.term-and-condition.index', ['type' => 'customer'])}}">Customer</a>
                                        </li>
                                        <li><a
                                                href="{{ route('admin.term-and-condition.index', ['type' => 'provider']) }}">Provider</a>
                                        </li>

                                    </ul>
                                </li>

                            </ul>
                        </li>
                    @endpermission


                     {{-- ************************ Cities ************************************* --}}
                    @permission('Chat')
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.chat') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M7.30566 14.5743H16.8987" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.5 7.79836C2.5 5.35646 3.75 3.25932 6.122 2.77265C8.493 2.28503 10.295 2.4536 11.792 3.26122C13.29 4.06884 12.861 5.26122 14.4 6.13646C15.94 7.01265 18.417 5.69646 20.035 7.44217C21.729 9.26979 21.72 12.0755 21.72 13.8641C21.72 20.6603 17.913 21.1993 12.11 21.1993C6.307 21.1993 2.5 20.7288 2.5 13.8641V7.79836Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span>Chat</span>
                            </a>
                        </li>
                    @endpermission
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
