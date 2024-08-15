namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Locker;
use App\Models\Child;

class AssignLocker extends Component
{
    public $children;
    public $lockers;
    public $selectedChild;
    public $selectedLocker;

    public function mount()
    {
        // Fetch children who don't have an assigned locker
        $this->children = Child::whereDoesntHave('locker')->get();

        // Fetch lockers that are not assigned
        $this->lockers = Locker::where('assigned', false)->get();
    }

    public function assignLocker()
    {
        $locker = Locker::find($this->selectedLocker);
        $child = Child::find($this->selectedChild);

        if ($locker && $child) {
            $locker->assigned = true;
            $locker->child_id = $child->id;
            $locker->save();

            $this->lockers = Locker::where('assigned', false)->get(); // Refresh lockers list
            $this->children = Child::whereDoesntHave('locker')->get(); // Refresh children list
            $this->selectedChild = null;
            $this->selectedLocker = null;
        }
    }

    public function render()
    {
        return view('livewire.assign-locker');
    }
}
