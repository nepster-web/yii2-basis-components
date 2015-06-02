# Работа со строками

Хелпер **StringHelper** работает с различными форматами данных, преобразуя их в строки


Например:

```
StringHelper::formatBytes(10000000) // 9.54 MB
```


# Методы

Форматирует и конвертирует кол-во байт, возвращает строку
```
StringHelper::formatBytes($bytes, $precision = 2)
```

Генерация случайной строки
```
StringHelper::generateRandomString($length = 8, $allowUppercase = true)
```