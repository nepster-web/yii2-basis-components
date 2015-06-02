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
 *   public static function getUserTypeArray($id = null)
 *   {
 *      return [
 *          self::WANT_RENT => [
 *              'label' => 'Хочу снять',
 *              'color' => 'green',
 *          ],
 *          self::MEDIATOR => [
 *              'label' => 'Посредник',
 *              'color' => 'green',
 *          ],
 *          self::OWNER => [
 *              'label' => 'Собственник',
 *              'color' => 'green',
 *          ],
 *          self::AGENCY => [
 *              'label' => 'Агенство',
 *              'color' => 'green',
 *          ],
 *      ];
 *   }
 */
class StatusHelper
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
     * @param array $options
     * @return false|string
     */
    public static function getItem(array $statuses, $item, $options = [])
    {
        if (!isset($statuses[$item])) {
            return false;
        }

        $label = null;
        $style = null;

        if (!is_array($statuses[$item]) || !$statuses[$item] || !isset($statuses[$item]['label'])) {
            return false;
        }

        if (isset($statuses[$item]['label']) && $statuses[$item]['label']) {
            $label = $statuses[$item]['label'];
        }

        ///TODO: добавить возможность поддержки всех свойств

        if ((isset($statuses[$item]['color']) && $statuses[$item]['color'])) {
            $style .= 'color: ' . $statuses[$item]['color'];
        }

        $_options = array_merge($options, [
            'style' => $style
        ]);

        return Html::tag('span', $label, $_options);
    }

    /**
     * Возвращает строку да или нет
     *
     * @param $bool
     * @param bool $reverse
     * @return string
     */
    public static function BooleanString($bool, $reverse = false)
    {
        $yesColor = 'green';
        $noColor = 'red';

        if ($reverse) {
            $yesColor = 'red';
            $noColor = 'green';
        }

        if ($bool) {
            return Html::tag('span', Yii::t('yii', 'Yes'), ['style' => 'color:' . $yesColor]);
        }

        return Html::tag('span', Yii::t('yii', 'No'), ['style' => 'color:' . $noColor]);
    }

    /**
     * Возвращает массив да или нет
     *
     * @param bool $reverse
     * @return string
     */
    public static function BooleanArray($reverse = false)
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