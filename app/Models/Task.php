<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory, Filterable;

    protected $table = 'tasks';

    protected $fillable = [
        'task_id',
        'status',
        'priority',
        'title',
        'description'
    ];

    /**
     * @return HasMany
     */
    public function childrenTasks(): HasMany
    {
        return $this->hasMany(Task::class,'task_id')->with('childrenTasks');
    }
}
