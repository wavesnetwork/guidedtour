# WAVES Guided Tour


# The WAVES Project

The WAVES project combines skill sets of both academic and enterprise partners to make Scenario-based learning (SBL) more accessible for a wide range of professions.  SBL techniques are widely recognised as a key tool in the educational toolkit, for safe training in competency and decision-making.

[http://wavesnetwork.eu](http://wavesnetwork.eu)

# Online demo

Visit the following link:

[WAVES Guided Tour Demo](http://olab.wavesnetwork.eu)


# Installation

1. Create database in MySQL from ```database.sql```, with/without test data in INSERT INTO...

2. Deploy database backend ```editor.php``` and insert your own test data

3. Add ```_introjs_hook.php```, modify its header for IP filtering (or change loading IntroJS from CDN to local source) and add mysql connection settings:
```php
<?php
include_once("iplib.php");
$filter = new IPFilter( array(
      '.....',   // add to IP adress to filter
));

if ($filter->check($_SERVER["REMOTE_ADDR"]) === true):
..

// --- connection to dedicated
$config["db_server"] = "localhost";
$config["db_name"] = "adddbname";
$config["db_user"] = "adddbuser";
$config["db_user_pw"] = "addyourpassword";
```

4. Modify labyrinth ver.3 source codes ```home.php```, ```../views/labyrinth/skin/*.php``` -- add:
```php
<?php
require_once('_introjs_hook.php');
?>
```

5. For exact jquery style DOM selecting/matching is important to add more ids or classes into skins -- ```../views/labyrinth/skin/*.php```, for example id="iba_node_title":
```html
<h4 id="iba_node_title"><?php echo Arr::get($templateData, 'node_title'); ?></h4>
```


# License
WAVES Guided Tour is licensed under the MIT Open Source license. For more information, see the LICENSE file in this repository.
