<?php

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

test('it renders create form', function () {
    Livewire::test(\App\Livewire\DataSetForm::class)
        ->assertStatus(200);
    $this->get(route('data-sets.create'))
        ->assertSeeLivewire(\App\Livewire\DataSetForm::class)
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
    $dataSet = \App\Models\DataSet::factory()->make();
    expect(DataSet::count('id'))->toBe(0); // make() doesn't save anything!
    expect($dataSet->validate())->toBe(true);
    $formData = $dataSet->only(['name','status', 'label', 'begin_at', 'interval', 'mya_deployment']);
    $formData['config_id'] = $config->id;

    // Post the form
    /** @var TestResponse $response */
    $response = asAuthenticatedUser()->post(route('data-sets.store'), $formData);

    // Check the database and get the newly created data set id
    expect(DataSet::count('id'))->toBe(1);   // created via form submission
    $newId = DataSet::first('id');

    // Check the resulting redirect
    expect($response->getStatusCode())->toBe(302);   // redirected to new data_set page
    expect($response->headers->get('Location'))->toBe(route('data-sets.show',[$newId]));
});

test('it validates submitted data set')->todo();
