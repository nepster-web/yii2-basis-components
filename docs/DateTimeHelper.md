# Дата и Время

Хелпер **DateTimeHelper** работает с датой и временем, преобразуя их в строки различных форматов.


> **ВНИМАНИЕ:** В качестве параметра $datetime можно передавать как DateTime формат так и UNIX Timestamp формат.


**Пример:**

```
use nepster\basis\helpers\DateTimeHelper;
```

```
DateTimeHelper::diffFullPeriod('2015-08-01 15:00:00', '2015-08-01 17:50:11') // 2 часа 50 минут
DateTimeHelper::diffFullPeriod(1433260571, 1433270782) // 2 часа 50 минут
```


# Методы

* ``DateTimeHelper::toTime($datetime)``: Возвращает время.
    <br/>Пример: 12:59
    
    
* ``DateTimeHelper::toFullDate($datetime)``: Возвращает полную строку даты.
    <br/>Пример: 23 июня 2015
    
    
* ``DateTimeHelper::toFullDate($datetime)``: Возвращает сокращенную строку даты.
    <br/>Пример: 23.06.2015
    
    
* ``DateTimeHelper::toFullDateTime($datetime, $separator = null)``: Возвращает полную строку даты и времени
    <br/>Пример: 23 июня 2015, 12:59
    
    
* ``DateTimeHelper::toShortDateTime($datetime, $separator = null, $leadingZeros = true)``: Возвращает сокращенную строку даты и времени
    <br/>Пример: 23.06.2015, 12:59
    
    
* ``DateTimeHelper::diffFullPeriod($datetime1, $datetime2 = null, $reduce = false, $showSeconds = false)``: Считает разницу между датами и возвращает полный период между этими датами
    <br/>Пример:
    <br/> - 40 секунд
    <br/> - 19 минут
    <br/> - 1 час 9 минут
    <br/> - 1 день 2 часа 9 минут
    <br/> - 1 год 10 месяцев 17 дней 21 час 29 минут
    <br/> - 5 лет 18 дней 7 часов 15 минут 
    
    
* ``DateTimeHelper::diffDaysPeriod($datetime1, $datetime2 = null, $showTimeUntilDay = true)``: Считает разницу между датами и возвращает период состоящий из дней между этими датами
    <br/>Пример: 
    
    
* ``DateTimeHelper::diffAgoPeriodRound($datetime1, $datetime2 = null, $reduce = false)``: Считает разницу между датами и возвращает округленный период между этими датами в прошедшем времени
    <br/>Пример: 
    
    
* ``DateTimeHelper::getDaysList()``: Возвращает список дней недели
    <br/>Пример: 
    
    
* ``DateTimeHelper::getMonthsList()``: Возвращает список месяцев
    <br/>Пример: 
    
    
* ``DateTimeHelper::getDiff($datetime1, $datetime2 = null)``: Разница между датами
    <br/>Пример: 