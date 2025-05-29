<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Book\Filament\Resources\BookResource;
use Modules\Book\Models\Book;
use Modules\Loan\Filament\Resources\LoanResource;
use Modules\Loan\Models\Loan;
use Modules\Member\Filament\Resources\MemberResource;
use Modules\Member\Models\Member;

class StatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Buku', Book::count())
                ->label(__('dashboard.stats.books'))
                ->description(__('dashboard.stats.link'))
                ->url(BookResource::getUrl())
                ->icon('heroicon-o-book-open'),
            Stat::make('Anggota', Member::count())
                ->label(__('dashboard.stats.members'))
                ->description(__('dashboard.stats.link'))
                ->url(MemberResource::getUrl())
                ->icon('heroicon-o-users'),
            Stat::make('Pinjaman', Loan::count())
                ->label(__('dashboard.stats.loans'))
                ->description(__('dashboard.stats.link'))
                ->url(LoanResource::getUrl())
                ->icon('heroicon-o-clipboard-document-list'),
        ];
    }
}