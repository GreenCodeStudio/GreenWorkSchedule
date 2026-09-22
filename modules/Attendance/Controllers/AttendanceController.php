<?php

namespace Attendance\Controllers;

use Attendance\Attendance;
use Authorization\Authorization;
use Comment\Comment;
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
        $comments=(new Comment())->getToShow('Attendance', $id);
        $this->addView('Attendance', 'AttendanceShow', ['item' => $data, 'comments' => ['items'=>$comments]]);
        $this->pushBreadcrumb(['title' => 'Attendance', 'url' => '/Attendance']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/Attendance/show/'.$id]);
    }

    function me()
    {
        $currentAttendance = new Attendance()->getCurrentByUserId(Authorization::getUserId());
        $this->addView('Attendance', 'AttendanceMe', ['currentAttendance' => $currentAttendance]);
    }
    function userSummary()
    {
        $this->will('Attendance', 'show');
        $this->addView('Attendance', 'UserAttendanceSummary');
    }
    function userSummary_data()
    {
        $this->will('Attendance', 'show');
        $Attendance = new Attendance();
        return ['selects' => $Attendance->getSelects()];
    }
}
