<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set the password to empty string so it can't be used to sign in.
        $data = parent::mutateFormDataBeforeCreate($data);
        $data['password'] = '';

        return $data;
    }
}
