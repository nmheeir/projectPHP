<?
require "../TEST_3/mvc/core/Database.php";
require "../TEST_3/mvc/models/DataView.php";
class BaseModel extends Database {
    protected $connect;

    public function _query($conn, $sql) {
        return $conn->query($sql);
    }

    //get all data from record
    public function get(string $table, array $options = [])
    {
        $this->connect = $this->getConnect();

        $select = $options['select'] ?? '*';
        $where = isset($options['where']) ? 'WHERE ' . $options['where'] : '';
        $order_by = isset($options['order_by']) ? 'ORDER BY ' . $options['order_by'] : '';
        $group_by = isset($options['group_by']) ? 'GROUP BY ' . $options['group_by'] : '';
        $limit = isset($options['offset']) && isset($options['limit']) ? 'LIMIT ' . $options['offset'] . ',' . $options['limit'] : '';

        $sql = "SELECT $select FROM `$table` $where $order_by $limit $group_by";
        $query = $this->_query($this->connect, $sql);

        $data = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, $row);
        }

        return $data;
    }

    /**
     * Nếu tồn tại id trong option => Update
     * Ngược lại => Insert
     */
    public function save(string $table, array $data = [])
    {
        $this->connect = $this->getConnect();

        $values = [];

        $id = isset($data['id']) ? intval($data['id']) : 0; 
        if ($id > 0) {
            // Update existing record
            $values = [];
            foreach ($data as $key => $value) {
                if ($key !== 'id') {
                    $values[] = "$key = '{$value}'";
                }
            }
            $sql = "UPDATE {$table}
                SET " . implode(',', $values) . "
                WHERE id = {$id}";
        } else {
            $columns = implode(',', array_keys($data));
            foreach ($data as $key => $value) {
                $values[] = "'$value'";
            }
            // Insert new record
            $columns = implode(',', array_keys($data));
            $sql = "INSERT INTO {$table} ({$columns}) VALUES (" . implode(',', $values) . ")";
        }

        $this->_query($this->connect, $sql);
        return $this->connect->lastInsertId();
    }

    public function delete(string $table, $id) {
        $this->connect = $this->getConnect();

        $sql = "DELETE FROM {$table} WHERE id := {$id}";

        $this->_query($this->connect, $sql);
    }

    public function custom(string $sql) {
        $this->connect = $this->getConnect();
        $query = $this->_query($this->connect, $sql);

        $data = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, $row);
        }

        return $data;
    }

}