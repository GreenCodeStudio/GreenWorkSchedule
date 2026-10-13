<?php

namespace Common;

class PageStandardController extends \Core\StandardController
{
    use \CommonBase\PageStandardControllerTrait;
    public function getPageTitle(): string
    {
        return "Green Work Schedule";
    }
    public function getPageHeader()
    {
        return ['title' => 'Green Work Schedule'];
    }
}

