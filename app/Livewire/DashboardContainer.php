<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Enums\OrderStatus;
use App\Services\OrderService;
use Illuminate\Support\Collection;
use Barryvdh\Debugbar\Facades\Debugbar;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class DashboardContainer extends Component
{

    public $startDate;
    public $endDate;
    private Collection $startingData;
    private bool $animated = true;
    public string $currency;
    public array $statuses;
    public array $countByStatus = [];

    public $colors = [
        '#f6ad55',
        '#fc8181',
        '#90cdf4',
        '#66DA26',
        '#cbd5e0',
    ];

    public $firstRun = true;
    public $showDataLabels = true;

    public function mount()
    {

        $order = Order::factory()->create();
        $products = Product::inRandomOrder()->take(2)->get();

        foreach ($products as $product) {
            $order->products()->attach($product->id, [
                'quantity' => 5,
                'product_name' => $product->name,
                'product_price' => $product->price,
            ]);
        }
dd($order->products()->count());
        $this->statuses = OrderStatus::cases();
        $this->startDate = now()->subDays(7)->format('Y-m-d');
        $this->currency = config('myconst.currency_symbol');
        $this->endDate = now()->format('Y-m-d');
        $this->startingData = $this->getData();
    }

    public function updatedStartDate($value)
    {
        Debugbar::info('updatedStartDate1 ' . $value);
        $this->startingData = $this->getData();
        Debugbar::info('updatedStartDate2 '. count($this->startingData));
    }


    public function render()
    {

        $this->firstRun = false;

        $this->getOrderByStatus();

        return view('livewire.dashboard-container')
            ->with([
                'ordersAmounForRange' => $this->getOrdersAmountForDateRange(),
                'ordersCountForRange' => $this->getOrdersCountForDateRange()
            ]);
    }

    private function getData(): Collection
    {
        Debugbar::info('getData1 ' . $this->startDate . ' ' . $this->endDate);
        $orderService = app(OrderService::class);
        $records = $orderService->getOrdersBetweenDates($this->startDate, $this->endDate);
        Debugbar::info('getData2 '. $this->startDate . ' ' . $this->endDate. ' ' . count($records));
        return $records;
    }

    private function getOrdersAmountForDateRange()
    {
        $localData = $this->startingData->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $localData = $localData->map(function ($day) {
            return [
                'date' => $day->first()->created_at->format('Y-m-d'),
                'total' => $day->sum('total')
            ];
        });

        return $localData->reduce(
            function (LineChartModel $lineChartModel, $item) use ($localData) {
                $date = $localData->search($item);
                return $lineChartModel->addPoint($date, $item['total']);
            },
            LivewireCharts::lineChartModel()
                /* ->setTitle(trans('orders_evolution')) */
                ->setAnimated($this->animated)
                ->setSmoothCurve()
                ->setXAxisVisible(true)
                ->setYAxisVisible(true)
                ->withLegend()
                ->setGridVisible(true)
                ->setDataLabelsEnabled(false)
                ->setJsonConfig([
                    'dataLabels.formatter' =>
                'function (value) { return parseFloat(value).toFixed(2) + " ' . $this->currency . '"; }',
                    'tooltip.y.formatter' => 'function (value) { return parseFloat(value).toFixed(2) + " '.$this->currency.'"; }',
                    'yaxis.labels.formatter' =>
                'function (value) { return parseFloat(value).toFixed(2) + " ' . $this->currency . '"; }',
                ])

        );
    }


    private function getOrdersCountForDateRange()
    {
        $localData = $this->startingData->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $localData = $localData->map(function ($day) {
            return [
                'date' => $day->first()->created_at->format('Y-m-d'),
                'count' => $day->count()
            ];
        });

        return $localData->reduce(
            function (ColumnChartModel $columnChartModel, $item) use ($localData) {
                $date = $localData->search($item);

                return $columnChartModel->addColumn($date, $item['count'], $this->colors[0]);
            },
            LivewireCharts::columnChartModel()
                /* ->setTitle(trans('orders_per_day')) */
                ->setAnimated($this->animated)
                ->setXAxisVisible(true)
                ->withoutLegend()
                ->setGridVisible(true)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors(array_values($this->colors))
                ->setColumnWidth(20)
                ->setJsonConfig([
                    'dataLabels.formatter' => 'function (value) { return parseFloat(value).toFixed(2); }',
                    'tooltip.y.formatter' => 'function (value) { return parseFloat(value).toFixed(2); }',
                    'yaxis.labels.formatter' => 'function (value) { return parseFloat(value).toFixed(2); }',
                    'title.align' => 'function (chartContext) { return "center"; }',
                ])
        );
    }

    private function getOrderByStatus()
    {
        $localData = $this->startingData->groupBy('status');

        $localData = $localData->map(function ($day) {
            return $day->count();
        });

        foreach ($this->statuses as $status) {
            if (!$localData->has($status->value)) {
                $localData[$status->value] = 0;
            }
        }

        $this->countByStatus = $localData->toArray();
    }


}
