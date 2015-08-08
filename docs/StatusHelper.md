# Работа со статусами

Хелпер **StatusHelper** работает с определенными массивами статусов.


**Результат**:

```
use nepster\basis\helpers\StatusHelper;
```

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

Исходя из вышеприведенного Результата, метод вернет строку определенного цвета.


# Все методы

* ``StatusHelper::getList(array $items)``: Возвращает массив статусов в формате: ключ-значение.
    <br/>Результат: [1 => 'Хочу снять', 2 => 'Посредник', 3 => 'Собственник', 4 => 'Агенство']
    
    
* ``StatusHelper::getItem(array $statuses, $item)``: Рендер элемента.
    <br/>Результат: ```<span style="color: green">Посредник</span>```
    
    
* ``StatusHelper::booleanString($bool, $reverse = false, $options = [])``: Возвращает строку да или нет.
    <br/>Результат: ```<span style="color: green">Да</span>```
    
    
* ``StatusHelper::booleanArray($reverse = false)``: Возвращает массив да или нет.
    <br/>Результат: [0 => 'Нет', 1 => 'Да']
    