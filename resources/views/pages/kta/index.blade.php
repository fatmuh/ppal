@extends('../layouts/' . $layout)

@section('subhead')
    <title>KTA - PPAL</title>
@endsection

@section('breadcrumb')
    <x-base.breadcrumb.link
        :index="0"
        :href="route('dashboard')"
    >
        Application
    </x-base.breadcrumb.link>
    <x-base.breadcrumb.link
        :index="1"
        :active="true"
        :href="route('kta.list')"
    >
        Kartu Tanda Anggota
    </x-base.breadcrumb.link>
@endsection

@section('subcontent')
    <div class="flex flex-col items-center mt-8 intro-y sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">List KTA</h2>
    </div>
    <!-- BEGIN: HTML Table Data -->
    <div class="p-5 mt-5 intro-y box">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form
                class="sm:mr-auto xl:flex"
                id="tabulator-html-filter-form"
            >
                <div class="items-center gap-2 mt-2 sm:mr-4 sm:flex xl:mt-0">
                    <x-base.form-input
                        class="mt-2 sm:mt-0 sm:w-40 2xl:w-full"
                        id="tabulator-html-filter-value"
                        type="text"
                        placeholder="Cari Nomor KTA"
                    />
                    <x-base.form-input
                        class="mt-2 sm:mt-0 sm:w-40 2xl:w-full"
                        id="tabulator-html-filter-name"
                        type="text"
                        placeholder="Cari Nama"
                    />
                    <x-base.form-input
                        class="mt-2 sm:mt-0 sm:w-40 2xl:w-full"
                        id="tabulator-html-filter-nik"
                        type="text"
                        placeholder="Cari NIK"
                    />
                </div>
                <div class="mt-2 xl:mt-0">
                    <x-base.button
                        class="w-full mt-2 sm:mt-0 sm:ml-1 sm:w-16"
                        id="tabulator-html-filter-reset"
                        type="button"
                        variant="secondary"
                    >
                        Reset
                    </x-base.button>
                </div>
            </form>
            <div class="flex mt-5 sm:mt-0">
                <x-base.button
                    class="w-full mr-2 lg:w-auto btn-kta-add"
                    id="tabulator-add"
                    variant="primary"
                    data-form-url="{{ route('kta.store') }}"
                >
                    <x-base.lucide
                            class="w-4 h-4 mr-2"
                            icon="Plus"
                    />
                    Tambah KTA
                </x-base.button>
                <x-base.menu>
                    <x-base.menu.button
                        class="px-2 box"
                        as="x-base.button"
                    >
                        <span class="flex items-center justify-center w-5 h-5">
                            <x-base.lucide
                                class="w-4 h-4"
                                icon="menu"
                            />
                        </span>
                    </x-base.menu.button>
                    <x-base.menu.items class="w-40">
                        <a
                            class="font-medium cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"
                            href="{{ route('kta.export') }}"
                            id="download-xlsx"
                        >
                            <x-base.lucide
                                class="w-4 h-4 mr-2"
                                icon="file-up"
                            /> Export
                        </a>
                        <a
                            class="font-medium cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"
                            href="{{ route('kta.export.csv') }}"
                            id="download-xlsx"
                        >
                            <x-base.lucide
                                class="w-4 h-4 mr-2"
                                icon="file-up"
                            /> Export CSV
                        </a>
                    </x-base.menu.items>
                </x-base.menu>
            </div>
        </div>
        <div class="overflow-x-auto scrollbar-hidden">
            <div
                class="mt-5"
                id="kta-tabulator"
                data-url="{{ route('kta.tabulator') }}"
            ></div>
        </div>
    </div>
    <!-- END: HTML Table Data -->
    @include('pages.kta.modals._form-kta')
    @include('pages.kta.modals._detail')
@endsection

@once
    @push('vendors')
        <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
        @vite('resources/js/vendor/lucide/index.js')
        {{-- @vite('resources/js/vendor/xlsx/index.js') --}}
    @endpush

    @push('scripts')
        @vite('resources/js/pages/kta/index.js')
    @endpush

    @push('validation-script')
        {!! JsValidator::formRequest('App\Http\Requests\KtaRequest', '#form-kta') !!}
    @endpush
@endonce
