<?php

namespace App\Http\Livewire\Scanner;

use App\Models\ActionType;
use App\Models\Apiary;
use App\Models\Employee;
use App\Models\HoneyProduction;
use App\Models\HoneyType;
use App\Models\TaskType;
use App\Models\User;
use App\Models\WaxProduction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Scan extends Component
{
    public string $scanned_qr='';
    public string $scanned_nfc='';


    protected function rules()
    {
        return [
            'scanned_qr'=>['string','nullable','max:128'],
            'scanned_nfc'=>['string','nullable','max:32'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validate();
    }


    public function store()
    {
        $this->validate();
        if( ($this->scanned_nfc==null && $this->scanned_qr==null) || ($this->scanned_nfc!=null && $this->scanned_qr!=null) ){
            $this->addError('scanned_nfc','Please fill exactly one field');
            $this->addError('scanned_qr','Please fill exactly one field');
            return;
        }

        $current_user=User::find(Auth::id());
        if(isset($current_user)){
            if($this->scanned_nfc==null){
                $current_user->last_scanned_nfc=null;
                $current_user->last_scanned_qr=$this->scanned_qr;
            }else{
                $current_user->last_scanned_nfc=$this->scanned_nfc;
                $current_user->last_scanned_qr=null;
            }
            $current_user->last_scanned_at=Carbon::now();
            $current_user->save();
        }

        flash("Succesfully scanned.")->success()->livewire($this);
        $this->afterStore();

    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.scanner.scan');
    }
}
