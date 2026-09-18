<?php

namespace WorkSchedule\Ajax;

class WorkScheduleItemAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('WorkScheduleItem', 'show');
        $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        return $WorkScheduleItem->getDataTable($options);
    }

    public function update($data)
    {
        $this->will('WorkScheduleItem', 'edit');
        $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        $WorkScheduleItem->update($data->id, $data);
    }

    public function updateMultiple(array $data)
    {
        $this->will('WorkScheduleItem', 'edit');
        $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        foreach ($data as $row) {
            $WorkScheduleItem->update($row->id, $row->data);
        }
    }

    public function insert($data)
    {
        $this->will('WorkScheduleItem', 'add');
        $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        $id = $WorkScheduleItem->insert($data);
    }
}
