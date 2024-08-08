<?php

namespace App\Filament\Resources\ImageCollectionResource\Pages;

use App\Filament\Resources\ImageCollectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImageCollection extends EditRecord
{
    protected static string $resource = ImageCollectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
