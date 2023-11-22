<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\LogicResource;
use app\modules\api\controllers\BaseController;

class LogicController extends BaseController
{
    public $modelClass = LogicResource::class;
}