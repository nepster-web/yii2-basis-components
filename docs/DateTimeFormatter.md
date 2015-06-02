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

```
Yii::$app->dateTime->toTime(time()) // 15:00
```


**toFullDate($datetime)** - Возвращает полную строку даты

```
Yii::$app->dateTime->toFullDate(time()) // 9 мая 2015
```


**toShortDate($datetime)** - Возвращает сокращенную строку даты

```
Yii::$app->dateTime->toShortDate(time()) // 9.5.2015
```


**toFullDateTime($datetime, $separator = null)** - Возвращает полную строку даты и времени

```
Yii::$app->dateTime->toFullDateTime(time()) // 9 мая 2015, 15:00
```


**toShortDateTime($datetime, $separator = null)** - Возвращает сокращенную строку даты и времени

```
Yii::$app->dateTime->toShortDateTime(time()) // 9.5.2015, 15:00
```


// TODO организовать документацию