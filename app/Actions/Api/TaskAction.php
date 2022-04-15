<?php

namespace App\Actions\Api;

use App\Exceptions\TaskChildrenWrongStatusException;
use Illuminate\Database\Eloquent\Collection;

class TaskAction
{
    const STATUS_TODO = 'todo';

    /**
     * @throws TaskChildrenWrongStatusException
     */
    public function checkChildrenTask(Collection $collection)
    {
        foreach ($collection as $task) {
            if ($task->status == self::STATUS_TODO) {
                throw new TaskChildrenWrongStatusException();
            } else {
                $this->checkChildrenTask($task->childrenTasks);
            }
        }
    }
}
