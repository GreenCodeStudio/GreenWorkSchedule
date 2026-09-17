<?php

namespace WorkSchedule\Repository;

use Core\Database\DB;
use Exception;


class WorkScheduleItemRepository extends \Core\Repository
{

    public function __construct()
    {
        $this->archiveMode = static::ArchiveMode_OnlyExisting;
    }
    public function defaultTable(): string
    {
        return 'work_schedule_item';
    }
    public function getDataTable($options)
    {
        $start = (int)$options->start;
        $limit = (int)$options->limit;
        $sqlOrder = $this->getOrderSQL($options);
        $rows = DB::get("SELECT * FROM work_schedule_item $sqlOrder LIMIT $start,$limit");
        $total = DB::get("SELECT count(*) as count FROM work_schedule_item")[0]->count;
        return ['rows' => $rows, 'total' => $total];
    }
        private function getOrderSQL($options)
    {
        if (empty($options->sort))
            return "";
        else {
            $mapping = ['id'=> 'id', 'user_id'=> 'user_id', 'work_schedule_id'=> 'work_schedule_id', 'start'=> 'start', 'end'=> 'end'];
            if (empty($mapping[$options->sort->col]))
                throw new Exception();
            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
        }
    }    public function getAll()
    {
        if($this->archiveMode == static::ArchiveMode_OnlyExisting)
            return DB::get("SELECT * FROM work_schedule_item WHERE is_archived = 0");
        else
            return DB::get("SELECT * FROM work_schedule_item");
    }
}