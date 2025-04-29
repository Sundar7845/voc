<nav class="px-4 md:px-16 py-4 flex justify-between gap-5 items-center ">
    <div>
        <a href="/dashboard">
            <img src={{ asset('/images/logo.svg') }} alt="logo" class="h-14 lg:h-16" />
        </a>
    </div>

    <div>
        <div class="flex items-center gap-3">
            <div class="text-end">
                <div class="text-md font-medium text-black">{{ Auth::user()->name }}</div>
                <div class="text-[#7C7C7C] text-sm hidden lg:block">Jewelone Showroom</div>
            </div>
            <div class="hidden lg:block">
                <img class="size-12 block rounded-full" src={{ asset('/images/avatar.svg') }} alt="avatar" />
            </div>

            <div>
                <a href="{{ route('logout') }}"
                    class="hidden lg:flex gap-1 items-center border cursor-pointer text-black border-black rounded-sm py-2 px-4 hover:text-white hover:bg-black">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                    </svg>

                    Logout
                </a>

                <a  href="{{ route('logout') }}" class="lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                <path d="M19 0C8.52197 0 0 8.52197 0 19C0 29.478 8.52197 38 19 38C29.478 38 38 29.478 38 19C38 8.52197 29.478 0 19 0ZM18.05 8.75425C18.05 8.22729 18.4768 7.80425 19 7.80425C19.5232 7.80425 19.95 8.22729 19.95 8.75425V16.3913C19.95 16.9183 19.5232 17.3413 19 17.3413C18.4768 17.3413 18.05 16.9183 18.05 16.3913V8.75425ZM19 27.5315C14.2983 27.5315 10.4685 23.7036 10.4685 19C10.4685 16.0461 11.964 13.3427 14.4782 11.771C14.9198 11.4908 15.5098 11.6244 15.7844 12.0697C16.0646 12.5113 15.931 13.1014 15.4857 13.376C13.5337 14.6006 12.3704 16.701 12.3704 19C12.3704 22.6571 15.3447 25.6314 19.0018 25.6314C22.659 25.6314 25.6333 22.6571 25.6333 19C25.6333 16.7011 24.47 14.6006 22.518 13.376C22.0708 13.1013 21.9391 12.5113 22.2193 12.0697C22.4939 11.6225 23.0783 11.4908 23.5255 11.771C26.0378 13.3426 27.5352 16.046 27.5352 19C27.5352 23.7017 23.7073 27.5315 19.0037 27.5315H19Z" fill="#9D4F2A"/>
                </svg>
                </a>
            </div>
        </div>
    </div>
</nav>
