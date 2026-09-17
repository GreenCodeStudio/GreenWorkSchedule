<?php
namespace WorkSchedule\Api;

class WorkScheduleItemApi extends \Core\ApiController
{
/**
     * @ApiEndpoint(
 *   'type' => 'get',
 *   'url' => 'WorkScheduleItem',
 *   'tags' => 
 *   array (
 *     0 => 'WorkSchedule-WorkScheduleItem',
 *   ),
 *   'description' => 'Get list of WorkScheduleItem',
 *   'responses' => 
 *   array (
 *     200 => 
 *     array (
 *       'content' => 
 *       array (
 *         'application/json' => 
 *         array (
 *           'schema' => 
 *           array (
 *             'type' => 'array',
 *             'items' => 
 *             array (
 *               'type' => 'object',
 *               'properties' => 
 *               array (
 *                 'id' => 
 *                 array (
 *                   'type' => 'int(11)',
 *                   'format' => NULL,
 *                 ),
 *                 'user_id' => 
 *                 array (
 *                   'type' => 'int(11)',
 *                   'format' => NULL,
 *                 ),
 *                 'work_schedule_id' => 
 *                 array (
 *                   'type' => 'int(11)',
 *                   'format' => NULL,
 *                 ),
 *                 'start' => 
 *                 array (
 *                   'type' => 'datetime',
 *                   'format' => 'date-time',
 *                 ),
 *                 'end' => 
 *                 array (
 *                   'type' => 'datetime',
 *                   'format' => 'date-time',
 *                 ),
 *               ),
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
     **/
    public function getList()
    {
        $this->will('WorkScheduleItem', 'show');
        $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        return $WorkScheduleItem->getAll();
    }
    
    /**
     * @ApiEndpoint(
 *   'type' => 'get',
 *   'url' => 'WorkScheduleItem/{id}',
 *   'tags' => 
 *   array (
 *     0 => 'WorkSchedule-WorkScheduleItem',
 *   ),
 *   'description' => 'Get one WorkScheduleItem',
 *   'parameters' => 
 *   array (
 *     0 => 
 *     array (
 *       'name' => 'id',
 *       'in' => 'path',
 *       'required' => true,
 *     ),
 *   ),
 *   'responses' => 
 *   array (
 *     200 => 
 *     array (
 *       'content' => 
 *       array (
 *         'application/json' => 
 *         array (
 *           'schema' => 
 *           array (
 *             'type' => 'object',
 *             'properties' => 
 *             array (
 *               'id' => 
 *               array (
 *                 'type' => 'int(11)',
 *                 'format' => NULL,
 *               ),
 *               'user_id' => 
 *               array (
 *                 'type' => 'int(11)',
 *                 'format' => NULL,
 *               ),
 *               'work_schedule_id' => 
 *               array (
 *                 'type' => 'int(11)',
 *                 'format' => NULL,
 *               ),
 *               'start' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'end' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
     **/
    public function getOneById(int $id)
    {
        $this->will('WorkScheduleItem', 'show');
        $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        return $WorkScheduleItem->getById($id);
    }
     /**
     * @ApiEndpoint(
 *   'type' => 'post',
 *   'url' => 'WorkScheduleItem',
 *   'tags' => 
 *   array (
 *     0 => 'WorkSchedule-WorkScheduleItem',
 *   ),
 *   'description' => 'Insert one WorkScheduleItem',
 *   'requestBody' => 
 *   array (
 *     'content' => 
 *     array (
 *       'application/json' => 
 *       array (
 *         'schema' => 
 *         array (
 *           'type' => 'object',
 *           'properties' => 
 *           array (
 *             'id' => 
 *             array (
 *               'type' => 'int(11)',
 *               'format' => NULL,
 *             ),
 *             'user_id' => 
 *             array (
 *               'type' => 'int(11)',
 *               'format' => NULL,
 *             ),
 *             'work_schedule_id' => 
 *             array (
 *               'type' => 'int(11)',
 *               'format' => NULL,
 *             ),
 *             'start' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'end' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 *   'responses' => 
 *   array (
 *     200 => 
 *     array (
 *       'content' => 
 *       array (
 *         'application/json' => 
 *         array (
 *           'schema' => 
 *           array (
 *             'type' => 'object',
 *             'properties' => 
 *             array (
 *               'id' => 
 *               array (
 *                 'type' => 'int(11)',
 *                 'format' => NULL,
 *               ),
 *               'user_id' => 
 *               array (
 *                 'type' => 'int(11)',
 *                 'format' => NULL,
 *               ),
 *               'work_schedule_id' => 
 *               array (
 *                 'type' => 'int(11)',
 *                 'format' => NULL,
 *               ),
 *               'start' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'end' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
     **/
    public function insert($data)
    {
        $this->will('WorkScheduleItem', 'add');
        $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        $id = $WorkScheduleItem->insert($data);
        return $WorkScheduleItem->getById($id);
    }
    
        /**
     * @ApiEndpoint(
 *   'type' => 'put',
 *   'url' => 'WorkScheduleItem/{id}',
 *   'tags' => 
 *   array (
 *     0 => 'WorkSchedule-WorkScheduleItem',
 *   ),
 *   'description' => 'Insert one WorkScheduleItem',
 *   'parameters' => 
 *   array (
 *     0 => 
 *     array (
 *       'name' => 'id',
 *       'in' => 'path',
 *       'required' => true,
 *     ),
 *   ),
 *   'requestBody' => 
 *   array (
 *     'content' => 
 *     array (
 *       'application/json' => 
 *       array (
 *         'schema' => 
 *         array (
 *           'type' => 'object',
 *           'properties' => 
 *           array (
 *             'id' => 
 *             array (
 *               'type' => 'int(11)',
 *               'format' => NULL,
 *             ),
 *             'user_id' => 
 *             array (
 *               'type' => 'int(11)',
 *               'format' => NULL,
 *             ),
 *             'work_schedule_id' => 
 *             array (
 *               'type' => 'int(11)',
 *               'format' => NULL,
 *             ),
 *             'start' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'end' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 *   'responses' => 
 *   array (
 *     200 => 
 *     array (
 *       'content' => 
 *       array (
 *         'application/json' => 
 *         array (
 *           'schema' => 
 *           array (
 *             'type' => 'object',
 *             'properties' => 
 *             array (
 *               'id' => 
 *               array (
 *                 'type' => 'int(11)',
 *                 'format' => NULL,
 *               ),
 *               'user_id' => 
 *               array (
 *                 'type' => 'int(11)',
 *                 'format' => NULL,
 *               ),
 *               'work_schedule_id' => 
 *               array (
 *                 'type' => 'int(11)',
 *                 'format' => NULL,
 *               ),
 *               'start' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'end' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
     **/
    public function update($data, int $id)
    {
        $this->will('WorkScheduleItem', 'edit');
        $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        $WorkScheduleItem->update($id, $data);
        return $WorkScheduleItem->getById($id);
    }
    

}