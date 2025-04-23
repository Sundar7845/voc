<nav class="px-4 md:px-16 py-4 flex justify-between gap-10 items-center ">
    <div>
        <a href="/dashboard">
            <img src={{ asset('/images/logo.svg') }} alt="logo" class="h-16" />
        </a>
    </div>

    <div>
        <div class="flex items-center gap-3">
            <div class="text-end">
                <div class="text-md font-medium text-black">{{ Auth::user()->name }}</div>
                <div class="text-[#7C7C7C] text-sm">Jewelone Showroom</div>
            </div>
            <div>
                <img class="size-12 block rounded-full" src={{ asset('/images/avatar.svg') }} alt="avatar" />
            </div>

            <div>
                <a href="{{ route('logout') }}"
                    class="flex gap-1 items-center border cursor-pointer text-black border-black rounded-sm py-2 px-4 hover:text-white hover:bg-black">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                    </svg>

                    Logout
                </a>
            </div>
        </div>
    </div>
</nav>
