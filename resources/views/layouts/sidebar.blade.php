<body id="body-pd" class="wireframe d-print-none">
    <div class="l-navbar" id="nav-bar">
        <nav class="nav sidebar">

            <ul>
                <li><a href="{{ route('dashboard') }}" class="nav_logo"><i class="fa fa-home" aria-hidden="true"></i>
                        <span class="nav_logo-name">Home</span> </a></li>
                @if (Auth::user()->role == 1 && Auth::user()->company_id == null)
                    <li><a href="{{ route('company-list') }}" class="nav_logo"><i class="fa fa-file-text-o"
                                aria-hidden="true"></i>
                            <span class="nav_logo-name">Manage Companies</span> </a></li>
                @endif
                @can('manage-client')
                    <li><a href="{{ route('client-list') }}" class="nav_logo"><i class="fa fa-users" aria-hidden="true"></i>
                            <span class="nav_logo-name">My Client</span> </a>
                    </li>
                @endcan
                @can('manage-payor')
                    <li><a href="{{ route('insurance') }}" class="nav_logo"><i class="fa fa-file" aria-hidden="true"></i>
                            <span class="nav_logo-name">Manage Payors</span> </a>
                    </li>
                @endcan
                @can('manage-invoice')
                    <li><a href="{{ route('all-invoices') }}" class="nav_logo"><i class="fa fa-money"
                                aria-hidden="true"></i>
                            <span class="nav_logo-name">Manage Invoice</span> </a>
                    </li>
                @endcan
                @can('manage-company')
                    @if (Auth::user()->role == 1 && Auth::user()->company_id == null)
                        <li><a href="{{ route('manage-userAdmin') }}" class="nav_logo"><i class="fa fa-users"
                                    aria-hidden="true"></i>
                                <span class="nav_logo-name">Manage Users</span> </a>
                        </li>
                    @endif
                @endcan

                @can('manage-users-client')
                    <li><a href="{{ route('manage-user') }}" class="nav_logo"><i class="fa fa-users" aria-hidden="true"></i>
                            <span class="nav_logo-name">Manage Users</span> </a>
                    </li>
                    @endif

                    @can('manage-company')
                        @if (Auth::user()->role == 1 && Auth::user()->company_id == null)
                            <li><a href="{{ route('role-list') }}" class="nav_logo"><i class="fa fa-cogs"
                                        aria-hidden="true"></i>
                                    <span class="nav_logo-name">Manage Roles</span> </a>
                            </li>
                        @endif
                    @endcan
                    @can('manage-roles-client')
                        <li><a href="{{ route('role-list-client') }}" class="nav_logo"><i class="fa fa-cogs"
                                    aria-hidden="true"></i>
                                <span class="nav_logo-name">Manage Roles</span> </a>
                        </li>
                    @endcan
                    @can('manage-archive')
                        <li><a href="{{ route('client-discharged') }}" class="nav_logo"><i class="fa fa-archive"
                                    aria-hidden="true"></i>
                                <span class="nav_logo-name">Manage Archive</span> </a>
                        </li>
                    @endcan
                    @can('manage-company')
                        <li><a href="{{ route('company-list-trash') }}" class="nav_logo"><i style="color:red"
                                    class="fa fa-recycle" aria-hidden="true"></i>
                                <span class="nav_logo-name">Recycle bin</span> </a>
                        </li>
                    @endcan
                    @can('manage-report')
                        <li>
                            <ul class="hover">
                                <li class="hoverli">

                                    <i class="fa fa-list" aria-hidden="true"></i>

                                    <ul class="file_menu" style="display:none;">
                                        <li>

                                        <li><a href="">&nbsp;&nbsp;Reports</a></li>


                                        <li><a href="{{ route('report-today-list') }}">&nbsp;&nbsp;Clients Report
                                            </a>
                                        </li>

                                        <li><a href="{{ route('report-invoices') }}">&nbsp;&nbsp;Invoice Report
                                            </a>
                                        </li>


                                    </ul>

                                </li>
                            @endcan
                        </ul>
                    </li>


                </ul>
            </nav>
        </div>
    </body>



    <!-- Modal for Employee Registration -->


    <script>
        $('#closemodal').click(function() {
            $('#myemployeesModal').modal('hide');
        });
    </script>
    </div>

    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(' .nav-link').forEach(function(element) {

                element.addEventListener('click', function(e) {

                    let nextEl = element.nextElementSibling;
                    let parentEl = element.parentElement;

                    if (nextEl) {
                        e.preventDefault();
                        let mycollapse = new bootstrap.Collapse(nextEl);

                        if (nextEl.classList.contains('show')) {
                            mycollapse.hide();
                        } else {
                            mycollapse.show();
                            // find other submenus with class=show
                            var opened_submenu = parentEl.parentElement.querySelector(
                                '.submenu.show');
                            // if it exists, then close all of them
                            if (opened_submenu) {
                                new bootstrap.Collapse(opened_submenu);
                            }
                        }
                    }
                }); // addEventListener
            }) // forEach
        });
        $(document).ready(function() {
            $(".hoverli").hover(
                function() {
                    $('ul.file_menu').stop(true, true).slideDown('medium');
                },
                function() {
                    $('ul.file_menu').stop(true, true).slideUp('medium');
                }
            );

        });
    </script>
