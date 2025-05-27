<?php

namespace Modules\Report\Filament\Pages;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class Report extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'report::filament.pages.report';

    public $report_type;
    public $start_date;
    public $end_date;

    public function mount(): void
    {
        $this->form->fill([
            'report_type' => 'loan',
            'start_date' => now()->startOfMonth(),
            'end_date' => now()->endOfMonth(),
        ]);
    }

    public function getTitle(): string
    {
        return __('report::module.title');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('report::module.navigation_group');
    }

    public static function getNavigationLabel(): string
    {
        return __('report::module.navigation_label');
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('')
                ->columns(2)
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('report_type')
                                ->label(__('report::module.report_type.label'))
                                ->options([
                                    'member' => __('report::module.report_type.option.member'),
                                    'book' => __('report::module.report_type.option.book'),
                                    'loan' => __('report::module.report_type.option.loan'),
                                ])
                                ->searchable()
                                ->required(),
                        ]),
                    Grid::make(2)
                        ->schema([
                            DatePicker::make('start_date')
                                ->label(__('report::module.start_date'))
                                ->native(false)
                                ->required(),
                            DatePicker::make('end_date')
                                ->label(__('report::module.end_date'))
                                ->native(false)
                                ->required(),
                        ]),
                    Actions::make([
                        Actions\Action::make('generatePrint')
                            ->label(__('report::module.button.print'))
                            ->button()
                            ->action(function () {
                                $url = route('report.print', [
                                    'type' => $this->report_type,
                                    'start' => $this->start_date,
                                    'end' => $this->end_date,
                                ]);

                                $this->js(<<<JS
                                    window.open("{$url}", "_blank");
                                JS);
                            }),
                    ]),
                ]),
        ];
    }
}
