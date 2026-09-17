<?php
namespace WorkSchedule\Api;

class WorkScheduleApi extends \Core\ApiController
{
/**
     * @ApiEndpoint(
 *   'type' => 'get',
 *   'url' => 'WorkSchedule',
 *   'tags' => 
 *   array (
 *     0 => 'WorkSchedule-WorkSchedule',
 *   ),
 *   'description' => 'Get list of WorkSchedule',
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
 *                 'name' => 
 *                 array (
 *                   'type' => 'text',
 *                   'format' => NULL,
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
        $this->will('WorkSchedule', 'show');
        $WorkSchedule = new \WorkSchedule\WorkSchedule();
        return $WorkSchedule->getAll();
    }
    
    /**
     * @ApiEndpoint(
 *   'type' => 'get',
 *   'url' => 'WorkSchedule/{id}',
 *   'tags' => 
 *   array (
 *     0 => 'WorkSchedule-WorkSchedule',
 *   ),
 *   'description' => 'Get one WorkSchedule',
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
 *               'name' => 
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
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
        $this->will('WorkSchedule', 'show');
        $WorkSchedule = new \WorkSchedule\WorkSchedule();
        return $WorkSchedule->getById($id);
    }
     /**
     * @ApiEndpoint(
 *   'type' => 'post',
 *   'url' => 'WorkSchedule',
 *   'tags' => 
 *   array (
 *     0 => 'WorkSchedule-WorkSchedule',
 *   ),
 *   'description' => 'Insert one WorkSchedule',
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
 *             'name' => 
 *             array (
 *               'type' => 'text',
 *               'format' => NULL,
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
 *               'name' => 
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
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
        $this->will('WorkSchedule', 'add');
        $WorkSchedule = new \WorkSchedule\WorkSchedule();
        $id = $WorkSchedule->insert($data);
        return $WorkSchedule->getById($id);
    }
    
        /**
     * @ApiEndpoint(
 *   'type' => 'put',
 *   'url' => 'WorkSchedule/{id}',
 *   'tags' => 
 *   array (
 *     0 => 'WorkSchedule-WorkSchedule',
 *   ),
 *   'description' => 'Insert one WorkSchedule',
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
 *             'name' => 
 *             array (
 *               'type' => 'text',
 *               'format' => NULL,
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
 *               'name' => 
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
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
        $this->will('WorkSchedule', 'edit');
        $WorkSchedule = new \WorkSchedule\WorkSchedule();
        $WorkSchedule->update($id, $data);
        return $WorkSchedule->getById($id);
    }
    

}