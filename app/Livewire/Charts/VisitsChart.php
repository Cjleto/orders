<?php

namespace App\Livewire\Charts;

use Debugbar;
use App\Models\Visit;
use Livewire\Component;
use Livewire\Attributes\On;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class VisitsChart extends Component
{
    public $data = [];
    public $period;

    public function mount ()
    {
        $this->period = 7;
        $this->getData();
    }


    public function getData()
    {
        $visits = Visit::query()
            ->selectRaw('count(*) as total, route')
            ->where('created_at', '>=', now()->subDays($this->period))
            ->orderBy('total', 'desc')
            ->limit(5)
            ->groupBy('route')
            ->get();

        $this->data = $visits->pluck('total', 'route');

        Debugbar::info($this->data->toJson());
    }

    public function updatedPeriod ()
    {
        $this->getData();
    }

    public function render()
    {

        // Creazione del modello del grafico a colonne
        $chart = (new ColumnChartModel())
            ->setTitle('Visite Menu')
            ->setColors(['#4A90E2', '#F5A623', '#F8E71C', '#9B9B9B', '#50E3C2'])
            ->disableShades()
            ->setDataLabelsEnabled(false)
            ->setAnimated(true);

        // Aggiungiamo i dati dinamicamente
        foreach ($this->data as $route => $count) {
            $chart->addColumn($route, $count, '#4A90E2');
        }

        return view('livewire.charts.visits-chart', compact('chart'));
    }
}
