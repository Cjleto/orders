<?php

use App\Models\Dish;
use App\Models\Company;
use App\Rules\DishName;
use App\Models\Category;
use App\Models\MacroCategory;
use App\Rules\DishDescription;


it('can create a dish', function () {
    $dish = Dish::factory()->create();
    expect($dish->id)->toBeInt();
    expect($dish->name)->toBeString();
    expect($dish->description)->toBeString();
    expect($dish->price)->toBeFloat();
    expect($dish->category_id)->toBeInt();
    expect($dish->created_at)->toBeObject();
    expect($dish->updated_at)->toBeObject();
});

it('can create a dish without description', function () {
    $dish = Dish::factory()->create(['description' => null]);
    $translated = $dish->getTranslatedValue('description', 'en');
    expect($dish->description)->toBeEmpty();

});

it('can create dishes with same name based on configuration', function () {

    // sovrascrivi il valore di config('myconst.enable_same_dish_name');
    config(['myconst.enable_same_dish_name' => true]);

    $data = createCompanyWithCategory();

    $category = $data['category'];

    $dish = Dish::factory()->create([
        'name' => 'Pasta al pomodoro',
        'category_id' => $category->id
    ]);

    $rule = new DishName($category, $dish);

    // scenario 1: stesso nome, stessa categoria
    $data = [
        'name' => 'Pasta al pomodoro',
    ];
    $validator = Validator::make($data, [
        'name' => $rule
    ]);
    expect($validator->passes())->toBeTrue();


    // scenario 2: nome diverso, stessa categoria
    $data = [
        'name' => 'Pasta al pesto',
    ];
    $validator = Validator::make($data, [
        'name' => $rule
    ]);
    expect($validator->passes())->toBeTrue();

});

it('can\'t create dishes with same name based on configuration', function () {

    // sovrascrivi il valore di config('myconst.enable_same_dish_name');
    config(['myconst.enable_same_dish_name' => false]);

    $data = createCompanyWithCategory();

    $category = $data['category'];
    $dish = Dish::factory()->create([
        'name' => 'Pasta al pomodoro',
        'category_id' => $category->id
    ]);

    $rule = new DishName($category, $dish);

    // scenario 1: stesso nome, stessa categoria
    $data = [
        'name' => 'Pasta al pomodoro',
    ];
    $validator = Validator::make($data, [
        'name' => $rule
    ]);
    expect($validator->passes())->toBeTrue();


    // scenario 2: nome diverso, stessa categoria
    $data = [
        'name' => 'Pasta al pesto',
    ];
    $validator = Validator::make($data, [
        'name' => $rule
    ]);
    expect($validator->passes())->toBeTrue();
});


it('can\'t set dish description empty when flag dish_description_can_be_empty is false', function () {
    config(['myconst.dish_description_can_be_empty' => false]);
    $rule = new DishDescription();
    $validator = $this->app['validator']->make(['description' => null], ['description' => $rule]);
    $this->assertFalse($validator->passes());
    $this->assertArrayHasKey('description', $validator->errors()->getMessages());
    $this->assertContains(__('The description is required.'), $validator->errors()->get('description'));
});

it('can set dish description empty when flag dish_description_can_be_empty is true', function () {
    config(['myconst.dish_description_can_be_empty' => true]);
    $rule = new DishDescription();
    $validator = $this->app['validator']->make(['description' => null], ['description' => $rule]);
    $this->assertTrue($validator->passes());
});

it('can set dish description empty when flag dish_description_can_be_empty is true and value is not null', function () {
    config(['myconst.dish_description_can_be_empty' => true]);
    $rule = new DishDescription();
    $validator = $this->app['validator']->make(['description' => ''], ['description' => $rule]);
    $this->assertTrue($validator->passes());
});

it('can\'t set dish description lenght to one', function () {
    config(['myconst.dish_description_can_be_empty' => true]);
    $rule = new DishDescription();
    $validator = $this->app['validator']->make(['description' => '5'], ['description' => $rule]);
    $this->assertFalse($validator->passes());
    $this->assertArrayHasKey('description', $validator->errors()->getMessages());
    $this->assertContains(__('The description must be between 2 and '.config('myconst.dish_max_length_description').' characters.'), $validator->errors()->get('description'));
});

it('can\'t set dish description longer than config params', function () {
    config(['myconst.dish_description_can_be_empty' => true]);
    $maxLenght = config('myconst.dish_max_length_description');
    $rule = new DishDescription();
    $validator = $this->app['validator']->make(['description' => str_repeat('a', $maxLenght+10)], ['description' => $rule]);
    $this->assertFalse($validator->passes());
    $this->assertArrayHasKey('description', $validator->errors()->getMessages());
    $this->assertContains(__('The description must be between ' . config('myconst.dish_min_length_description') . ' and '.config('myconst.dish_max_length_description').' characters.'), $validator->errors()->get('description'));
});
