# UltimaPHP - OpenSource Ultima Online Server

UltimaPHP is a moder Ultima Online server, fully written in PHP 5.4

This server was created for attend those who ever wanted to create differend addaptations on the core of your shard or even in Ultima Online.

The base idea of this server was developed by Matthew [Ankron, from sphere community] and for study propose I re-scripted the entire server to understand how it works, and after that i decided to create a standalone version of the server to work in any OS.  

Feature list from UltimaPHP:

 * Handle the socket connections
 * Compress / Decompress IN/OUT data
 * Support for encrypted clients (working on it)
 * Works in any OS with an standalone PHP 5.4 (or greater) instalation


## How to install?

First of all, you need a installation of PHP 5.4 or greater in your systen, for that go to [PHP download page](http://php.net/downloads.php) and get the version of PHP you want to use.

After install the PHP on the machine, edit the file ```ultimaphp.ini``` as you wish and follow the next steps to start the server:

  ### Linux
  
  1) Open the terminal and navigate to the root folder of UltimaPHP
  2) Type: ```php startserver.php```


  ### MacOS
  
  (need someone with mac to help us)

  ### Windows
  
  1) Open the manu bar and open ```cmd```
  2) Navigate to PHP installation folder
  3) type ```php.exe c:\ultimaphp\instalation\folder\startserver.php```

Note: On ```ultimaphp.ini``` there is some database information but untill now there is nothing programmed using databases, so there is no need for install MySQL for now.

### Usefull links to help coding

 * [SocketSniff](http://nirsoft.net/utils/socket_sniffer.html) program i use to monitor an program sockets communication
 * [POL Packet Guide](http://docs.polserver.com/packets/index.php) for learning all about the packages sent trought server and client
 * [Sphere 0.56b leaked code](https:///github.com/necr0potenc3/Sphere) to see how things works
 * [RunUO repository](https://github.com/runuo/runuo) to see how things works
 * [POL Repository](https://github.com/polserver/polserver) to see how things works
 * [NodeUO](https://github.com/chjj/node-uo)
