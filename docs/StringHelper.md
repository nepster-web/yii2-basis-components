# Работа со строками

Хелпер **StringHelper** работает с различными форматами данных, преобразуя их в строки


Пример:

```
StringHelper::formatBytes(10000000) // 9.54 MB
```


# Все методы
    
* ``StringHelper::formatBytes($bytes, $precision = 2)``: Форматирует и конвертирует кол-во байт, возвращает строку.
    <br/>Результат: 1 MB
        
    
* ``StringHelper::generateRandomString($length = 8, $allowUppercase = true)``: Генерация случайной строки.
    <br/>Результат: CAPJzMMe


* ``StringHelper::closeTags($html)``: Закрытие HTML тегов.
    <br/>Результат: <p>Hello World</p>


* ``StringHelper::ucfirst('hello world')``: Первая буква - заглавная.
    <br/>Результат: <p>Hello world</p>