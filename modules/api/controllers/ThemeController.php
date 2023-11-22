<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\ThemeResource;
use app\modules\api\controllers\BaseController;

class ThemeController extends BaseController
{
    public $modelClass = ThemeResource::class;
}