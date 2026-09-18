<?php

namespace WorkSchedule;

use CommonBase\UniversalExporter\UeItem;
use CommonBase\UniversalExporter\UniversalExporter;
use User\Repository\UserRepository;
use WorkSchedule\Repository\WorkScheduleItemRepository;
use WorkSchedule\Repository\WorkScheduleRepository;

class WorkScheduleItem extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new WorkScheduleItemRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["WorkSchedule", "WorkScheduleItem", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];
        $ret['user_id'] = $data->user_id;
        $ret['work_schedule_id'] = empty($data->work_schedule_id) ? null : $data->work_schedule_id;
        $ret['start'] = $data->start;
        $ret['end'] = $data->end;

        return $ret;
    }

    public function insert($data): int
    {
        $filtered = $this->filterData($data);

        $id = $this->defaultDB->insert($filtered);
        \Core\WebSocket\Sender::sendToUsers(["WorkSchedule", "WorkScheduleItem", "Insert", $id]);
        return $id;
    }

    public function getAll()
    {
        return $this->defaultDB->getAll();
    }

    public function getSelects()
    {
        $ret = [];
        $user = new UserRepository();
        $ret["user"] = $user->getSelect();
        $work_schedule = new WorkScheduleRepository();
        $ret["work_schedule"] = $work_schedule->getSelect();
        return $ret;
    }

    public function export(string $type, object $options)
    {
        $options->start = 0;
        $options->limit = 1000000;
        $rows = $this->defaultDB->getDataTable($options)['rows'];
        return (new UniversalExporter('WorkScheduleItem'))->export($type, $rows, fn($row)=>[new UeItem('start', 'Start', $row->start), new UeItem('end', 'End', $row->end)]);
    }
}
