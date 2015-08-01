<?php

namespace nepster\basis\helpers;

use Yii;

/**
 * Хелпер работает с различными форматами данных, преобразуя их в строки
 *
 * StringHelper::formatBytes($bytes, $precision = 2) - Форматирует и конвертирует кол-во байт, возвращает строку
 * StringHelper::generateRandomString($length = 8, $allowUppercase = true) - Генерация случайной строки
 * StringHelper::closeTags($html) - Закрытие HTML тегов
 */
class StringHelper extends \nepster\basis\Basis
{
    /**
     * Форматирует и конвертирует кол-во байт, возвращает строку
     *
     * Например: 9.54 MB
     *
     * @param $bytes
     * @param int $precision
     * @return string
     */
    public static function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Генерация случайной строки
     *
     * @param int $length
     * @param bool $allowUppercase
     * @return string
     */
    public static function generateRandomString($length = 8, $allowUppercase = true)
    {
        $validCharacters = 'abcdefghijklmnopqrstuxyvwz1234567890';
        if ($allowUppercase) {
            $validCharacters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $validCharNumber = strlen($validCharacters);
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $index = mt_rand(0, $validCharNumber - 1);
            $result .= $validCharacters[$index];
        }
        return $result;
    }

    /**
     * Закрытие HTML тегов
     * TODO: (эта функция имеет недостатки и не в состоянии справиться с некоторыми ситуациями)
     *
     * @param string $html
     * @return string
     */
    public static function closeTags($html)
    {
        // Теги не требующие закрытия
        $arrSingleTags = ['meta', 'img', 'br', 'link', 'area'];

        // Получаем список тегов
        preg_match_all('#<([a-z1-6]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];

        // Закрытие соответствующего тега
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];

        if (count($closedtags) === count($openedtags)) {
            return $html;
        }

        // Последний открытый тег впереди
        $openedtags = array_reverse($openedtags);

        foreach ($openedtags as $key => $value) {
            if (in_array($value, $arrSingleTags)) {
                continue;
            }
            if (in_array($value, $closedtags)) {
                unset($closedtags[array_search($value, $closedtags)]);
            } else {
                $html .= '</'.$value.'>';
            }
        }

        return $html;
    }
}
