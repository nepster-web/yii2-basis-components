<?php

namespace nepster\basis\helpers;

use \DateTime as DateTime;
use yii\i18n\Formatter;
use Yii;

/**
 * Хелпер работает с датой и временем, преобразуя их в строки различных форматов
 *
 * DateTimeHelper::toTime($datetime) - Возвращает время
 * DateTimeHelper::toFullDate($datetime) - Возвращает полную строку даты
 * DateTimeHelper::toShortDate($datetime, $leadingZeros = true) - Возвращает сокращенную строку даты
 * DateTimeHelper::toFullDateTime($datetime, $separator = null) - Возвращает полную строку даты и времени
 * DateTimeHelper::toShortDateTime($datetime, $separator = null, $leadingZeros = true) - Возвращает сокращенную строку даты и времени
 * DateTimeHelper::diffFullPeriod($datetime1, $datetime2 = null, $reduce = false, $showSeconds = false) - Считает разницу между датами и возвращает полный период между этими датами
 * DateTimeHelper::diffDaysPeriod($datetime1, $datetime2 = null, $showTimeUntilDay = true) - Считает разницу между датами и возвращает период состоящий из дней между этими датами
 * DateTimeHelper::diffAgoPeriodRound($datetime1, $datetime2 = null, $reduce = false) - Считает разницу между датами и возвращает округленный период между этими датами в прошедшем времени
 * DateTimeHelper::getDaysList() - Возвращает список дней недели
 * DateTimeHelper::getMonthsList() - Возвращает список месяцев
 * DateTimeHelper::getDiff($datetime1, $datetime2 = null) - Разница между датами
 *
 * //TODO вывод списка дней
 * //TODO вывод списка месяцев
 *
 */
class DateTimeHelper extends \nepster\basis\Basis
{
    /**
     * @var
     */
    public static $dateToTimeSeparator = ', ';

