<?php
    class Reservasi {
        private $conn;
        private $table_name = "reservations";

        public $id;
        public $guest_id;
        public $room_id;
        public $check_in_date;
        public $check_out_date;

        public function __construct($db){
            $this->conn = $db;
        }

        //  data semua reservasi
        public function index(){
            $query = "SELECT * FROM {$this->table_name}";
            $data = $this->conn->prepare($query);
            $data->execute();
            return $data;
        }

        //  halaman create
        public function create(){
            header("Location: create.php");
            exit();
        }

        // reservasi ke database
        public function store(){
            $query = "INSERT INTO {$this->table_name} 
                    (guest_id, room_id, check_in_date, check_out_date) 
                    VALUES (?, ?, ?, ?)
                    ";
            $data = $this->conn->prepare($query);
        
            $data->execute([
                $this->guest_id,
                $this->room_id,
                $this->check_in_date,
                $this->check_out_date,
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

        // Update reservasi ke database
        public function update(){
            $query = "UPDATE {$this->table_name} 
                    SET guest_id=?, room_id=?, check_in_date=?, check_out_date=?
                    WHERE id=?";
            $data = $this->conn->prepare($query);
        
            $data->execute([ 
                $this->guest_id,
                $this->room_id,
                $this->check_in_date,
                $this->check_out_date,
                $this->id
            ]);
        
            return $data->rowCount() > 0;
        }

        // Hapus reservasi dari database
        public function delete(){
            $query = "DELETE FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
        
            return $data->rowCount() > 0;
        }
    }
?>