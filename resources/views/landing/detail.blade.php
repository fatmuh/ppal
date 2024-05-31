<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>KTA - PPAL</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link
        href="{{ asset('assets/img/logo.png') }}"
        rel="shortcut icon"
    >
</head>

<body class="bg-gray-100">

    <div class="bg-gray-100 min-h-screen flex items-center justify-center py-1">
        <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="PPAL"></a>
    </div>
    <div class="bg-gray-100 min-h-screen flex items-center justify-center py-4">

        <div class="max-w-4xl w-full bg-white p-8 rounded-lg shadow-md" id="formContainer">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                @method("PATCH")
                <div id="formTop">
                    <!-- Post Content Section -->

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                                <div>
                                    <input type="text" id="full_name" name="full_name" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Nama Lengkap" value="{{ $kta->full_name }}"></input>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Tempat, Tanggal Lahir</label>
                                <div>
                                    <input type="text" id="ttl" name="ttl" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Tempat, Tanggal Lahir" value="{{ $kta->ttl }}"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Agama</label>
                                <div>
                                    <input type="text" id="agama" name="agama" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Agama" value="{{ $kta->agama }}"></input>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Golongan Darah</label>
                                <div>
                                    <select id="gol_darah" name="gol_darah" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500">
                                        <option value="{{ $kta->gol_darah }}">{{ $kta->gol_darah }} (Sekarang)</option>
                                        @foreach (['-', 'A', 'A+', 'B', 'B+', 'AB', 'AB+', 'O'] as $option)
                                            @unless ($option == $kta->gol_darah)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endunless
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Pangkat Terakhir</label>
                                <div>
                                    <input type="text" id="pangkat_terakhir" name="pangkat_terakhir" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Pangkat Terakhir" value="{{ $kta->pangkat_terakhir }}"></input>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Nomor Induk Kependudukan (NIK)</label>
                                <div>
                                    <input type="text" id="nik" name="nik" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Nomor Induk Kependudukan (NIK)" value="{{ $kta->nik }}"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Tanda Jasa Tertinggi</label>
                                <div>
                                    <input type="text" id="tanda_jasa_tertinggi" name="tanda_jasa_tertinggi" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Tanda Jasa Tertinggi" value="{{ $kta->tanda_jasa_tertinggi }}"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden" id="formBottom">
                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Istri / Suami</label>
                                <div>
                                    <select id="istri_suami" name="istri_suami" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500">
                                        <option value="{{ $kta->istri_suami }}">{{ $kta->istri_suami }} (Sekarang)</option>
                                        @foreach (['Istri', 'Suami'] as $option)
                                            @unless ($option == $kta->istri_suami)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endunless
                                        @endforeach
                                    </select>                                    
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Nama Istri / Suami</label>
                                <div>
                                    <input type="text" id="nama_istri_suami" name="nama_istri_suami" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Nama Istri / Suami" value="{{ $kta->nama_istri_suami }}"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">NIK Istri/Suami</label>
                                <div>
                                    <input type="text" id="nik_istri_suami" name="nik_istri_suami" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan NIK Istri/Suami" value="{{ $kta->nik_istri_suami }}"></input>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Wilayah/Rayon</label>
                                <div>
                                    <input type="text" id="wil_rayon" name="wil_rayon" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Wilayah/Rayon" value="{{ $kta->wil_rayon }}"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Alamat 1</label>
                                <div>
                                    <input type="text" id="alamat1" name="alamat1" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Alamat 1" value="{{ $kta->alamat1 }}"></input>
                                </div>
                            </div>
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Alamat 2</label>
                                <div>
                                    <input type="text" id="alamat2" name="alamat2" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan Alamat 2" value="{{ $kta->alamat2 }}"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2 mb-6">
                            Submit <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                id="send" fill="#fff">
                                <path fill="none" d="M0 0h24v24H0V0z"></path>
                                <path
                                    d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            <div class="flex items-center justify-center">
                <button type="button" id="expandButton" class="flex justify-center items-center bg-gray-400 hover:bg-gray-500 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2">
                    <span id="toggleButtonText">Buka Form</span>
                    <svg id="expandIconDown" class="w-4 h-4 ml-2 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg id="expandIconUp" class="w-4 h-4 ml-2 transform transition-transform duration-300 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center gap-2">
        <a href="{{ route('kta.front', $kta->id) }}" target="_blank"
            class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2 mb-6">
            KTA Depan <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M18.4697 13.4697C18.7626 13.1768 19.2374 13.1768 19.5303 13.4697L21.5303 15.4697C21.8232 15.7626 21.8232 16.2374 21.5303 16.5303C21.2374 16.8232 20.7626 16.8232 20.4697 16.5303L19.75 15.8107V20C19.75 20.4142 19.4142 20.75 19 20.75C18.5858 20.75 18.25 20.4142 18.25 20V15.8107L17.5303 16.5303C17.2374 16.8232 16.7626 16.8232 16.4697 16.5303C16.1768 16.2374 16.1768 15.7626 16.4697 15.4697L18.4697 13.4697Z" fill="#ffffff"></path> <path d="M10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C21.672 6.01511 21.9082 7.22882 21.9743 9.25H2.02572C2.09185 7.22882 2.32803 6.01511 3.17157 5.17157C4.34315 4 6.22876 4 10 4Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M10 20H14C15.0559 20 15.964 20 16.75 19.9743V18.2362C16.2601 18.1817 15.7847 17.9666 15.409 17.591C14.5303 16.7123 14.5303 15.2877 15.409 14.409L17.409 12.409C18.2877 11.5303 19.7123 11.5303 20.591 12.409L21.9937 13.8118C22 13.2613 22 12.6595 22 12C22 11.5581 22 11.142 21.9981 10.75H2.00189C2 11.142 2 11.5581 2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20ZM5.25 16C5.25 15.5858 5.58579 15.25 6 15.25H10C10.4142 15.25 10.75 15.5858 10.75 16C10.75 16.4142 10.4142 16.75 10 16.75H6C5.58579 16.75 5.25 16.4142 5.25 16ZM12.5 15.25C12.0858 15.25 11.75 15.5858 11.75 16C11.75 16.4142 12.0858 16.75 12.5 16.75H14C14.4142 16.75 14.75 16.4142 14.75 16C14.75 15.5858 14.4142 15.25 14 15.25H12.5Z" fill="#ffffff"></path> </g></svg>
        </a>
        <a href="{{ route('kta.back', $kta->id) }}" target="_blank"
            class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2 mb-6">
            KTA Belakang <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M18.4697 20.5303C18.7626 20.8232 19.2374 20.8232 19.5303 20.5303L21.5303 18.5303C21.8232 18.2374 21.8232 17.7626 21.5303 17.4697C21.2374 17.1768 20.7626 17.1768 20.4697 17.4697L19.75 18.1893V14C19.75 13.5858 19.4142 13.25 19 13.25C18.5858 13.25 18.25 13.5858 18.25 14V18.1893L17.5303 17.4697C17.2374 17.1768 16.7626 17.1768 16.4697 17.4697C16.1768 17.7626 16.1768 18.2374 16.4697 18.5303L18.4697 20.5303Z" fill="#ffffff"></path> <path d="M10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C21.672 6.01511 21.9082 7.22882 21.9743 9.25H2.02572C2.09185 7.22882 2.32803 6.01511 3.17157 5.17157C4.34315 4 6.22876 4 10 4Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M10 20H14C14.6595 20 15.2613 20 15.8118 19.9937L15.409 19.591C14.5303 18.7123 14.5303 17.2877 15.409 16.409C15.7847 16.0334 16.2601 15.8183 16.75 15.7638V14C16.75 12.7574 17.7574 11.75 19 11.75C20.2426 11.75 21.25 12.7574 21.25 14V15.7638C21.4739 15.7887 21.6947 15.8471 21.9044 15.9391C22 14.9172 22 13.636 22 12C22 11.5581 22 11.142 21.9981 10.75H2.00189C2 11.142 2 11.5581 2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20ZM6 15.25C5.58579 15.25 5.25 15.5858 5.25 16C5.25 16.4142 5.58579 16.75 6 16.75H10C10.4142 16.75 10.75 16.4142 10.75 16C10.75 15.5858 10.4142 15.25 10 15.25H6ZM12.5 15.25C12.0858 15.25 11.75 15.5858 11.75 16C11.75 16.4142 12.0858 16.75 12.5 16.75H14C14.4142 16.75 14.75 16.4142 14.75 16C14.75 15.5858 14.4142 15.25 14 15.25H12.5Z" fill="#ffffff"></path> </g></svg>
        </a>
    </div>
    <div class="flex items-center justify-center gap-2">
        <a href="{{ route('landing.search') }}"
            class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2 mb-6">
            Cari <svg fill="#ffffff" height="15px" width="15px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 296.999 296.999" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M156.215,53.603c-13.704-13.704-31.924-21.251-51.302-21.251c-19.38,0-37.6,7.548-51.302,21.251 c-3.855,3.855-3.855,10.105,0,13.96c3.856,3.854,10.104,3.854,13.96,0c9.974-9.975,23.236-15.469,37.342-15.469 c14.106,0,27.368,5.494,37.342,15.469c20.59,20.59,20.59,54.094,0,74.685c-3.855,3.855-3.855,10.105,0,13.96 c1.928,1.927,4.454,2.891,6.98,2.891s5.052-0.964,6.98-2.891C184.503,127.92,184.503,81.891,156.215,53.603z"></path> <path d="M289.054,250.651l-93.288-93.288c23.145-40.108,17.591-92.372-16.674-126.637C159.278,10.912,132.933,0,104.913,0 c-28.022,0-54.365,10.912-74.18,30.727C10.918,50.542,0.007,76.884,0.007,104.906c0,28.021,10.912,54.365,30.727,74.179 c20.452,20.451,47.315,30.676,74.179,30.676c18.145,0,36.287-4.672,52.456-14.003l93.289,93.287 c5.127,5.129,11.946,7.954,19.197,7.954c7.253,0,14.071-2.824,19.198-7.953C299.639,278.461,299.639,261.238,289.054,250.651z M104.913,190.029c-21.806-0.003-43.619-8.303-60.219-24.904c-16.086-16.085-24.945-37.471-24.945-60.219 s8.859-44.134,24.945-60.219c16.085-16.086,37.471-24.945,60.219-24.945c22.748,0,44.133,8.859,60.219,24.945 c33.205,33.205,33.205,87.233,0,120.438C148.528,181.729,126.724,190.031,104.913,190.029z M275.094,275.088 c-1.4,1.399-3.259,2.17-5.238,2.17c-1.978,0-3.838-0.771-5.237-2.171l-90.952-90.951c1.852-1.61,3.664-3.289,5.426-5.051 c1.761-1.761,3.441-3.573,5.05-5.425l90.951,90.951C277.982,267.5,277.982,272.199,275.094,275.088z"></path> </g> </g> </g> </g></svg>
        </a>
        <a href="{{ route('landing.index') }}"
            class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2 mb-6">
            Form KTA <svg fill="#FFF" height="15px" width="15px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve" stroke="#FFF"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_222_" d="M250.606,154.389l-150-149.996c-5.857-5.858-15.355-5.858-21.213,0.001 c-5.857,5.858-5.857,15.355,0.001,21.213l139.393,139.39L79.393,304.394c-5.857,5.858-5.857,15.355,0.001,21.213 C82.322,328.536,86.161,330,90,330s7.678-1.464,10.607-4.394l149.999-150.004c2.814-2.813,4.394-6.628,4.394-10.606 C255,161.018,253.42,157.202,250.606,154.389z"></path> </g></svg>
        </a>
    </div>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <script>
        const formTop = document.getElementById('formTop');
        const formBottom = document.getElementById('formBottom');
        const expandButton = document.getElementById('expandButton');
        const expandIconDown = document.getElementById('expandIconDown');
        const expandIconUp = document.getElementById('expandIconUp');
        const toggleButtonText = document.getElementById('toggleButtonText');

        expandButton.addEventListener('click', function () {
            if (formBottom.classList.contains('hidden')) {
                formBottom.classList.remove('hidden');
                formBottom.classList.add('block');
                formBottom.classList.add('opacity-100');
                formBottom.classList.remove('opacity-0');
                expandIconDown.classList.add('hidden');
                expandIconUp.classList.remove('hidden');
                toggleButtonText.textContent = 'Tutup Form';
            } else {
                formBottom.classList.remove('block');
                formBottom.classList.remove('opacity-100');
                formBottom.classList.add('opacity-0');
                formBottom.classList.add('hidden');
                expandIconDown.classList.remove('hidden');
                expandIconUp.classList.add('hidden');
                toggleButtonText.textContent = 'Buka Form';
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            axios.post('{{ route('landing.update', $kta->id) }}', formData)
                .then(function (response) {
                    // Jika validasi berhasil
                    alert("Data KTA berhasil diubah!");
                    // form.reset();
                    // Lakukan aksi sesuai kebutuhan, contoh: form.submit();
                })
                .catch(function (error) {
                    // Jika terjadi kesalahan validasi
                    if (error.response.status === 422) {
                        let errors = error.response.data.errors;
                        // Tampilkan pesan kesalahan validasi
                        Object.keys(errors).forEach(function (key) {
                            let errorMessage = errors[key][0];
                            let inputField = document.querySelector('#' + key);
                            let errorElement = inputField.nextElementSibling;
                            if (errorElement && errorElement.classList.contains('text-red-500')) {
                                errorElement.textContent = errorMessage;
                            } else {
                                inputField.insertAdjacentHTML('afterend', '<p class="text-red-500 text-sm">' + errorMessage + '</p>');
                            }
                        });
                    }
                });
        });

        // Hilangkan pesan validasi saat input menerima fokus
        form.querySelectorAll('input, select, textarea').forEach(function(input) {
            input.addEventListener('focus', function() {
                let errorElement = this.nextElementSibling;
                if (errorElement && errorElement.classList.contains('text-red-500')) {
                    errorElement.remove();
                }
            });
        });
    });
    </script>

    <!-- BEGIN: Validation Javascript-->
    {{-- <script type="module" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\BacklogRequest') !!} --}}
    <!-- END: Validation Javascript-->

</body>

</html>
