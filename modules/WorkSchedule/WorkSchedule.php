<?php
namespace WorkSchedule;

use WorkSchedule\Repository\WorkScheduleRepository;

class WorkSchedule extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new WorkScheduleRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["WorkSchedule", "WorkSchedule", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];
        $ret['id'] = $data->id;
$ret['name'] = $data->name;

        return $ret;
    }

    public function insert($data):int
    {
        $filtered = $this->filterData($data);
        
        $id = $this->defaultDB->insert($filtered);
        \Core\WebSocket\Sender::sendToUsers(["WorkSchedule", "WorkSchedule", "Insert", $id]);
        return $id;
    }
    public function getAll()
    {
        return $this->defaultDB->getAll();
    }
    
    
}