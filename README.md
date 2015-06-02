# Базовые дополнения для Yii2

Набор различных расширений, хелперов и компонентов, которые облегчают реализацию определенных задач.

> **NOTE:** Пакет находится в стадии разработки.
```Не рекомендован к использованию```


## Установка

Предпочтительный способ установки через [composer](http://getcomposer.org/download/).

Запустите в консоле

```
php composer.phar require --prefer-dist nepster-web/yii2-basis-components "dev-master"
```

или добавьте

```
"nepster-web/yii2-basis-components": "dev-master"
```

в файл `composer.json` в секцию require.


# Обзор

## Components

- [BasisFormat](docs/BasisFormat.md) - организовывает единую точку доступа ко всем базовым расширениям.


## Helpers

- [DateTimeHelper](docs/DateTimeHelper.md) - хелпер для работы с датой и временем.
- [StatusHelper](docs/StatusHelper.md) - форматирует статусы определенного формата.
- [StringHelper](docs/StringHelper.md) - форматирует данные приобразуя их в строки.


## Лицензия

Данный пакет выпущен под лицензией MIT. Подробную информацию читайте в файле [LICENSE.md](LICENSE.md).