<?php

namespace App\Traits;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Ho preso il trati LogsActivity e l'ho modificato per aggiungere il campo impersonated se applicabile.
 * e definito di default le opzioni di log per i modelli che utilizzano questo trait. che richiede il package
 * in questo modo posso includere direttamente questo trait nei model che voglio loggare e non devo preoccuparmi
 * di definire le opzioni di log ogni volta.
 */
trait LogsActivityWithImpersonation
{
    use LogsActivity;

    /**
     * Modifica l'attività per aggiungere il campo impersonated se applicabile.
     *
     * @param  Activity  $activity
     * @param  string  $eventName
     * @return void
     */
    public function tapActivity(Activity $activity, string $eventName)
    {
        if (Auth::check() && Auth::user()->isImpersonated()) {
            $activity->properties = $activity->properties->merge(['impersonated' => true]);
        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

}
