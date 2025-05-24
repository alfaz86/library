<style>
    .fi-sidebar {
        background-color: white;
    }
</style>
@if (request()->route()->getName() === 'filament.admin.pages.logs')
    <style>
        .bg-danger {
            background-color: rgb(185 28 28);
            zoom: 85%;
        }

        .bg-warning {
            background-color: rgb(251 191 36);
            zoom: 85%;
        }

        .bg-info {
            background-color: rgb(34 211 238);
            zoom: 85%;
        }

        .flex.items-center.justify-between>.w-full.mr-2 {
            margin-right: 0.5rem;
        }

        .flex.items-center.justify-between>.w-auto.ml-2 {
            margin-left: 0.5rem;
        }

        .flex.items-center.justify-between>.w-auto.ml-2 {
            margin-left: 0.5rem;
        }
    </style>
@endif