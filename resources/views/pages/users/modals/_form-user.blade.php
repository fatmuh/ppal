<x-base.dialog id="form-users-modal" size="md" staticBackdrop>
    <x-base.dialog.panel>
        <x-base.dialog.title>
            <h2 id="users-detail-name" class="mr-auto text-base font-medium">
                Form Admin
            </h2>
        </x-base.dialog.title>
        <form action="" id="form-users" method="POST" enctype="multipart/form-data" class="block">
            @csrf
            @method('POST')
            <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">

                <div class="col-span-12" id="name-column">
                    <x-base.form-label>Nama</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="name"
                            type="text"
                            placeholder="Masukkan Nama"
                            name="name"
                            value="{{ old('no_kta') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="email-column">
                    <x-base.form-label>Email</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="email"
                            type="text"
                            placeholder="Masukkan Email"
                            name="email"
                            value="{{ old('email') }}"
                        />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6" id="password-column">
                    <x-base.form-label>Password</x-base.form-label>
                    <code class="ml-1 text-danger">*</code>
                    <div>
                        <x-base.form-input
                            id="password"
                            type="password"
                            placeholder="Masukkan Password"
                            name="password"
                            value="{{ old('password') }}"
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
