?php

/**
 * PHP MySQL Update data demo
 */
class UpdateDataDemo {

    const DB_HOST = 'localhost';
    const DB_NAME = 'radius';
    const DB_USER = 'radius';
    const DB_PASSWORD = 'radius_pass';

    /**
     * PDO instance
     * @var PDO
     */
    private $pdo = null;

    /**
     * Open the database connection
     */
    public function __construct() {
        // open database connection
        $connStr = sprintf("mysql:host=%s;dbname=%s", self::DB_HOST, self::DB_NAME);
        try {
            $this->pdo = new PDO($connStr, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Update an existing task in the tasks table
     * @param string $subject
     * @param string $description
     * @param string $startDate
     * @param string $endDate
     * @return bool return true on success or false on failure
     */
    public function update($pppoeuser, $ipv6pd) {
       $task = [
            ':pppoeuser' => $pppoeuser,
            ':ipv6pd' => $ipv6pd];

        $sql = 'UPDATE radreply SET value=:ipv6pd WHERE username=:pppoeuser and attribute="Delegated-IPv6-Prefix"';

        #echo $sql;
        $q = $this->pdo->prepare($sql);

        return $q->execute($task);
    }

    /**
     * close the database connection
     */
    public function __destruct() {
        // close the database connection
        $this->pdo = null;
    }

}

$obj = new UpdateDataDemo();
($obj->update($_POST['username'],$_POST['ipv6pd']));
