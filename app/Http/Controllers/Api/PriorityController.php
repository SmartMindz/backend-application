<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Priority\CountPriorityRequest;
use App\Http\Requests\Priority\CreatePriorityRequest;
use App\Http\Requests\Priority\ListPriorityRequest;
use App\Http\Requests\Priority\ShowPriorityRequest;
use App\Http\Requests\Priority\UpdatePriorityRequest;
use App\Http\Requests\Project\DestroyProjectRequest;
use App\Models\Priority;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PriorityController extends ItemController
{
    /**
     * PriorityController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function getValidationRules(): array
    {
        return [];
    }

    /**
     * Get the event unique name part.
     *
     * @return string
     */
    public function getEventUniqueNamePart(): string
    {
        return 'priority';
    }

    /**
     * Get the model class.
     *
     * @return string
     */
    public function getItemClass(): string
    {
        return Priority::class;
    }

    /**
     * @api             {post} /priorities/show Show
     * @apiDescription  Show priority.
     *
     * @apiVersion      1.0.0
     * @apiName         Show Priority
     * @apiGroup        Priority
     *
     * @apiUse          AuthHeader
     *
     * @apiParam {Integer} id  Priority ID
     *
     * @apiParamExample {json} Request Example
     * {
     *   "id": 1
     * }
     *
     * @apiSuccess {Object}   res      Priority
     *
     * @apiUse          PriorityObject
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *    "res": {
     *      "id": 1
     *      "name": "Normal",
     *      "color": null
     *    }
     *  }
     *
     * @apiUse          400Error
     * @apiUse          UnauthorizedError
     *
     */
    public function show(ShowPriorityRequest $request): JsonResponse
    {
        return $this->_show($request);
    }

    /**
     * @api             {get} /priorities/list List
     * @apiDescription  Get list of priorities.
     *
     * @apiVersion      1.0.0
     * @apiName         Priority List
     * @apiGroup        Priority
     *
     * @apiUse          AuthHeader
     *
     * @apiSuccess {Object}   res      Priority
     *
     * @apiUse          PriorityObject
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *    "res": [{
     *      "id": 1
     *      "name": "Normal",
     *      "color": null
     *    }]
     *  }
     *
     * @apiUse          400Error
     * @apiUse          UnauthorizedError
     *
     */
    public function index(ListPriorityRequest $request): JsonResponse
    {
        return $this->_index($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     *
     * @api             {post} /priorities/create Create
     * @apiDescription  Creates priority
     *
     * @apiVersion      1.0.0
     * @apiName         Create Priority
     * @apiGroup        Priority
     *
     * @apiUse          AuthHeader
     *
     * @apiParam {String}  name   Priority name
     * @apiParam {String}  color  Priority color
     *
     * @apiParamExample {json} Request Example
     *  {
     *    "name": "Normal",
     *    "color": null
     *  }
     *
     * @apiSuccess {Object}   res      Priority
     *
     * @apiUse          PriorityObject
     *
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *    "res": {
     *      "id": 1
     *      "name": "Normal",
     *      "color": null
     *    }
     *  }
     *
     * @apiUse          400Error
     * @apiUse          UnauthorizedError
     *
     */
    public function create(CreatePriorityRequest $request): JsonResponse
    {
        return $this->_create($request);
    }

    /**
     * @throws Exception
     * @api             {post} /priorities/edit Edit
     * @apiDescription  Edit Priority
     *
     * @apiVersion      1.0.0
     * @apiName         Edit
     * @apiGroup        Priority
     *
     * @apiUse          AuthHeader
     *
     * @apiParam {Integer}  id           ID
     * @apiParam {String}   name   Priority name
     * @apiParam {String}   color  Priority color
     *
     * @apiParamExample {json} Simple Request Example
     *  {
     *    "id": 1,
     *    "name": "Normal",
     *    "color": null
     *  }
     *
     * @apiSuccess {Object}   res      Priority
     *
     * @apiUse          PriorityObject
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *    "res": {
     *      "id": 1
     *      "name": "Normal",
     *      "color": null
     *    }
     *  }
     *
     * @apiUse         400Error
     * @apiUse         ValidationError
     * @apiUse         UnauthorizedError
     * @apiUse         ItemNotFoundError
     */
    public function edit(UpdatePriorityRequest $request): JsonResponse
    {
        return $this->_edit($request);
    }

    /**
     * @api             {post} /priorities/remove Destroy
     * @apiDescription  Destroy User
     *
     * @apiVersion      1.0.0
     * @apiName         Destroy Priority
     * @apiGroup        Priority
     *
     * @apiUse          AuthHeader
     *
     * @apiParam {Integer}  id  ID of the target priority
     *
     * @apiParamExample {json} Request Example
     * {
     *   "id": 1
     * }
     *
     * @apiSuccess {String}   message  Destroy status
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *    "message": "Item has been removed"
     *  }
     *
     * @apiUse          400Error
     * @apiUse          ValidationError
     * @apiUse          ForbiddenError
     * @apiUse          UnauthorizedError
     */
    public function destroy(DestroyProjectRequest $request): JsonResponse
    {
        return $this->_destroy($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function count(CountPriorityRequest $request): JsonResponse
    {
        return $this->_count($request);
    }
}