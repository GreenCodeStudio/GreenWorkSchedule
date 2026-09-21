<?php
namespace Attendance\Ajax;

use Attendance\Attendance;
use Common\Authorization\Authorization;

class AttendanceAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('Attendance', 'show');
        $Attendance = new \Attendance\Attendance();
        return $Attendance->getDataTable($options);
    }

    public function update($data)
    {
        $this->will('Attendance', 'edit');
        $Attendance = new \Attendance\Attendance();
        $Attendance->update($data->id, $data);
    }

    public function updateMultiple(array $data)
    {
        $this->will('Attendance', 'edit');
        $Attendance = new \Attendance\Attendance();
        foreach ($data as $row) {
            $Attendance->update($row->id, $row->data);
        }
    }

    public function insert($data)
    {
        $this->will('Attendance', 'add');
        $Attendance = new \Attendance\Attendance();
        $id = $Attendance->insert($data);
    }
    public function startWork()
    {
        (new Attendance())->startWork(Authorization::getUserId());
    }
    public function endWork()
    {
        (new Attendance())->endWork(Authorization::getUserId());
    }
}
