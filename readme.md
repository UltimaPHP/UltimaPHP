[![Build Status](https://travis-ci.org/UltimaPHP/UltimaPHP.svg?branch=master)](https://travis-ci.org/UltimaPHP/UltimaPHP)

## UltimaPHP - Ultima Online OpenSource Server

UltimaPHP is a modern Ultima Online server written in PHP 7.0.

This server was created for those who ever wanted to create different adaptations on the core of your shard.

I decided to build this project for study propose I've re-scripted the entire socket server to understand how it works and after that i decided to create a lightweight standalone version of the server that runs in any OS easily.

Note: The server only works with the last updated Ultima Online client (7.0.70.10) and we will not spend time with older clients for now.

## How to install?

First of all, you will need to install PHP 7.0 or greater and MongoDB 3.4+, I recommend you to use PHP 7.1 it's ultra-fast and lightweight, for that:

* [PHP download page](http://php.net/downloads.php) and get the version of PHP you want to use
* [MongoDB page](https://www.mongodb.com) and get the right version of MongoDB for your machine.

After installing PHP and MongoDB on the machine, edit the file ```ultimaphp.ini``` as you wish, create a MongoDB database named "ultimaphp" (or anyone, just need to change at the ultimaphp.ini) and create/import all collections from ```tools/Mongo Database/*.json``` (file name is the collection name) and follow the next steps to start the server:

Note 1: You can use some program to visualize and work with MongoDB like: [RoboMongo](https://robomongo.org/download) or [MongoChef](https://studio3t.com/download/)

Note 2: The default owner account/password in the database is: test/test

Note 3: The default player account/password in the database is: test2/test

Note 4: Passwords is always stored in MD5 encryption both in the database and in server variables

Note 5: UltimaPHP only works (till now) with no-encrypted clients.

### Linux

 * Open the terminal and navigate to the root folder of UltimaPHP project
 * Type: ```php7.0 startserver.php```

### Mac

 * Docker Stack is coming :)

### Windows

 * Open the run dialog (SUPER+R) and type ```cmd``` then run
 * Navigate to PHP installation folder ```cd c:\php\installation\folder\```
 * And start the server ```php.exe c:\ultimaphp\instalation\folder\startserver.php```

## Base PHP compilation
#### For those, like me, who preffer to use an most performatic standalone PHP, with only what it really needs
```bash
./configure --prefix=/usr --with-config-file-path=/etc --enable-sockets --enable-bcmath --enable-mbstring --enable-zip --enable-pcntl --enable-ftp --enable-exif --enable-sysvmsg --enable-sysvsem --enable-sysvshm --enable-wddx --with-mcrypt --with-iconv --with-zlib-dir=/usr --with-xpm-dir=/usr --with-openssl --with-gettext=/usr --with-zlib=/usr --with-bz2=/usr
make
make install
```

### What is already working?
 * Classic client
 * 3D Client
 * Login
 * Create Character
 * Open Paper doll (self/other players)
 * Open status bar (self/other players/mobiles)
 * Show all names (Players/other players/mobiles)
 * Add objects
 * Add mobiles
 * Login multiple chars
 * Equip multiple objects
 * PickUp / Drag / Drop item
 * Walk / Run in any of the 6 worlds
 * Send and receive Unicode Sysmessage
 * Where Command
 * Teleport command to any world
 * Invis command
 * Change the mobile name
 * Change player name (if is GM)
 * Click on players/mobiles/objects
 * DClick on players/mobiles/objects
 * Open skills info
 * Emote
 * Talk
 * Store objects inside multiple containers
 * Save the player objects
 * Save the world objects
 * Mobile walking using pathfinding (Still need to work on it, see issues)
 * Dialogs (With Gump Studio Exporter plugin already working, tools folder)
 * Containers
 * Many other things

### Useful links that could help you code

 * [Sublime Text 3](http://www.sublimetext.com/3) recommended IDE used to program the server
 * [SocketSniff](http://nirsoft.net/utils/socket_sniffer.html) program i use to monitor an program sockets communication
 * [POL Packet Guide](http://docs.polserver.com/packets/index.php) for learning all about the packages sent trought server and client
 * [Sphere 0.56d source](https://github.com/Sphereserver/Source) to discover how things works, maybe...
 * [RunUO repository](https://github.com/runuo/runuo) to see how things works
 * [POL Repository](https://github.com/polserver/polserver) to see how things works
 * [Ultima Online Classic](http://uo.com)

### Do you feel like you could help in any way this project?

Feel free to join us and help this project grow in whatever you can!
We always like to hear new ideas and feedbacks, so why don't you create an issue to tell us what can you do to help us grow?

### Coding standards

 * All .php files should start with `<?php` and end without `?>`
 * All .php files should have the comment line header
 * All class names start with an UPPERCASE character, IE: class ClassName {...}
 * All method names must start with LOWERCASE character and all next words start with an UPPERCASE character with no space, IE: goodMethodName()
 * All codes must be indented with a tab
 * All codes must be formatted in K&R style before committed, manually or using your preferred tool

### Authors

 * João Escribano - Brazil
 * Maurício Nunes - Brazil
 * Youri Theodorakopoulos - Brazil
 * Fábio Henrique - Brazil
 * Gökay Gürcan - Netherlands
