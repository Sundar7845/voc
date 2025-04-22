<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('/images/avatar.svg') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>
</head>

<body class="bg-[#FCFAF9] min-h-screen roboto antialiased text-black">
    <header class="bg-[#F2EDE4] border-b border-[#C7C7C7]">
        <nav class="px-4 md:px-16 py-4 flex justify-between gap-10 items-center ">
            <div>
                <a href="/">
                    <img src={{ asset('/images/logo.svg') }} alt="logo" class="h-16" />
                </a>
            </div>

            <div>
                <div class="flex items-center gap-3">
                    <div class="text-end">
                        <div class="text-md font-medium text-black">Coimbatore</div>
                        <div class="text-[#7C7C7C] text-sm">Jewelone Showroom</div>
                    </div>
                    <div>
                        <img class="size-12 block rounded-full" src={{ asset('/images/avatar.svg') }} alt="avatar" />
                    </div>

                    <div>
                        <button
                            class="flex gap-1 items-center border cursor-pointer text-black border-black rounded-sm py-2 px-4 hover:text-white hover:bg-black">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                            </svg>

                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="grid md:grid-cols-[240px_auto]">
        <aside class="bg-[#F2EDE4] ">
            <div class="p-4">
                <div class="flex flex-col gap-2 items-center">
                    <a href="/dashboard" class="flex items-center gap-1 bg-[#9D4F2A] text-white p-2 w-full rounded-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 fill-white stroke-white" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M6.1609 5H9.87626C10.6094 5 11.2032 5.73312 11.2032 6.32691V10.0423C11.2032 10.7754 10.6094 11.3692 9.87626 11.3692H6.1609C5.42778 11.3692 4.83398 10.6361 4.83398 10.0423V6.32691C4.83398 5.59379 5.42778 5 6.1609 5Z" />
                            <path
                                d="M14.1228 5.5H17.8382C18.0341 5.5 18.241 5.59964 18.4108 5.78175C18.5852 5.96876 18.6651 6.18382 18.6651 6.32691V10.0423C18.6651 10.4992 18.2951 10.8692 17.8382 10.8692H14.1228C13.9269 10.8692 13.7199 10.7695 13.5501 10.5874C13.3758 10.4004 13.2959 10.1854 13.2959 10.0423V6.32691C13.2959 5.86994 13.6658 5.5 14.1228 5.5Z"
                                stroke="inherit" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M6.1609 12.9614H9.87626C10.6094 12.9614 11.2032 13.6945 11.2032 14.2883V18.0037C11.2032 18.7368 10.6094 19.3306 9.87626 19.3306H6.1609C5.42778 19.3306 4.83398 18.5975 4.83398 18.0037V14.2883C4.83398 13.5552 5.42778 12.9614 6.1609 12.9614Z" />
                            <path
                                d="M14.1228 12.9614H17.8382C18.5713 12.9614 19.1651 13.6945 19.1651 14.2883V18.0037C19.1651 18.7368 18.5713 19.3306 17.8382 19.3306H14.1228C13.3897 19.3306 12.7959 18.5975 12.7959 18.0037V14.2883C12.7959 13.5552 13.3897 12.9614 14.1228 12.9614Z" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="/live-user" class="flex items-center gap-1 text-[#4E5356] p-2 w-full rounded-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 fill-[#4E5356]" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M8.08908 7.85166C8.08905 7.0899 8.31839 6.34524 8.7481 5.71184C9.17782 5.07845 9.78861 4.58476 10.5032 4.29323C11.2179 4.00169 12.0042 3.92539 12.7629 4.07399C13.5215 4.22258 14.2184 4.58938 14.7654 5.12801C15.3123 5.66665 15.6848 6.35292 15.8358 7.10004C15.9867 7.84716 15.9092 8.62157 15.6132 9.32535C15.3172 10.0291 14.816 10.6307 14.1728 11.0539C13.5297 11.4771 12.7735 11.703 12 11.703C10.9632 11.7018 9.96913 11.2957 9.23595 10.5737C8.50278 9.85165 8.09033 8.87274 8.08908 7.85166ZM18.1928 15.2104C17.6741 14.6278 17.0365 14.1595 16.3216 13.8361C15.6067 13.5126 14.8306 13.3412 14.0439 13.3331H9.95606C9.16936 13.3412 8.39325 13.5126 7.67837 13.8361C6.96348 14.1595 6.32589 14.6278 5.8072 15.2104C4.68039 16.451 4.03967 18.0467 4.00015 19.7108C3.99893 19.7483 4.00538 19.7857 4.01913 19.8208C4.03287 19.8558 4.05363 19.8877 4.08015 19.9147C4.10668 19.9417 4.13845 19.9631 4.17356 19.9778C4.20867 19.9924 4.24642 20 4.28455 20H19.7154C19.7536 20 19.7913 19.9924 19.8264 19.9778C19.8616 19.9631 19.8933 19.9417 19.9198 19.9147C19.9464 19.8877 19.9671 19.8558 19.9809 19.8208C19.9946 19.7857 20.0011 19.7483 19.9999 19.7108C19.9604 18.0467 19.3197 16.451 18.1928 15.2104Z" />
                        </svg>
                        Live User
                    </a>
        </aside>
        <main class="relative min-h-screen border-l border-[#C7C7C7]" style="
            background-image: url('../assets/images/watermark.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 260px;
          ">
            <section class="py-8 px-6">
                <div class="flex justify-between items-center gap-6">
                    <div class="flex gap-2 items-center">
                        <a href="/live-user">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="32" viewBox="0 0 31 32" fill="none">
                                <rect x="0.455882" y="0.955882" width="30.0882" height="30.0882" rx="7.54412" fill="#FCFAF9" stroke="#C7C7C7" stroke-width="0.911765"/>
                                <path d="M9.40805 15.5905L12.8984 11.664C13.0808 11.4783 13.3458 11.4799 13.5153 11.6333C13.6849 11.7868 13.6995 12.0807 13.546 12.2503L10.7033 15.4474H21.9514C22.1923 15.4474 22.3877 15.6427 22.3877 15.8837C22.3877 16.1247 22.1923 16.32 21.9514 16.32H10.7033L13.546 19.5171C13.6995 19.6867 13.6798 19.9751 13.5153 20.134C13.3441 20.2994 13.0519 20.2729 12.8984 20.1033L9.40805 16.1768C9.25388 15.9613 9.27225 15.7787 9.40805 15.5905Z" fill="#252C32"/>
                              </svg>
                        </a>
                        <h1 class="text-xl font-semibold">Customer Details</h1>
    
                    </div>
                    <div>
                        <div>date</div>
                    </div>
                </div>


                <div class="border-b border-[#C7C7C7] mt-6">
                    <div class="border-b-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2">Previous History</div>
                </div>


                <div class="mt-8">

                    <div class="overflow-x-auto rounded-box border border-[#C7C7C7] max-w-lg">
                        <table class="table">

                          <tbody>
                        
                            <tr  class="border-[#C7C7C7]">
                                <td class="border-r border-[#C7C7C7]">Previous Visit Date</td>
                                <td>12/02/2025</td>
                            </tr>
                            <tr  class="border-[#C7C7C7]">
                                <td class="border-r border-[#C7C7C7]">Duration of Visit </td>
                                <td>-</td>
                            </tr>
                            <tr  class="border-[#C7C7C7]">
                                <td class="border-r border-[#C7C7C7]">Purchased / Non Purchased</td>
                                <td>-</td>
                            </tr>
                            <tr  class="border-[#C7C7C7]">
                                <td class="border-r border-[#C7C7C7]">Sales Data (All in table)</td>
                                <td>-</td>
                            </tr>
                            
                            
                          </tbody>
                        </table>
                      </div>
                    

                </div>

            </section>
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function showroomSelect() {
            return {
                open: false,
                search: '',
                selected: ['Anna Nagar', 'Vellore'], // pre-selected
                items: ['Anna Nagar', 'Puducherry', 'Vellore', 'Hosur', 'Trichy', 'Coimbatore', 'Hyderabad', 'Bangalore', 'Chennai', 'Delhi', 'Mumbai'],

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

</body>

</html>