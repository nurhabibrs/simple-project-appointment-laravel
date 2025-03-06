<?php

namespace App\Filament\Resources;

use App\Enums\AppointmentEnum;
use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Spatie\LaravelOptions\Options;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
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
                        Forms\Components\TextInput::make('first_name')
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
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->default(\Auth::user()->email)
                            ->required(),
                        PhoneInput::make('phone')
                            ->label('No Ponsel')
                            ->initialCountry('id')
                            ->displayNumberFormat(PhoneInputNumberType::E164)
                            ->required(),
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\Select::make('appoint_for')
                            ->label('Janji Temu Untuk')
                            ->options(\filamentOption(Options::forEnum(AppointmentEnum::class)))
                            ->required(),
                        Forms\Components\DateTimePicker::make('appointment_date')
                            ->label('Tanggal dan Jam Janji Temu')
                            ->minDate(now()->startOfDay())
                            ->required(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_date')
                    ->label('Tanggal Janji Temu')
                    ->dateTime('d M Y H:i:s'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Dibuat oleh')
                    ->visible(fn () => \Auth::user()->role == 'Admin'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($record) => $record->status == 'pending' ? 'warning' : 'success')
                    ->formatStateUsing(fn ($record) => $record->status == 'pending' ? 'Menunggu Persetujuan' : 'Disetujui'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('approve')
                        ->label('Approve')
                        ->visible(fn ($record) => \Auth::user()->role == 'Admin' && $record->status == 'pending')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Apakah anda yakin ingin menyetujui janji temu ini?')
                        ->modalDescription('')
                        ->action(function ($record) {
                           \DB::beginTransaction();
                           try {
                               $record->update([
                                   'status' =>  'approved',
                               ]);

                               \DB::commit();
                           } catch (\Throwable $e) {
                               \DB::rollBack();

                               Notification::make()
                                   ->danger()
                                   ->body('Terjadi kegagalan dalam approve');
                           }
                        }),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->visible(fn ($record) => $record->created_by == \Auth::user()->id && $record->status == 'pending'),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
        return \Auth::user()->role == 'Admin' ? $query : $query->where('created_by', \Auth::user()->id);
    }
}
