<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\TaskFilter;
use App\Http\Requests\Api\Task\CreateRequest;
use App\Http\Requests\Api\Task\UpdateRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

/**
 * Resource api class
 */
class TaskController extends Controller
{
    /**
     * Index method with filters
     * @param TaskFilter $filter
     * @return JsonResponse
     */
    public function index(TaskFilter $filter): JsonResponse
    {
        $tasks = Task::filter($filter)->get();

        return $this->sendResponse($tasks);
    }

    /**
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        Task::create($validated);

        return $this->sendResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $task = Task::find($id);

        if ($task) {
            return $this->sendResponse($task);
        } else {
            return $this->sendError('Not found task by id: ' . $id);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $validate = $request->validated();

        $task = Task::where('id', $id)
            ->whereNull('task_id')
            ->with('childrenTasks')
            ->first();

        if ($task->childrenTasks->isEmpty()) {
            return $this->sendError('Can`t update task where children`s task has status = `todo`', 406);
        } else {
            $task->update($validate);
            return $this->sendResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $task = Task::find($id);

        if ($task->status != 'done') {
            return $this->sendError('Can not to delete task with status = `todo`');
        } else {
            Task::destroy($id);
            return $this->sendResponse();
        }
    }
}
