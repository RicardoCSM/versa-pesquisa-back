<?php

namespace app\modules\api\resources;

use app\models\Survey;

class SurveyResource extends Survey
{
    /**
     * Creates a new survey.
     * @param array $data
     * @return mixed
     */
    public static function createSurvey($data)
    {
        $model = new self();
        $model->load($data, '');

        if ($model->save()) {
            $theme = new ThemeResource();
            $theme->save();
            $model->theme_id = $theme->id;

            $settings = new SurveySettingResource();
            $settings->save();
            $model->setting_id = $settings->id;

            $model->save();

            $page = new PageResource();
            $page->survey_id = $model->id;
            $page->position = 1;
            $page->save();

            return $model;
        } else {
            return $model->errors;
        }
    }
}