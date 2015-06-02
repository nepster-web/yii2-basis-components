# Дата и Время

Хелпер **DateTimeHelper** работает с датой и временем, преобразуя их в строки различных форматов.


> **ВНИМАНИЕ:** В качестве параметра $datetime можно передавать как DateTime формат так и UNIX Timestamp формат.


Например:

```
DateTimeHelper::diffFullPeriod('2015-08-01 15:00:00', '2015-08-01 17:50:11') // 2 часа 50 минут
DateTimeHelper::diffFullPeriod(1433260571, 1433270782) // 2 часа 50 минут
```


# Методы

Возвращает время
```
DateTimeHelper::toTime($datetime)
```

Возвращает полную строку даты
```
DateTimeHelper::toFullDate($datetime)
```

Возвращает сокращенную строку даты
```
DateTimeHelper::toShortDate($datetime, $leadingZeros = true)
```

Возвращает полную строку даты и времени
```
DateTimeHelper::toFullDateTime($datetime, $separator = null)
```

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