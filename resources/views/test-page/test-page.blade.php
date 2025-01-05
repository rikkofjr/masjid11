
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kubik - Tailwind Template</title>
        <link rel="stylesheet" href="http://127.0.0.1/Laravel/belajar/kubik/assets/css/tailwind.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        
    </head>

    <body class="bg-white">
        
        <!-- home section -->
        <section class="py-8 md:py-16">

            <div class="container max-w-screen-xl mx-auto px-4">

                <nav class="flex-wrap lg:flex items-center justify-between mb-20 lg:mb-40" x-data="{navbarOpen:false}">
                    <div class="flex items-center justify-between mb-10 lg:mb-0">
                        <img src="assets/image/navbar-logo.svg" alt="Logo">

                        <button class="flex items-center justify-center border border-green-500 w-10 h-10 text-green-500 rounded-md outline-none lg:hidden ml-auto" @click="navbarOpen = !navbarOpen">
                            <i data-feather="menu"></i>
                        </button>
                    </div>

                    <ul class="hidden lg:block lg:flex flex-col lg:flex-row lg:items-center lg:space-x-20" :class="{'hidden':!navbarOpen,'flex':navbarOpen}">
                        <li class="font-medium text-green-500 text-lg hover:text-green-300 transition ease-in-out duration-300 mb-5 lg:mb-0">
                            <a href="#">Services</a>
                        </li>

                        <li class="font-medium text-green-500 text-lg hover:text-green-300 transition ease-in-out duration-300 mb-5 lg:mb-0">
                            <a href="#">Works</a>
                        </li>

                        <li class="font-medium text-green-500 text-lg hover:text-green-300 transition ease-in-out duration-300 mb-5 lg:mb-0">
                            <a href="#">Blog</a>
                        </li>

                       <li class="px-8 py-3 font-medium text-green-500 text-lg text-center border-2 border-green-500 rounded-md hover:bg-green-500 hover:text-white transition ease-linear duration-300">
                            <a href="#">Connect</a>
                       </li>
                    </ul>
                </nav>

                <header class="flex-col xl:flex-row flex justify-between">

                    <div class="mx-auto text-center xl:text-left xl:mx-0 mb-20 xl:mb-0">
                        <h1 class="font-bold text-gray-700 text-3xl md:text-6xl leading-tight mb-10">A digital <br> Product design <br> Agency</h1>

                        <p class="font-normal text-gray-500 text-sm md:text-lg mb-10">We develop world class high quality product <br> designs.</p>

                        <div class="flex items-center justify-center lg:justify-start">
                            <a href="#" class="px-8 py-3 bg-green-500 font-medium text-white text-md md:text-lg rounded-md hover:bg-green-700 transition ease-in-out duration-300 mr-14">Our story</a>

                            <a href="#" class="hidden lg:block font-normal text-gray-500 text-lg mr-8">Watch Showreel</a>

                            <a href="#" class="px-4 py-4 text-gray-300 border-2 border-gray-200 rounded-full">
                                <i data-feather="play"></i>
                            </a>
                        </div>
                    </div>

                    <div class="mx-auto xl:mx-0">
                        <img src="assets/image/home-img.svg" alt="Image">
                    </div>

                </header>

            </div> <!-- container.// -->

        </section>
        <!-- home section //end -->

        <!-- feature section -->
        <section class="py-8 md:py-16">

            <div class="container max-w-screen-xl mx-auto px-4">

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                    <div class="text-center mb-10 xl:mb-0">
                        <div class="flex items-center justify-center">
                            <div class="w-20 py-7 flex justify-center bg-purple-50 text-purple-500 rounded-md mb-5 md:mb-10">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                        </div>

                        <h2 class="font-semibold text-gray-700 text-xl md:text-3xl mb-5">Business planning</h2>

                        <p class="font-normal text-gray-400 text-sm md:text-lg">Excepteur sint occaecat cupidatat non <br> proident, sunt in culpa qui officia deserunt <br> mollit anim id est laborum.</p>
                    </div>

                    <div class="text-center mb-10 md:mb-0">
                        <div class="flex items-center justify-center">
                            <div class="w-20 py-7 flex justify-center bg-red-50 text-red-500 rounded-md mb-5 md:mb-10">
                                <i data-feather="dollar-sign"></i>
                            </div>
                        </div>

                        <h2 class="font-semibold text-gray-700 text-xl md:text-3xl mb-5">Financial planning</h2>

                        <p class="font-normal text-gray-400 text-sm md:text-lg">Excepteur sint occaecat cupidatat non <br> proident, sunt in culpa qui officia deserunt <br> mollit anim id est laborum.</p>
                    </div>

                    <div class="text-center">
                        <div class="flex items-center justify-center">
                            <div class="w-20 py-7 flex justify-center bg-blue-50 text-blue-500 rounded-md mb-5 md:mb-10">
                                <i data-feather="search"></i>
                            </div>
                        </div>

                        <h2 class="font-semibold text-gray-700 text-xl md:text-3xl mb-5">Market Analytics</h2>

                        <p class="font-normal text-gray-400 text-sm md:text-lg">Excepteur sint occaecat cupidatat non <br> proident, sunt in culpa qui officia deserunt <br> mollit anim id est laborum.</p>
                    </div>
                </div>

            </div> <!-- container.// -->

        </section>
        <!-- feature section //end -->

        <section class="py-8 md:py-16">

            <div class="container max-w-screen-xl mx-auto px-4">

                <h1 class="font-semibold text-gray-700 text-3xl md:text-4xl text-center mb-5">What we do?</h1>

                <p class="font-normal text-gray-500 text-md md:text-lg text-center mb-20 md:mb-40">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit <br> anim id est laborum.</p>

                <div class="flex flex-col xl:flex-row items-center justify-between mb-20 md:mb-40">
                    <div class="mx-auto xl:mx-0 mb-20 xl:mb-0">
                        <img src="assets/image/image-1.svg" alt="Image">
                    </div>

                    <div class="mx-auto xl:mx-0 text-center xl:text-left">
                        <h1 class="font-bold text-gray-700 text-3xl md:text-4xl mb-10">Design is our most intense <br> process</h1>

                        <p class="font-normal text-gray-400 text-sm md:text-lg mb-5">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum <br> dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <br> non proident, sunt in culpa qui officia deserunt mollit anim id est <br> laborum.</p>

                        <a href="#" class="flex items-center justify-center xl:justify-start font-semibold text-green-500 text-lg gap-3 hover:text-green-700 transition ease-in-out duration-300">
                            See more
                            <i data-feather="chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col xl:flex-row items-center justify-between mb-20 md:mb-40">
                    <div class="mx-auto xl:mx-0 text-center xl:text-left mb-20 xl:mb-0">
                        <h1 class="font-bold text-gray-700 text-3xl md:text-4xl mb-10">Don’t worry about the investment, <br> it will come back.</h1>

                        <p class="font-normal text-gray-400 text-sm md:text-lg mb-5">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum <br> dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <br> non proident, sunt in culpa qui officia deserunt mollit anim id est <br> laborum.</p>

                        <a href="#" class="flex items-center justify-center xl:justify-start font-semibold text-green-500 text-lg gap-3 hover:text-green-700 transition ease-in-out duration-300">
                            See more
                            <i data-feather="chevron-right"></i>
                        </a>
                    </div>

                    <div class="mx-auto xl:mx-0">
                        <img src="assets/image/image-2.svg" alt="Image">
                    </div>
                </div>

                <div class="flex flex-col xl:flex-row items-center justify-between">
                    <div class="mx-auto xl:mx-0 mb-20 xl:mb-0">
                        <img src="assets/image/image-3.svg" alt="Image">
                    </div>

                    <div class="mx-auto xl:mx-0 text-center xl:text-left">
                        <h1 class="font-bold text-gray-700 text-3xl md:text-4xl mb-10">Instantly understandable content <br> is important</h1>

                        <p class="font-normal text-gray-400 text-sm md:text-lg mb-5">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum <br> dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <br> non proident, sunt in culpa qui officia deserunt mollit anim id est <br> laborum.</p>

                        <a href="#" class="flex items-center justify-center xl:justify-start font-semibold text-green-500 text-lg gap-3 hover:text-green-700 transition ease-in-out duration-300">
                            See more
                            <i data-feather="chevron-right"></i>
                        </a>
                    </div>
                </div>

            </div> <!-- container.// -->

        </section>

        <section class="py-8 md:py-16">

            <div class="container max-w-screen-xl mx-auto px-4">

                <h1 class="font-semibold text-gray-700 text-3xl md:text-4xl text-center mb-5">Our works</h1>

                <p class="font-normal text-gray-500 text-md md:text-lg text-center mb-20">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit <br> anim id est laborum.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 xl:gap-10">
                    <div class="space-y-2 xl:space-y-4">
                        <img src="assets/image/yoga-1.svg" alt="Image" class="hover:opacity-75 transition ease-in-out duration-300">

                        <p class="font-normal text-gray-400 text-base">Design, Branding, Development</p>

                        <a href="#" class="block font-semibold text-gray-700 text-xl md:text-2xl hover:text-green-500 transition ease-in-out duration-300">Yoga School</a>
                    </div>

                    <div class="space-y-2 xl:space-y-4">
                        <img src="assets/image/yoga-2.svg" alt="Image" class="hover:opacity-75 transition ease-in-out duration-300">

                        <p class="font-normal text-gray-400 text-base">Design, Branding, Development</p>

                        <a href="#" class="block font-semibold text-gray-700 text-xl md:text-2xl hover:text-green-500 transition ease-in-out duration-300">Yoga School</a>
                    </div>

                    <div class="space-y-2 xl:space-y-4">
                        <img src="assets/image/yoga-3.svg" alt="Image" class="hover:opacity-75 transition ease-in-out duration-300">

                        <p class="font-normal text-gray-400 text-base">Design, Branding, Development</p>

                        <a href="#" class="block font-semibold text-gray-700 text-xl md:text-2xl hover:text-green-500 transition ease-in-out duration-300">Yoga School</a>
                    </div>

                    <div class="space-y-2 xl:space-y-4">
                        <img src="assets/image/yoga-3.svg" alt="Image" class="hover:opacity-75 transition ease-in-out duration-300">

                        <p class="font-normal text-gray-400 text-base">Design, Branding, Development</p>

                        <a href="#" class="block font-semibold text-gray-700 text-xl md:text-2xl hover:text-green-500 transition ease-in-out duration-300">Yoga School</a>
                    </div>

                    <div class="space-y-2 xl:space-y-4">
                        <img src="assets/image/yoga-1.svg" alt="Image" class="hover:opacity-75 transition ease-in-out duration-300">

                        <p class="font-normal text-gray-400 text-base">Design, Branding, Development</p>

                        <a href="#" class="block font-semibold text-gray-700 text-xl md:text-2xl hover:text-green-500 transition ease-in-out duration-300">Yoga School</a>
                    </div>

                    <div class="space-y-2 xl:space-y-4 mb-10 md:mb-20">
                        <img src="assets/image/yoga-2.svg" alt="Image" class="hover:opacity-75 transition ease-in-out duration-300">

                        <p class="font-normal text-gray-400 text-base">Design, Branding, Development</p>

                        <a href="#" class="block font-semibold text-gray-700 text-xl md:text-2xl hover:text-green-500 transition ease-in-out duration-300">Yoga School</a>
                    </div>
                </div>

                <div class="flex justify-center mb-20 md:mb-40">
                    <a href="#" class="px-6 py-2 md:px-8 md:py-3 flex items-center gap-3 font-medium text-green-500 text-lg border-2 border-green-500 rounded-md hover:bg-green-500 hover:text-white transition ease-linear duration-300">
                        See more works
                        <i data-feather="arrow-up-right"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 ml-4 md:ml-20 xl:ml-0 mb-20 xl:mb-40">
                    <img src="assets/image/brand-1.svg" alt="Image" class="mb-5 md:mb-10 xl:mb-0">

                    <img src="assets/image/brand-2.svg" alt="Image" class="mb-5 md:mb-0">

                    <img src="assets/image/brand-3.svg" alt="Image" class="mb-5 md:mb-10 xl:mb-0">

                    <img src="assets/image/brand-4.svg" alt="Image" class="mb-5 md:mb-0">
                </div>

                <div class="flex flex-wrap md:flex-nowrap justify-between mb-8">
                    <div>
                        <p class="font-normal text-gray-500 text-md md:text-lg uppercase mb-3">Let's tealk</p>

                        <h1 class="font-bold text-gray-700 text-xl md:text-4xl">Do you have any Project?</h1>
                    </div>

                    <div class="mt-10">
                        <a href="#" class="px-4 py-2 md:px-8 md:py-3 font-medium text-green-500 text-lg border-2 border-green-500 rounded-md hover:bg-green-500 hover:text-white transition ease-linear duration-300">
                            Contact us now
                        </a>
                    </div>
                </div>

                <hr class="text-gray-300 mb-8">

                <p class="font-normal text-gray-500 text-md md:text-lg mb-4 md:mb-10">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit <br> anim id est laborum.</p>

            </div> <!-- container.// -->
            
        </section>

        <footer class="bg-green-50 py-8 md:py-16">

            <div class="container max-w-screen-xl mx-auto px-4">

                <div class="lg:flex flex-col md:flex-row text-center lg:text-left lg:justify-between">
                    <div class="mb-10 lg:mb-0">
                        <img src="assets/image/footer-logo.svg" alt="Image" class="mb-5 mx-auto lg:mx-0">
    
                        <p class="font-normal text-gray-400 text-md">Excepteur sint occaecat cupidatat non <br> proident, sunt in culpa qui officia deserunt <br> mollit anim id est laborum.</p>
                    </div>

                    <div class="space-y-4 mb-10 lg:mb-0">
                        <h4 class="font-semibold text-gray-500 text-lg mb-6">Our services</h4>

                        <a href="#" class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Pricing</a>

                        <a href="#" class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">UI Design</a>

                        <a href="#" class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Animation</a>

                        <a href="#" class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Development</a>
                    </div>

                    <div class="space-y-4 mb-10 lg:mb-0">
                        <h4 class="font-semibold text-gray-500 text-lg mb-6">Our Company</h4>

                        <a href="#" class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Reporting</a>

                        <a href="#" class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Get in Touch</a>

                        <a href="#" class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Management</a>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-500 text-lg mb-6">Our services</h4>

                        <a href="#" class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">121 King St, VIC3000, US</a>

                        <a href="#" class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">888-123-42287</a>

                        <a href="#" class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">info@example.com</a>
                    </div>
                </div>

                <hr class="text-gray-300 mt-10">

                <p class="font-normal text-gray-400 text-md text-center mt-5">&copy; 2021 Digital Agency. All rights reserved.</p>

            </div> <!-- container.// -->

        </footer>


        <script>
            feather.replace()
        </script>

    </body>
</html>