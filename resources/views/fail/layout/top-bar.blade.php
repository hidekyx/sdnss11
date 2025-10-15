<div class="border-b border-theme-24 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
    <div class="top-bar-boxed flex items-center">
        <!-- BEGIN: Logo -->
        <a href="" class="-intro-x hidden md:flex">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{ asset('assets/images/layout/logo-wide.png') }}">
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb breadcrumb--light mr-auto"> <a href="" class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Dashboard</a> </div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Search -->
        <div class="intro-x relative mr-3 sm:mr-6">
            <div class="search hidden sm:block">
                <input type="text" class="search__input input placeholder-theme-13" placeholder="Search...">
                <i data-feather="search" class="search__icon"></i>
            </div>
            <a class="notification notification--light sm:hidden" href=""> <i data-feather="search" class="notification__icon"></i> </a>
            <div class="search-result">
                <div class="search-result__content">
                    <div class="search-result__content__title">Pages</div>
                    <div class="mb-5">
                        <a href="" class="flex items-center">
                            <div class="w-8 h-8 bg-theme-18 text-theme-9 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="inbox"></i> </div>
                            <div class="ml-3">Mail Settings</div>
                        </a>
                    </div>
                    <div class="search-result__content__title">Users</div>
                    <div class="mb-5">
                        <a href="" class="flex items-center mt-2">
                            <div class="w-8 h-8 image-fit">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('assets/dashboard/images/profile-11.jpg') }}">
                            </div>
                            <div class="ml-3">Denzel Washington</div>
                            <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">denzelwashington@left4code.com</div>
                        </a>
                    </div>
                    <div class="search-result__content__title">Products</div>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('assets/dashboard/images/preview-7.jpg') }}">
                        </div>
                        <div class="ml-3">Dell XPS 13</div>
                        <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">PC &amp; Laptop</div>
                    </a>
                </div>
            </div>
        </div>
        <!-- END: Search -->
        <!-- BEGIN: Notifications -->
        <div class="intro-x dropdown relative mr-4 sm:mr-6">
            <div class="dropdown-toggle notification notification--light notification--bullet cursor-pointer"> <i data-feather="bell" class="notification__icon"></i> </div>
            <div class="notification-content dropdown-box mt-8 absolute top-0 right-0 z-10 -mr-10 sm:mr-0">
                <div class="notification-content__box dropdown-box__content box">
                    <div class="notification-content__title">Notifications</div>
                    <div class="cursor-pointer relative flex items-center ">
                        <div class="w-12 h-12 flex-none image-fit mr-1">
                            <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('assets/dashboard/images/profile-11.jpg') }}">
                            <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a href="javascript:;" class="font-medium truncate mr-5">Denzel Washington</a>
                                <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                            </div>
                            <div class="w-full truncate text-gray-600">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Notifications -->
        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8 relative">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110">
                <img alt="Midone Tailwind HTML Admin Template" src="{{ asset('assets/dashboard/images/profile-9.jpg') }}">
            </div>
            <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                <div class="dropdown-box__content box bg-theme-38 text-white">
                    <div class="p-4 border-b border-theme-40">
                        <div class="font-medium">Denzel Washington</div>
                        <div class="text-xs text-theme-41">Frontend Engineer</div>
                    </div>
                    <div class="p-2">
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                    </div>
                    <div class="p-2 border-t border-theme-40">
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
</div>