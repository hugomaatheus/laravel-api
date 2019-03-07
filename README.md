# laravel-api
API REST utilizando Laravel, mapeando operações de CRUD.

## Instalação

#### Variaveis de ambiente
Crie o arquivo `.env` na pasta root do projeto

```
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=SeuSGBD

```

```
$ php artisan key:generate
```

#### Dependências
```
$ composer install
```

#### Migrações do banco
```
$ php artisan migrate --seed
```

#### Inicializar server
```
$ php artisan serve
```

#### Visualizar rotas
```
$ php artisan route:list
```

#### Api headers
```
Accept application/json
Content-Type application/json
```

#### Inserir autor
```
POST api/authors
```

#### Atualizar autor
```
PUT|PATCH api/authors/{id}
```
id `int`
name `string`
age `int`
email `string`
password `string`
password_confirmation `string`

#### Testes
```
$ vendor/bin/phpunit
```
