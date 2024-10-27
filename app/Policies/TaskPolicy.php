<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */

    public function update(User $user, Task $task){
        return $user->id === $task->project->user_id;
    }

    public function delete(User $user, Task $task){
        return $user->id === $task->project->user_id;
    }

    public function __construct()
    {
        //
    }
}
