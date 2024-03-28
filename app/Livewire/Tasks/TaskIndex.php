<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TaskIndex extends Component
{
    public $tasks;

    #[Rule(['required', 'max:16', 'string'])]
    public $name;

    public function mount()
    {
        // $this->tasks = Task::with('user')->get();
    }

    public function hydrate()
    {
        // dd('OK');
    }

    public function boot()
    {
        $this->tasks = Task::with('user')->get();
    }

    public function updating()
    {
        //
    }

    public function updated()
    {
        //
    }

    public function rendering($view, $data)
    {
        $data['name'] = 'Task';

        // dd($data);
    }

    public function rendered($view, $html)
    {
        // dd($html);
    }

    public function dehydrate()
    {
        $this->tasks = $this->tasks->toArray();
    }

    public function save()
    {
        $this->validate();

        Task::create([
            'user_id' => 1,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Task successfully created');

        $this->dispatch('task-updated');

        return $this->redirect(route('tasks'));
    }

    public function render()
    {
        return view('livewire.tasks.task-index')
            ->title('Tasks - Hostinger Livewire')
            ->with([
                'button' => 'New Task',
            ]);
    }
}
