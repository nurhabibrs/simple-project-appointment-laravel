<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAppointment extends ViewRecord
{
    protected static string $resource = AppointmentResource::class;

    protected static ?string $breadcrumb = 'Lihat';

    protected static ?string $title = 'Lihat Janji Temu';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->visible(fn ($record) => $record->created_by == \Auth::user()->id && $record->status == 'pending'),
        ];
    }
}
