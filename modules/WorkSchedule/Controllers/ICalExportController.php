<?php

namespace WorkSchedule\Controllers;

use Authorization\Authorization;
use Core\Exceptions\NotFoundException;
use DateTimeImmutable;
use WorkSchedule\ICalExporter;
use WorkSchedule\Repository\ICalTokenRepository;
use WorkSchedule\WorkScheduleItem;

class ICalExportController extends \Common\PageStandardController
{

    function index(string $key)
    {
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cal.ics"');
        $calendarComponent=(new ICalExporter())->generateCallendar($key);
        if($calendarComponent===null){
            throw new NotFoundException();
        }
        echo $calendarComponent;
        exit;
    }
    public function hasPermission(string $methodName)
    {
        return true;
    }
}
