# AKAI-TRIOS (nazwa robocza)

Aplikacja internetowa

## Getting Started

1. Sklonuj repozytorium
`git clone https://github.com/AKAI-TRIOS/trios.git`
albo bezpośrednio w PhpStorm
2. Zainstaluj bazę danych MySQL
3. Zainstaluj potrzebne biblioteki
`composer install`
4. Skopiuj plik `.env.example` do pliku `.env`
5. Stwórz bazę danych `CREATE DATABASE trios;`
6. Wypełnij plik `.env` danymi dostępowymi do bazy MySQL
```
DB_DATABASE=trios
DB_USERNAME=<nazwa użytkownika bazy danych>
DB_PASSWORD=<hasło do bazy danych>
```
7. Stwórz tabele w bazie danych i dodaj do niej testowe dane
`php artisan migrate:refresh --seed`
8. Wygeneruj klucz
`php artisan key:generate`
9. Uruchom aplikację
`php artisan serve`
10. Wejdź pod adres `localhost:8000` i korzystaj z aplikacji.

### Wymagania

What things you need to install the software and how to install them

```
PHP
MySQL
```

Opcjonalnie:

```
beanstalkd
supervisor
```

### Instalacja kolejki do wykonywania zadań w tle (beanstalkd+supervisor)

Ubuntu 16.04 LTS:
```
$ sudo apt-get update
$ sudo apt-get install -y beanstalkd supervisor
$ sudo nano /etc/supervisor/conf.d/trios.conf
```
Dodaj do pliku, zmieniając ścieżki:
```
[program:trios]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/vhosts/trios/artisan queue:work beanstalkd --sleep=3 --tries=3
autostart=true
autorestart=true
numprocs=4
redirect_stderr=true
stdout_logfile=/var/www/vhosts/trios/storage/logs/worker.log
```

```
$ sudo supervisorctl
> reread
> add trios
> start trios
```

W `.env`

```
#change to beanstalkd
QUEUE_DRIVER=sync
```

Cobbled together from:

http://fideloper.com/ubuntu-beanstalkd-and-laravel4#bottom
https://laravel.com/docs/5.4/queues
https://gist.github.com/Avidproducers/b53677fc58b50da7c2f16898da0f6fb5

### Integracja ze Slackiem

https://my.slack.com/services/new/incoming-webhook/

Uzupełnij w .env:

```
SLACK_CHANNEL=
SLACK_WEBHOOK_URL=
```

### Ręczne przypisywanie uprawnień

Aby dostać się do panelu administratora nie wystarczy się zalogować,
potrzebne są też odpowienie uprawnienia. Dopóki nie dodamy do panelu
administracyjnego zarządzania użytkownikami, uprawnienia można dodać tak:

```
php artisan tinker # uruchamia interaktywną konsolę

$user = App\User::find(1); # zamiast jedynki ID użytkownika
$admin = App\Role::whereName('admin')->first(); # admin - może wszystko
$mod = App\Role::whereName('mod')->first(); # mod - może zarządzać triosami
# jeśli rola jest niedostępna, trzeba najpierw uruchomić php artisan db:seed --class EntrustSeeder
$user->attachRole($admin);
```

### Konfiguracja zewnętrznych API (opcjonalne)

Dodaj do pliku `.env` podane poniżej klucze:
* Facebook

    How to get `<client_id>` and `<client_secret>`: [link](https://blog.damirmiladinov.com/laravel/laravel-5.2-socialite-facebook-login.html)
    ```
    FACEBOOK_ID=<client_id>
    FACEBOOK_SECRET=<client_secret>
    FACEBOOK_URL=http://localhost:8000/auth/facebook/callback
    ```
* Twitter

    How to get `<client_id>` and `<client_secret>`: [link](https://blog.damirmiladinov.com/laravel/laravel-5.2-socialite-twitter-login.html)
     ```
    TWITTER_ID=<client_id>
    TWITTER_SECRET=<client_secret>
    TWITTER_URL=http://localhost:8000/auth/twitter/callback
     ```
* Google

    How to get `<client_id>` and `<client_secret>`: [link](https://blog.damirmiladinov.com/laravel/laravel-5.2-socialite-google-login.html)
     ```
    GOOGLE_ID=<client_id>
    GOOGLE_SECRET=<client_secret>
    GOOGLE_URL=http://localhost:8000/auth/google/callback
     ```

### Installing

A step by step series of examples that tell you have to get a development env running

Say what the step will be

```
Give the example
```

And repeat

```
until finished
```

End with an example of getting some data out of the system or using it for a little demo

## Running the tests

Testy przeglądarkowe

`php artisan dusk`

### Test stylu kodu

Kod w tym repozytorium powinien być zgodny z
[PSR-1](http://www.php-fig.org/psr/psr-1/) oraz
[PSR-2](http://www.php-fig.org/psr/psr-2/)


## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Laravel](https://laravel.com/docs/) - Framework

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags).

## Authors

* **Marcin Ławniczak** - *rozpoczęcie projektu* - [marcinlawnik](https://github.com/marcinlawnik)
* **Mikołaj Rozwadowski** - *frontend & backend* - [hejmsdz](https://github.com/hejmsdz)
* **Denis Knop** - *frontend & backend* - [knopers666](https://github.com/knopers666)
* **Michał Dolata** - *backend* - [MichalDolata](https://github.com/MichalDolata)
* **Mateusz Stempniewicz** - *frontend & backend* - [Mateusz-Stempniewicz](https://github.com/Mateusz-Stempniewicz)
* **Zofia Dobrowolska** - *backend & design* - [zofiadob](https://github.com/zofiadob)
* **Rafał Rudol** - *frontend and design* - [rrudol](https://github.com/rrudol)
See also the list of [contributors](https://github.com/AKAI-TRIOS/trios/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* **Zofia Dobrowolska** - *Super logo*
