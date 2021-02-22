## Sobre o Larodon
    Sistema de gerenciamento de clinicas Odontológicas, desenvolvido em laravel.


## instalação

```shell
        git clone https://github.com/iagomussel/larodon.git
        cd larodon  
        composer install
        npm install
        php artisan key:generate
        composer run post-root-package-install
```
então edite o arquivo .env com os dados do banco
```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=odonto
        DB_USERNAME=root
        DB_PASSWORD=
```
```shell
        php artisan migrate
        php -S localhost:8000
```

## Sobre o Laravel

Laravel é um framework de aplicação web com sintaxe expressiva e elegante. Acreditamos que o desenvolvimento deve ser uma experiência agradável e criativa para ser verdadeiramente gratificante. O Laravel tenta tirar a dor do desenvolvimento facilitando as tarefas comuns usadas na maioria dos projetos da web


