import {FormManager} from "../../../Core/js/form";
import {Ajax} from "../../../Core/js/ajax";
import {pageManager} from "../../../Core/js/pageManager";
import {DatasourceAjax} from "../../../Core/js/datasourceAjax";
import {t} from "../../i18n.xml";
import {t as TCommonBase} from "../../../CommonBase/i18n.xml";
import {ObjectsList} from "../../../Core/js/ObjectsList/objectsList";
import {Permissions} from "../../../Core/js/permissions";
import {create} from "fast-creator";
import UserAttendanceSummaryItem from "../../Views/UserAttendanceSummaryItem.mpts"

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
            content: (row) => row.worker ? (row.worker.name + ' ' + row.worker.surname) : ''
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

export class userSummary {

    constructor(page, data) {
        this.page = page;
        page.querySelector('select[name="worker_id"]').append(...data.selects.user.map(x => create('option', {
            value: x.id,
            text: x.title
        })));
        this.load();
        for (const x of this.page.querySelectorAll('[name="startRange"],[name="endRange"],[name="worker_id"]')) {
            x.addEventListener('change', () => this.load());
        }
    }

    async load() {
        const startRange = this.page.querySelector('[name="startRange"]')
        const endRange = this.page.querySelector('[name="endRange"]')
        const workerSelect = this.page.querySelector('[name="worker_id"]')
        if (!startRange.value || !endRange.value) {
            const month = new Date();
            month.setDate(1)
            startRange.value = month.toISOString().split('T')[0];
            month.setMonth(month.getMonth() + 1);
            month.setDate(month.getDate() - 1);
            endRange.value = month.toISOString().split('T')[0];
        }
        const start = startRange.value;
        const end = endRange.value;
        const worker = workerSelect.value;
        const result = await Ajax.Attendance.userSummary(startRange.value, endRange.value, workerSelect.value);
        if (start == startRange.value && end == endRange.value && worker == workerSelect.value) {
            const tbody = this.page.querySelector('table.report tbody');
            while (tbody.firstChild) tbody.removeChild(tbody.firstChild);
            for (const row of result) {
                const dates=[row.scheduleItem?.start,row.scheduleItem?.end, row.attendance?.startWorker??row.attendance?.startAdded, row.attendance?.endWorker??row.attendance?.endAdded].filter(x=>x).sort();
                const diff = (new Date(dates[dates.length-1]).getTime() - new Date(dates[0]).getTime());
                row.isMultiDay = diff > 24*60*60*1000;
                if(row.isMultiDay) {
                    row.date = dates[0].substring(0,10);
                }else{
                    row.date =[...new Set(dates.map(x=>x.substring(0,10)))].join(' / ');
                }
                console.log(row);

                tbody.appendChild(UserAttendanceSummaryItem(row));
            }
        }
    }
}
