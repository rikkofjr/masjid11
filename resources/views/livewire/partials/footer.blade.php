<footer class="bg-green-50 py-8 md:py-16">
  <div class="container max-w-screen-xl mx-auto px-4">

    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between">
      <!-- Logo -->
      <div class="mb-10 lg:mb-0 flex-[20%]">
        <img src="{{ asset('assets-internal/mosque.png') }}" alt="Image" class="mb-5 mx-auto lg:mx-0 w-[120px] h-auto">
      </div>

      <!-- Hubungi Kami -->
      <div class="space-y-4 flex-[80%]">
        <h4 class="font-semibold text-gray-700 text-xl mb-4">Hubungi Kami</h4>

        <div class="flex items-start gap-2 text-gray-600">
          <svg class="w-6 h-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
          </svg>
          <span>{{ $profileMasjid->alamat_masjid }}</span>
        </div>
        <div class="flex items-start gap-2 text-gray-600">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.427 14.768 17.2 13.542a1.733 1.733 0 0 0-2.45 0l-.613.613a1.732 1.732 0 0 1-2.45 0l-1.838-1.84a1.735 1.735 0 0 1 0-2.452l.612-.613a1.735 1.735 0 0 0 0-2.452L9.237 5.572a1.6 1.6 0 0 0-2.45 0c-3.223 3.2-1.702 6.896 1.519 10.117 3.22 3.221 6.914 4.745 10.12 1.535a1.601 1.601 0 0 0 0-2.456Z"/>
            </svg>
            <span>{{ $profileMasjid->no_handphone }}</span>
        </div>

      </div>
    </div>

    <hr class="text-gray-300 mt-10">

    <p class="font-normal text-gray-400 text-sm text-center mt-5"></p>

  </div>
</footer>
