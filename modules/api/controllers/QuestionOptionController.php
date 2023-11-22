<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\QuestionOptionResource;
use app\modules\api\controllers\BaseController;

class QuestionOptionController extends BaseController
{
    public $modelClass = QuestionOptionResource::class;
}