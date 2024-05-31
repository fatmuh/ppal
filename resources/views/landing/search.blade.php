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

        <div class="max-w-lg w-full bg-white p-8 rounded-lg shadow-md" id="formContainer">
            <form action="{{ route('landing.detail') }}" method="GET" enctype="multipart/form-data">
                {{-- @csrf --}}
                <div id="formTop">
                    <!-- Post Content Section -->

                    <div class="mb-6">
                        <div class="grid grid-cols-1 gap-4 gap-y-3">
                            <div>
                                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">Cari Data</label>
                                <div>
                                    <input type="text" id="search" name="search" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="Masukkan No. KTA atau NIK"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2 mb-6">
                            Cari <svg fill="#ffffff" height="15px" width="15px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 296.999 296.999" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M156.215,53.603c-13.704-13.704-31.924-21.251-51.302-21.251c-19.38,0-37.6,7.548-51.302,21.251 c-3.855,3.855-3.855,10.105,0,13.96c3.856,3.854,10.104,3.854,13.96,0c9.974-9.975,23.236-15.469,37.342-15.469 c14.106,0,27.368,5.494,37.342,15.469c20.59,20.59,20.59,54.094,0,74.685c-3.855,3.855-3.855,10.105,0,13.96 c1.928,1.927,4.454,2.891,6.98,2.891s5.052-0.964,6.98-2.891C184.503,127.92,184.503,81.891,156.215,53.603z"></path> <path d="M289.054,250.651l-93.288-93.288c23.145-40.108,17.591-92.372-16.674-126.637C159.278,10.912,132.933,0,104.913,0 c-28.022,0-54.365,10.912-74.18,30.727C10.918,50.542,0.007,76.884,0.007,104.906c0,28.021,10.912,54.365,30.727,74.179 c20.452,20.451,47.315,30.676,74.179,30.676c18.145,0,36.287-4.672,52.456-14.003l93.289,93.287 c5.127,5.129,11.946,7.954,19.197,7.954c7.253,0,14.071-2.824,19.198-7.953C299.639,278.461,299.639,261.238,289.054,250.651z M104.913,190.029c-21.806-0.003-43.619-8.303-60.219-24.904c-16.086-16.085-24.945-37.471-24.945-60.219 s8.859-44.134,24.945-60.219c16.085-16.086,37.471-24.945,60.219-24.945c22.748,0,44.133,8.859,60.219,24.945 c33.205,33.205,33.205,87.233,0,120.438C148.528,181.729,126.724,190.031,104.913,190.029z M275.094,275.088 c-1.4,1.399-3.259,2.17-5.238,2.17c-1.978,0-3.838-0.771-5.237-2.171l-90.952-90.951c1.852-1.61,3.664-3.289,5.426-5.051 c1.761-1.761,3.441-3.573,5.05-5.425l90.951,90.951C277.982,267.5,277.982,272.199,275.094,275.088z"></path> </g> </g> </g> </g></svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="flex items-center justify-center">
        <a href="{{ route('landing.index') }}"
            class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2 mb-6">
            Form KTA <svg fill="#FFF" height="15px" width="15px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve" stroke="#FFF"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_222_" d="M250.606,154.389l-150-149.996c-5.857-5.858-15.355-5.858-21.213,0.001 c-5.857,5.858-5.857,15.355,0.001,21.213l139.393,139.39L79.393,304.394c-5.857,5.858-5.857,15.355,0.001,21.213 C82.322,328.536,86.161,330,90,330s7.678-1.464,10.607-4.394l149.999-150.004c2.814-2.813,4.394-6.628,4.394-10.606 C255,161.018,253.42,157.202,250.606,154.389z"></path> </g></svg>
        </a>
    </div>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <!-- BEGIN: Validation Javascript-->
    {{-- <script type="module" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\BacklogRequest') !!} --}}
    <!-- END: Validation Javascript-->

</body>

</html>
