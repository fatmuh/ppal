<div class="col-span-12">
    <x-base.tab.group>
        <div class="px-5 border-b intro-y border-slate-200">
            <div class="flex flex-col pb-5 -mx-5 lg:flex-row">
                <div class="flex items-center justify-center flex-1 px-5 lg:justify-start">
                    <div class="relative flex-none w-20 h-20 image-fit sm:h-24 sm:w-24 lg:h-32 lg:w-32">
                        <img
                            class="rounded-full"
                            src="{{ ($kta->foto) ?  '/get-image?image='.$kta->foto : 'https://ui-avatars.com/api/?name='. $kta->full_name }}"
                            alt="Foto - {{ $kta->full_name }}"
                        />
                    </div>
                    <div class="ml-5">
                        <div class="text-lg font-medium sm:whitespace-normal">
                            {{ $kta->full_name }}
                        </div>
                        <span class="px-2 py-1 rounded
                            {{ $kta->istri_suami == 'Suami' ? 'bg-info/20 text-info' : ($kta->istri_suami == 'Istri' ? 'bg-success/20 text-success' : 'bg-warning/20 text-warning') }}">
                            {{ ($kta->istri_suami == 'Suami') ? 'PEREMPUAN' : 'LAKI-LAKI' }}
                        </span>
                    </div>
                </div>
                <div class="flex-1 px-5 pt-5 mt-6 border-t border-l border-r border-slate-200/60 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                    <div class="font-medium text-center lg:mt-3 lg:text-left">
                        Informasi Personal
                    </div>
                    <div class="flex flex-col items-center justify-center mt-4 lg:items-start">
                        <table>
                            <tbody>
                            <tr>
                                <td>Nomor KTA</td>
                                <td class="px-2">:</td>
                                <td class="font-medium text-success"> {{ $kta->no_kta }}</td>
                            </tr>
                            <tr>
                                <td class="pt-2">Tempat, Tanggal Lahir</td>
                                <td class="px-2 pt-2 font-medium">:</td>
                                <td class="pt-2 font-medium text-pending"> {{ $kta->ttl }}</td>
                            </tr>
                            <tr>
                                <td class="pt-2">Agama</td>
                                <td class="px-2 pt-2 font-medium">:</td>
                                <td class="pt-2 font-medium text-danger"> {{ $kta->agama }}</td>
                            </tr>
                            <tr>
                                <td class="pt-2">Golongan Darah</td>
                                <td class="px-2 pt-2 font-medium">:</td>
                                <td class="pt-2 font-medium text-primary"> {{ $kta->gol_darah }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-base.tab.group>

</div>

<div class="col-span-12">
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Informasi Diri -->
        <div class="col-span-12 intro-y box lg:col-span-6">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="mr-auto text-base font-medium">
                    Informasi Diri
                </h2>
            </div>
            <div class="p-5">

                <div class="flex items-center pb-3 border-b border-slate-200 dark:border-darkmode-400">
                    <div>
                        <div class="text-slate-500">Nomor Induk Kependudukan (NIK)</div>
                        <div class="mt-1 font-medium text-md">{{ $kta->nik }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-3">
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex items-center pb-3 border-b border-slate-200 dark:border-darkmode-400">
                            <div class="mt-3">
                                <div class="text-slate-500">Pangkat Terakhir</div>
                                <div class="mt-1 font-medium text-md">{{ $kta->pangkat_terakhir }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex items-center pb-3 border-b border-slate-200 dark:border-darkmode-400">
                            <div class="mt-3">
                                <div class="text-slate-500">Tanda Jasa Tertinggi</div>
                                <div class="mt-1 font-medium text-md">{{ $kta->tanda_jasa_tertinggi }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Informasi Detail -->

        <!-- BEGIN: Deskripsi Proyek -->
        <div class="col-span-12 intro-y box lg:col-span-6">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="mr-auto text-base font-medium">
                    Informasi Lainnya
                </h2>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-12 gap-3">
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex items-center pb-3 border-b border-slate-200 dark:border-darkmode-400">
                            <div>
                                <div class="text-slate-500">Nama {{ $kta->istri_suami }}</div>
                                <div class="mt-1 font-medium text-md">{{ $kta->nama_istri_suami }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex items-center pb-3 border-b border-slate-200 dark:border-darkmode-400">
                            <div>
                                <div class="text-slate-500">Nomor Induk Kependudukan (NIK) {{ $kta->istri_suami }}</div>
                                <div class="mt-1 font-medium text-md">{{ $kta->nik_istri_suami }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-3">
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex items-center pb-3 border-b border-slate-200 dark:border-darkmode-400">
                            <div class="mt-3">
                                <div class="text-slate-500">Alamat</div>
                                <div class="mt-1 font-medium text-md">{{ $kta->alamat1 }} {{ $kta->alamat2 }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex items-center pb-3 border-b border-slate-200 dark:border-darkmode-400">
                            <div class="mt-3">
                                <div class="text-slate-500">Wilayah / Rayon</div>
                                <div class="mt-1 font-medium text-md">{{ $kta->wil_rayon }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Deskripsi Proyek -->
    </div>
</div>
