<?php

namespace App\Livewire;

use Livewire\Component;

class MiniBarChart extends Component
{
    public $chartId;
    public $ingresos;
    public $egresos;

    public function render()
    {
        return view('livewire.mini-bar-chart');
    }
}
