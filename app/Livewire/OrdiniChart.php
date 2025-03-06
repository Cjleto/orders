<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\OrderService;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Collection;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class OrdiniChart extends Component
{
    public $startDate;
    public $endDate;
    protected OrderService $orderService;

    public $colors = [
        'food' => '#f6ad55',
        'shopping' => '#fc8181',
        'entertainment' => '#90cdf4',
        'travel' => '#66DA26',
        'other' => '#cbd5e0',
    ];

    public $firstRun = true;
    public $showDataLabels = true;

    public function mount(OrderService $orderService)
    {
        $this->orderService = $orderService;
        $this->startDate = now()->subDays(30)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }


    public function render()
    {

        $startingData = $this->getData();

        $startingData = $startingData->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $startingData = $startingData->map(function ($day) {
            return [
                'date' => $day->first()->created_at->format('Y-m-d'),
                'total' => $day->sum('total')
            ];
        });

        $ordiniChartModel = $startingData->reduce(function (LineChartModel $lineChartModel, $item) use ($startingData) {
            $date = $startingData->search($item);


                return $lineChartModel->addPoint($date, $item['total']);
            }, LivewireCharts::lineChartModel()
                ->setTitle('Orders Evolution')
                ->setAnimated($this->firstRun)
                ->setSmoothCurve()
                ->setXAxisVisible(true)
                ->withLegend()
                ->setGridVisible(true)
                ->setDataLabelsEnabled($this->showDataLabels)

            );

        $this->firstRun = false;

        return view('livewire.ordini-chart',[
            'ordiniChartModel' => $ordiniChartModel
        ]);
    }

    private function getData(): Collection
    {
        return $this->orderService->getOrdersBetweenDates($this->startDate, $this->endDate);

    }
}
