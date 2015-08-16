# UltimaPHP - OpenSource Ultima Online Server

UltimaPHP is a modern Ultima Online server written in PHP 5.4.

This server was created for thoes who ever wanted to create differend addaptations on the core of your shard or even in Ultima Online.

The idea of the server written in PHP came from Matthew [Ankron, on sphere community] and for study propose i re-scripted the entire server to understand how it works, and after all i decided to create a standalone version of the server to work in any OS.

Here is the feature list of UltimaPHP (for now):

 * Handle the socket connections
 * Compress / Decompress IN/OUT data
 * Future support for encrypted clients (working on it)
 * Works in any OS with an standalone PHP 5.4 (or greater) instalation


## How to install?

First of all, you need a installation of PHP 5.4 or greater and of MySQL (or any PDO compatible database) installed in your machine, for that go to [PHP download page](http://php.net/downloads.php) and get the version of PHP you want to use and then to [MySQL dowload page](http://dev.mysql.com/downloads/mysql/) and get the right version of MySQL for your machine.

After install PHP and MySQL on the machine, edit the file ```ultimaphp.ini``` as you wish, import the file ```database.sql``` to your mysql server and follow the next steps to start the server:

### Linux

 * Open the terminal and navigate to the root folder of UltimaPHP
 * Type: ```php startserver.php```


### Mac

 * We need someone with mac to help us

### Windows

 * Open the manu bar and open ```cmd```
 * Navigate to PHP installation folder
 * type ```php.exe c:\ultimaphp\instalation\folder\startserver.php```


### What is allready working?

 * Response PING request
 * Disconnect player
 * Login request
 * Login validation trought PDO Database
 * Server list response
 * Get client version information
 * Client selected server handler
 * Character list trought PDO Database (for old and new clients, packet change since client 7.0.13.0)
 * Client selected character handler
 * Enable locked client features
 * Receive the client language (We will use later to create an multi-language shard system)
 * Receive the client Screen Size (I really dunno why... but the client sends anyway before connect to the server)
 * Receive the client flags (I dunno what this is too... but the client sends anyway before connect to the server)
 * Send the player locale and body information to the client
 * Send all skill status to the client (80%, the packet is allready done but we need to create the database to store the skills and show the information on the packet to the client)
 * Connecting the client to the world (80%, we need to script a few packets to make it works)


 #### Usefull links to help coding

 * [SocketSniff](http://nirsoft.net/utils/socket_sniffer.html) program i use to monitor an program sockets communication
 * [POL Packet Guide](http://docs.polserver.com/packets/index.php) for learning all about the packages sent trought server and client
 * [Sphere 0.56b leaked code](https:///github.com/necr0potenc3/Sphere) to see how things works
 * [RunUO repository](https://github.com/runuo/runuo) to see how things works
 * [POL Repository](https://github.com/polserver/polserver) to see how things works
 * [NodeUO](https://github.com/chjj/node-uo)