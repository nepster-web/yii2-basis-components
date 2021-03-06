# Дата и Время

Хелпер **DateTimeHelper** работает с датой и временем, преобразуя их в строки различных форматов.


> **ВНИМАНИЕ:** В качестве параметра $datetime можно передавать как DateTime формат так и UNIX Timestamp формат.


**Результат:**

```
use nepster\basis\helpers\DateTimeHelper;
```

```
DateTimeHelper::diffFullPeriod('2015-08-01 15:00:00', '2015-08-01 17:50:11') // 2 часа 50 минут
DateTimeHelper::diffFullPeriod(1433260571, 1433270782) // 2 часа 50 минут
```


# Все методы

* ``DateTimeHelper::toTime($datetime)``: Возвращает время.
    <br/>Результат: 12:59
    
    
* ``DateTimeHelper::toFullDate($datetime)``: Возвращает полную строку даты.
    <br/>Результат: 9 мая 2015
    
    
* ``DateTimeHelper::toShortDate($datetime, $leadingZeros = true)``: Возвращает сокращенную строку даты.
    <br/>Результат: 23.06.2015
    
    
* ``DateTimeHelper::toFullDateTime($datetime, $separator = null)``: Возвращает полную строку даты и времени
    <br/>Результат: 23 июня 2015, 12:59
    
    
* ``DateTimeHelper::toShortDateTime($datetime, $separator = null, $leadingZeros = true)``: Возвращает сокращенную строку даты и времени
    <br/>Результат: 23.06.2015, 12:59
    
    
* ``DateTimeHelper::diffFullPeriod($datetime1, $datetime2 = null, $reduce = false, $showSeconds = false)``: Считает разницу между датами и возвращает полный период между этими датами
    <br/>Результат:
    <br/> - 40 секунд
    <br/> - 19 минут
    <br/> - 1 час 9 минут
    <br/> - 1 день 2 часа 9 минут
    <br/> - 1 год 10 месяцев 17 дней 21 час 29 минут
    <br/> - 5 лет 18 дней 7 часов 15 минут 
    
    
* ``DateTimeHelper::diffDaysPeriod($datetime1, $datetime2 = null, $showTimeUntilDay = true)``: Считает разницу между датами и возвращает период состоящий из дней между этими датами
    <br/>Результат: 
    <br/> - 40 секунд
    <br/> - 19 минут
    <br/> - 1 час 7 минут
    <br/> - 1 день
    <br/> - 17 дней
    <br/> - 18 дней 
    
    
* ``DateTimeHelper::diffAgoPeriodRound($datetime1, $datetime2 = null, $reduce = false)``: Считает разницу между датами и возвращает округленный период между этими датами в прошедшем времени
    <br/>Результат: 
    <br/> - 40 секунд назад
    <br/> - 1 минуту назад
    <br/> - 1 час и 7 минут назад
    <br/> - 1 день 2 часа и 9 минут назад
    <br/> - 1 год 10 месяцев 17 дней 21 час и 29 минут назад
    <br/> - 5 лет 18 дней 7 часов и 15 минут назад 
    
    
* ``DateTimeHelper::diffAgoPeriodRound($datetime1, $datetime2 = null, $reduce = false)``: Считает разницу между датами и возвращает округленный период между этими датами в прошедшем времени
    <br/>Результат: 
    <br/> - 40 секунд назад
    <br/> - 1 минуту назад
    <br/> - 1 час назад
    <br/> - 1 день назад
    <br/> - 1 год назад
    <br/> - 5 лет назад

    
* ``DateTimeHelper::getDaysList()``: Возвращает список дней недели
    <br/>Результат:
    ```
    Array
    (
        [0] => Понедельник
        [1] => Вторник
        [2] => Среда
        [3] => Четверг
        [4] => Пятница
        [5] => Суббота
        [6] => Воскресенье
    )
    ```
    
    
* ``DateTimeHelper::getMonthsList($declension = false)``: Возвращает список месяцев
    <br/>Результат:
    ```
    Array
    (
        [1] => Январь
        [2] => Февраль
        [3] => Март
        [4] => Апрель
        [5] => Май
        [6] => Июнь
        [7] => Июль
        [8] => Август
        [9] => Сентябрь
        [10] => Октябрь
        [11] => Ноябрь
        [12] => Декабрь
    )
    ```
    
    
* ``DateTimeHelper::getTimeUnitsList()``: Возвращает список единиц измерения времени
    <br/>Результат:
    ```
    Array
    (
        [week] => неделя
        [second] => секунда
        [minute] => минута
        [day] => день
        [hour] => час
        [month] => месяц
        [year] => год
    )
    ```


* ``DateTimeHelper::getDiff($datetime1, $datetime2 = null)``: Разница между датами
    <br/>Результат:
    ```
    DateInterval Object
    (
        [y] => 0
        [m] => 2
        [d] => 0
        [h] => 3
        [i] => 12
        [s] => 10
        [weekday] => 0
        [weekday_behavior] => 0
        [first_last_day_of] => 0
        [invert] => 0
        [days] => 61
        [special_type] => 0
        [special_amount] => 0
        [have_weekday_relative] => 0
        [have_special_relative] => 0
    )
    ```