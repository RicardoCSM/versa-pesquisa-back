<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\QuestionOptionResource;
use app\modules\api\controllers\BaseController;

class QuestionOptionController extends BaseController
{
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = QuestionOptionResource::class;
}