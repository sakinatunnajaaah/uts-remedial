<?php
    class Ruangan {
        private $conn;
        private $table_name = "rooms";

        public $id;
        public $hotel_id;
        public $room_number;
        public $room_type;
        public $price;
        public $availability;

        public function __construct($db){
            $this->conn = $db;
        }

        // data ruangan
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

        // Tambah ruangan ke database
        public function store(){
            $query = "INSERT INTO {$this->table_name} 
                    (hotel_id, room_number, room_type, price, availability) 
                    VALUES (?, ?, ?, ?, ?)
                    ";
            $data = $this->conn->prepare($query);
        
            $data->execute([
                $this->hotel_id, 
                $this->room_number,
                $this->room_type, 
                $this->price,
                $this->availability,
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

        // Update ruangan ke database
        public function update(){
            $query = "UPDATE {$this->table_name} 
                    SET hotel_id=?, room_number=?, room_type=?, price=?, availability=? 
                    WHERE id=?";
            $data = $this->conn->prepare($query);
        
            $data->execute([
                $this->hotel_id, 
                $this->room_number,
                $this->room_type, 
                $this->price,
                $this->availability,
                $this->id
            ]);
        
            return $data->rowCount() > 0;
        }

        // Hapus ruangan dari database
        public function delete(){
            $query = "DELETE FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
        
            return $data->rowCount() > 0;
        }
    }
?>