<?php

namespace Attendance;

use Attendance\Repository\AttendanceRepository;
use User\Repository\UserRepository;
use WorkSchedule\Repository\WorkScheduleItemRepository;

class Attendance extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new AttendanceRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }


    public function insert($data, int $userId): int
    {
        $start=new \DateTime($data->date.' '.$data->start);
        $end=new \DateTime($data->date.' '.$data->end);
        if($start>$end){
            $end->add(new \DateInterval('P1D'));
        }

        $id = $this->defaultDB->insert([
            'worker_id' => $data->worker_id,
            'startUser_id' => $userId,
            'startAdded' => date('Y-m-d H:i:s'),
            'startWorker'=>$start->format('Y-m-d H:i:s'),
            'endUser_id' => $userId,
            'endAdded' => date('Y-m-d H:i:s'),
            'endWorker'=>$end->format('Y-m-d H:i:s'),
        ]);
        \Core\WebSocket\Sender::sendToUsers(["Attendance", "Attendance", "Insert", $id]);
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
        return $ret;
    }

    public function startWork($getUserId)
    {
        $this->defaultDB->insert([
            'worker_id' => $getUserId,
            'startUser_id' => $getUserId,
            'startAdded' => date('Y-m-d H:i:s')
        ]);
    }

    public function getCurrentByUserId($getUserId)
    {
        return $this->defaultDB->getCurrentByUserId($getUserId);
    }

    public function endWork($getUserId)
    {
        $current = $this->defaultDB->getCurrentByUserId($getUserId);
        if ($current == null) {
            $this->defaultDB->insert([
                'worker_id' => $getUserId,
                'endUser_id' => $getUserId,
                'endAdded' => date('Y-m-d H:i:s')
            ]);
        } else {
            $this->defaultDB->update($current->id, [
                'endUser_id' => $getUserId,
                'endAdded' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function getToShow(int $id)
    {
        return $this->defaultDB->getToShow($id);
    }

    public function userSummary($startRange, $endRange, $workerId)
    {
        $attendance =(new AttendanceRepository())->getForUserSummary($startRange, $endRange, $workerId);
        $scheduleItems=(new WorkScheduleItemRepository())->getForUserSummary($startRange, $endRange, $workerId);
        return [
            'attendance'=>$attendance,
            'scheduleItems'=>$scheduleItems
        ];
    }
}
