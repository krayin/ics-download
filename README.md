# Krayin ICS Download

### 1. Introduction:
CalendarApp allows you to download ICS file in activity section.

### 2. Requirements:

* **Krayin**: v1.0.0.

### 3. Installation:
* Install the PWA extension
```
composer require krayin/ics-download:dev-master
```

* Run these commands below to complete the setup

```
php artisan config:cache
```

```
php artisan migrate
```

```
php artisan route:cache
```
> That's it, your extension must be working now.