    /**
     * @var array
     */
    protected static $days = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday'
    ];

    /**
     * @var array
     */
    protected static $months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    /**
     * Возвращает время
     *
     * Например: 15:00
     *
     * @param $datetime
     * @return string
     */
    public static function toTime($datetime)
    {
        $formatter = self::getFormatter($datetime);
        return $formatter->asDate($datetime, 'k:mm');
    }

    /**
     * Возвращает полную строку даты
     *
     * Например: 9 мая 2015
     *
     * @param $datetime
     * @return string
     */
    public static function toFullDate($datetime)
    {
        $formatter = self::getFormatter($datetime);
        return $formatter->asDate($datetime, 'd MMMM Y');
    }

    /**
     * Возвращает сокращенную строку даты
     *
     * Например: 09.05.2015
     *
     * @param bool $leadingZeros Ведущий нуль
     * @param $datetime
     * @return string
     */
    public static function toShortDate($datetime, $leadingZeros = true)
    {
        $formatter = self::getFormatter($datetime);
        $format = $leadingZeros ? 'dd.MM.Y' : 'd.M.Y';
        return $formatter->asDate($datetime, $format);
    }

    /**
     * Возвращает полную строку даты и времени
     *
     * Например: 9 мая 2015, 15:00
     *
     * @param $datetime
     * @param null $separator
     * @return mixed
     */
    public static function toFullDateTime($datetime, $separator = null)
    {
        if ($separator === null) {
            $separator = self::$dateToTimeSeparator;
        }

        $formatter = self::getFormatter($datetime);
        return str_replace('%', $separator, $formatter->asDate($datetime, 'd MMMM Y%k:mm'));
    }

    /**
     * Возвращает сокращенную строку даты и времени
     *
     * Например: 9.05.2015, 15:00
     *
     * @param $datetime
     * @param bool $leadingZeros Ведущий нуль
     * @param null $separator
     * @return mixed
     */
    public static function toShortDateTime($datetime, $separator = null, $leadingZeros = true)
    {
        if ($separator === null) {
            $separator = self::$dateToTimeSeparator;
        }
        $formatter = self::getFormatter($datetime);
        $format = $leadingZeros ? 'dd.MM.Y%k:mm' : 'd.M.Y%k:mm';
        return str_replace('%', $separator, $formatter->asDate($datetime, $format));
    }

    /**
     * Считает разницу между датами
     * и возвращает полный период между этими датами
     *
     * Например:
     *  40 секунд
     *  19 минут
     *  1 час 9 минут
     *  1 день 2 часа 9 минут
     *  1 год 10 месяцев 17 дней 21 час 29 минут
     *  5 лет 18 дней 7 часов 15 минут
     *
     * @param $datetime1
     * @param null $datetime2
     * @param bool $reduce - Сокращает именование времени (например минута = м.)
     * @param bool $showSeconds - Показывать секунды
     * @return string
     */
    public static function diffFullPeriod($datetime1, $datetime2 = null, $reduce = false, $showSeconds = false)
    {
        static::initI18N();

        $interval = self::getDiff($datetime1, $datetime2);

        $result = [];

        if ($interval->y > 0) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} y.', ['n' => $interval->y]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# year} other{# years}}', ['n' => $interval->y]);
            }
        }

        if ($interval->m > 0) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} m.', ['n' => $interval->m]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# month} other{# months}}', ['n' => $interval->m]);
            }
        }

        if ($interval->d > 0) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} d.', ['n' => $interval->d]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# day} other{# days}}', ['n' => $interval->d]);
            }
        }

        if ($interval->h > 0) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} h.', ['n' => $interval->h]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# hour} other{# hours}}', ['n' => $interval->h]);
            }
        }

        if ($interval->i > 0) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} min.', ['n' => $interval->i]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# minute} other{# minutes}}', ['n' => $interval->i]);
            }
        }

        if ($interval->i <= 0 && $interval->s > 0 || $showSeconds) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} sec.', ['n' => $interval->s]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# second} other{# seconds}}', ['n' => $interval->s]);
            }
        }

        return implode(' ', $result);
    }

    /**
     * Считает разницу между датами
     * и возвращает период состоящий из дней между этими датами
     *
     * Например:
     *  40 секунд
     *  19 минут
     *  1 час 7 минут
     *  1 день
     *  687 дней
     *  1 845 дней
     *
     * @param $datetime1
     * @param null $datetime2
     * @param bool $showTimeUntilDay - Показывать время, когда дата менее одного дня
     * @return string
     */
    public static function diffDaysPeriod($datetime1, $datetime2 = null, $showTimeUntilDay = true)
    {
        $interval = self::getDiff($datetime1, $datetime2);

        if ($interval->days > 0) {
            return Yii::t('basis', '{n, plural, one{# day} other{# days}}', ['n' => $interval->d]);
        }

        if ($showTimeUntilDay) {
            $result = [];

            if ($interval->h > 0) {
                $result[] = Yii::t('basis', '{n, plural, one{# hour} other{# hours}}', ['n' => $interval->h]);
            }

            if ($interval->i > 0) {
                $result[] = Yii::t('basis', '{n, plural, one{# minute} other{# minutes}}', ['n' => $interval->i]);
            }

            if ($interval->i <= 0 && $interval->s) {
                $result[] = Yii::t('basis', '{n, plural, one{# second} other{# seconds}}', ['n' => $interval->s]);
            }

            return implode(' ', $result);
        }

        return Yii::t('basis', '{n, plural, one{# day} other{# days}}', ['n' => 1]);
    }

    /**
     * Считает разницу между датами
     * и возвращает полный период между этими датами
     * в прошедшем времени
     *
     * 40 секунд назад
     * 1 минуту назад
     * 1 час и 7 минут назад
     * 1 день 2 часа и 9 минут назад
     * 1 год 10 месяцев 17 дней 21 час и 29 минут назад
     * 5 лет 18 дней 7 часов и 15 минут назад
     *
     * @param $datetime1
     * @param null $datetime2
     * @param bool $reduce
     * @param bool $showSeconds
     * @return string
     */
    public static function diffAgoPeriod($datetime1, $datetime2 = null, $reduce = false, $showSeconds = false)
    {
        $interval = self::getDiff($datetime1, $datetime2);

        $result = [];

        if ($interval->y > 0) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} y.', ['n' => $interval->y]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# year} other{# years}}', ['n' => $interval->y]);
            }
        }

        if ($interval->m > 0) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} m.', ['n' => $interval->m]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# month} other{# months}}', ['n' => $interval->m]);
            }
        }

        if ($interval->d > 0) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} d.', ['n' => $interval->d]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# day} other{# days}}', ['n' => $interval->d]);
            }
        }

        if ($interval->h > 0) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} h.', ['n' => $interval->h]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# hour} other{# hours}}', ['n' => $interval->h]);
            }
        }

        if ($interval->i > 0) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} min.', ['n' => $interval->i]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# minute} other{# minutes}} ago', ['n' => $interval->i]);
            }
        }

        if ($interval->i <= 0 && $interval->s > 0 || $showSeconds) {
            if ($reduce) {
                $result[] = Yii::t('basis', '{n} sec.', ['n' => $interval->s]);
            } else {
                $result[] = Yii::t('basis', '{n, plural, one{# second} other{# seconds}} ago', ['n' => $interval->s]);
            }
        }

        if (isset($result[count($result) - 2])) {
            array_splice($result, count($result) - 1, 0, Yii::t('basis', 'and'));
        }

        return implode(' ', $result) . ' ' . Yii::t('basis', 'ago');
    }

    /**
     * Считает разницу между датами
     * и возвращает округленный период между этими датами
     * в прошедшем времени
     *
     *  40 секунд назад
     *  1 минуту назад
     *  1 час назад
     *  1 день назад
     *  1 год назад
     *  5 лет назад
     *
     * @param $datetime1
     * @param null $datetime2
     * @param bool $reduce
     * @return string
     */
    public static function diffAgoPeriodRound($datetime1, $datetime2 = null, $reduce = false)
    {
        $interval = self::getDiff($datetime1, $datetime2);

        $result = [];

        if ($interval->y > 0) {
            if ($reduce) {
                $result = Yii::t('basis', '{n} y.', ['n' => $interval->y]);
            } else {
                $result = Yii::t('basis', '{n, plural, one{# year} other{# years}}', ['n' => $interval->y]);
            }
        } else if ($interval->m > 0) {
            if ($reduce) {
                $result = Yii::t('basis', '{n} m.', ['n' => $interval->m]);
            } else {
                $result = Yii::t('basis', '{n, plural, one{# month} other{# months}}', ['n' => $interval->m]);
            }
        } else if ($interval->d > 0) {
            if ($reduce) {
                $result = Yii::t('basis', '{n} d.', ['n' => $interval->d]);
            } else {
                $result = Yii::t('basis', '{n, plural, one{# day} other{# days}}', ['n' => $interval->d]);
            }
        } else if ($interval->h > 0) {
            if ($reduce) {
                $result = Yii::t('basis', '{n} h.', ['n' => $interval->h]);
            } else {
                $result = Yii::t('basis', '{n, plural, one{# hour} other{# hours}}', ['n' => $interval->h]);
            }
        } else if ($interval->i > 0) {
            if ($reduce) {
                $result = Yii::t('basis', '{n} min.', ['n' => $interval->i]);
            } else {
                $result = Yii::t('basis', '{n, plural, one{# minute} other{# minutes}} ago', ['n' => $interval->i]);
            }
        } else if ($interval->i <= 0 && $interval->s > 0) {
            if ($reduce) {
                $result = Yii::t('basis', '{n} sec.', ['n' => $interval->s]);
            } else {
                $result = Yii::t('basis', '{n, plural, one{# second} other{# seconds}} ago', ['n' => $interval->s]);
            }
        }

        return $result . ' ' . Yii::t('basis', 'ago');
    }

    /**
     * Возвращает список дней недели
     *
     * @return array
     */
    public static function getDaysList()
    {
        $result = [];

        $formatter = new Formatter();

        foreach (self::$days as $day) {
            $result[] = $formatter->asDate($day, 'EEEE');
        }

        return $result;
    }

    /**
     * Возвращает список месяцев
     *
     * @return array
     */
    public static function getMonthsList()
    {
        $result = [];

        $formatter = new Formatter();

        foreach (self::$months as $month) {
            $result[] = $formatter->asDate($month, 'MMMM');
        }

        return $result;
    }

    /**
     * Разница между датами
     *
     * @param $datetime1
     * @param null $datetime2
     * @return bool|\DateInterval
     */
    public static function getDiff($datetime1, $datetime2 = null)
    {
        if (!$datetime2) {
            $datetime2 = time();
        }

        if (!is_numeric($datetime1)) {
            $datetime1 = strtotime($datetime1);
        }

        if (!is_numeric($datetime2)) {
            $datetime2 = strtotime($datetime2);
        }

        $_datetime1 = new DateTime();
        $_datetime1->setTimestamp($datetime1);

        $_datetime2 = new DateTime();
        $_datetime2->setTimestamp($datetime2);

        $interval = $_datetime1->diff($_datetime2);

        return $interval;
    }

    /**
     * Инициализирует Yii2 Formatter
     *
     * @param $datetime
     * @return Formatter
     */
    private static function getFormatter($datetime)
    {
        $formatter = new Formatter();

        if (!is_numeric($datetime)) {
            $formatter->timeZone = 'UTC';
        }

        return $formatter;
    }

}