<?php

use App\Livewire\DataSetForm;
use App\Models\User;
use \App\Models\DataSet;
use Livewire\Livewire;
use Illuminate\Testing\TestResponse;
use App\Models\Config as DataSetConfig;
use Tests\TestCase;



beforeEach(function () {
    // Some code...
});

afterEach(function () {
    // Some code...
});


test('it redirects home page to data-sets', function () {
    /** @var TestResponse $response */
    $response = $this->get('/');
    expect($response->getStatusCode())->toBe(302);
    expect($response->headers->get('Location'))->toBe(route('data-sets.index'));
});

test('it requires auth to retrieve create form', function () {
    $this->get(route('data-sets.create'))
        ->assertForbidden();
});

test('it renders create form', function () {
    Livewire::actingAs(User::factory()->create());
    Livewire::test(DataSetForm::class)
        ->assertStatus(200);
    $this->get(route('data-sets.create'))
        ->assertSeeLivewire(DataSetForm::class)
        ->assertSee('name')
        ->assertSee('status')
        ->assertSee('begin_at')
        ->assertSee('end_at')
        ->assertSee('mya_deployment')
        ->assertSee('interval')
        ->assertSee('comments');
});

test('it stores a new data set', function () {
    //prepare form data
    $config = DataSetConfig::factory()->create();
    $dataSet = DataSet::factory()->make();

    Livewire::actingAs(User::factory()->create());
    $response = Livewire::test(DataSetForm::class)
        ->set($dataSet->only(['name','status', 'label', 'begin_at', 'interval', 'mya_deployment']))
        ->set('config_id', $config->id)
        ->call('save')
        ->assertStatus(200);

    // Check the database and get the newly created data set id
    expect(DataSet::count('id'))->toBe(1);   // created via form submission
    $newId = DataSet::first('id');

    // Check the resulting redirect
   $response->assertRedirect(route('data-sets.show',[$newId]));
});


test('it requires name field', function () {
    // Use factory to get some valid sample data
    $config = DataSetConfig::factory()->create();
    $dataSet = DataSet::factory()->make();    // make() doesn't save anything to DB!
    $response = Livewire::test(DataSetForm::class)
        ->set($dataSet->only(['status', 'label', 'begin_at', 'interval', 'mya_deployment']))
        ->set('config_id', $config->id)
        ->call('save');
    $response->assertHasErrors(['name' => 'required']);
});

test('it requires begin_at field', function () {
    // Use factory to get some valid sample data
    $config = DataSetConfig::factory()->create();
    $dataSet = DataSet::factory()->make();    // make() doesn't save anything to DB!
    $response = Livewire::test(DataSetForm::class)
        ->set($dataSet->only(['name', 'status', 'label', 'interval', 'mya_deployment']))
        ->set('config_id', $config->id)
        ->call('save');
    $response->assertHasErrors(['begin_at' => 'required']);
});

test('it requires config_id field', function () {
    // Use factory to get some valid sample data
    $dataSet = DataSet::factory()->make();    // make() doesn't save anything to DB!
    $response = Livewire::test(DataSetForm::class)
        ->set($dataSet->only(['name', 'status', 'label', 'interval', 'begin_at']))
        ->set('config_id', null)
        ->call('save');
    $response->assertHasErrors(['config_id' => 'required']);
});
