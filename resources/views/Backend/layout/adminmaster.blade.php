<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('/images/avatar.svg') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @yield('header')
</head>

<body class="bg-[#FCFAF9] min-h-screen roboto antialiased text-black">
    <header class="bg-[#F2EDE4] border-b border-[#C7C7C7]">

        {{-- <----- Navbar --->  --}}
        @include('backend.panel.navbar')
    </header>

    <div class="grid md:grid-cols-[240px_auto]">

        {{-- <---- Sidebar -----> --}}

        @include('backend.panel.sidebar')

        {{-- <---- Main Content -----> --}}
        <main class="relative min-h-screen border-l border-[#C7C7C7]"
            style="
                   background-image: url('/images/watermark.png');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 280px;
          ">
            @yield('content')
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session()->has('alert-type') && session()->has('message'))
                let toastStyles = {
                    success: "linear-gradient(to right, #00b09b, #96c93d)",
                    error: "linear-gradient(to right, #ff416c, #ff4b2b)",
                    warning: "linear-gradient(to right, #ffcc00, #ff8800)",
                    info: "linear-gradient(to right, #3498db, #2980b9)"
                };

                Toastify({
                    text: "{{ session('message') }}",
                    className: "{{ session('alert-type') }}",
                    close: true,
                    duration: 3000,
                    style: {
                        background: toastStyles["{{ session('alert-type') }}"]
                    }
                }).showToast();
            @endif
        });
    </script>
    <script>
        function showroomSelect() {
            return {
                open: false,
                search: '',
                selected: ['Coimbatore'], // pre-selected
                items: ['Anna Nagar', 'Puducherry', 'Vellore', 'Hosur', 'Trichy', 'Salem', 'Erode',
                    'Coimbatore', 'Experience center', 'Pollachi', 'Udumalpet', 'Madurai', 'Ramnad'
                ],

                get filteredItems() {
                    return this.items.filter(item =>
                        item.toLowerCase().includes(this.search.toLowerCase())
                    );
                },

                toggleSelection(item) {
                    const index = this.selected.indexOf(item);
                    if (index > -1) {
                        this.selected.splice(index, 1);
                    } else {
                        this.selected.push(item);
                    }
                },

                logSelected() {
                    console.log('Selected Showrooms:', this.selected);
                }
            }
        }
    </script>
    <script>
        var swiper = new Swiper(".my-slider", {
            slidesPerView: "auto",
            spaceBetween: 10,

            navigation: {
                nextEl: ".swiper-next",
                prevEl: ".swiper-prev",
            },

        });
    </script>
    @yield('scripts')
</body>

</html>
