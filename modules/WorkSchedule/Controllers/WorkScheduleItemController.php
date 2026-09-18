<?php

namespace WorkSchedule\Controllers;

use Authorization\Permissions;
use Core\Exceptions\NotFoundException;
use WorkSchedule\WorkScheduleItem;

class WorkScheduleItemController extends \Common\PageStandardController
{

    function index()
    {
        $this->will('WorkScheduleItem', 'show');
        $this->addView('WorkSchedule', 'WorkScheduleItemList');
        $this->pushBreadcrumb(['title' => 'WorkScheduleItem', 'url' => '/WorkScheduleItem']);

    }

    /**
     * @param int $id
     * @OfflineDataOnly
     */
    function edit(int $id)
    {
        $this->will('WorkScheduleItem', 'edit');
        $this->addView('WorkSchedule', 'WorkScheduleItemEdit', ['type' => 'edit']);
        $this->pushBreadcrumb(['title' => 'WorkScheduleItem', 'url' => '/WorkScheduleItem']);
        $this->pushBreadcrumb(['title' => 'Edycja', 'url' => '/WorkScheduleItem/edit/'.$id]);
    }

    function edit_data(int $id)
    {
        $this->will('WorkScheduleItem', 'edit');
        $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        $data = $WorkScheduleItem->getToEdit($id);
        if ($data == null)
            throw new NotFoundException();
        return ['WorkScheduleItem' => $data,'selects'=>$WorkScheduleItem->getSelects()];
    }

    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('WorkScheduleItem', 'add');
        $this->addView('WorkSchedule', 'WorkScheduleItemEdit', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'WorkScheduleItem', 'url' => '/WorkScheduleItem']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/WorkScheduleItem/add']);
    }
    function add_data()
    {
        $this->will('WorkScheduleItem', 'add');
        $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        return ['selects' => $WorkScheduleItem->getSelects()];
    }

        /**
     * @param int $id
     */
    function show(int $id)
    {
        $this->will('WorkScheduleItem', 'show');
                $WorkScheduleItem = new \WorkSchedule\WorkScheduleItem();
        $data = $WorkScheduleItem->getById($id);
        if ($data == null)
            throw new NotFoundException();

        $this->addView('WorkSchedule', 'WorkScheduleItemShow', ['item' => $data]);
        $this->pushBreadcrumb(['title' => 'WorkScheduleItem', 'url' => '/WorkScheduleItem']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/WorkScheduleItem/show/'.$id]);
    }

    public function export()
    {
        ob_end_clean();
        ['mime'=>$mime, 'data'=>$data]= (new WorkScheduleItem())->export($_POST['type'], json_decode($_POST['options']));
        header('Content-type: ' . $mime);
        echo $data;
        exit;
    }
}
