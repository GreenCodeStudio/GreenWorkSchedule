<?php

namespace Attendance\Repository;

use Core\Database\DB;
use Exception;


class AttendanceRepository extends \Core\Repository
{

    public function __construct()
    {
        $this->archiveMode = static::ArchiveMode_OnlyExisting;
    }
    public function defaultTable(): string
    {
        return 'attendance';
    }
    public function getDataTable($options)
    {
        $start = (int)$options->start;
        $limit = (int)$options->limit;
        $sqlOrder = $this->getOrderSQL($options);
        $rows = DB::funquery("SELECT a.id, JSON_OBJECT('id',u.id, 'name',u.name ,'surname', u.surname) as worker,  IFNULL(a.startWorker, a.startAdded) as start, IFNULL(a.endWorker, a.endAdded) as end FROM attendance a LEFT JOIN user u ON a.worker_id = u.id $sqlOrder LIMIT $start,$limit")
            ->select(fn($x)=>[...(array)$x, 'worker'=>json_decode($x->worker)])
            ->toArray();
        $total = DB::get("SELECT count(*) as count FROM attendance")[0]->count;
        return ['rows' => $rows, 'total' => $total];
    }
        private function getOrderSQL($options)
    {
        if (empty($options->sort))
            return "";
        else {
            $mapping = ['worker_id'=> 'worker_id', 'startUser_id'=> 'startUser_id', 'endUser_id'=> 'endUser_id', 'startAdded'=> 'startAdded', 'startWorker'=> 'startWorker', 'startSupervisor'=> 'startSupervisor', 'endAdded'=> 'endAdded', 'endWorker'=> 'endWorker', 'endSupervisor'=> 'endSupervisor'];
            if (empty($mapping[$options->sort->col]))
                throw new Exception();
            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
        }
    }    public function getAll()
    {
        if($this->archiveMode == static::ArchiveMode_OnlyExisting)
            return DB::get("SELECT * FROM attendance WHERE is_archived = 0");
        else
            return DB::get("SELECT * FROM attendance");
    }

    public function getCurrentByUserId($getUserId)
    {
        return DB::get("SELECT * FROM (SELECT * FROM attendance WHERE worker_id = ? AND worker_id = startUser_id ORDER BY startAdded DESC LIMIT 1) sub WHERE endAdded is null", [$getUserId])[0]??null;
    }

    public function getToShow(int $id)
    {
        $item= DB::get("SELECT 
    a.*,
    JSON_OBJECT('id',w.id, 'name',w.name ,'surname', w.surname) as worker,
    JSON_OBJECT('id',su.id, 'name',su.name ,'surname', su.surname) as startUser,
    JSON_OBJECT('id',eu.id, 'name',eu.name ,'surname', eu.surname) as endUser
FROM attendance a
         LEFT JOIN user w ON a.worker_id = w.id
         LEFT JOIN user su ON a.startUser_id = su.id
            LEFT JOIN user eu ON a.endUser_id = eu.id
         WHERE a.id = ?", [$id])[0]??null;
        if(!empty($item)){
            $item->worker = json_decode($item->worker);
            $item->startUser = json_decode($item->startUser);
            $item->endUser = json_decode($item->endUser);
        }
        return $item;
    }

    public function getForUserSummary($startRange, $endRange, $workerId)
    {
        return DB::get("SELECT * FROM attendance WHERE worker_id = ? AND date(nullif(startWorker, startAdded)) BETWEEN ? AND ? ORDER BY nullif(startWorker, startAdded)", [$workerId, $startRange, $endRange]);
    }
}
