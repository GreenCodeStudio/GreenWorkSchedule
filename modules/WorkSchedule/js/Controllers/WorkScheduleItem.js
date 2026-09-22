import {FormManager} from "../../../Core/js/form";
import {Ajax} from "../../../Core/js/ajax";
import {pageManager} from "../../../Core/js/pageManager";
import {DatasourceAjax} from "../../../Core/js/datasourceAjax";
import {t} from "../../i18n.xml";
import {t as TCommonBase} from "../../../CommonBase/i18n.xml";
import {ObjectsList} from "../../../Core/js/ObjectsList/objectsList";
import {Permissions} from "../../../Core/js/permissions";
import {UniversalExporter} from "../../../CommonBase/js/UniversalExporter";
import {create} from "fast-creator";

export class index {
    constructor(page, data) {
        const container = page.querySelector('.page-WorkScheduleItem-list .container');
        let datasource = new DatasourceAjax('WorkScheduleItem', 'getTable', ['WorkSchedule', 'WorkScheduleItem'], null, 'updateMultiple');
        let objectsList = new ObjectsList(datasource, 'calendarView');
        objectsList.allowTableEdit = true;
        objectsList.columns = [];
        objectsList.columns.push({
            name: t('WorkScheduleItem.user'),
            dataName: 'user',
            sortName: 'user',
            width: 100,
            widthGrow: 1,
            content: row => row.user.name + ' ' + row.user.surname

        });
        objectsList.columns.push({
            name: t('WorkScheduleItem.start'),
            dataName: 'start',
            sortName: 'start',
            width: 100,
            widthGrow: 1
        });
        objectsList.columns.push({
            name: t('WorkScheduleItem.end'),
            dataName: 'end',
            sortName: 'end',
            width: 100,
            widthGrow: 1
        });
        objectsList.generateActions = (rows, mode) => {
            let ret = [];
            if (rows.length == 1) {
                if (Permissions.can('WorkScheduleItem', 'edit')) {
                    ret.push({
                        name: TCommonBase("edit"),
                        icon: 'icon-edit',
                        href: "/WorkScheduleItem/edit/" + rows[0].id,
                        action: "edit"
                    });
                }
                if (Permissions.can('WorkScheduleItem', 'show')) {
                    ret.push({
                        name: TCommonBase("show"),
                        icon: 'icon-show',
                        href: "/WorkScheduleItem/show/" + rows[0].id,
                        action: "show",
                        main: true
                    });
                }
            }
            return ret;
        }
        objectsList.dateRowCallback = (row) => {
            console.log('sssss', row.start)
            return new Date(row.start);
        };
        objectsList.calendarRowCallback = (row) => {
            const element = create('div');
            element.append(create('div', {text: row.start.substring(11,16) + '-' + row.end.substring(11,16)}));
            element.append(create('div', {text: row.user.name + ' ' + row.user.surname}));
            return element;
        }
        objectsList.calendarDayActions = (day) => [
            {
                name: TCommonBase("add"),
                icon: 'icon-add',
                action: "add",
                href: '/WorkScheduleItem/add?date=' + day.toISOString().substring(0, 10),
                main: true,
            },
        ]
        objectsList.generateExports = UniversalExporter.generateObjectsListsExports(objectsList, '/WorkScheduleItem/export');
        container.append(objectsList);
        objectsList.refresh();
    }
}

export class edit {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        form.loadSelects(data.selects);
        form.load(data.WorkScheduleItem);

        form.submit = async newData => {
            await Ajax.WorkScheduleItem.update(newData);
            pageManager.goto('/WorkScheduleItem?date=' + newData.date);
        }
    }
}

export class add {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        form.loadUrlQuery();
        if (data && data.selects)
            form.loadSelects(data.selects);

        form.submit = async newData => {
            await Ajax.WorkScheduleItem.insert(newData);
            pageManager.goto('/WorkScheduleItem?date=' + newData.date);
        }
    }
}
