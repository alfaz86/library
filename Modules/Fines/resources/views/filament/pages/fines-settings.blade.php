<x-filament-panels::page>
    <form wire:submit.prevent="save" class="space-y-4">
        {{ $this->form }}

        <x-filament::button type="submit" style="margin-top: 25px; margin-right: 8px;">
            {{ __('filament-panels::resources/pages/edit-record.form.actions.save.label') }}
        </x-filament::button>

        <x-filament::button
            color="gray"
            href="{{ url()->previous() === url()->current() ? route('filament.admin.pages.module-manager') : url()->previous() }}"
            tag="a"
            style="margin-top: 25px;"
        >
            {{ __('filament-panels::resources/pages/edit-record.form.actions.cancel.label') }}
        </x-filament::button>
    </form>
</x-filament-panels::page>