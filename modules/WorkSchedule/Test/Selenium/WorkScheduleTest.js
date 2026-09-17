
        const BaseSeleniumTest = require("../../../E2eTests/Test/Selenium/baseSeleniumTest");
const {Key, By} = require("selenium-webdriver");
const {expect} = require("chai");
const {DataGenerator} = require("../../../E2eTests/Test/Selenium/DataGenerator");
const {E2eTestLog} = require("../../../E2eTests/Test/Selenium/E2eTestLog");

module.exports = class WorkScheduleTest extends BaseSeleniumTest {
    constructor(driver) {
        super(driver);
        this.exampleItem = {
            "name": "sdfdsvrfd",
            "country": "pl",
            "VATIN": "8464865214",
            "REGON": "4356234554",
            "KRS": "98744536412",
            "address": "hgjyghfhbbdf",
            "postal": "00-000",
            "city": "sdfsdes"
        };
        this.exampleItemRandom = {
            "name": DataGenerator.generateRandomString(),
            "country": DataGenerator.generateRandomString(2),
            "VATIN": DataGenerator.generateRandomInt(1e9, 1e10 - 1).toString(),
            "REGON": DataGenerator.generateRandomInt(1e9, 1e10 - 1).toString(),
            "KRS": DataGenerator.generateRandomInt(1e9, 1e10 - 1).toString(),
            "address": DataGenerator.generateRandomString(),
            "postal": "00-000",
            "city": DataGenerator.generateRandomString()
        };
    }

    async mainTest() {
        await this.navigateToList();
        await this.addNew(this.exampleItem, true);
        await this.addNew(this.exampleItemRandom, false);
    }

    async navigateToList() {
        E2eTestLog.header("Navigate to list", 3)
        await this.clickElement("a[href=\"/WorkSchedule\"]")
        await this.asleep(1000);
        await this.takeScreenshot("WorkSchedule-list-before");
        for (const name in this.exampleItem) {
            const value = this.exampleItem[name];
            if (typeof value === "string" && value.length > 5) {
                expect(await this.driver.findElement(By.css(".page-WorkSchedule-list")).getText()).to.not.contain(value);
            }
        }
    }

    async addNew(item, assert) {
        E2eTestLog.header(`Add new (assert: ${assert})`, 3)
        await this.clickElement("a[href=\"/WorkSchedule/add\"]")
        await this.asleep(1000);
        await this.takeScreenshot("WorkSchedule-add-before", assert);
        for (const name in item) {
            const value = item[name];
            await this.sendKeysToElement("form [name=\"" + name + "\"]", value);
        }
        await this.asleep(200);
        await this.takeScreenshot("WorkSchedule-add-filled", assert);
        await this.clickElement("form button");
        await this.asleep(2000);
        await this.takeScreenshot("WorkSchedule-afterAdd", assert);
    }
};