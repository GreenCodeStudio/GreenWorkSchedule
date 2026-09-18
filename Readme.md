# Green Work Schedule

Green Work Schedule is an open-source app for managing worker's scheudle, leaves and work-hours.

You can use it in our cloud at https://greenworkschedule.green-code.studio/ or run it on your own server.

## Features

* Schedule
* Leaves
* Attendance

## Pricing

Cloud hosting on our servers is paid (excluding the free plan with limits), but if you run Green Work Schedule on your own server, it is free with no limits.

## License

MIT


## Installation guide

1. Install web server (for example Nginx) with PHP (8.5 or higher)
2. Install MySQL and create empty database
3. Install PowerShell (pwsh) - on Windows it's built-in, but can be in old version, on Linux and MacOS you need to install it.
2. Download ZIP archive from releases page and extract.
3. Configure web server to point to `public_html` directory.
4. Fill .env file
5. Run in powershell script creating tables in MySQL:

```powershell
. ./script;
Upgrade-Migration;
```
