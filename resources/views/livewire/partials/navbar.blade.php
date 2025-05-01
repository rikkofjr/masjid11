<section class="py-8 md:py-16">
<div class="container max-w-screen-xl mx-auto px-4">
<nav class="flex-wrap lg:flex items-center justify-between mb-20 lg:mb-40" x-data="{navbarOpen:false}">
  <div class="flex items-center justify-between mb-10 lg:mb-0">
      <img src="{{asset('assets-internal/mosque.png')}}" alt="Logo" width="100px">

      <button class="flex items-center justify-center border border-green-500 w-10 h-10 text-green-500 rounded-md outline-none lg:hidden ml-auto" @click="navbarOpen = !navbarOpen">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
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
          <a href="/admin">login</a>
     </li>
  </ul>
</nav>
</div>
