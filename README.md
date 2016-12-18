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

W tej chwili nie ma testów, ale będą.

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

See also the list of [contributors](https://github.com/AKAI-TRIOS/trios/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone who's code was used
* Inspiration
* etc
