<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    {{-- jquery --}}
    {{-- <script src="jquery-3.7.1.min.js"></script> --}}

    {{-- sweet --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <!-- Custom CSS -->
    @yield('script')
    <style>
        /* Custom styles for the admin dashboard */
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            /* Bootstrap dark theme color */
            padding-top: 60px;
            /* Adjust based on the height of your navbar */
        }

        .content {
            margin-left: 250px;
            /* Adjust based on the width of your sidebar */
            padding: 20px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-wrap">
        <ul class="nav flex-column">


            {{-- <li class="nav-item">
                <a class="nav-link text-white d-flex align-items-center my-2" href="{{route('logout')}}">
                    <i class="fas fa-user text-white mr-3 ml-1 fa-2x "></i> Log Out
                </a>
            </li> --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <i class="fas fa-user text-white mr-3 ml-1 fa-2x ml-4"></i>
                <button type="submit bg-blacl text-white">Logout {{Auth::user()->name}}</button>
              </form>

            <li class="nav-item text-white">
                <a class="nav-link active text-white d-flex align-items-center my-2" href="#">
                    <i class="fas fa-home text-white mr-3 ml-1 fa-2x "></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white d-flex align-items-center my-2" href="{{ route('ticket.view') }}">
                    <i class="fas fa-ticket-alt text-white mr-3 ml-1 fa-2x "></i> Tickets
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white d-flex align-items-center my-2" href="{{ route('user.view') }}">
                    <i class="fas fa-user text-white mr-3 ml-1 fa-2x "></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white d-flex align-items-center my-2" href="#">
                    <i class="fas fa-clipboard-list text-white mr-3 ml-1 fa-2x "></i>Ticket Logs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white my-2 d-flex align-items-center " href="#">
                    <i class="fas fa-tags text-white mr-3 ml-1 fa-2x "></i> Labels
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white aligh-center d-flex align-items-center my-2" href="#">
                    <i class="fas fa-list text-white mr-3 ml-1 fa-2x "></i> <span class="">Categories</span>
                </a>
            </li>


            <!-- Add more menu items as needed -->
        </ul>
    </nav>

    <!-- Page content -->
    <div class="content">
        @yield('dashboard')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    {{-- sweetalert --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



</body>

</html>
