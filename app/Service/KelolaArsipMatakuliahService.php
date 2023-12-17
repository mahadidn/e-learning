<!-- repo arsip -->
public function arsipMataKuliah(){
        $statement = $this->connection->prepare("SELECT * FROM arsip_nilai");
        $statement->execute();

        $row = $statement->fetchAll();
        return $row;
    }