<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exam Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

@include('layouts.navigation')

<body class="h-full font-sans">

    <!-- component -->
    <!-- This is an example component -->
    <div>

        <div class="flex overflow-hidden bg-white pt-16">
            <aside id="sidebar"
                class="fixed z-20 h-full top-0 left-0 pt-16 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75"
                aria-label="Sidebar">
                <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
                    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        @include('layouts.side-bar')
                    </div>
                </div>
            </aside>
            <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
            <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">

                <main>


                    @yield('content')

                </main>

                @include('layouts.footer')

            </div>
        </div>

        <script>
            // for delete modal function

            function submitDeleteForm(id) {
                // Trigger form submission
                document.getElementById('deleteForm' + id).submit();
                // Close the modal
                document.getElementById('deleteModal' + id).close();
            }

            function changeStatus(id) {
                // Trigger form submission
                document.getElementById('statusForm' + id).submit();
                // Close the modal
                document.getElementById('statusModal' + id).close();
            }

            function changeVisible(id) {
                document.getElementById('visibleForm' + id).submit();

                document.getElementById('visibleModel' + id).close();
            }
        </script>

        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="https://demo.themesberg.com/windster/app.bundle.js"></script>

    </div>

</body>

</html>
