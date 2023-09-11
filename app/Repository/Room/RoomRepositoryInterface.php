<?php
    namespace App\Repository\Room;
    interface RoomRepositoryInterface {
        public function getRoom();
        public function RoomEdit($id);
        public function RoomCreate($data);
        public function update($data);
        public function delete($id);
    }
?>