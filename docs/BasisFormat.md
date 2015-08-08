# BasisFormat
Компонент BasicFormat организовывает единую точку доступа ко всем базовым расширениям


# Настройка 

Сконфигурируйте Ваше приложение, добавив следующую настройку:

```
    'components' => [
        ..
        'BasisFormat' => [
            'class' => 'nepster\basis\components\BasisFormat',
        ],
        ...
    ]
```


# Пример использования

Используйте метод **helper**, чтобы получить инстанс необходимого класса-хелпера, пример:

```
    Yii::$app->BasisFormat->helper('DateTime')->diffFullPeriod( time(), time() + 40 );
    Yii::$app->BasisFormat->helper('Status')->booleanString(0);
```