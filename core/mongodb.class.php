<?php
require_once UltimaPHP::$basedir . 'includes/Mongodb/vendor/autoload.php';

class Mongodb extends MongoDB\Client {
    private $database;

    public function __construct() {
        $this->database = UltimaPHP::$conf['mongodb']['database'];

        $URI = getenv('UPHP_MONGO_URI') ?: UltimaPHP::$conf['mongodb']['URI'];
        $username = getenv('UPHP_MONGO_USER') ?: UltimaPHP::$conf['mongodb']['username'];
        $password = getenv('UPHP_MONGO_PW') ?: UltimaPHP::$conf['mongodb']['password'];
        $host = getenv('UPHP_MONGO_HOST') ?: UltimaPHP::$conf['mongodb']['host'];
        $port = getenv('UPHP_MONGO_PORT') ?: UltimaPHP::$conf['mongodb']['port'];

        if (!empty($URI)) {
            $dsn = $URI . $this->database;
        } else {
            if (!empty($username) && !empty($password)) {
                $dsn = 'mongodb://' . $username . ':' . $password . '@' . $host . ':' . $port . '/' . $this->database;
            } else {
                $dsn = 'mongodb://' . $host . ':' . $port . '/' . $this->database;
            }
        }

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
