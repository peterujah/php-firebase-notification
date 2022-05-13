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
use Peterujah\NanoBlock\FirebaseServiceModel;
use Peterujah\NanoBlock\FirebaseService;

define("GOOGLE_FCM_API_KEY", "AAAAtXpvsYU:APXXX");
$model = new FirebaseServiceModel();
$service = new FirebaseService(GOOGLE_FCM_API_KEY);
```

Sending a message to a single device id can be done like this.

```php
$model->setTo("f-bbVq2uCgY:APA91bF0s7jk5lXXy");
$model->setTitle("I code it here");
$model->setMessage("Will you like to join us?");
$response = $service->notify($model);
var_export($response);
```

Sending a message to a multiple user IDs can be done like this

```php
$model->setTo(array("User-A", "User-B", "User-C"));
$model->setTitle("I code it here");
$model->setMessage("Will you like to join us?");
$response = $service->notify($model);
var_export($response);
```
    
 Sending a message by topic IDs/name can be done like this

```php
$model->setIsTopic(FirebaseServiceModel::TOPIC);
$model->setTo("TOPIC_GROUP_ID_NAME");
$model->setTitle("I code it here");
$model->setMessage("Will you like to join us?");
$response = $service->notify($model);
var_export($response);
```

Methods

Set the notification payload node type. The default is `FirebaseServiceModel::NODE_NOTIFICATION`

```php 
$model->setNode(FirebaseServiceModel::NODE_NOTIFICATION | FirebaseServiceModel::NODE_DATA);
```

Sets the notification to send to topic. The default is `false`, pass `FirebaseServiceModel::TOPIC` or `true`, to enable topic.
```php
$model->setIsTopic(FirebaseServiceModel::TOPIC);
```

Sets the notification body, default is message
```php
$model->setBody($body);
```
Sets the notification image url.
```php
$model->setImage("https://img.com/path/to/foo.png");
```

Sets the notification click action for android.
```php
$model->setClickAction($click);
```

Sets the notification refernce for custom use.
```php
$model->setReference($ref);
```

Sets the notification additional meta data for custom use.
```php
$model->setMeta($array);
```

Sets the notification badge id.
```php
$model->setBadge($int);
```

Sets the notification background state.
```php
$model->setIsBackground($bool);
```
Sets the notification sound type.
```php
$model->setSound($sound);
```
