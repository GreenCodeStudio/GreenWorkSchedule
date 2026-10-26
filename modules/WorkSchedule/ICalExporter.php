<?php

namespace WorkSchedule;

use MKrawczyk\FunQuery\FunQuery;
use WorkSchedule\Repository\ICalTokenRepository;
use WorkSchedule\Repository\WorkScheduleItemRepository;

class ICalExporter
{
    public function getKeys(int $ownerUserId)
    {

        $all = (new ICalTokenRepository())->getAllToken($ownerUserId);
        if (empty($all)) {
            $all = bin2hex(random_bytes(16));
            (new ICalTokenRepository())->insert(['token' => $all, 'owner_user_id' => $ownerUserId]);
        }
        $own = (new ICalTokenRepository())->getUsersToken($ownerUserId, $ownerUserId);
        if (empty($own)) {
            $own = bin2hex(random_bytes(16));
            (new ICalTokenRepository())->insert(['token' => $own, 'owner_user_id' => $ownerUserId, 'target_user_id' => $ownerUserId]);
        }
        return ['all' => $all, 'own' => $own];
    }

    public function generateCallendar($token)
    {
        $tokenInfo = (new ICalTokenRepository())->getByToken($token);
        if (empty($tokenInfo)) {
            return null;
        }
        if ($tokenInfo->target_user_id) {
            $workScheduleItems = (new WorkScheduleItemRepository())->getAllForUser($tokenInfo->target_user_id);
        } else {
            $workScheduleItems = (new WorkScheduleItemRepository())->getAll();
        }
        $events = FunQuery::from($workScheduleItems)->map(function ($item) {
            return (new \Eluceo\iCal\Domain\Entity\Event())
                ->setSummary('Test')
                ->setDescription('Test desc...')
                ->setOccurrence(
                    new \Eluceo\iCal\Domain\ValueObject\TimeSpan(
                        new \Eluceo\iCal\Domain\ValueObject\DateTime(new \DateTime($item->start), false),
                        new \Eluceo\iCal\Domain\ValueObject\DateTime(new \DateTime($item->end), false),
                    )
                );
        });

// 2. Create Calendar domain entity
        $calendar = new \Eluceo\iCal\Domain\Entity\Calendar($events->toArray());

// 3. Transform domain entity into an iCalendar component
        $componentFactory = new \Eluceo\iCal\Presentation\Factory\CalendarFactory();
        return $componentFactory->createCalendar($calendar);

    }
}
