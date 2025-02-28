<?php

namespace App\Http\Actions;

use Exception;
use App\Models\Company;
use App\Models\MenuSetting;
use App\Http\Dtos\CompanyDto;
use Illuminate\Support\Facades\DB;

class CreateCompanyAction
{
    public function handle(CompanyDto $dto): Company
    {
        try {

            $company = DB::transaction(function () use ($dto) {
                $company = new Company();
                $company->forceFill($dto->toArrayOfAttributes()); // Forzo l'assegnazione di campi personalizzati come logo

                if (isset($dto->logo)) {
                    $company->addMedia($dto->logo)->toMediaCollection('logo');
                    unset($company->logo); // Rimuovo logo per evitare di sovrascrivere accidentalmente il model
                }

                $company->save();

                $menuSetting = MenuSetting::factory()->create([
                    'company_id' => $company->id,
                    'title' => $company->name
                ]);


                return $company;
            });

            $company->save();

            return $company;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
