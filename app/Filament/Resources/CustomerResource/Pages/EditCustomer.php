<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Pages\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CustomerResource;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $recipient = auth()->user();

        Notification::make()
            ->title('Saved successfully')
            ->sendToDatabase($recipient)
        ;
    }
}
