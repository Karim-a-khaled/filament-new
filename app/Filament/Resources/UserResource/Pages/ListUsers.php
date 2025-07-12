<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'Verified' => Tab::make()->modifyQueryUsing(function (Builder $query) {
                $query->whereNotNull('email_verified_at');
            }),
            'Unverified' => Tab::make()->modifyQueryUsing(function (Builder $query) {
                $query->whereNull('email_verified_at');
            }),
        ];
    }
}
