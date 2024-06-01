<?php
    class Tamu {
        private $conn;
        private $table_name = "guests";

        public $id;
        public $first_name;
        public $last_name;
        public $email;
        public $phone;

        public function __construct($db){
            $this->conn = $db;
        }

        // data produk
        public function index(){
            $query = "SELECT * FROM {$this->table_name}";
            $data = $this->conn->prepare($query);
            $data->execute();
            return $data;
        }

        // halaman create
        public function create(){
            header("Location: create.php");
            exit();
        }

        // Tambah produk ke database
        public function store(){
            $query = "INSERT INTO {$this->table_name} 
                    (first_name, last_name, email, phone) 
                    VALUES (?, ?, ?, ?)
                    ";
            $data = $this->conn->prepare($query);
        
            $data->execute([
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->phone,
            ]);
        
            return $data->rowCount() > 0;
        }

        // halaman edit
        public function edit(){
            $query = "SELECT * FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
            return $data;
        }

        // Update produk ke database
        public function update(){
            $query = "UPDATE {$this->table_name} 
                    SET first_name=?, last_name=?, email=?, phone=?
                    WHERE id=?";
            $data = $this->conn->prepare($query);
        
            $data->execute([ 
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->phone,
                $this->id
            ]);
        
            return $data->rowCount() > 0;
        }

        // Hapus produk dari database
        public function delete(){
            $query = "DELETE FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
        
            return $data->rowCount() > 0;
        }
    }
?>