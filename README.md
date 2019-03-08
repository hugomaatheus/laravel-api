# laravel-api
API REST utilizando Laravel, mapeando operações de CRUD.

## Instalação

#### Variaveis de ambiente
Crie o arquivo `.env` na pasta root do projeto

```
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=sqlite

```

```
$ php artisan key:generate
```

#### Dependências
```
$ composer install
```

#### Inicializar database
```
$ php artisan migrate
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
id `int`
name `string`
age `int`
email `string`

#### Atualizar autor
```
PUT|PATCH api/authors/{id}
```
id `int`
name `string`
age `int`
email `string`

#### Inserir livro
```
POST api/books
```
id `int`
title `string`
author_id `int`

#### Atualizar livro
```
PUT|PATCH api/books/{id}
```
id `int`
title `string`
author_id `int`

#### Testes
```
$ ./vendor/bin/phpunit
```
