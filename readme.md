## UltimaPHP - Ultima Online OpenSource Server

UltimaPHP is a modern Ultima Online server written in PHP 7.0.

This server was created for thoes who ever wanted to create differend addaptations on the core of your shard.

I decided to build this project for study propose i've re-scripted the entire socket server to understand how it works and after that i decided to create a lightweight standalone version of the server that runs in any OS easly.

Note 1: The server works with the last updated UO clients (7.0.59.5) and we will not spent time with older clients for now.

Note 2: I'm developing using the Ultima Online Classic Client - v7.0.59.5

## How to install?

First of all you will need to install PHP 7.0 or greater and MongoDb 3.4+, I reccomend you to use PHP 7.1 it's ultra fast and lightweight, for that:

* [PHP download page](http://php.net/downloads.php) and get the version of PHP you want to use
* [MongoDB page](https://www.mongodb.com) and get the right version of mongodb for your machine.

After install PHP and MongoDB on the machine, edit the file ```ultimaphp.ini``` as you wish, create a mongodb database named "ultimaphp" (or anyone, just need to change at the ultimaphp.ini) and create/import all collections from ```tools/Mongo Database/*.json``` (file name is the collection name) and follow the next steps to start the server:

Note 1: You can use some program to visualize and work with mongodb like: [RoboMongo](https://robomongo.org/download) or [MongoChef](https://studio3t.com/download/)

Note 2: The default owner account/password in the database is: test/test

Note 3: The default player account/password in the database is: test2/test

Note 4: Passwords is allways stored in MD5 encryption both in database and in server variables

Note 5: UltimaPHP only works (till now) with no-encrypted clients.

### Linux

 * Open the terminal and navigate to the root folder of UltimaPHP project
 * Type: ```php7.0 startserver.php```

### Mac

 * We need someone with mac to help us :)

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
 * Open Paperdol (self/other players)
 * Open status bar (self/other players/mobiles)
 * Show all names (Players/other players/mobiles)
 * Add objects
 * Add mobiles
 * Login multiple chars
 * Equip multiple objects
 * PickUp / Drag / Drop item
 * Walk / Run in any of the 6 worlds
 * Send and receive unicode Sysmessage
 * Where Command
 * Teleport command to any world
 * Invis command
 * Change mobile name
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
 * Dialogs (With Gump Studio Exporter plugin allready working, tools folder)
 * Containers
 * Many other things

### Usefull links that could help you code

 * [Sublime Text 3](http://www.sublimetext.com/3) recommended IDE used to program the server
 * [SocketSniff](http://nirsoft.net/utils/socket_sniffer.html) program i use to monitor an program sockets communication
 * [POL Packet Guide](http://docs.polserver.com/packets/index.php) for learning all about the packages sent trought server and client
 * [Sphere 0.56d source](https://github.com/Sphereserver/Source) to discover how things works, maybe...
 * [RunUO repository](https://github.com/runuo/runuo) to see how things works
 * [POL Repository](https://github.com/polserver/polserver) to see how things works
 * [Ultima Online Classic](http://uo.com)

### Do you feel like you coul help in anyway this projet?

Feel free to join us and help this project grow in whatever you can!
We always like to hear new ideas and feedbacks, so why don't you create an issue to tell us what can you do to help us grow?

### Coding standards

 * All .php files should start with `<?php` and end without `?>`
 * All .php files should have the comment line header
 * All class names starts with UPPERCASE character, IE: class ClassName {...}
 * All method names must start with LOWERCASE character and all next words start with UPPERCASE character with no space, IE: goodMethodName()
 * All codes must be idented with tab
 * All codes must be formatted in K&R style before commited, manually or using your preffered tool

### Database standards

 * All data storage tables must have an ID indexed
 * All secure information, like passwords, must be stored encrypted
 * All relashionship must have an foreign key linkng the table columns
 * All tables names must be LOWERCASE and words separated with underline, IE: good_table_name

### Authors

 * João Escribano - Brazil
 * Maurício Nunes - Brazil