import {pageManager} from "../../Core/js/pageManager";
pageManager.registerController('WorkSchedule', () => import('./Controllers/WorkSchedule'));
pageManager.registerController('WorkScheduleItem', () => import('./Controllers/WorkScheduleItem'));