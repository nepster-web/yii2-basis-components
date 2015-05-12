# Базовые дополнения для Yii2

Набор различных расширений, хелперов и компонентов, которые облегчают определенные задачи.

> **NOTE:** Пакет находится в стадии разработки.


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

## Helpers

- [RequestHelper](docs/RequestHelper.md) - для работы с данными запросов пользователей.
- [StatusHelper](docs/StatusHelper.md) - для форматирования статусов.
- [StringHelper](docs/StringHelper.md) - для работы со строками.


## Components

- [DateTimeFormatter](docs/DateTimeFormatter.md) - для работы с датой и временем.


## Лицензия

Данный пакет выпущен под лицензией MIT. Подробную информацию читайте в файле [LICENSE.md](LICENSE.md).