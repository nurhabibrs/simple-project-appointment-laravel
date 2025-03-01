<?php

it('can render appointment page', function () {
    $this->get(\App\Filament\Resources\AppointmentResource::getUrl('index'))->assertSuccessful();
});

it('can create appointment', function () {
    $data = \App\Models\Appointment::factory()->definition();

    Livewire::test(\App\Filament\Resources\AppointmentResource\Pages\CreateAppointment::class)
        ->fillForm($data)
        ->call('create')
        ->assertHasNoFormErrors()
        ->assertSuccessful();

    $this->assertDatabaseHas('appointments', [
        'first_name' => $data['first_name'],
        'email' => $data['email'],
    ]);
});
