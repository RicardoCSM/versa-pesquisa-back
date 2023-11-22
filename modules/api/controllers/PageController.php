<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\PageResource;
use app\modules\api\controllers\BaseController;

class PageController extends BaseController
{
    public $modelClass = PageResource::class;
}