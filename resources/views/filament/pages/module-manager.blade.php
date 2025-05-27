<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-3 gap-4">
        @foreach($this->getModules() as $module)
            <x-filament::card>
                <div>
                    <div class="text-lg font-semibold">
                        {{ __('module_manager.modules.' . $module->getLowerName() . '.title') }}
                    </div>
                    <div class="text-sm text-gray-500">Status:
                        <span class="{{ $module->isEnabled() ? 'text-green-600' : 'text-red-600' }}">
                            {{ $module->isEnabled() ? __('module_manager.modules.' . $module->getLowerName() . '.status.enabled') : __('module_manager.modules.' . $module->getLowerName() . '.status.disabled') }}
                        </span>
                    </div>
                </div>

                <div class="my-2">
                    <div>{{ __($module->getDescription()) }}</div>
                </div>

                <div class="flex items-center justify-end mt-3">
                    @if ($module->isEnabled() && $module->get('setting_route'))
                        <x-filament::icon-button icon="heroicon-m-cog-6-tooth" color="gray" label="fines-settings"
                            style="zoom: 150%; margin-right: 1px;" :disabled="!$module->isEnabled()" tag="a"
                            :href="route($module->get('setting_route'))" />
                    @endif

                    <x-filament::button wire:click="toggleModule('{{ $module->getName() }}')"
                        :disabled="$processingModule === $module->getName()"
                        color="{{ $module->isEnabled() ? 'danger' : 'success' }}">
                        @if ($processingModule === $module->getName())
                            <x-heroicon-o-arrow-path class="w-4 h-4 animate-spin" />
                        @else
                            {{ !$module->isEnabled() ? __('module_manager.modules.' . $module->getLowerName() . '.actions.enable') : __('module_manager.modules.' . $module->getLowerName() . '.actions.disable') }}
                        @endif
                    </x-filament::button>

                </div>
            </x-filament::card>
        @endforeach
    </div>
</x-filament-panels::page>