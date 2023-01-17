
# Laravel-Blue-Coding Challenge

Created application to generate short url's


## Install

#### Clone the repository

```bash
git clone git@github.com:esirangelomub/laravel-blue-coding.git
```

#### Setting Environment Variables

```bash
cp .env.example .env
```

#### Install with composer

```bash
cd laravel-blue-coding
composer install
```

#### Run with sail

```bash
./vendor/bin/sail up -d
```

#### Stop with sail
```bash
./vendor/bin/sail down
```

#### Migrations & Seeders
```bash
./vendor/bin/sail artisan migration --seed
```






    
## Usages/Examples

#### Store links
```php
<?php
$client = new Client();
$headers = [
  'Content-Type' => 'application/json'
];
$body = '{
  "link": "https://www.google.com"
}';
$request = new Request('POST', 'localhost:8081/api/v1/shorten', $headers, $body);
$res = $client->sendAsync($request)->wait();
echo $res->getBody();
```

#### List links
```php
<?php
$client = new Client();
$headers = [
  'Cookie' => 'XSRF-TOKEN=eyJpdiI6ImFGRGV5Qll5N2lBN3VFVmQxaGdMWHc9PSIsInZhbHVlIjoiWmc4MGg3ZDVOVkNkVCt2Yko2blAxaXlOemliN3k1SzNNNDFJZlo1OERVZDN3dG5wcXJvWHZFbWhmeFM3V1htdnhoaGZ0eThIckU5emt5T1VCRi9jMCtIa3lUd1Y1ZGlsbDBFcTNtSklDcUhzRmIwYVh6Wm0rYm4rU1pwb2Y0WTEiLCJtYWMiOiI2Y2E3MWFjNjc1ZDEyMmE4NzdmZTAzYWRmNDkxNDUyZGI5MWM0NTA3YmVlOTdhYjY3ODhmODlkOGFhYzVkYzIyIiwidGFnIjoiIn0%3D; laravel_blue_coding_session=eyJpdiI6InZFdVA0emJPejF2OUdLT1BEYURZZmc9PSIsInZhbHVlIjoibis2N1AvTGhVc1grSlI2cmFoamZ1L1Z2ZFhhK0RTS0hkdmt4eE1PellzejU1b3ZhNUhYYmFFWHhLMEsxVktkMWdHd1N1L2d2VldpNHdmN0hlYlpOU29VTmtValZGZXJyaW9mZ0tZOHNQM3ZCZU5LNmdML2JYL01TcElEZWtCNk4iLCJtYWMiOiJjODVjODBlYjRiZDRhMjVmZjQwODFjMjA1MTg3NmYxMzM5ODRiMTM1N2VjNTdiMmNhYzc2YWFjYTI2MWJhZDE5IiwidGFnIjoiIn0%3D'
];
$request = new Request('GET', 'localhost:8081/api/v1/shorten', $headers);
$res = $client->sendAsync($request)->wait();
echo $res->getBody();
```

#### Access link
```php
<?php
<?php
$client = new Client();
$headers = [
  'Cookie' => 'XSRF-TOKEN=eyJpdiI6ImFGRGV5Qll5N2lBN3VFVmQxaGdMWHc9PSIsInZhbHVlIjoiWmc4MGg3ZDVOVkNkVCt2Yko2blAxaXlOemliN3k1SzNNNDFJZlo1OERVZDN3dG5wcXJvWHZFbWhmeFM3V1htdnhoaGZ0eThIckU5emt5T1VCRi9jMCtIa3lUd1Y1ZGlsbDBFcTNtSklDcUhzRmIwYVh6Wm0rYm4rU1pwb2Y0WTEiLCJtYWMiOiI2Y2E3MWFjNjc1ZDEyMmE4NzdmZTAzYWRmNDkxNDUyZGI5MWM0NTA3YmVlOTdhYjY3ODhmODlkOGFhYzVkYzIyIiwidGFnIjoiIn0%3D; laravel_blue_coding_session=eyJpdiI6InZFdVA0emJPejF2OUdLT1BEYURZZmc9PSIsInZhbHVlIjoibis2N1AvTGhVc1grSlI2cmFoamZ1L1Z2ZFhhK0RTS0hkdmt4eE1PellzejU1b3ZhNUhYYmFFWHhLMEsxVktkMWdHd1N1L2d2VldpNHdmN0hlYlpOU29VTmtValZGZXJyaW9mZ0tZOHNQM3ZCZU5LNmdML2JYL01TcElEZWtCNk4iLCJtYWMiOiJjODVjODBlYjRiZDRhMjVmZjQwODFjMjA1MTg3NmYxMzM5ODRiMTM1N2VjNTdiMmNhYzc2YWFjYTI2MWJhZDE5IiwidGFnIjoiIn0%3D'
];
$request = new Request('GET', 'http://localhost:8081/<CODE>', $headers);
$res = $client->sendAsync($request)->wait();
echo $res->getBody();
```

## Postman collection

You can restore the Postman collection from the project root and have the endpoints already configured for use.

```
Laravel-Blue-Coding.postman_collection.json
```



## Stack used

**Back-end:** PHP, Laravel 9, Docker and Sail

**Database:** PostgreSQL 15


## Tests

To run the tests, run the following command

```bash
./vendor/bin/sail artisan test
```


## 🔗 Links
[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://github.com/esirangelomub/)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/eduardosirangelo/?locale=en_US/)

