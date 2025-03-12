<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
</head>

<body class="antialiased open-sans">

    <main class="bg-[url('/images/background.jpg')] min-h-screen flex justify-center items-center">

        <div class="px-16 space-y-8 grow max-w-xl">
            <div class="flex flex-col gap-8 justify-center items-center">
                <div>
                    <img src="/images/logo-white.svg" alt="logo" class="px-10">
                </div>
                <div class="text-xl md:text-2xl text-center font-semibold uppercase text-[#FCFAF9] copperplate">JewelOne
                    - VOC Form</div>
            </div>

            <div>
                <form action="{{ route('loginstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="relative mb-8">
                        <label for="employeeNumber"
                            class="text-white absolute transform -translate-y-2 left-4 bg-[url(/images/background.jpg)] text-xs px-2">Employee
                            Number</label>
                        <input type="text" id="employeeNumber" name="employeeNumber"
                            placeholder="Enter Employee Number" required
                            class="bg-transparent border border-[#C7C7C7] text-white focus:outline-white placeholder:!text-white rounded-lg block w-full p-3" />
                    </div>

                    <div class="relative mb-8">
                        <label for="employeePassword"
                            class="text-white absolute transform -translate-y-2 left-4 bg-[url(/images/background.jpg)] text-xs px-2">Password</label>
                        <input type="password" id="employeePassword" name="employeePassword"
                            placeholder="Enter Password" required
                            class="bg-transparent border border-[#C7C7C7] text-white focus:outline-white placeholder:!text-white rounded-lg block w-full p-3" />
                    </div>

                    <div>
                        <button
                            class="text-[#964A26] cursor-pointer bg-[#F2EDE4] block w-full uppercase h-12 rounded-md text-lg font-semibold">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
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


</body>

</html>
