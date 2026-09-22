<?php
namespace Common\Controllers;
use Attendance\Attendance;
use Authorization\Authorization;
use Common\PageStandardController;

class StartController extends PageStandardController
{
    public function index()
    {
        $currentAttendance = new Attendance()->getCurrentByUserId(Authorization::getUserId());
        $this->addView('Attendance', 'AttendanceMe', ['currentAttendance' => $currentAttendance]);
    }
}
