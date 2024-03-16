<x-base.dialog id="kta-detail-modal" size="xxl">
    <x-base.dialog.panel>
        <x-base.dialog.title>
            <h2 id="detail-kta-header-title" class="mr-auto text-base font-medium"></h2>
        </x-base.dialog.title>
        <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3 modal-body">

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
        </x-base.dialog.footer>
    </x-base.dialog.panel>
</x-base.dialog>
