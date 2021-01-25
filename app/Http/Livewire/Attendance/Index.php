<?php

namespace App\Http\Livewire\Attendance;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    protected $listeners=[];
    public string $employee_PESEL='';
    public string $employee='';
    public string $attendance='';
    public string $status='';
    public function start(){
        if(!isset($this->employee_PESEL))return;
        //find unfinished attendance
        $att=Attendance::where('employee_PESEL',$this->employee_PESEL)->whereNull('finished_at')->first();
        if($att==null){
            //if none - create
            DB::select('call NewAttendance(?)', array($this->employee_PESEL));
            $this->status="At work, started just now";
        }

    }
    public function finish(){
        if(!isset($this->employee_PESEL))return;
        //find unfinished attendance
        $att=Attendance::where('employee_PESEL',$this->employee_PESEL)->whereNull('finished_at')->first();
        if($att==null){
            //if none - ignore - nothing to finish
        }
        else{
            $att->finished_at=Carbon::now();
            $att->save();
            $this->status="Not present";

        }
    }



    public function mount(){
        $current_user=User::find(Auth::id());
        if(isset($current_user) && isset($current_user->employee_PESEL)){
            $this->employee_PESEL=$current_user->employee_PESEL;
            $emp=Employee::find($this->employee_PESEL);
            if($emp!=null){
                $this->employee=$emp->first_name.' '.$emp->last_name;
                $this->isPresent();
            }
            else{
                $this->status='Cannot determine who you are!';
            }
        }
        else{
            $this->status='Cannot determine who you are!';
        }
    }

    public function isPresent(){
        $att=Attendance::where('employee_PESEL',$this->employee_PESEL)->whereNull('finished_at')->first();
        if($att!=null){
            $this->status="At work, started at: {$att->started_at}";
            return true;
        }
        else{
            $this->status="Not present";
            return false;
        }
    }

    public function render()
    {
        return view('livewire.attendance.index', [

        ]);
    }
}
