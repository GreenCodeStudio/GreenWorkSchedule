<?php
namespace Attendance\Ajax;

use Attendance\Attendance;
use Authorization\Authorization;

class AttendanceAjax extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('Attendance', 'show');
        $Attendance = new \Attendance\Attendance();
        return $Attendance->getDataTable($options);
    }

    public function insert($data)
    {
        $this->will('Attendance', 'add');
        $Attendance = new \Attendance\Attendance();
        $id = $Attendance->insert($data, Authorization::getUserId());
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
