<?php
namespace WorkSchedule\Ajax;

class WorkScheduleAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('WorkSchedule', 'show');
        $WorkSchedule = new \WorkSchedule\WorkSchedule();
        return $WorkSchedule->getDataTable($options);
    }

    public function update($data)
    {
        $this->will('WorkSchedule', 'edit');
        $WorkSchedule = new \WorkSchedule\WorkSchedule();
        $WorkSchedule->update($data->id, $data);
    }
    
    public function updateMultiple(array $data)
    {      
        $this->will('WorkSchedule', 'edit');
        $WorkSchedule = new \WorkSchedule\WorkSchedule();
        foreach ($data as $row) {
            $WorkSchedule->update($row->id, $row->data);
        }
    }

    public function insert($data)
    {
        $this->will('WorkSchedule', 'add');
        $WorkSchedule = new \WorkSchedule\WorkSchedule();
        $id = $WorkSchedule->insert($data);
    }
}