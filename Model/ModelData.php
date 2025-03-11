<?php
    require_once "../Config/Connection.php";
class ModelData
{
    private $db;

    public function __construct()
    {
        $this->db = new Connection();
    }

    // CREATE
    public function insertData($table, $data)
    {
        try {
            $keys = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));

            $sql = "INSERT INTO $table ($keys) VALUES ($values)";
            $stmt = $this->db->Con->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // READ
    public function getData($table, $limit, $offset)
    {
        $stmt = $this->db->Con->prepare("SELECT * FROM $table LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countData($table){
        try {
            $stmt = $this->db->Con->prepare("SELECT COUNT(*) AS total FROM $table");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            return 0;
        }
    }

    // UPDATE
    public function updateData($table, $data, $id)
    {
        try {
            $setClause = "";
            foreach ($data as $key => $value) {
                $setClause .= "$key = :$key, ";
            }
            $setClause = rtrim($setClause, ", ");

            $sql = "UPDATE $table SET $setClause WHERE id = :id";
            $stmt = $this->db->Con->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
            // DELETE
    public function deleteData($table, $id)
    {
        try {
            $sql = "DELETE FROM $table WHERE id = :id";
            $stmt = $this->db->Con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getDataById($table, $id) {
        try {
            $stmt = $this->db->Con->prepare("SELECT * FROM $table WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

}