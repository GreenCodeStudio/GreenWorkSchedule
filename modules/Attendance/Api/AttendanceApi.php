<?php
namespace Attendance\Api;

class AttendanceApi extends \Core\ApiController
{
/**
     * @ApiEndpoint(
 *   'type' => 'get',
 *   'url' => 'Attendance',
 *   'tags' => 
 *   array (
 *     0 => 'Attendance-Attendance',
 *   ),
 *   'description' => 'Get list of Attendance',
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
 *                 'worker_id' => 
 *                 array (
 *                   'type' => 'int',
 *                   'format' => NULL,
 *                 ),
 *                 'startUser_id' => 
 *                 array (
 *                   'type' => 'int',
 *                   'format' => NULL,
 *                 ),
 *                 'endUser_id' => 
 *                 array (
 *                   'type' => 'int',
 *                   'format' => NULL,
 *                 ),
 *                 'startAdded' => 
 *                 array (
 *                   'type' => 'datetime',
 *                   'format' => 'date-time',
 *                 ),
 *                 'startWorker' => 
 *                 array (
 *                   'type' => 'datetime',
 *                   'format' => 'date-time',
 *                 ),
 *                 'startSupervisor' => 
 *                 array (
 *                   'type' => 'datetime',
 *                   'format' => 'date-time',
 *                 ),
 *                 'endAdded' => 
 *                 array (
 *                   'type' => 'datetime',
 *                   'format' => 'date-time',
 *                 ),
 *                 'endWorker' => 
 *                 array (
 *                   'type' => 'datetime',
 *                   'format' => 'date-time',
 *                 ),
 *                 'endSupervisor' => 
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
        $this->will('Attendance', 'show');
        $Attendance = new \Attendance\Attendance();
        return $Attendance->getAll();
    }
    
    /**
     * @ApiEndpoint(
 *   'type' => 'get',
 *   'url' => 'Attendance/{id}',
 *   'tags' => 
 *   array (
 *     0 => 'Attendance-Attendance',
 *   ),
 *   'description' => 'Get one Attendance',
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
 *               'worker_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'startUser_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'endUser_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'startAdded' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'startWorker' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'startSupervisor' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'endAdded' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'endWorker' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'endSupervisor' => 
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
        $this->will('Attendance', 'show');
        $Attendance = new \Attendance\Attendance();
        return $Attendance->getById($id);
    }
     /**
     * @ApiEndpoint(
 *   'type' => 'post',
 *   'url' => 'Attendance',
 *   'tags' => 
 *   array (
 *     0 => 'Attendance-Attendance',
 *   ),
 *   'description' => 'Insert one Attendance',
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
 *             'worker_id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'startUser_id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'endUser_id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'startAdded' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'startWorker' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'startSupervisor' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'endAdded' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'endWorker' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'endSupervisor' => 
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
 *               'worker_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'startUser_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'endUser_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'startAdded' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'startWorker' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'startSupervisor' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'endAdded' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'endWorker' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'endSupervisor' => 
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
        $this->will('Attendance', 'add');
        $Attendance = new \Attendance\Attendance();
        $id = $Attendance->insert($data);
        return $Attendance->getById($id);
    }
    
        /**
     * @ApiEndpoint(
 *   'type' => 'put',
 *   'url' => 'Attendance/{id}',
 *   'tags' => 
 *   array (
 *     0 => 'Attendance-Attendance',
 *   ),
 *   'description' => 'Insert one Attendance',
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
 *             'worker_id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'startUser_id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'endUser_id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'startAdded' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'startWorker' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'startSupervisor' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'endAdded' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'endWorker' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'endSupervisor' => 
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
 *               'worker_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'startUser_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'endUser_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'startAdded' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'startWorker' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'startSupervisor' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'endAdded' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'endWorker' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'endSupervisor' => 
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
        $this->will('Attendance', 'edit');
        $Attendance = new \Attendance\Attendance();
        $Attendance->update($id, $data);
        return $Attendance->getById($id);
    }
    

}