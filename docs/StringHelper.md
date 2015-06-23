# Работа со строками

Хелпер **StringHelper** работает с различными форматами данных, преобразуя их в строки


Например:

```
StringHelper::formatBytes(10000000) // 9.54 MB
```


# Все методы
    
* ``StringHelper::formatBytes($bytes, $precision = 2)``: Форматирует и конвертирует кол-во байт, возвращает строку.
    <br/>Пример: 1 MB
        
    
* ``StringHelper::generateRandomString($length = 8, $allowUppercase = true)``: Генерация случайной строки.
    <br/>Пример: CAPJzMMe