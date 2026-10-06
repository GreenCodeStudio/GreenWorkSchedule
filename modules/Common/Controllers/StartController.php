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
        $lastAttendances = new Attendance()->getLastByUserId(Authorization::getUserId(), 5);
        $nextScheduleItems = (new \WorkSchedule\WorkScheduleItem())->getNextByUserId(Authorization::getUserId());
        $this->addView('Common', 'Start', ['workScheduleData' => [
            'nextScheduleItems' => $nextScheduleItems,
            'isEmpty' => empty($nextScheduleItems)
        ],
            'attendanceData' => [
                'currentAttendance' => $currentAttendance,
                'lastAttendances' => $lastAttendances]]);
    }
}
