# Как поднять проект ?

В корне проекта есть Makefile. В консоли в корне проекта запустите команду:

```shell
make build
```

Команда соберет и установит все зависимости.
После завершения команды в консоли выведтся PUBLIC_KEY который необходимо перенести в:

``
/app/.env -> JWT_PUBLIC="{PUBLIC}"
``

## Запустить скрипт
```shell
make requrest
```

В файле ``app/app/Http/Controllers/AuthController.php`` 
проверяется токен на основе `` PUBLIC_KEY``



В файле ``cli/app/src/Endpoint/Console/VerifiedJwtToken.php`` 
отправляет запрос в ``app/app/Http/Controllers/AuthController.php`` 
по url http://172.10.0.2/auth


В файле ``cli/app/src/Endpoint/Console/DoNothing.php ``
генерируется private и public keys