<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    Modules\Core\Providers\CoreServiceProvider::class,
    Modules\Book\Providers\BookServiceProvider::class,
    Modules\Member\Providers\MemberServiceProvider::class,
    Modules\Loan\Providers\LoanServiceProvider::class,
    Modules\LoanReturn\Providers\LoanReturnServiceProvider::class,
    Modules\Fines\Providers\FinesServiceProvider::class,
];
