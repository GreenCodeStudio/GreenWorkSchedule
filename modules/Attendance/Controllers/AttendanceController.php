<?php

namespace Attendance\Controllers;

use Attendance\Attendance;
use Authorization\Authorization;
use Core\Exceptions\NotFoundException;

class AttendanceController extends \Common\PageStandardController
{

    function index()
    {
        $this->will('Attendance', 'show');
        $this->addView('Attendance', 'AttendanceList');
        $this->pushBreadcrumb(['title' => 'Attendance', 'url' => '/Attendance']);

    }


    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('Attendance', 'add');
        $this->addView('Attendance', 'AttendanceAdd', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'Attendance', 'url' => '/Attendance']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/Attendance/add']);
    }
    function add_data()
    {
        $this->will('Attendance', 'add');
        $Attendance = new Attendance();
        return ['selects' => $Attendance->getSelects()];
    }

        /**
     * @param int $id
     */
    function show(int $id)
    {
        $this->will('Attendance', 'show');
                $Attendance = new Attendance();
        $data = $Attendance->getToShow($id);
        if ($data == null)
            throw new NotFoundException();
        $this->addView('Attendance', 'AttendanceShow', ['item' => $data]);
        $this->pushBreadcrumb(['title' => 'Attendance', 'url' => '/Attendance']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/Attendance/show/'.$id]);
    }

    function me()
    {
        $currentAttendance = new Attendance()->getCurrentByUserId(Authorization::getUserId());
        dump($currentAttendance);
        $this->addView('Attendance', 'AttendanceMe', ['currentAttendance' => $currentAttendance]);
    }
}
