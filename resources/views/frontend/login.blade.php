<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
</head>
<body class="antialiased open-sans">

<main class="bg-[url('/images/background.jpg')] min-h-screen flex justify-center items-center">
  <div class="px-16 space-y-8 grow max-w-xl">
    <!-- Logo and Title -->
    <div class="flex flex-col gap-8 justify-center items-center">
      <div>
        <img src="/images/logo-white.svg" alt="logo" class="px-10">
      </div>
      <div class="text-xl md:text-2xl text-center font-semibold uppercase text-[#FCFAF9] copperplate">
        JewelOne - VOC Form
      </div>
    </div>

    <!-- Form -->
    <div>
      <form>
        <!-- Employee Number -->
        <div class="relative mb-8">
          <label for="employeeNumber"
                 class="text-white absolute transform -translate-y-2 left-4 bg-[url(/images/background.jpg)] text-xs px-2">
            Employee Number
          </label>
          <input type="text" id="employeeNumber" name="employeeNumber" placeholder="Enter Employee Number" required
                 class="bg-transparent border border-[#C7C7C7] text-white focus:outline-white placeholder:!text-white rounded-lg block w-full p-3"/>
        </div>

        <!-- Password -->
        <div class="relative mb-8">
          <label for="employeePassword"
                 class="text-white absolute transform -translate-y-2 left-4 bg-[url(/images/background.jpg)] text-xs px-2">
            Password
          </label>
          <input type="password" id="employeePassword" name="employeePassword" placeholder="Enter Password" required
                 class="bg-transparent border border-[#C7C7C7] text-white focus:outline-white placeholder:!text-white rounded-lg block w-full p-3 pr-10"/>

          <!-- Toggle Button -->
          <button type="button" id="togglePassword" class="absolute cursor-pointer top-1/2 right-4 transform -translate-y-1/2 text-white">
            <!-- Eye Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" id="eyeIcon" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
              <path fill-rule="evenodd"
                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                    clip-rule="evenodd"/>
            </svg>

            <!-- Eye Slash Icon (Hidden by Default) -->
            <svg xmlns="http://www.w3.org/2000/svg" id="eyeSlashIcon" viewBox="0 0 24 24" fill="currentColor"
                 class="size-6 hidden">
              <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z"/>
              <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z"/>
              <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z"/>
            </svg>
          </button>
        </div>

        <!-- Login Button -->
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

<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordField = document.getElementById('employeePassword');
  const eyeIcon = document.getElementById('eyeIcon');
  const eyeSlashIcon = document.getElementById('eyeSlashIcon');

  togglePassword.addEventListener('click', () => {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    eyeIcon.classList.toggle('hidden');
    eyeSlashIcon.classList.toggle('hidden');
  });
</script>

</body>
</html>
