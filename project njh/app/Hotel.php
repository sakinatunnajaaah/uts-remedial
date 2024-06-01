<?php
    class Hotel {
        private $conn;
        private $table_name = "hotels";

        public $id;
        public $name;
        public $address;
        public $city;
        public $country;

        public function __construct($db){
            $this->conn = $db;
        }

        // Tampilkan data semua hotel
        public function index(){
            $query = "SELECT * FROM {$this->table_name}";
            $data = $this->conn->prepare($query);
            $data->execute();
            return $data;
        }

        // Tampilkan halaman create
        public function create(){
            header("Location: create.php");
            exit();
        }

        // Tambah hotel ke database
        public function store(){
            $query = "INSERT INTO {$this->table_name} 
                    (name, address, city, country) 
                    VALUES (?, ?, ?, ?)
                    ";
            $data = $this->conn->prepare($query);
        
            $data->execute([
                $this->name,
                $this->address,
                $this->city,
                $this->country,
            ]);
        
            return $data->rowCount() > 0;
        }

        // Tampilkan halaman edit
        public function edit(){
            $query = "SELECT * FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
            return $data;
        }

        // Update hotel ke database
        public function update(){
            $query = "UPDATE {$this->table_name} 
                    SET name=?, address=?, city=?, country=? 
                    WHERE id=?";
            $data = $this->conn->prepare($query);
        
            $data->execute([ 
                $this->name,
                $this->address,
                $this->city,
                $this->country,
                $this->id
            ]);
        
            return $data->rowCount() > 0;
        }

        // Hapus hotel dari database
        public function delete(){
            $query = "DELETE FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
        
            return $data->rowCount() > 0;
        }
    }
?>