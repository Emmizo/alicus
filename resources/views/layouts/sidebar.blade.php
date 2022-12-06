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
                @if (Auth::user()->role == 1 && Auth::user()->company_id != null)
                    <li><a href="{{ route('client-list') }}" class="nav_logo"><i class="fa fa-users"
                                aria-hidden="true"></i>
                            <span class="nav_logo-name">My Client</span> </a>
                    </li>
                @endif
                {{-- @if (Auth::user()->role == 1 && Auth::user()->company_id != null)
                    <li><a href="{{ route('medication-list', ['id' => $data->company_id, 'name' => $data->company_name]) }}"
                            class="nav_logo"><i class="fa fa-users" aria-hidden="true"></i>
                            <span class="nav_logo-name">Manage Medication</span> </a>
                    </li>
                @endif --}}
                @if (Auth::user()->role == 1 && Auth::user()->company_id == null)
                    <li><a href="{{ route('manage-userAdmin') }}" class="nav_logo"><i
                                class="fa fa-assistive-listening-systems" aria-hidden="true"></i>
                            <span class="nav_logo-name">Manage Users</span> </a>
                    </li>
                @else
                    <li><a href="{{ route('manage-user') }}" class="nav_logo"><i
                                class="fa fa-assistive-listening-systems" aria-hidden="true"></i>
                            <span class="nav_logo-name">Manage Users</span> </a>
                    </li>
                @endif
                @if (Auth::user()->role == 1 && Auth::user()->company_id == null)
                    <li><a href="{{ route('role-list') }}" class="nav_logo"><i class="fa fa-assistive-listening-systems"
                                aria-hidden="true"></i>
                            <span class="nav_logo-name">Manage Roles</span> </a>
                    </li>
                @endif
                <li>
                    <ul class="hover">
                        <li class="hoverli">

                            <i class="fa fa-list" aria-hidden="true"></i>

                            <ul class="file_menu" style="display:none;">
                                <li>

                                <li><a href="">&nbsp;&nbsp;Reports</a></li>


                                <li><a href="{{ route('report-today-list') }}">&nbsp;&nbsp;My Client Report
                                    </a>
                                </li>


                                {{-- <li><a href="">&nbsp;&nbsp;My Client Weekly Report </a> </li>


                                <li><a href="">&nbsp;&nbsp;My Client Monthly Report </a> </li> --}}

                            </ul>
                        </li>
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
