<?php

namespace App\Http\Livewire\Production;

use App\Models\ActionType;
use App\Models\Apiary;
use App\Models\Employee;
use App\Models\HoneyProduction;
use App\Models\HoneyType;
use App\Models\WaxProduction;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Action;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public bool $isHoney = true;
    public array $isHoney_dropdown=[];
    public string $honey_type_name='';
    public array $honey_type_name_dropdown=[];
    public string $apiary_code_name='';
    public array $apiary_code_name_dropdown=[];
    public string $from_date='';
    public string $to_date='';

    public $firstRun = true;

    private $colors = [
        '#DFFF00',
        '#FFBF00',
        '#FF7F50',
        '#DE3163',
        '#9FE2BF',
        '#40E0D0',
        '#6495ED',
        '#CCCCFF'
    ];

    protected $listeners = [
        'closedProductionDeleteModal' => '$refresh',
    ];

    public function mount()
    {
        $this->resetPage();
        $this->setup_dropdowns();
    }
    public function setup_dropdowns(){
        $this->apiary_code_name_dropdown=[];
        $apiaries=Apiary::get(['code_name']);
        $this->apiary_code_name_dropdown[] = ['name' => 'All', 'value' => '', 'checked' => false];
        foreach ($apiaries as $apiary) {
            $this->apiary_code_name_dropdown[] = ['name' => $apiary->code_name, 'value' => $apiary->code_name, 'checked' => false];
        }

        $this->honey_type_name_dropdown=[];
        $honey_types=HoneyType::get(['name']);
        $this->honey_type_name_dropdown[] = ['name' => 'All', 'value' => '', 'checked' => false];
        foreach ($honey_types as $ht) {
            $this->honey_type_name_dropdown[] = ['name' => $ht->name, 'value' => $ht->name, 'checked' => false];
        }
        $this->isHoney_dropdown= [
            ['name' => 'Honey', 'value' => true, 'checked' => false],
            ['name' => 'Wax', 'value' => false, 'checked' => false]
        ];

    }
    public function resetFilters(){
        $this->from_date='';
        $this->to_date='';
        $this->honey_type_name='';
        $this->apiary_code_name='';
    }

    public function get_data(){
        if($this->isHoney){
            return HoneyProduction::
                where('apiary_code_name', 'like', "%{$this->apiary_code_name}%")->
                where('honey_type_name', 'like', "%{$this->honey_type_name}%")->
                when($this->to_date, function($query,$date){
                        return $query->whereDate('produced_at','<=', $date);
                    })->
                when($this->from_date, function($query,$date){
                    return $query->whereDate('produced_at','>=', $date);
                })->
                orderBy('produced_at', 'desc')->
                orderBy('apiary_code_name', 'asc');
        }
        else{
            return WaxProduction::
                where('apiary_code_name', 'like', "%{$this->apiary_code_name}%")->
                when($this->to_date, function($query,$date){
                    return $query->whereDate('produced_at','<=', $date);
                })->
                when($this->from_date, function($query,$date){
                    return $query->whereDate('produced_at','>=', $date);
                })->
                orderBy('produced_at', 'desc')->
                orderBy('apiary_code_name', 'asc');
        }
    }
    public function openProductionDeleteModal($id){
        if($this->isHoney)
            $this->emit('openHoneyProductionDeleteModal',$id);
        else
            $this->emit('openWaxProductionDeleteModal',$id);
    }

    public function get_column_chart_data($productions)
    {
        $column_chart = $productions->get()->groupBy('apiary_code_name')
            ->reduce(function (ColumnChartModel $columnChartModel, $data) {
                $type = $data->first()->apiary_code_name;
                $value = $data->sum('produced_weight');
                return $columnChartModel->addSeriesColumn('Produced', $type, $value);
            }, (new ColumnChartModel())
                ->setTitle('Productions from apiaries')
                ->setAnimated($this->firstRun)
                ->multiColumn()
            );
        return $column_chart;
    }

    public function get_line_chart_data($productions)
    {
        $processed_productions = $productions->orderBy('produced_at', 'desc')->groupBy('apiary_code_name', 'produced_at')->selectRaw('apiary_code_name, produced_at, sum(produced_weight) as sum')->get();
        $line_chart = $processed_productions
            ->reverse()
            ->reduce(function (LineChartModel $lineChartModel, $data) use ($processed_productions) {
                $series = $data->apiary_code_name;
                $type = $data->produced_at->toDateString();
                $value = $data->sum;

                return $lineChartModel->addSeriesPoint($series, $type, $value);
            },(new LineChartModel())
                ->setTitle('Productions from apiaries')
                ->setAnimated($this->firstRun)
                ->multiLine()
            );
        return $line_chart;
    }

    public function render()
    {
        $data = $this->get_data();
        $column_chart = $this->get_column_chart_data($data);
        $line_chart = $this->get_line_chart_data($data);
        $this->firstRun = false;
        $production = DB::select('SELECT getProduced(?, ?, ?) AS produced', [
            $this->isHoney == true ? 'HONEY': 'WAX',
            $this->from_date == '' ? Carbon::createFromTimestamp(0)->toDateTimeString() : $this->from_date,
            $this->to_date == '' ? Carbon::now()->toDateTimeString() : $this->from_date
        ]);
        $production = $production->count() > 0 ? $production[0]->produced : 0;

        return view(
            'livewire.production.table',
                [
                    'productions' => $this->get_data()->paginate(10),
                    'column_chart' => $column_chart,
                    'line_chart' => $line_chart,
                    'produced' => $production,
                ]
        );

    }
}
