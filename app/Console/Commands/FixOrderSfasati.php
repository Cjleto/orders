<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use function Laravel\Prompts\pause;

class FixOrderSfasati extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:order-sfasati';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // per ogni model che ha il trait HasAutomaticOrder devo ordinare gli elementi per order
        // e poi riassegnare gli order in modo incrementale

        $companies = Company::query()
            ->with([
                'macroCategories.categories.dishes',
                'macroCategories.categories.subCategories.dishes'
                ])
            ->get();

        foreach($companies as $company) {
            pause("Fixing order for company {$company->name}");
            //$this->error("Fixing order for company {$company->name}");
            $macroCategories = $company->macroCategories;
            $this->fixOrder($macroCategories, 'macro categories');

            foreach($macroCategories as $macroCategory) {
                //$this->warn("Fixing order for macro category {$macroCategory->name}");
                $categories = $macroCategory->categories;
                $this->fixOrder($categories, 'categories');

                foreach($categories as $category) {
                    //$this->warn("Fixing order for category {$category->name}");

                    $subCategories = $category->subCategories;
                    $this->fixOrder($subCategories, 'sub categories');

                    $dishes = $category->dishes;
                    $this->fixOrder($dishes, 'dishes');

                }
            }


        }

    }

    private function fixOrder(Collection $models, string $label)
    {
        $models = $models->sortBy('order');

        $order = 1;

        $this->warn("Fixing order for $label");

        foreach($models as $model) {
            $this->info("{$model->name} - from order {$model->order} to order $order");
            $model->order = $order;
            /* $model->save(); */
            $order++;
        }
    }
}
