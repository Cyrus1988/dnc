### Available methods of REST API:

#### Tasks


| Method        | Url                | ControllerMethod  | Description                 |
| ------------- |:-------------------|:-----:    |-----------------------------|
| GET           | /api/tasks         | index     | Show all tasks with filters |
| POST          | /api/tasks         | store     | Create new task             |
| GET           | /api/tasks/{id}        | show      | Get task by ID              |
| PUT/PATCH     | /api/tasks/{id} | update    | Update task by ID           |
| DELETE        | /api/tasks/{id} | destroy   | Delete task by ID           |


####Api store request example
```json
{
    "title": "some_title",
    "task_id": 6,
    "status": "done",
    "description": "some_description"
}
```

####Api update request example 

```json
{
    "title": "some_title",
    "priority": 3,
    "task_id": 6,
    "status": "done",
    "description": "some_description"
}
```
###Project structure:
><b>app</b>
>><b>Http</b>
>>><b>TaskFilter</b> - filter class for our tasks
>>
>>><b>Controllers</b> - Base controller class with api-trait inside
>>>><b>API</b> - Task-api class with CRUD method's
>>
>>><b>Requests</b> - Request directory
>>>><b>Api</b>
>>>>><b>Task</b> - Create and Update validation requests
>
>><b>Traits</b> - Traits directory with APIResponse and Filter traits
