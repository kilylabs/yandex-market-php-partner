# Клиенты

Клиенты – специальные классы PHP-библиотеки. Методы этих классов реализуют запросы к ресурсам партнерского API Яндекс.Маркета. Ресурсы сгруппированы в клиенты по тематикам: предложения, ставки, цели и т. д.

Чтобы отправлять запросы, создайте экземпляры нужных клиентов и вызывайте их методы. При создании экземпляра клиента нужно указать авторизационные данные. Например, получим информацию о прайс-листе магазина:

```php
// Указываем авторизационные данные
$clientId = '9876543210fedcbaabcdef0123456789';
$token = '01234567-89ab-cdef-fedc-ba9876543210';
// Указываем идентификатор магазина (он требуется для большинства методов)
$campaignId = '10001';
// Создаем экземпляр клиента для работы с ассортиментом
$assortmentClient = new \Yandex\Market\Partner\Clients\AssortmentClient($clientId, $token);
// Получаем информацию о прайс-листе
$feed = $assortmentClient->getFeed($campaignId, 12345);
```

# Итераторы

Выходные данные методов, возвращающих информацию о нескольких объектах (например, список магазинов), содержат итератор по этим объектам. Итератор позволяет получить текущий объект (метод `current`), перейти к следующему (метод `next`), получить количество объектов (метод `count`). Например, получим информацию о магазинах пользователя Яндекса, на которого зарегистрировано приложение:

```php
// Создаем экземпляр клиента с базовыми методами
$baseClient = new \Yandex\Market\Partner\Clients\BaseClient($clientId, $token);
// Получаем объект с магазинами
$campaignsObject = $baseClient->getCampaigns();
// Получаем итератор по магазинам
$campaigns = $campaignsObject->getCampaigns();
// Получаем количество магазинов
$campaignsCount = $campaigns->count();
// Получаем первый магазин
$campaign = $campaigns->current();
// Получаем следующий магазин
$campaign = $campaigns->next();
```

Если метод возвращает итератор или содержит его в выходных данных, это указано в [описании метода](Методы). Все методы с [постраничным возвратом](#Постраничный-возврат) содержат в выходных данных итератор.

# Постраничный возврат

Некоторые методы возвращают результаты постранично. В выходных данных содержится объект с информацией о текущей странице и общем количестве страниц. Этот объект можно получить вызовом метода `getPager`:

```php
// Получаем объект с магазинами
$campaignsObject = $baseClient->getCampaigns();
// Получаем объект с информацией о странице результатов
$campaignsPager = $campaignsObject->getPager();
```

Также в выходных данных содержится [итератор](#Итераторы) по результатам текущей страницы.

Во входных параметрах методов с постраничным возвратом можно указать параметры нужной страницы — например, ее номер и размер. Названия и описания этих параметров для каждого метода приведены в соответствующих статьях [технической документации API](https://tech.yandex.ru/market/partner/doc/dg/reference/all-methods-docpage/)

Если метод возвращает результаты постранично, это указано в [его описании](Методы).