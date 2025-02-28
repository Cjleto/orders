<?php

use App\Models\Dish;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MacroCategory;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('deletes related categories when a macro is deleted', function(){


    // 1. Creare una macro categoria
    $macroCategory = MacroCategory::factory()->create();

    // 2. Creare categorie associate
    $category1 = Category::factory()->create(['macro_category_id' => $macroCategory->id]);
    $category2 = Category::factory()->create(['macro_category_id' => $macroCategory->id]);

    // 3. Controllare che le categorie esistano
    expect(Category::count())->toBe(2);

    // 4. Eliminare la macro categoria
    $macroCategory->delete();

    // 5. Verificare che le categorie siano state eliminate
    expect(Category::count())->toBe(0);
});


it('deletes related subcategories when a category is deleted', function () {

    // 1. Creare una categoria
    $category = Category::factory()->create();

    // 2. Creare subcategorie associate
    $subCategory1 = SubCategory::factory()->create(['category_id' => $category->id]);
    $subCategory2 = SubCategory::factory()->create(['category_id' => $category->id]);

    // 3. Controllare che le subcategorie esistano
    expect(SubCategory::count())->toBe(2);

    // 4. Eliminare la categoria
    $category->delete();

    // 5. Verificare che le subcategorie siano state eliminate
    expect(SubCategory::count())->toBe(0);
});


it('deletes related dishes when a subcategory is deleted', function () {


    $category = Category::factory()->create();

    // 1. Creare una subcategoria
    $subCategory = SubCategory::factory()->recycle($category)->create();

    // 2. Creare piatti associati
    $dish1 = Dish::factory()->create([
        'category_id' => $category->id,
        'sub_category_id' => $subCategory->id
    ]);
    $dish2 = Dish::factory()->create([
        'category_id' => $category->id,
        'sub_category_id' => $subCategory->id
    ]);

    // 3. Controllare che i piatti esistano
    expect(Dish::count())->toBe(2);

    // 4. Eliminare la subcategoria
    $subCategory->delete();

    // 5. Verificare che i piatti siano stati eliminati
    expect(Dish::count())->toBe(2);

    // 6. Verificare che i piatti non abbiano sub categroies
    expect(Dish::where('sub_category_id', $subCategory->id)->count())->toBe(0);

    expect(Dish::where('category_id', $category->id)->count())->toBe(2);
});

it('deletes related dishes when a category is deleted', function () {

    // 1. Creare una categoria
    $category = Category::factory()->create();

    // 2. Creare subcategorie associate
    $subCategory1 = SubCategory::factory()->recycle($category)->create();
    $subCategory2 = SubCategory::factory()->recycle($category)->create();

    // 3. Creare piatti associati
    $dish1 = Dish::factory()->create([
        'category_id' => $category->id,
        'sub_category_id' => $subCategory1->id
    ]);
    $dish2 = Dish::factory()->create([
        'category_id' => $category->id,
        'sub_category_id' => $subCategory2->id
    ]);

    // 4. Controllare che i piatti esistano
    expect(Dish::count())->toBe(2);

    // 5. Eliminare la categoria
    $category->delete();

    // 6. Verificare che i piatti siano stati eliminati
    expect(Dish::count())->toBe(0);

    // 7. Verificare che i piatti non abbiano categorie
    expect(Dish::where('category_id', $category->id)->count())->toBe(0);

    // 8. Verificare che i piatti non abbiano subcategorie
    expect(Dish::where('sub_category_id', $subCategory1->id)->count())->toBe(0);
    expect(Dish::where('sub_category_id', $subCategory2->id)->count())->toBe(0);
});

