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
        $event = (new \Eluceo\iCal\Domain\Entity\Event())
            ->setSummary('Test')
            ->setDescription('Test desc...')
            ->setOccurrence(
                new \Eluceo\iCal\Domain\ValueObject\TimeSpan(
                    new DateTime(),
                    (new DateTime())->modify('+1 hour')
                )
            );

// 2. Create Calendar domain entity
        $calendar = new \Eluceo\iCal\Domain\Entity\Calendar([$event]);

// 3. Transform domain entity into an iCalendar component
        $componentFactory = new \Eluceo\iCal\Presentation\Factory\CalendarFactory();
        $calendarComponent = $componentFactory->createCalendar($calendar);

// 5. Output
        echo $calendarComponent;
        exit;
    }
    public function hasPermission(string $methodName)
    {
        return true;
    }
}
