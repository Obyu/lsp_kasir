<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Shuisi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Tailwind Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        @vite('/resources/css/app.css')
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/logo.png">
        
        <script src="/resources/js/custom.js"></script>
        <!-- alertifyjs Css -->
        

        <!-- alertifyjs default themes  Css -->
        

        <!-- Layout config Js -->
        <!-- Icons CSS -->
        
        <!-- Tailwind CSS -->
        
      <link rel="stylesheet" href="/assets/css/tailwind2.css">
    </head>

    <body data-mode="light" data-sidebar-size="lg" class="group min-h-screen">
    @php
                                $user = Auth::user();
                                $role = $user->level;
                                @endphp
        <!-- ========== Left Sidebar Start ========== -->
        <div class="fixed bottom-0 z-10 h-screen ltr:border-r rtl:border-l vertical-menu rtl:right-0 ltr:left-0 top-[70px] bg-slate-50 border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700">
        
            <div data-simplebar class="h-full">
                <!--- Sidemenu -->
                <div class="metismenu pb-10 pt-2.5" id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul id="side-menu">
                        @if ($role != 'owner')
                        <li class="px-5 py-3 text-xs font-medium text-gray-500 cursor-default leading-[18px] group-data-[sidebar-size=sm]:hidden block" data-key="t-menu">Menu</li>
        
                        <li>
                            <a href="{{ route('dashboard.dashboard') }}" class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                <i class=" bx bx-home-alt text-lg pl-2"></i>
                                <span data-key="t-dashboard" class="px-2"> Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('menu.index') }}" class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                <i class="bx bxs-food-menu text-lg pl-2"></i>
                                <span data-key="t-dashboard" class="px-2"> Menu</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pelanggan.index') }}" class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                <i class="bx bx-user-plus text-lg pl-2"></i>
                                <span data-key="t-dashboard" class="px-2"> Pelanggan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('meja.index') }}" class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                <i class="mdi mdi-table-chair text-lg pl-2"></i>
                                <span data-key="t-dashboard" class="px-2"> Meja</span>
                            </a>
                        </li>
                        <li>
                        <a href="{{ route('pesanan.index') }}" class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                <i class=" bx bx-shopping-bag text-lg pl-2" fill="#545a6d33"></i>
                                <span data-key="t-dashboard"  class="px-2"> Pesanan</span>
                        </a>
                        </li>
                        <li>
                        <a href="{{ route('transaction.index') }}" class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                <i class="bx bx-money text-lg pl-2" fill="#545a6d33"></i>
                                <span data-key="t-dashboard" class="px-2"> Transaksi</span>
                           </a>
                        </li>
                        <li>
                            <a href="index.html" class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                <i class="bx bxs-user-plus text-lg pl-2"></i>
                                <span data-key="t-dashboard" class="px-2"> User</span>
                            </a>
                        </li>
                        
                        
                        @endif
                    </ul>
        
                        
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
         <nav class="fixed top-0 left-0 right-0 z-10 flex items-center bg-white  dark:bg-zinc-800 print:hidden dark:border-zinc-700 ltr:pr-6 rtl:pl-6">
            <div class="flex justify-between w-full">
                <div class="flex items-center topbar-brand">
                    <div class="hidden lg:flex navbar-brand items-center justify-between shrink px-6 h-[70px]  ltr:border-r rtl:border-l bg-[#fbfaff] border-gray-50 dark:border-zinc-700 dark:bg-zinc-800 shadow-none">
                        <a href="#" class="flex items-center text-lg flex-shrink-0 font-bold dark:text-white leading-[69px]">
                            <img src="/assets/images/logo.png" alt="" class="inline-block w-12b    h-12 align-middle ltr:xl:mr-2 rtl:xl:ml-2">
                            <span class="hidden font-bold text-gray-700 align-middle xl:block dark:text-gray-100 leading-[69px]">Shuisi</span>
                        </a>
                    </div>
                    <button type="button" class="group-data-[sidebar-size=sm]:border-b border-b border-[#e9e9ef] dark:border-zinc-600 dark:lg:border-transparent lg:border-transparent  group-data-[sidebar-size=sm]:border-[#e9e9ef] group-data-[sidebar-size=sm]:dark:border-zinc-600 text-gray-800 dark:text-white h-[70px] px-4 ltr:-ml-[52px] rtl:-mr-14 py-1 vertical-menu-btn text-16" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
        
                </div>
                <div class="flex justify-between w-full items-center border-b border-[#e9e9ef] dark:border-zinc-600 ltr:pl-6 rtl:pr-6">
                    <div>
                        <form class="hidden app-search xl:block">
                            <div class="relative inline-block">
                                <input type="text" class="pl-4 pr-[40px] border-0 rounded bg-[#f8f9fa] dark:bg-[#363a38] focus:ring-0 text-13 placeholder:text-13 dark:placeholder:text-gray-200 dark:text-gray-100  max-w-[223px]" placeholder="Search...">
                                <button class="py-1.5 px-2.5 w-9 h-[34px] text-white bg-violet-500 inline-block absolute ltr:right-1 top-1 rounded shadow shadow-violet-100 dark:shadow-gray-900 rtl:left-1 rtl:right-auto" type="button"><i class="align-middle bx bx-search-alt"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="flex">
                        <div>
                            <div class="relative block dropdown sm:hidden">
                                <button type="button" class="text-xl px-4 h-[70px] text-gray-600 dark:text-gray-100 dropdown-toggle" data-dropdown-toggle="navNotifications">
                                    <i data-feather="search" class="w-5 h-5"></i>
                                </button>
        
                                <div class="absolute top-0 z-50 hidden px-4 mx-4 list-none bg-white border rounded shadow  dropdown-menu -left-36 w-72 border-gray-50 dark:bg-zinc-800 dark:border-zinc-600 dark:text-gray-300" id="navNotifications">
                                    <form class="py-3 dropdown-item" aria-labelledby="navNotifications">
                                        <div class="m-0 form-group">
                                            <div class="flex w-full">
                                                <input type="text" class="border-gray-100 dark:border-zinc-600 dark:text-zinc-100 w-fit" placeholder="Search ..." aria-label="Search Result">
                                                <button class="text-white border-l-0 border-transparent rounded-l-none btn btn-primary bg-violet-500" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="relative dropdown">

                                <button type="button" class="flex items-center px-3 py-2 h-[70px] border-x border-gray-50 bg-gray-50/30  dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <img class="border-[3px] border-gray-700 dark:border-zinc-400 rounded-full w-9 h-9 ltr:xl:mr-2 rtl:xl:ml-2" src="/assets/images/Bojji.jpeg" alt="Header Avatar">
                                    <span class="hidden font-medium xl:block">{{ $user->nama }}</span>
                                    <i class="hidden align-bottom mdi mdi-chevron-down xl:block"></i>
                                </button>
                                <div class="absolute top-0 z-50 hidden w-40 list-none bg-white dropdown-menu dropdown-animation rounded shadow  dark:bg-zinc-800" id="profile/log">
                                    <div class="border border-gray-50 dark:border-zinc-600" aria-labelledby="navNotifications">
                                        <hr class="border-gray-50 dark:border-gray-700">
                                        <div class="dropdown-item dark:text-gray-100">
                                            <form id="logout-form" action="{{ route('login.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            <a class="block p-3 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50" href="{{ route('login.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="mr-1 align-middle mdi mdi-logout text-16"></i> Logout
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="main-content group-data-[sidebar-size=sm]:ml-[70px]">
            <div class="page-content dark:bg-zinc-700">
                <div class="container-fluid px-[0.625rem]">
                    @yield('content')             
                </div>
            </div>
        </div>
        <script src="/assets/libs/@popperjs/core/umd/popper.min.js"></script>
        <script src="/assets/libs/feather-icons/feather.min.js"></script>
        <script src="/assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <!-- alertifyjs js -->
        <script src="/assets/libs/alertifyjs/build/alertify.min.js"></script>

        <script  src="/assets/js/app.js"></script>
    </body>

</html>