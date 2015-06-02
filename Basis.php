<?php

namespace nepster\basis;

use Yii;

/**
 * Class Basis
 */
class Basis
{
    /**
     * Инициализация переводов
     */
    public static function initI18N()
    {
        if (!empty(Yii::$app->i18n->translations['basis'])) {
            return;
        }
        Yii::setAlias("@nepster/basis/", __DIR__);
        Yii::$app->i18n->translations['basis'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@nepster/basis/messages",
            'forceTranslation' => true
        ];
    }
}