<?php
use App\Models\Config as DataSetConfig;
use App\Models\User;

test('it renders create form', function () {
    $this->get(route('configs.create'))
        ->assertSeeLivewire(\App\Livewire\ConfigForm::class)
        ->assertSee('name')
        ->assertSee('yaml')
        ->assertSee('comments');
});

test ('it requires authorization to create', function () {

    // Use factory to get some valid sample data
    $config = DataSetConfig::factory()->make();
    // We haven't declared a user via actingAs here
    $response = Livewire::test(\App\Livewire\ConfigForm::class)
        ->set('name', $config->name)
        ->set('yaml', $config->yaml)
        ->set('comments', $config->comments)
        ->call('save')
        ->assertForbidden();

});

test('it stores a new config', function () {
    Livewire::actingAs(User::factory()->create());

    // Use factory to get some valid sample data
    $config = DataSetConfig::factory()->make();    // make() doesn't save anything to DB!
    $response = Livewire::test(\App\Livewire\ConfigForm::class)
        ->set('name', $config->name)
        ->set('yaml', $config->yaml)
        ->set('comments', $config->comments)
        ->call('save')
        ->assertRedirect(route('configs.index'));

    // Check database for our new creation
    $this->assertTrue(DataSetConfig::whereName($config->name)->exists());
});

test('it requires name field', function () {
    // Use factory to get some valid sample data
    $config = DataSetConfig::factory()->make();    // make() doesn't save anything to DB!
    $response = Livewire::test(\App\Livewire\ConfigForm::class)
        ->set('name', null)
        ->set('yaml', $config->yaml)
        ->set('comments', $config->comments)
        ->call('save');
    $response->assertHasErrors(['name' => 'required']);
});

test('it requires yaml field', function () {
    // Use factory to get some valid sample data
    $config = DataSetConfig::factory()->make();    // make() doesn't save anything to DB!
    $response = Livewire::test(\App\Livewire\ConfigForm::class)
        ->set('name', $config->name)
        ->set('yaml', null)
        ->set('comments', $config->comments)
        ->call('save');
    $response->assertHasErrors(['yaml' => 'required']);
});

test('it syntax checks yaml field', function () {
    // Use factory to get some valid sample data
    $config = DataSetConfig::factory()->make();    // make() doesn't save anything to DB!
    $response = Livewire::test(\App\Livewire\ConfigForm::class)
        ->set('name', $config->name)
        ->set('yaml', 'text that is not yaml')
        ->set('comments', $config->comments)
        ->call('save');
    $response->assertHasErrors(['yaml']);
});

test ('it requires authorization to update', function () {

    // Use factory to get some valid sample data
    $config = DataSetConfig::factory()->create();
    // We haven't declared a user via actingAs here
    $response = Livewire::test(\App\Livewire\ConfigForm::class)
        ->set('config_id', $config->id)
        ->set('name', $config->name . '_modified')
        ->set('yaml', $config->yaml)
        ->set('comments', $config->comments)
        ->call('save')
        ->assertForbidden();

});

test('it updates an existing config', function () {
    Livewire::actingAs(User::factory()->create());

    // Use factory to get some valid sample data
    $config = DataSetConfig::factory()->create();    // make() doesn't save anything to DB!
    $response = Livewire::test(\App\Livewire\ConfigForm::class)
        ->set('config_id', $config->id)
        ->set('name', $config->name . '_modified')
        ->set('yaml', $config->yaml)
        ->set('comments', $config->comments)
        ->call('save')
        ->assertRedirect(route('configs.index'));

    // Check database for our new creation
    $this->assertTrue(DataSetConfig::whereName($config->name . '_modified')->exists());
});
