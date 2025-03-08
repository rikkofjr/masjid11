<div>
   
    <style>
                .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
        }
        .displayNone{
        display: none;
        }
    </style>


<div class="my-8 py-10 md:py-1">
    <div class="container bg-white drop-shadow-xl py-10 px-5 min-h-80">
        <div class="items-center py-3">
            @if(!empty($successMessage))
            <div class="alert alert-success">
               {{ $successMessage }}
            </div>
            @endif
              
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                        <p>1</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                        <p>2</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}">3</a>
                        <p> 3</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-4" type="button" class="btn btn-circle {{ $currentStep != 4 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">4</a>
                        <p> 4</p>
                    </div>
                </div>
            </div>

            <div class="mt-9 row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
                <h5 class="text-xl font-sans">-</h3><hr/>

                <div class="mb-5">

                    <div class="form-group py-6">
                        <h3 class="mb-5 text-lg font-medium font-size gray-900 dark:text-white">Pilih Jenis ZIS</h3>
                        <ul class="grid w-full gap-6 md:grid-cols-3 sm:grid-cols-3">
                            @foreach ($jenis_zis as $item)
                            <li>
                                <input type="radio" id="{{$item->id}}" name="id_jenis_zis" value="{{$item->id}}" class="hidden peer" wire:model="id_jenis_zis" required />
                                <label for="{{$item->id}}" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">{{$item->nama}}</div>
                                    </div>
                                    <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </label>
                            </li>
                            @endforeach
                        </ul>
                        @error('id_jenis_zis') 
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <span class="font-medium">{{ $message }}</span>.
                            </div>
                        @enderror                            
                    </div>

                    <div class="form-group py-6">
                        <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Pembayaran Menggunakan</h3>
                        <ul class="grid w-full gap-6 md:grid-cols-2">
                            <li>
                                <input type="radio" id="uang" name="jenis_pembayaran" wire:model="jenis_pembayaran" value="uang" class="hidden peer" required />
                                <label for="uang" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">Uang</div>
                                    </div>
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                    </svg>
                                    
                                </label>
                            </li>
                            <!-- Disable zakat beras sementara
                            <li>
                                <input type="radio" id="beras" wire:model="jenis_pembayaran" name="jenis_pembayaran" value="beras" class="hidden peer" required />
                                <label for="beras" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">Beras</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>

                                </label>
                            </li>
                            -->
                        </ul>

                        @error('jenis_pembayaran') 
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <span class="font-medium">{{ $message }}</span>.
                            </div>
                        @enderror 
                    </div>

                    <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 nextBtn mt-5 pull-right" wire:click="firstStepSubmit" type="button" >Next</button>
                    
                </div>
            </div>
            <div class="mt-9 setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
                <h5 class="text-xl font-sans">-</h3>
                <br/><hr/>
                <div class="mb-5">
                    
                    
                    <!--ambil nilai zakat fitrah -->
                    
                    @if($jenis_pembayaran === 'uang')
                        @if($id_jenis_zis === $ambil_zakat_fitrah->id)

                            <div class="form-group py-6">
                                
                                <label class="mb-5 text-lg font-medium font-size gray-900 dark:text-white">Jumlah Jiwa yang akan dibayarkan</label>
                                <br>

                                <div class="">
                                    <div class="relative flex items-center max-w-[12rem]">
                                        <button wire:click="decrement" type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                            </svg>
                                        </button>
                                        <input type="number" wire:model="jumlah_jiwa" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="999" required />
                                        <button wire:click="increment" type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Jika yang dipilih adalah Zakat Fitrah-->
                            <h5 class="mb-5 text-lg font-medium font-size gray-900 dark:text-white">Pilih nominal uang perjiwa</h5>
                            <ul class="grid w-full gap-6 md:grid-cols-3">

                                <li>
                                    <input checked type="radio" id="50000" name="uang_perjiwa" value="50000" class="hidden peer" wire:model="uang_perjiwa" required/>
                                    <label for="50000" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">Rp 50.000,-</div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                        </svg>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="55000" name="uang_perjiwa" value="55000" class="hidden peer" wire:model="uang_perjiwa" required />
                                    <label for="55000" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">Rp 55.000,-</div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                        </svg>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="60000" name="uang_perjiwa" value="60000" class="hidden peer" wire:model="uang_perjiwa" required />
                                    <label for="60000" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">Rp 60.000,-</div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                        </svg>
                                    </label>
                                </li>
                                
                            </ul>
                            @error('uang_perjiwa') 
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                    <span class="font-medium">{{ $message }}</span>.
                                </div>
                            @enderror 
                    
                        @else
                        
                            <input type="hidden" value="1" wire:model="jumlah_jiwa" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div class="form-group py-6">
                                <label for="uang_perjiwa" class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Masukan Nominal Uang Zakat</label>
                                <input type="text" oninput="formatNumber()" id="numericInput" placeholder="Hanya tulis angka" wire:model="uang_perjiwa" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            @error('uang_perjiwa') 
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                    <span class="font-medium">{{ $message }}</span>.
                                </div>
                            @enderror 
                        
                        @endif
                    
                    @else
                        <!-- Jika pembayaran yang digunakan yang dipilih adalah beras-->
                        <h5 class="my-5 text-lg">masukan nominal beras</h5>
                        <div class="my-2">
                            <label for="large-input" class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Jumlah Beras</label>
                            <input type="number" wire:model="beras_perjiwa"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    
                    @endif

                        
                        <button class="mx-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button" wire:click="back(1)">Back</button>
                        <button class="mx-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 nextBtn mt-5 pull-right" type="button" wire:click="secondStepSubmit">Next</button>
                </div>
            </div>
            <div class="mt-9 setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                <div class="mb-5 grid-cols-1">
                
                    <h5 class="text-xl font-sans">Masukan Identitas</h3>
                        <br/><hr/><br/>

                    <div class="form-group">
                        <label for="atas_nama" class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Atas Nama</label>
                        <input type="text" placeholder="Contoh : Joko (untuk diri sendiri) atau Kel. Joko (Untuk Keluarga)" wire:model="atas_nama" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    @error('atas_nama') 
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span class="font-medium">{{ $message }}</span>.
                        </div>
                    @enderror 
                    
                    <div class="form-group mt-5">
                        <label for="nama_lain" class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Nama Anggota keluarga yang akan dizakatkan (Optional)</label>
                        <textarea name="nama_lain" wire:model="nama_lain" id="" cols="30" rows="10" placeholder="Contoh : Melly Binti Joko, Sutisna Bin Joko, dsb. (Optional)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                    
                    <button class="mx-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button" wire:click="back(2)">Back</button>
                    
                    <button class="mx-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 nextBtn mt-5 pull-right" type="button" wire:click="thirdStepSubmit">Next</button>

                </div>
            </div>
            <div class="mt-9 setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4">
                <div class="mb-5 grid-cols-1">
                
                    <h3> - </h3>
                    
                    
                    <div class="form-group">
                        <label for="uang_infaq" class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Mau sekalian infaq ? (optional)</label>
                        <input type="text" placeholder="Hanya tulis angka" wire:model="uang_infaq" id="uang_infaq"  autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>



                            <script>
                                new AutoNumeric('#uang_infaq', {
                                    digitGroupSeparator: ',',
                                    decimalSeparator: '.',
                                    decimalPlaces: 2
                                });
                                
                                // new AutoNumeric('#uang_perjiwas', {
                                //     digitGroupSeparator: ',',
                                //     decimalSeparator: '.',
                                //     decimalPlaces: 2
                                // });

                                function formatNumber() {
                                    let input = document.getElementById('numericInput');
                                    let value = input.value;

                                    // Remove non-numeric characters (except for decimal point)
                                    value = value.replace(/[^\d.]/g, '');

                                    // Format the number with commas as thousand separators
                                    let parts = value.split('.');
                                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                                    // Join back the integer and decimal parts
                                    input.value = parts.join('.');
                                }
                                
                                
                            </script>
                            
                    
                    
                    <button class="mx-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button" wire:click="back(3)">Back</button>
                    <button wire:navigate class="mx-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 nextBtn mt-5 pull-right" wire:click="submitForm" wire:loading.attr="disabled" type="button">
                        <div wire:loading.remove>
                            Proses Zakat
                        </div>
                        <div wire:loading>
                            Loading...
                        </div>
                    </button>
                
                </div>
            </div>
            
        </div>
    </div> <!-- container.// -->

</div>



</div>
    
