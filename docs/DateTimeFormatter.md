# Дата и Время

Компонент **DateTimeFormatter** работает с датой и временем, преобразуя их в строки различных форматов.


# Настройка 

Сконфигурируйте Ваше приложение, добавив следующую настройку:

```
    'components' => [
        ..
        'dateTime' => [
            'class' => 'nepster\basis\components\DateTimeFormatter',
            'dateToTimeSeparator' => ', ',
        ],
        ...
    ]
```



# Методы
--------

**toTime($datetime)** - Возвращает время

Пример:
```Yii::$app->dateTime->toTime(time())```
        
Результат:
15:00

----------------------------

**toFullDate($datetime)** - Возвращает полную строку даты

Пример:
```Yii::$app->dateTime->toFullDate(time())```
        
Результат:
9 мая 2015

----------------------------

**toShortDate($datetime)** - Возвращает сокращенную строку даты

Пример:
```Yii::$app->dateTime->toShortDate(time())```
        
Результат:
9.05.2015

----------------------------

**toFullDateTime($datetime, $separator = null)** - Возвращает полную строку даты и времени

Пример:
```Yii::$app->dateTime->toFullDateTime(time())```
        
Результат:
9 мая 2015, 15:00

----------------------------

**toShortDateTime($datetime, $separator = null)** - Возвращает сокращенную строку даты и времени

Пример:
```Yii::$app->dateTime->toShortDateTime(time())```
        
Результат:
9.05.2015, 15:00

----------------------------