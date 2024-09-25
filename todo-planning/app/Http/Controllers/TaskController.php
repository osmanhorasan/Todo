<?php
// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Task;
use App\Services\TaskDistributor;

class TaskController extends Controller
{
    protected $taskDistributor;

    public function __construct(TaskDistributor $taskDistributor)
    {
        $this->taskDistributor = $taskDistributor;
    }

    public function index()
    {
        $distributionResult = $this->taskDistributor->distributeTasks();

        $tasks = Task::with('developer')->get()->map(function($task) use ($distributionResult) {
            foreach ($distributionResult as $developerId => $developerInfo) {
                if (in_array($task->id, array_column($developerInfo['tasks'], 'id'))) {
                    $task->assignedDeveloper = Developer::find($developerId)->name;
                }
            }
            return $task;
        });

        return response()->json($tasks);
    }

}
