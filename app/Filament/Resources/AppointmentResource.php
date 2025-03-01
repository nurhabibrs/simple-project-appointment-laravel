<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Ysfkaya\FilamentPhoneInput\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    protected static ?string $navigationLabel = 'Janji Temu';

    protected static ?string $label = 'Janji Temu';

    protected static ?string $breadcrumb = 'Janji Temu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make()
                    ->schema([
                        Forms\Components\TextInput::make('firt_name')
                            ->label('Nama Depan')
                            ->required(),
                        Forms\Components\TextInput::make('last_name')
                            ->label('Nama Belakang')
                            ->required(),
                        Forms\Components\TextInput::make('birth_place')
                            ->label('Tempat Lahir')
                            ->required(),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Tanggal Lahir')
                            ->minDate(now()->subYears(100))
                            ->maxDate(now())
                            ->required()
                            ->displayFormat('d M Y'),
                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([1 => 'Pria', 0 => 'Wanita'])
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label('Alamat')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->default(\Auth::user()->email)
                            ->required(),
                        \Ysfkaya\FilamentPhoneInput\Forms\PhoneInput::make('phone')
                            ->label('No Ponsel')
                            ->initialCountry('id')
                            ->displayNumberFormat(PhoneInputNumberType::E164)
                            ->required(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'view' => Pages\ViewAppointment::route('/{record}'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
