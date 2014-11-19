HTTP Application library (httpApp)
==================================

Назначение
----------

Данная библиотека предназначена для быстрого и простого построения несложных `php`-приложений. Библиотека позволяет создавать специализированные обработки для http-ресурсов без использования прямого вызова программных файлов, обеспечивая роутинг на уровне приложения.

Установка
---------

Установка библиотеки производится через пакетный менеджер [composer][], который позволяет легко подключать необходимые библиотеки с возможностью обновления версий.

#### Создание рабочих папок приложения

В качестве примера настройки выберем следующую структуру папок:
```
kernel
    resources
        <программные файлы и папки, определяющие будущие ресурсы>
    app.php
    composer.json
```

1. Вносим необходимые изменения файла `composer.json`: 
```json
{
    "require": {
        "yaseek/httpapp": "~0.2"
    },
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/yaseek/httpapp.git"
        }
    ]
}
```

2. Скачиваем рабочий модуль `composer.phar` системы [composer][]
3. Выполняем команду `php composer install`

После выполнения этих несложных действий мы можем приступить собственно к настройке приложения

Настройка
---------

#### Настройка запуска приложения

Как мы ранее условились, главный запускаемый модуль нашего приложения будет называться `app.php`, поэтому все дальнейшие настройки будем проводить с учётом этого факта.

Программный код нашего модуля состоит всего из 4 строк, где мы подключаем загруженные библиотеки, инициализируем экземпляр приложения и настраиваем роутер:

#### Содержимое модуля `app.php`:
```php
require_once __DIR__ . '/vendor/autoload.php';

$app = new Yaseek\HTTPApplication();

Yaseek\HTTPRouter::start($app, array('resources' => __DIR__ . '/resources') );
Yaseek\HTTPRouter::stop($app);
```

#### Установки файла `.htaccess`:
```
# BEGIN 
<IfModule mod_rewrite.c>
RewriteEngine On

RewriteBase /

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule . /kernel/app.php [L]
</IfModule>

# END 
```

### Пример создания ресурса

Каждый модуль ресурса должен использовать глобальную переменную `$app` &mdash; ту самую, которая нами была определена в модуле `app.php`.

#### Содержимое модуля ресурса `data.php`:
```php
global $app;

$app->get('~^/data$~', array('Data', 'getData'));
$app->get('~^/data/(.+)$~', array('Data', 'getData'));

class Data {
    public static function getData ($request, $response) {
        $response->headers(array(
            "Content-Type" => "application/json; charset=utf-8"
        ));
        
        $response->send(200, array('query'=>$request->query, 'params'=>$request->params));
    }
}
```

тут мы видим, что при запросе к серверу `/data/sub?param1=1&param2=2`
сервер вернёт:
```json
{
    "query": {
        "param1": "1",
        "param2": "2"
    },
    "params": [
        "/data/sub",
        "sub"
    ]
}
```

## Лицензия

Данная библиотека доступна на [GItHub][home] с условиями лицензирования [MIT][mit]

[composer]: http://getcomposer.org/
[mit]: http://revolunet.mit-license.org
[home]: http://github.org/yaseek/httpapp
