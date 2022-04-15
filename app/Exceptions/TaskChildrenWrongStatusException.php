<?php

namespace App\Exceptions;

use Exception;

class TaskChildrenWrongStatusException extends Exception
{
    /**
     * @var string
     */
    protected $code = 406;
    /**
     * @var string
     */
    protected $message = 'Can`t update task where children`s task has status = `todo`';
}
