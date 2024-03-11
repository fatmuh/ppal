<x-base.dialog id="form-kta-modal" size="xl" staticBackdrop>
    <x-base.dialog.panel>
        <x-base.dialog.title>
            <h2 id="kta-detail-name" class="mr-auto text-base font-medium">
                Form KTA
            </h2>
        </x-base.dialog.title>
        <form action="" id="form-kta" method="POST" enctype="multipart/form-data" class="block">
            @csrf
            @method('POST')
            <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                
                <div class="col-span-12 md:col-span-6" id="kta-column">
                    <x-base.form-label>No. KTA</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="no_kta"
                            type="text"
                            placeholder="XIV-004-7-0002"
                            name="no_kta"
                            value="{{ old('no_kta') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="name-column">
                    <x-base.form-label>Nama Lengkap</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="full_name"
                            type="text"
                            placeholder="Masukkan Nama Lengkap"
                            name="full_name"
                            value="{{ old('full_name') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="ttl-column">
                    <x-base.form-label>Tempat, Tanggal Lahir</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="ttl"
                            type="text"
                            placeholder="Masukkan Tempat, Tanggal Lahir"
                            name="ttl"
                            value="{{ old('ttl') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="agama-column">
                    <x-base.form-label>Agama</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.tom-select
                            id="agama"
                            name="agama"
                            class="tom-select w-full"
                            data-placeholder="Pilih Agama"
                        >
                            <option></option>
                            <option value="ISLAM">ISLAM</option>
                            <option value="KRISTEN">KRISTEN</option>
                            <option value="KATHOLIK">KATHOLIK</option>
                            <option value="BUDHA">BUDHA</option>
                            <option value="HINDU">HINDU</option>
                            <option value="KONGHUCU">KONGHUCU</option>
                            <option value="OTHER">OTHER</option>
                        </x-base.tom-select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="goldar-column">
                    <x-base.form-label>Golongan Darah</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.tom-select
                            id="gol_darah"
                            name="gol_darah"
                            class="tom-select w-full"
                            data-placeholder="Pilih Golongan Darah"
                        >
                            <option></option>
                            <option value="A">A</option>
                            <option value="A+">A+</option>
                            <option value="B">B</option>
                            <option value="B+">B+</option>
                            <option value="AB">AB</option>
                            <option value="AB+">AB+</option>
                            <option value="O">O</option>
                        </x-base.tom-select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="pangkat-column">
                    <x-base.form-label>Pangkat Terakhir</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="pangkat_terakhir"
                            type="text"
                            placeholder="Masukkan Pangkat Terakhir"
                            name="pangkat_terakhir"
                            value="{{ old('pangkat_terakhir') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="nik-column">
                    <x-base.form-label>Nomor Induk Kependudukan (NIK)</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="nik"
                            type="text"
                            placeholder="Masukkan Nomor Induk Kependudukan (NIK)"
                            name="nik"
                            value="{{ old('nik') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="tanda-jasa-column">
                    <x-base.form-label>Tanda Jasa Teringgi</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="tanda_jasa_tertinggi"
                            type="text"
                            placeholder="Masukkan Tanda Jasa Teringgi"
                            name="tanda_jasa_tertinggi"
                            value="{{ old('tanda_jasa_tertinggi') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12" id="tanggal-cetak-column">
                    <x-base.form-label>Tanggal Cetak</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="tanggal_cetak"
                            type="text"
                            placeholder="Masukkan Tanggal Cetak"
                            name="tanggal_cetak"
                            value="{{ date('d M Y'); }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="foto-column">
                    <x-base.form-label>Foto 2x3</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            class="w-full border border-gray-300 rounded file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-violet-50 hover:file:bg-violet-100 form-upload"
                            id="foto"
                            type="file"
                            name="foto"
                            data-imagepreview="true"
                            accept="image/*"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="ttd-column">
                    <x-base.form-label>Tanda Tangan</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            class="w-full border border-gray-300 rounded file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-violet-50 hover:file:bg-violet-100 form-upload"
                            id="ttd"
                            type="file"
                            name="ttd"
                            data-imagepreview="true"
                            accept="image/*"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="istri-suami-column">
                    <x-base.form-label>Istri / Suami</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.tom-select
                            id="istri_suami"
                            name="istri_suami"
                            class="tom-select w-full"
                            data-placeholder="Pilih Golongan Darah"
                        >
                            <option></option>
                            <option value="Istri">Istri</option>
                            <option value="Suami">Suami</option>
                        </x-base.tom-select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="nama-istri-suami-column">
                    <x-base.form-label>Nama Istri / Suami</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="nama_istri_suami"
                            type="text"
                            placeholder="Masukkan Nama Istri / Suami"
                            name="nama_istri_suami"
                            value="{{ old('nama_istri_suami') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="nik-istri-suami-column">
                    <x-base.form-label>NIK Istri / Suami</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="nik_istri_suami"
                            type="text"
                            placeholder="Masukkan NIK Istri / Suami"
                            name="nik_istri_suami"
                            value="{{ old('nik_istri_suami') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="wil-rayon-column">
                    <x-base.form-label>Wilayah / Rayon</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="wil_rayon"
                            type="text"
                            placeholder="Masukkan Wilayah / Rayon"
                            name="wil_rayon"
                            value="{{ old('wil_rayon') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="alamat-satu-column">
                    <x-base.form-label>Alamat 1</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="alamat1"
                            type="text"
                            placeholder="Masukkan Alamat 1"
                            name="alamat1"
                            value="{{ old('alamat1') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="alamat-dua-column">
                    <x-base.form-label>Alamat 2</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="alamat2"
                            type="text"
                            placeholder="Masukkan Alamat 2"
                            name="alamat2"
                            value="{{ old('alamat2') }}"
                        />
                    </div>
                </div>
            </x-base.dialog.description>
            <x-base.dialog.footer>
                <x-base.button
                    class="mr-2"
                    data-tw-dismiss="modal"
                    variant="outline-secondary"
                    type="button"
                >
                    <x-base.lucide
                        class="w-4 h-4 mr-2"
                        icon="X"
                    />
                    Tutup
                </x-base.button>
                <x-base.button
                    class="mr-2"
                    variant="primary"
                    type="submit"
                >
                    <x-base.lucide
                        class="w-4 h-4 mr-2"
                        icon="Save"
                    />
                    Simpan
                </x-base.button>
            </x-base.dialog.footer>
        </form>
    </x-base.dialog.panel>
</x-base.dialog>
