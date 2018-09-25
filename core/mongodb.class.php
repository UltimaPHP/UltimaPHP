<?php
require_once UltimaPHP::$basedir . 'includes/Mongodb/vendor/autoload.php';

class Mongodb extends MongoDB\Client {
    private $database;

    public function __construct() {
        $this->database = UltimaPHP::$conf['mongodb']['database'];
        $dsn            = 'mongodb://' . UltimaPHP::$conf['mongodb']['host'] . ':27017/' . $this->database;
        parent::__construct($dsn, ['readPreference' => 'secondaryPreferred', 'keepAlive' => 1, 'connectTimeoutMS' => 30000, 'socketTimeoutMS' => 0], ['typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']]);
        $this->selectDatabase($this->database);
    }

    public function database($database) {
        $this->database = $database;
        $this->selectDatabase($this->database);
    }

    public function collection($collection) {
        return $this->selectCollection($this->database, $collection);
    }
}

function mongoId($id) {
    if (is_object($id)) {
        return $id;
    } else {
        return new MongoDB\BSON\ObjectId($id);
    }
}