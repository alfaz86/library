<x-filament-panels::page>
    <form wire:submit.prevent="save" class="space-y-4">
        {{ $this->form }}

        <x-filament::button type="submit" style="margin-top: 25px;">
            {{ __('filament-panels::resources/pages/edit-record.form.actions.save.label') }}
        </x-filament::button>
    </form>
</x-filament-panels::page>