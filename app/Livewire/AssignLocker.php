<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Child;
use App\Models\Locker;

class AssignLocker extends Component
{
    use WithPagination;

    public $selectedChildId;
    public $selectedLockerId;
    public $showLockerSelection = false;
    public $searchTerm = ''; // For filtering children
    public $lockerSearchTerm = ''; // For filtering lockers
    public $searchSubmitted = false; // To trigger search only when button is clicked

    public function render()
    {
        return view('livewire.assign-locker', [
            'children' => $this->getFilteredChildren(),
            'lockers' => $this->getFilteredLockers(),
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->searchSubmitted = false; // Reset the flag when search term changes
    }

    public function performSearch()
    {
        $this->searchSubmitted = true; // Set the flag to true to perform search
    }

    public function performLockerSearch()
    {
        $this->searchSubmitted = true; // Set the flag to true to perform locker search
    }

    public function showLockerOptions($childId)
    {
        $this->selectedChildId = $childId;
        $this->showLockerSelection = true;
        $this->lockerSearchTerm = ''; // Clear search term when starting locker assignment
    }

    public function assignLocker($lockerId)
    {
        $child = Child::find($this->selectedChildId);
        $locker = Locker::find($lockerId);

        if ($child && $locker) {
            if ($child->locker) {
                $previousLocker = $child->locker;
                $previousLocker->update(['status' => 'Available']);
                $child->locker()->dissociate();
                $child->save();
            }

            $locker->update(['status' => 'In Use']);
            $child->update(['locker_id' => $locker->id]);

            $this->reset(['selectedChildId', 'selectedLockerId', 'showLockerSelection']);
            $this->dispatch('refreshChildren');

            session()->flash('message', 'Locker assigned successfully!');
        } else {
            session()->flash('error', 'Child or locker not found.');
        }
    }

    public function unassignLocker($childId)
    {
        $child = Child::find($childId);

        if ($child && $child->locker) {
            $locker = $child->locker;
            $locker->update(['status' => 'Available']);
            $child->locker()->dissociate();
            $child->save();

            $this->dispatch('refreshChildren');

            session()->flash('message', 'Locker unassigned successfully!');
        } else {
            session()->flash('error', 'Child or locker not found.');
        }
    }

    private function getFilteredChildren()
    {
        if (!$this->searchSubmitted) {
            return Child::with(['class', 'locker'])->paginate(10);
        }

        return Child::with(['class', 'locker'])
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);
    }

    private function getFilteredLockers()
    {
        if ($this->showLockerSelection) {
            return Locker::where('status', 'Available')
                ->where('locker_name', 'like', '%' . $this->lockerSearchTerm . '%')
                ->get();
        }

        return collect(); // Return an empty collection if locker selection is not active
    }
}
