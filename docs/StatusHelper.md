# Работа со статусами

Хелпер **StatusHelper** работает с определенными массивами статусов.


Например:

```
    public static function getUserTypeArray()
    {
       return [
           self::WANT_RENT => [
               'label' => 'Хочу снять',
               'style' => 'color: red',
           ],
           self::MEDIATOR => [
               'label' => 'Посредник',
               'style' => 'color: green',
           ],
           self::OWNER => [
               'label' => 'Собственник',
               'style' => 'color: blue',
           ],
           self::AGENCY => [
               'label' => 'Агенство',
               'style' => 'color: orange',
           ],
       ];
    }
```


Вернет элемент с указанными опциями:

```
StatusHelper::getItem($statuses, $item)
```

Исходя из вышеприведенного примера, вернет строку определенного цвета.


# Методы
--------

Возвращает массив статусов в формате: ключ-значение
```
StatusHelper::getList(array $items)
```

Рендер элемента
```
StatusHelper::getItem(array $statuses, $item)
```

Возвращает строку да или нет
```
StatusHelper::booleanString($bool, $reverse = false, $options = [])
```
```

Возвращает массив да или нет
```
StatusHelper::booleanArray($reverse = false)
```