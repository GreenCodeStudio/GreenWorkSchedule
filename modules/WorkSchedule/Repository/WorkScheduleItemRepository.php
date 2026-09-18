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
        $rows = DB::funquery("SELECT wsi.id, wsi.start, wsi.end, json_object('id',wsi.user_id, 'name',u.name, 'surname',u.surname) as user FROM work_schedule_item wsi JOIN user u ON u.id = wsi.user_id $sqlOrder LIMIT $start,$limit")->map(fn($row)=>(object)[...(array)$row, 'user'=>json_decode($row->user)])->toArray();
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
