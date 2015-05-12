<?php

namespace nepster\basis\components;

use \DateTime as DateTime;
use yii\base\Component;
use yii\i18n\Formatter;
use Yii;

/**
 * Компонент работает с датой и временем, преобразуя их в строки различных форматов
 *
 * //TODO организовать документацию
 * //TODO организовать i18n, переводы
 *
 */
class DateTimeFormatter extends Component
{
    /**
     * @var
     */
    public $dateToTimeSeparator = ', ';

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
    public function toTime($datetime)
    {
        $formatter = $this->getFormatter($datetime);
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
    public function toFullDate($datetime)
    {
        $formatter = $this->getFormatter($datetime);
        return $formatter->asDate($datetime, 'd MMMM Y');
    }

    /**
     * Возвращает сокращенную строку даты
     *
     * Например: 9.05.2015
     *
     * @param $datetime
     * @return string
     */
    public function toShortDate($datetime)
    {
        $formatter = $this->getFormatter($datetime);
        return $formatter->asDate($datetime, 'd.MM.Y');
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
    public function toFullDateTime($datetime, $separator = null)
    {
        if ($separator === null) {
            $separator = $this->dateToTimeSeparator;
        }

        $formatter = $this->getFormatter($datetime);
        return str_replace('%', $separator, $formatter->asDate($datetime, 'd MMMM Y%k:mm'));
    }

    /**
     * Возвращает сокращенную строку даты и времени
     *
     * Например: 9.05.2015, 15:00
     *
     * @param $datetime
     * @param null $separator
     * @return mixed
     */
    public function toShortDateTime($datetime, $separator = null)
    {
        if ($separator === null) {
            $separator = $this->dateToTimeSeparator;
        }

        $formatter = $this->getFormatter($datetime);
        return str_replace('%', $separator, $formatter->asDate($datetime, 'd.MM.Y%k:mm'));
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
    public function diffFullPeriod($datetime1, $datetime2 = null, $reduce = false, $showSeconds = false)
    {
        $interval = self::getDiff($datetime1, $datetime2);

        $result = [];

        if ($interval->y > 0) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} г.', ['n' => $interval->y]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# год} few{# года} many{# лет} other{# лет} }', ['n' => $interval->y]);
            }
        }

