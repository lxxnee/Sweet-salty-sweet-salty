<?php
namespace model;

class BoardsnameModel extends Model {
    public function getBoardsnameList() {
        try {
            $sql =
                " SELECT "
                ." b_type "
                ." ,bn_name "
                ." FROM "
                ." boardsname "
                ." ORDER BY "
                ." b_type ASC "
            ;  
            
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll();

            return $result;
        } catch (\Throwable $e) {
            echo "BoardsnameModel -> getBoardsnameList(),".$e->getMessage();
            exit;
        }
    }
}