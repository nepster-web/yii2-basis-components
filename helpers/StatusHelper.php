<?php

namespace nepster\basis\helpers;

use yii\helpers\Html;
use yii;

/**
 * Class StatusHelper
 * Хелпер работает с определенными массивами статусов.
 *
 * Пример массива статусов:
 *
 *   public static function getUserTypeArray()
 *   {
 *      return [
 *          self::WANT_RENT => [
 *              'label' => 'Хочу снять',
 *              'style' => 'color: red',
 *          ],
 *          self::MEDIATOR => [
 *              'label' => 'Посредник',
 *              'style' => 'color: green',
 *          ],
 *          self::OWNER => [
 *              'label' => 'Собственник',
 *              'style' => 'color: blue',
 *          ],
 *          self::AGENCY => [
 *              'label' => 'Агенство',
 *              'style' => 'color: orange',
 *          ],
 *      ];
 *   }
 *
 * StatusHelper::getList(array $items) - Возвращает массив статусов в формате: ключ-значение
 * StatusHelper::getItem(array $statuses, $item) - Рендер элемента
 * StatusHelper::booleanString($bool, $reverse = false, $options = []) - Возвращает строку да или нет
 * StatusHelper::booleanArray($reverse = false) - Возвращает массив да или нет
 */
class StatusHelper extends \nepster\basis\Basis
{
    /**
     * Возвращает массив статусов в формате: ключ - значение
     *
     * @param array $items
     * @return array
     */
    public static function getList(array $items)
    {
        return array_map(function ($a) {
            return $a['label'];
        }, $items);
    }

    /**
     * Рендер элемента
     *
     * @param array $statuses
     * @param $item
     * @return false|string
     */
    public static function getItem(array $statuses, $item)
    {
        if (!isset($statuses[$item])) {
            return false;
        }

        $label = null;

        if (!is_array($statuses[$item]) || !isset($statuses[$item]['label'])) {
            return false;
        }

        if (isset($statuses[$item]['label']) && $statuses[$item]['label']) {
            $label = $statuses[$item]['label'];
        }

        unset($statuses[$item]['label']);

        return Html::tag('span', $label, $statuses[$item]);
    }

    /**
     * Возвращает строку да или нет
     *
     * @param $bool
     * @param bool $reverse
     * @param array $options
     * @return string
     */
    public static function booleanString($bool, $reverse = false, $options = [])
    {
        $yes = ['style' => 'color: green'];
        $no = ['style' => 'color: red'];

        if ($reverse) {
            $yes = ['style' => 'color: red'];
            $no = ['style' => 'color: green'];
        }

        if ($bool) {
            $options = array_merge($options, $yes);
            return Html::tag('span', Yii::t('yii', 'Yes'), $options);
        }

        $options = array_merge($options, $no);
        return Html::tag('span', Yii::t('yii', 'No'), $options);
    }

    /**
     * Возвращает массив да или нет
     *
     * @param bool $reverse
     * @return string
     */
    public static function booleanArray($reverse = false)
    {
        if ($reverse) {
            return [
                0 => Yii::t('yii', 'Yes'),
                1 => Yii::t('yii', 'No'),
            ];
        }

        return [
            0 => Yii::t('yii', 'No'),
            1 => Yii::t('yii', 'Yes'),
        ];
    }
}