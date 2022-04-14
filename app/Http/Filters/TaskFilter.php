<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends QueryFilter
{
    /**
     * Filter by status field
     * @param string $status
     * @return Builder|null
     */
    public function status(string $status): ?Builder
    {
        if (!$status) {
            return null;
        }

        return $this->builder->where('status', $status);
    }

    /**
     * Filter by priority filed using between-operator
     * @param $priority
     * @return Builder|null
     */
    public function priority($priority): ?Builder
    {
        $min = min($priority);
        $max = max($priority);

        if (!$priority) {
            return null;
        }

        return $this->builder->whereBetween('priority', [$min, $max]);
    }

    /**
     * Filter by title field by like-operator
     * @param string $title
     * @return Builder|null
     */
    public function title(string $title): ?Builder
    {
        if (!$title) {
            return null;
        }

        return $this->builder->where('title',$title);
    }

    /**
     * Filter by priority order
     * @param string $prioritySort
     * @return Builder|null
     */
    public function priority_sort(string $prioritySort): ?Builder
    {
        if (!$prioritySort) {
            return null;
        }

        return $this->builder->orderBy('priority', $prioritySort);
    }

    /**
     * Filter by created_at
     * @param string $createDateSort
     * @return Builder|null
     */
    public function created_sort(string $createDateSort): ?Builder
    {
        if (!$createDateSort) {
            return null;
        }

        return $this->builder->orderBy('created_at', $createDateSort);
    }

    /**
     * Filter by updated_at === `времени выполнения`
     * @param string $updatedDateSort
     * @return Builder|null
     */
    public function updated_sort(string $updatedDateSort): ?Builder
    {
        if (!$updatedDateSort) {
            return null;
        }

        return $this->builder->orderBy('updated_at', $updatedDateSort);
    }
}