        if ($interval->m > 0) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} м.', ['n' => $interval->m]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# месяц} few{# месяца} many{# месяцев} other{# месяцев} }', ['n' => $interval->m]);
            }
        }

        if ($interval->d > 0) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} д.', ['n' => $interval->d]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# день} few{# дня} many{# дней} other{# дней} }', ['n' => $interval->d]);
            }
        }

        if ($interval->h > 0) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} ч.', ['n' => $interval->h]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# час} few{# часа} many{# часов} other{# часов} }', ['n' => $interval->h]);
            }
        }

        if ($interval->i > 0) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} м.', ['n' => $interval->i]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# минута} few{# минуты} many{# минут} other{# минут} }', ['n' => $interval->i]);
            }
        }

        if ($interval->i <= 0 && $interval->s > 0 || $showSeconds) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} с.', ['n' => $interval->s]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# секунда} few{# секунды} many{# секунд} other{# секунд} }', ['n' => $interval->s]);
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
    public function diffDaysPeriod($datetime1, $datetime2 = null, $showTimeUntilDay = true)
    {
        $interval = self::getDiff($datetime1, $datetime2);

        if ($interval->days > 0) {
            return Yii::t('app', '{n, plural, one{# день} few{# дня} many{# дней} other{# дней} }', ['n' => $interval->days]);
        }

        if ($showTimeUntilDay) {
            $result = [];

            if ($interval->h > 0) {
                $result[] = Yii::t('app', '{n, plural, one{# час} few{# часа} many{# часов} other{# часов} }', ['n' => $interval->h]);
            }

            if ($interval->i > 0) {
                $result[] = Yii::t('app', '{n, plural, one{# минута} few{# минуты} many{# минут} other{# минут} }', ['n' => $interval->i]);
            }

            if ($interval->i <= 0 && $interval->s) {
                $result[] = Yii::t('app', '{n, plural, one{# секунда} few{# секунды} many{# секунд} other{# секунд} }', ['n' => $interval->s]);
            }

            return implode(' ', $result);
        }

        return Yii::t('app', '{n, plural, one{# день} few{# дня} many{# дней} other{# дней} }', ['n' => 1]);
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
    public function diffAgoPeriod($datetime1, $datetime2 = null, $reduce = false, $showSeconds = false)
    {
        $interval = self::getDiff($datetime1, $datetime2);

        $result = [];

        if ($interval->y > 0) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} г.', ['n' => $interval->y]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# год} few{# года} many{# лет} other{# лет} }', ['n' => $interval->y]);
            }
        }

        if ($interval->m > 0) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} м.', ['n' => $interval->m]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# месяц} few{# месяца} many{# месяцев} other{# месяцев} }', ['n' => $interval->m]);
            }
        }

        if ($interval->d > 0) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} д.', ['n' => $interval->d]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# день} few{# дня} many{# дней} other{# дней} }', ['n' => $interval->d]);
            }
        }

        if ($interval->h > 0) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} ч.', ['n' => $interval->h]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# час} few{# часа} many{# часов} other{# часов} }', ['n' => $interval->h]);
            }
        }

        if ($interval->i > 0) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} м.', ['n' => $interval->i]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# минуту} few{# минуты} many{# минут} other{# минут} }', ['n' => $interval->i]);
            }
        }

        if ($interval->i <= 0 && $interval->s > 0 || $showSeconds) {
            if ($reduce) {
                $result[] = Yii::t('app', '{n} с.', ['n' => $interval->s]);
            } else {
                $result[] = Yii::t('app', '{n, plural, one{# секунда} few{# секунды} many{# секунд} other{# секунд} }', ['n' => $interval->s]);
            }
        }

        if (isset($result[count($result) - 2])) {
            array_splice($result, count($result) - 1, 0, 'и');
        }

        return implode(' ', $result) . ' ' . Yii::t('app', 'назад');
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
    public function diffAgoPeriodRound($datetime1, $datetime2 = null, $reduce = false)
    {
        $interval = self::getDiff($datetime1, $datetime2);

        $result = [];

        if ($interval->y > 0) {
            if ($reduce) {
                $result = Yii::t('app', '{n} г.', ['n' => $interval->y]);
            } else {
                $result = Yii::t('app', '{n, plural, one{# год} few{# года} many{# лет} other{# лет} }', ['n' => $interval->y]);
            }
        } else if ($interval->m > 0) {
            if ($reduce) {
                $result = Yii::t('app', '{n} м.', ['n' => $interval->m]);
            } else {
                $result = Yii::t('app', '{n, plural, one{# месяц} few{# месяца} many{# месяцев} other{# месяцев} }', ['n' => $interval->m]);
            }
        } else if ($interval->d > 0) {
            if ($reduce) {
                $result = Yii::t('app', '{n} д.', ['n' => $interval->d]);
            } else {
                $result = Yii::t('app', '{n, plural, one{# день} few{# дня} many{# дней} other{# дней} }', ['n' => $interval->d]);
            }
        } else if ($interval->h > 0) {
            if ($reduce) {
                $result = Yii::t('app', '{n} ч.', ['n' => $interval->h]);
            } else {
                $result = Yii::t('app', '{n, plural, one{# час} few{# часа} many{# часов} other{# часов} }', ['n' => $interval->h]);
            }
        } else if ($interval->i > 0) {
            if ($reduce) {
                $result = Yii::t('app', '{n} м.', ['n' => $interval->i]);
            } else {
                $result = Yii::t('app', '{n, plural, one{# минуту} few{# минуты} many{# минут} other{# минут} }', ['n' => $interval->i]);
            }
        } else if ($interval->i <= 0 && $interval->s > 0) {
            if ($reduce) {
                $result = Yii::t('app', '{n} с.', ['n' => $interval->s]);
            } else {
                $result = Yii::t('app', '{n, plural, one{# секунда} few{# секунды} many{# секунд} other{# секунд} }', ['n' => $interval->s]);
            }
        }

        return $result . ' ' . Yii::t('app', 'назад');
    }

    /**
     * Возвращает список дней недели
     *
     * @return array
     */
    public function getDaysList()
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
    public function getMonthsList()
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
    public function getDiff($datetime1, $datetime2 = null)
    {
        $_datetime1 = new \DateTime();
        $_datetime1->setTimestamp($datetime1);

        $_datetime2 = new \DateTime();
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
    private function getFormatter($datetime)
    {
        $formatter = new Formatter();

        if (!is_numeric($datetime)) {
            $formatter->timeZone = 'UTC';
        }

        return $formatter;
    }

}