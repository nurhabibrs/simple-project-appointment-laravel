<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAppointment extends CreateRecord
{
    protected static ?string $breadcrumb = 'Buat';

    protected static ?string $title = 'Buat Janji Temu';
    protected static string $resource = AppointmentResource::class;

    protected static bool $canCreateAnother = false;
}
