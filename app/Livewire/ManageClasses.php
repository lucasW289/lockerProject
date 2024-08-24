<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Classes; // Make sure to import your model
use Illuminate\Support\Facades\Auth;


class ManageClasses extends Component
{
    public $classes, $classId, $className, $building;
    public $editing = false;

    public function mount()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403); // Forbidden
        }
        $this->classes = Classes::all();
    }

    public function render()
    {
        return view('livewire.manage-classes');
    }

    public function storeClass()
    {
        $this->validate([
            'className' => 'required|string|max:255',
            'building' => 'required|string|max:255',
        ]);

        if ($this->editing) {
            $class = Classes::find($this->classId);
            $class->update([
                'name' => $this->className,
                'building' => $this->building,
            ]);
            session()->flash('message', 'Class Updated Successfully!');
        } else {
            Classes::create([
                'name' => $this->className,
                'building' => $this->building,
            ]);
            session()->flash('message', 'Class Added successfully!');

        }

        $this->resetFields();
    }

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
    public function editClass($id)
    {
        $class = Classes::find($id);
        $this->classId = $class->id;
        $this->className = $class->name;
        $this->building = $class->building;
        $this->editing = true;
    }

    public function deleteClass($classId)
    {
        $class = Classes::find($classId);
        
        if ($class) {
            // Delete associated students if needed
            $class->delete();
    
            // Flash message
            session()->flash('message', 'Class and associated students deleted successfully.');
        } else {
            session()->flash('error', 'Class not found.');
        }
    
        // Livewire should re-render automatically
        return redirect()->route('manage.class');

    }
    

    

    public function resetFields()
    {
        $this->classId = null;
        $this->className = '';
        $this->building = '';
        $this->editing = false;
        $this->classes = Classes::all();
    }
}
