<?php

namespace App\Http\Livewire\Example;

use Livewire\Component;

class Form extends Component
{
    public $country;
    public function render()
    {
        return view('livewire.example.form');
    }
    public function store()
    {
        dd($this);
    }
}
