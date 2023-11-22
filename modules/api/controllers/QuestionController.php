<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\QuestionResource;
use app\modules\api\controllers\BaseController;

class QuestionController extends BaseController
{
    public $modelClass = QuestionResource::class;

}