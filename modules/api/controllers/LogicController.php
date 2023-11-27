<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\LogicResource;
use app\modules\api\controllers\BaseController;

class LogicController extends BaseController
{
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = LogicResource::class;
}