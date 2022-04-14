<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * The base class for a filters.
 * Для каждой модели, в которой хотим использовать метод {@link filter()}, реализуем наследника {@link QueryFilter}.
 * В дочернем классе реализуем методы фильтрации модели, важно: имя метода должно соответствовать имени параметра,
 * по которому фильтруем модель.
 * Модель должна заюзать трейт {@link Filterable} чтобы магия заработа
 */
abstract class QueryFilter
{
    protected Request $request;

    protected Builder $builder;

    protected string $delimiter = ',';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Для каждого ключа ассоциативного массива, который вернул метод {@link filters()},
     * вызывает одноименный метод, при наличии такового, передает значение элемента массива в метод.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], [$value]);
            }
        }

        return $this->builder;
    }

    /**
     * Получает все значения строки запроса в виде ассоциативного массива
     *
     * @return array|string|null
     */
    public function filters(): array|string|null
    {
        return $this->request->query();
    }

    public function request(): Request
    {
        return $this->request;
    }

    protected function paramToArray($param)
    {
        return explode($this->delimiter, $param);
    }
}
