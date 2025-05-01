<div>
    <section class="py-8 md:py-16">
        <div class="container max-w-screen-xl mx-auto px-4">
            <div class="flex flex-col xl:flex-row items-center justify-between mb-20 md:mb-40">
                <div class="mx-auto xl:mx-0 mb-20 xl:mb-0">
                    <img src="assets/image/image-1.svg" alt="Image">
                </div>

                <div class="mx-auto xl:mx-0 text-center xl:text-left">
                    <h1 class="font-bold text-gray-700 text-3xl md:text-4xl mb-10">Selamat Datang Di Website {{$profileMasjid->nama_masjid ?? '-'}}</h1>

                    <p class="font-normal text-gray-400 text-sm md:text-lg mb-5">
                        {{$profileMasjid->deskripsi ?? '-'}}
                    </p>

                    <a href="#" class="flex items-center justify-center xl:justify-start font-semibold text-green-500 text-lg gap-3 hover:text-green-700 transition ease-in-out duration-300">
                        See more
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>
                </div>
            </div>

        </div> <!-- container.// -->

    </section>

    <section class="py-8 md:py-16" style="background-color: rgba(250,250,250,0.6);">
        <div class="container max-w-screen-xl mx-auto px-4">
            <h1 class="font-bold text-gray-700 text-3xl mb-10">Program Unggulan</h1>
            <div class="key-feature-grid mt-10 grid grid-cols-2 gap-7 md:grid-cols-3 xl:grid-cols-3">
                @foreach($programMasjid as $item)
                <div class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg">
                    <div>
                    <h3 class="h4 text-xl lg:text-3xl ">{{$item->judul_program ?? '-'}}</h3>
                    <p>{{$item->deskripsi ?? '-'}}</p>
                    </div>
                    <span class="icon mt-4">
                    <img class="objec-contain" src="images/icons/feature-icon-1.svg" alt="">
                    </span>
                </div>
                @endforeach
            </div>

        </div> <!-- container.// -->

    </section>

    <section class="py-8 md:py-16">
        <div class="container max-w-screen-xl mx-auto px-4">
            <h1 class="font-bold text-gray-700 text-3xl mb-10">Artikel Terbaru</h1>
            
            <div class="key-feature-grid mt-10 grid grid-cols-2 gap-7 md:grid-cols-3 xl:grid-cols-3">
                @foreach($programMasjid as $item)
                    <div class="mb-8 md:col-6 rounded-lg bg-white p-5 shadow-lg">
                        <div class="card">
                        <img class="card-img" width="100%" height="304" src="{{asset('storage/'.$item->photo)}}" alt="">
                        <div class="card-content">
                            <h3 class="h4 card-title">
                            {{$item->judul_program}}
                            </p>
                            <div class="card-footer mt-6 flex space-x-4">
                            <span class="inline-flex items-center text-xs text-[#666]">
                                <svg class="mr-1.5" width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5 2H11V0.375C11 0.16875 10.8313 0 10.625 0H9.375C9.16875 0 9 0.16875 9 0.375V2H5V0.375C5 0.16875 4.83125 0 4.625 0H3.375C3.16875 0 3 0.16875 3 0.375V2H1.5C0.671875 2 0 2.67188 0 3.5V14.5C0 15.3281 0.671875 16 1.5 16H12.5C13.3281 16 14 15.3281 14 14.5V3.5C14 2.67188 13.3281 2 12.5 2ZM12.3125 14.5H1.6875C1.58438 14.5 1.5 14.4156 1.5 14.3125V5H12.5V14.3125C12.5 14.4156 12.4156 14.5 12.3125 14.5Z" fill="#939393"></path>
                                </svg>
                                21st Sep,2020
                            </span>
                            <span class="inline-flex items-center text-xs text-[#666]">
                                <svg class="mr-1.5" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.65217 0C3.42496 0 0 3.58065 0 8C0 12.4194 3.42496 16 7.65217 16C11.8794 16 15.3043 12.4194 15.3043 8C15.3043 3.58065 11.8794 0 7.65217 0ZM7.65217 14.4516C4.24264 14.4516 1.48107 11.5645 1.48107 8C1.48107 4.43548 4.24264 1.54839 7.65217 1.54839C11.0617 1.54839 13.8233 4.43548 13.8233 8C13.8233 11.5645 11.0617 14.4516 7.65217 14.4516ZM9.55905 11.0839L6.93941 9.09355C6.84376 9.01935 6.78822 8.90323 6.78822 8.78065V3.48387C6.78822 3.27097 6.95484 3.09677 7.15849 3.09677H8.14586C8.34951 3.09677 8.51613 3.27097 8.51613 3.48387V8.05484L10.5773 9.62258C10.7439 9.74839 10.7778 9.99032 10.6575 10.1645L10.0774 11C9.95708 11.171 9.72567 11.2097 9.55905 11.0839Z" fill="#939393"></path>
                                </svg>
                                10 Min To Read
                            </span>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
                


            </div>

        </div> <!-- container.// -->

    </section>
</div>
