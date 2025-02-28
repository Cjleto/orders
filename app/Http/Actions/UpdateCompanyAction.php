<?php

namespace App\Http\Actions;

use Exception;
use App\Models\Company;
use App\Http\Dtos\CompanyDto;

class UpdateCompanyAction
{
    public function handle(Company $company, CompanyDto $data): Company
    {
        try {
            // Gestione dell'aggiornamento del logo, se presente
            if (isset($data->logo)) {
                $company->addMedia($data->logo)->toMediaCollection('logo');
            }

            // Aggiorna la company con i dati del DTO
            $company->update($data->toArrayOfAttributes());
            $company->save();

            return $company;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
