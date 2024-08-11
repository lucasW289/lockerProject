<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Locker;
use Illuminate\Support\Facades\Auth;

class ManageLockers extends Component
{
    use WithPagination;

    public $locker_id;
    public $locker_name;
    public $building;
    public $floor;
    public $status;
    public $selectedLocker;
    public $user;
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';

    protected $rules = [
        'locker_name' => 'required|string|max:255',
        'building'    => 'required|string|max:255',
        'floor'       => 'required|string|max:255',
        'status'      => 'required|in:Available,In Use,Out of Service',
    ];

    public function mount()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403); // Forbidden
        }
        if (Auth::user()) {
            $this->user = Auth::user();
        }
    }

    public function selectToUpdate($id)
    {
        $this->selectedLocker = Locker::find($id);
        $this->locker_id = $this->selectedLocker->id;
        $this->locker_name = $this->selectedLocker->locker_name;
        $this->building = $this->selectedLocker->building;
        $this->floor = $this->selectedLocker->floor;
        $this->status = $this->selectedLocker->status;

        $this->dispatch('show-edit-confirmation', [
            'id' => $id,
            'locker_name' => $this->locker_name,
            'building' => $this->building,
            'floor' => $this->floor,
            'status' => $this->status,
        ]);
    }
    
    public function selectToDelete($id)
    {
        $this->dispatch('show-delete-confirmation', ['id' => $id]);
    }

    public function addLocker()
    {
        $this->validate([
            'locker_name' => 'required|string|max:255|unique:lockers,locker_name',
            'building'    => 'required|string|max:255',
            'floor'       => 'required|string|max:255',
            'status'      => 'required|in:Available,In Use,Out of Service',
        ]);

        Locker::create([
            'locker_name' => $this->locker_name,
            'building'    => $this->building,
            'floor'       => $this->floor,
            'status'      => $this->status,
        ]);

        $this->reset();
        session()->flash('message', 'Locker added successfully!');
    }

    public function updateLocker()
    {
        $this->validate();

        $locker = Locker::find($this->locker_id);

        if ($locker) {
            $locker->update([
                'locker_name' => $this->locker_name,
                'building'    => $this->building,
                'floor'       => $this->floor,
                'status'      => $this->status,
            ]);

            session()->flash('message', 'Locker updated successfully!');
            $this->reset();
        } else {
            session()->flash('error', 'Locker not found!');
        }
    }

    public function deleteLocker($id)
    {
        $locker = Locker::find($id);

        if ($locker) {
            $locker->delete();
            session()->flash('message', 'Locker deleted successfully!');
        } else {
            session()->flash('error', 'Locker not found!');
        }
    }

    public function sort($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    
    public function render()
    {
        $lockers = Locker::query()
            ->where('locker_name', 'like', '%'.$this->search.'%')
            ->where(function ($query) {
                if ($this->building) {
                    $query->where('building', 'like', '%'.$this->building.'%');
                }
                if ($this->floor) {
                    $query->where('floor', 'like', '%'.$this->floor.'%');
                }
                if ($this->status) {
                    $query->where('status', $this->status);
                }
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.manage-lockers', [
            'lockers' => $lockers,
        ]);
    }
}
