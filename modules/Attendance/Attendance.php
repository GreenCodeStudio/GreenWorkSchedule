<?php

namespace Attendance;

use Attendance\Repository\AttendanceRepository;

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

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["Attendance", "Attendance", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];
        $ret['worker_id'] = $data->worker_id;
        $ret['startUser_id'] = empty($data->startUser_id) ? null : $data->startUser_id;
        $ret['endUser_id'] = empty($data->endUser_id) ? null : $data->endUser_id;
        $ret['startAdded'] = empty($data->startAdded) ? null : $data->startAdded;
        $ret['startWorker'] = empty($data->startWorker) ? null : $data->startWorker;
        $ret['startSupervisor'] = empty($data->startSupervisor) ? null : $data->startSupervisor;
        $ret['endAdded'] = empty($data->endAdded) ? null : $data->endAdded;
        $ret['endWorker'] = empty($data->endWorker) ? null : $data->endWorker;
        $ret['endSupervisor'] = empty($data->endSupervisor) ? null : $data->endSupervisor;

        return $ret;
    }

    public function insert($data): int
    {
        $filtered = $this->filterData($data);

        $id = $this->defaultDB->insert($filtered);
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
        $user = new Repository\userRepository();
        $ret["user"] = $user->getSelect();
        $user = new Repository\userRepository();
        $ret["user"] = $user->getSelect();
        $user = new Repository\userRepository();
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
}
