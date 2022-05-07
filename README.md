A simple php class to help you send firebase push notification from php curl. 
It will allow you to push cloud messaging through firebase in 3 different way.
 
    1. Send to a single device id
    2. Send to a multiple device ids
    3. Send to a specific topic  subscribers

Installation

Installation is super-easy via Composer:

```bash 
composer require peterujah/php-firebase-notification
```

initialize the firebase class with your google api key

```php
define("GOOGLE_FCM_API_KEY", "AAAAtXpvsYU:APXXX");
$model = new \Peterujah\NanoBlock\Firebase\ServiceModel();
$service = new \Peterujah\NanoBlock\Firebase\Service(GOOGLE_FCM_API_KEY);
```

Sending a message to a single device id can be done like this.

```php
$model->setTo("f-bbVq2uCgY:APA91bF0s7jk5lXXy");
$model->setTo("/topics/sendUsersInfo");
$model->setTitle("I code it here");
$model->setMessage("Will you like to join us?");
$model->setIsBackground(false);
$response = $service->notify($model);
var_export($response);
```

Sending a message to a multiple user IDs can be done like this

```php
$model->setTo(array("User-A", "User-B", "User-C"));
$model->setTo("/topics/sendUsersInfo");
$model->setTitle("I code it here");
$model->setMessage("Will you like to join us?");
$model->setIsBackground(false);
$response = $service->notify($model);
var_export($response);
```
    
 Sending a message by topic IDs/name can be done like this

```php
$model->setIsTopic(ServiceModel::TOPIC);
$model->setTo("/topics/sendUsersInfo");
$model->setTitle("I code it here");
$model->setMessage("Will you like to join us?");
$model->setIsBackground(false);
$response = $service->notify($model);
var_export($response);
```

Methods

Set the notification payload node type. The default is `ServiceModel::NODE_NOTIFICATION`

```php 
$model->setNode(ServiceModel::NODE_NOTIFICATION | ServiceModel::NODE_DATA);
```
