## Sobre o Larodon
    Sistema de gerenciamento de clinicas Odontológicas, desenvolvido em laravel.
    
![Sem título](https://user-images.githubusercontent.com/12155389/108744168-64753580-7518-11eb-991a-dac5f0a2a5f7.png)

<h2>Como executar o projeto</h2>
</p>

*   Instalar um Editor de Texto/IDE ([Visual Studio Code](https://code.visualstudio.com/download), [Notepad++](https://notepad-plus-plus.org/download/v7.7.html)), [MySQL 5.7+](https://dev.mysql.com/downloads/mysql/5.7.html) (Ou driver de banco de dados de preferência), [PHP 7.2+](https://www.php.net/downloads.php) (Standalone ou parte de XAMPP, WAMP, etc)
*   Instalar o [composer](http://getcomposer.org)
*   Instalar uma ferramenta de git ([normal](https://git-scm.com/download/win), [git bash](https://gitforwindows.org/), [GitHub Desktop](https://desktop.github.com/))
*   Fazer o clone do projeto com o git (**não é para baixar o zip**), exemplo: git clone https://github.com/iagomussel/larodon.git
*   Navegar até a pasta que foi feito o clone e digitar os seguintes comandos:
1. composer install
2. Copiar o .env.example para .env e preencher os dados de conexão do banco de dados
3. Criar database no banco de dados com o nome que você criou no .env
```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=odonto
        DB_USERNAME=root
        DB_PASSWORD=
```
5. agora digite o comando: php artisan key:generate no terminal, e digite o código que aparecer no .env APP_KEY=
6. Se você instalou o MariaDB ou uma versão anterior ao MySQL 5.7: [modificar o código conforme este link](https://laravel-news.com/laravel-5-4-key-too-long-error)
7. A partir daqui são os comandos que deverão ser executados sempre que mudar algo no banco:
8. php artisan migrate (ou php artisan migrate:fresh para atualizar o banco)
9. php artisan serve (roda a aplicação)
*   Acessar o localhost:8000, usuario=admin e senha=admin



## Sobre o Laravel

Laravel é um framework de aplicação web com sintaxe expressiva e elegante. Acreditamos que o desenvolvimento deve ser uma experiência agradável e criativa para ser verdadeiramente gratificante. O Laravel tenta tirar a dor do desenvolvimento facilitando as tarefas comuns usadas na maioria dos projetos da web


