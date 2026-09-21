import {FormManager} from "../../../Core/js/form";
import {Ajax} from "../../../Core/js/ajax";
import {pageManager} from "../../../Core/js/pageManager";
import {DatasourceAjax} from "../../../Core/js/datasourceAjax";
import {t} from "../../i18n.xml";
import {t as TCommonBase} from "../../../CommonBase/i18n.xml";
import {ObjectsList} from "../../../Core/js/ObjectsList/objectsList";
import {Permissions} from "../../../Core/js/permissions";

export class index {
    constructor(page, data) {
        const container = page.querySelector('.page-Attendance-list .container');
        let datasource = new DatasourceAjax('Attendance', 'getTable', ['Attendance', 'Attendance'], null, 'updateMultiple');
        let objectsList = new ObjectsList(datasource);
        objectsList.allowTableEdit = true;
        objectsList.columns = [];
        objectsList.columns.push({
            name: t('Attendance.worker'),
            dataName: 'worker',
            sortName: 'worker',
            width: 100,
            widthGrow: 1,
            content: (row) => row.worker?(row.worker.name+' '+row.worker.surname):''
        });
        objectsList.columns.push({
            name: t('Attendance.start'),
            dataName: 'start',
            sortName: 'start',
            width: 100,
            widthGrow: 1
        });
        objectsList.columns.push({
            name: t('Attendance.end'),
            dataName: 'end',
            sortName: 'end',
            width: 100,
            widthGrow: 1
        });
        objectsList.generateActions = (rows, mode) => {
            let ret = [];
            if (rows.length == 1) {
                if (Permissions.can('Attendance', 'edit')) {
                    ret.push({
                        name: TCommonBase("edit"),
                        icon: 'icon-edit',
                        href: "/Attendance/edit/" + rows[0].id,
                        action: "edit"
                    });
                }
                if (Permissions.can('Attendance', 'show')) {
                    ret.push({
                        name: TCommonBase("show"),
                        icon: 'icon-show',
                        href: "/Attendance/show/" + rows[0].id,
                        action: "show",
                        main: true
                    });
                }
            }
            return ret;
        }
        container.append(objectsList);
        objectsList.refresh();
    }
}


export class add {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        if (data && data.selects)
            form.loadSelects(data.selects);

        form.submit = async newData => {
            await Ajax.Attendance.insert(newData);
            pageManager.goto('/Attendance');
        }
    }
}

export class me {
    constructor(page, data) {
        page.querySelector('.startWorkBtn').addEventListener('click', async () => {
            await Ajax.Attendance.startWork();
        })
        page.querySelector('.endWorkBtn').addEventListener('click', async () => {
            await Ajax.Attendance.endWork();
        })
    }
}
