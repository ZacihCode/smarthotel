<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

#[\Livewire\Attributes\Layout('admin.layouts.app')]
class UserManage extends Component
{
    use WithPagination;

    public $user_id, $name, $email, $password, $role;
    public $editMode = false;
    public $userIdBeingEdited;

    public $search = '';
    public $selectedUsers = [];
    public $selectAll = false;

    public $confirmingDelete = false;
    public $confirmingBulkDelete = false;
    public $userIdToDelete;

    public $showModal = false;

    protected $rules = [
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|max:255',
        'password'  => 'nullable|min:6',
        'role'      => 'required|in:ADMIN,TAMU',   // Sesuaikan dengan role di AuthController
    ];

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'role']);
        $this->resetValidation();
        $this->editMode = false;
        $this->userIdBeingEdited = null;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->editMode) {

            User::findOrFail($this->userIdBeingEdited)->update($data);
        } else {

            $data['password'] = Hash::make($this->password ?? '123456');
            User::create($data);
        }

        session()->flash('message', 'User berhasil disimpan!');
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);

        $this->name  = $user->name;
        $this->email = $user->email;
        $this->role  = $user->role;

        $this->editMode = true;
        $this->userIdBeingEdited = $user_id;
        $this->showModal = true;
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->userIdToDelete = $id;
    }

    public function deleteUserConfirmed()
    {
        User::findOrFail($this->userIdToDelete)->delete();

        $this->selectedUsers = array_diff($this->selectedUsers, [$this->userIdToDelete]);
        $this->confirmingDelete = false;

        session()->flash('message', 'User berhasil dihapus!');
    }

    public function confirmBulkDelete()
    {
        $this->confirmingBulkDelete = true;
    }

    public function deleteSelectedConfirmed()
    {
        User::whereIn('id', $this->selectedUsers)->delete();

        $this->selectedUsers = [];
        $this->selectAll = false;
        $this->confirmingBulkDelete = false;

        session()->flash('message', 'Beberapa user berhasil dihapus!');
    }

    public function toggleSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedUsers = User::pluck('id')->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function render()
    {
        $users = User::where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.user-manage', compact('users'));
    }
}
