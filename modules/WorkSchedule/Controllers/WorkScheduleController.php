<?php

namespace WorkSchedule\Controllers;

use Core\Exceptions\NotFoundException;

class WorkScheduleController extends \Common\PageStandardController
{

    function index()
    {
        $this->will('WorkSchedule', 'show');
        $this->addView('WorkSchedule', 'WorkScheduleList');
        $this->pushBreadcrumb(['title' => 'WorkSchedule', 'url' => '/WorkSchedule']);

    }

    /**
     * @param int $id
     * @OfflineDataOnly
     */
    function edit(int $id)
    {
        $this->will('WorkSchedule', 'edit');
        $this->addView('WorkSchedule', 'WorkScheduleEdit', ['type' => 'edit']);
        $this->pushBreadcrumb(['title' => 'WorkSchedule', 'url' => '/WorkSchedule']);
        $this->pushBreadcrumb(['title' => 'Edycja', 'url' => '/WorkSchedule/edit/'.$id]);
    }

    function edit_data(int $id)
    {
        $this->will('WorkSchedule', 'edit');
        $WorkSchedule = new \WorkSchedule\WorkSchedule();
        $data = $WorkSchedule->getById($id);
        if ($data == null)
            throw new NotFoundException();
        return ['WorkSchedule' => $data];
    }

    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('WorkSchedule', 'add');
        $this->addView('WorkSchedule', 'WorkScheduleEdit', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'WorkSchedule', 'url' => '/WorkSchedule']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/WorkSchedule/add']);
    }


        /**
     * @param int $id
     */
    function show(int $id)
    {
        $this->will('WorkSchedule', 'show');
                $WorkSchedule = new \WorkSchedule\WorkSchedule();
        $data = $WorkSchedule->getById($id);
        if ($data == null)
            throw new NotFoundException();

        $this->addView('WorkSchedule', 'WorkScheduleShow', ['item' => $data]);
        $this->pushBreadcrumb(['title' => 'WorkSchedule', 'url' => '/WorkSchedule']);
        $this->pushBreadcrumb(['title' => 'Szczegóły', 'url' => '/WorkSchedule/show/'.$id]);
    }
}
