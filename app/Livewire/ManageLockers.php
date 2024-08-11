<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Locker;
use Illuminate\Support\Facades\Auth;

class ManageLockers extends Component
{
    use WithPagination;
    public $search = '';
    public $buildingFilter = '';
    public $floorFilter = '';
    public $statusFilter = '';

    public $locker_id;
    public $locker_name;
    public $building;
    public $floor;
    public $status;
    public $selectedLocker;
    public $user;

    public $sortField = 'id';
    public $sortDirection = 'asc';
    public function logout()
    {
        // For Sanctum, log out the user and invalidate their session
        Auth::guard('web')->logout(); // Use 'web' guard for session-based authentication

        // Optionally invalidate the user's API tokens
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete(); // Delete all tokens for the user
        }

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login'); // Redirect to the login page
    }
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

    
    public function applyFilters()
    {
        // This method can be used to trigger any additional actions if needed
        // For example, you can add custom logic to reset or validate filters
        $this->resetPage(); // Reset pagination to the first page
    }
    public function resetFilters()
    {
        // Reset filter properties to default values
        $this->search = '';
        $this->buildingFilter = '';
        $this->floorFilter = '';
        $this->statusFilter = '';

        // Optionally, you can reset pagination here as well
        $this->resetPage();
    }

    public function render()
    {
        $query = Locker::query();

        // Apply filters to the query
        if ($this->search) {
            $query->where('locker_name', 'like', '%'.preg_replace('/\s+/', '%', $this->search).'%');
        }

        if ($this->buildingFilter) {
            $query->where('building', 'like', '%'.$this->buildingFilter.'%');
        }

        if ($this->floorFilter) {
            $query->where('floor', 'like', '%'.$this->floorFilter.'%');
        }

        if ($this->statusFilter) {
            $query->where('status', 'like', '%'.$this->statusFilter.'%');
        }

        // Optional: Sorting and pagination
        $lockers = $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate(6);

        return view('livewire.manage-lockers', [
            'lockers' => $lockers,
        ]);
    }
}
