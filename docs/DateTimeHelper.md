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


Возвращает сокращенную строку даты и времени
```
DateTimeHelper::toShortDateTime($datetime, $separator = null, $leadingZeros = true)
```

Считает разницу между датами и возвращает полный период между этими датами
```
DateTimeHelper::diffFullPeriod($datetime1, $datetime2 = null, $reduce = false, $showSeconds = false)
```

Считает разницу между датами и возвращает период состоящий из дней между этими датами
```
DateTimeHelper::diffDaysPeriod($datetime1, $datetime2 = null, $showTimeUntilDay = true)
```

Считает разницу между датами и возвращает округленный период между этими датами в прошедшем времени
```
DateTimeHelper::diffAgoPeriodRound($datetime1, $datetime2 = null, $reduce = false)
```

Возвращает список дней недели
```
DateTimeHelper::getDaysList()
```

Возвращает список месяцев
```
DateTimeHelper::getMonthsList()
```

Разница между датами
```
DateTimeHelper::getDiff($datetime1, $datetime2 = null)
```





* ``DateTimeHelper::toTime($datetime) ``: Возвращает время.
    <br/>Пример: 12:59
    
    
* ``DateTimeHelper::toFullDate($datetime) ``: Возвращает полную строку даты.
    <br/>Пример: 23 июня 2015
    
    
* ``DateTimeHelper::toFullDate($datetime) ``: Возвращает сокращенную строку даты.
    <br/>Пример: 23.06.2015



  
  
  
  

| Метод                                                                                                | Пример                  | Описание                                        |
| :----------------------------------------------------------------------------------------------------|:------------------------|:------------------------------------------------|
| DateTimeHelper::toFullDate($datetime)                                                                |             |                    |
| DateTimeHelper::toShortDate($datetime, $leadingZeros = true)                                         |               |               |
| DateTimeHelper::toFullDateTime($datetime, $separator = null)                                         | 23 июня 2015, 12:59     | Возвращает полную строку даты и времени         |
| DateTimeHelper::toShortDateTime($datetime, $separator = null, $leadingZeros = true)                  |      | Возвращает сокращенную строку даты и времени                       |
| DateTimeHelper::diffFullPeriod($datetime1, $datetime2 = null, $reduce = false, $showSeconds = false) |      | Считает разницу между датами и возвращает полный период между этими датами                    |
| DateTimeHelper::diffDaysPeriod($datetime1, $datetime2 = null, $showTimeUntilDay = true)              |      | Считает разницу между датами и возвращает период состоящий из дней между этими датами         |
| DateTimeHelper::diffAgoPeriodRound($datetime1, $datetime2 = null, $reduce = false)                   |      | Считает разницу между датами и возвращает округленный период между этими датами в прошедшем времени |
| DateTimeHelper::getDaysList()                                                                        |      | Возвращает список дней недели |
| DateTimeHelper::getMonthsList()                                                                      |      | Возвращает список месяцев     |
| DateTimeHelper::getDiff($datetime1, $datetime2 = null)                                               |      | Разница между датами          |
