<?php

namespace nepster\basis\components;

use \ReflectionClass as ReflectionClass;
use yii\base\Component;
use Yii;

/**
 * Компонент BasicFormat организовывает единую точку доступа ко всем базовым расширениям
 */
class BasisFormat extends Component
{
    /**
     * @var string
     */
    public $namespaceHelpers = '\\nepster\basis\\helpers\\';

    /**
     * Возвращает инстанс класса хелпера
     * @param $helper
     * @return object
     */
    public function helper($helper)
    {
        $oReflectionClass = new ReflectionClass($this->namespaceHelpers . $helper . 'Helper');
        return $oReflectionClass->newInstance();
    }
}