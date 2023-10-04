<?php
    namespace App\Repository\Room;
    interface RoomRepositoryInterface {
        public function getRoomListing();
        public function RoomEdit($id);
        public function RoomCreate($data);
        public function update($data);
        public function delete($id);
        public function roomRandomById();
        public function roomAmenityByroomId($id);
        public function roomFeatureByroomId($id);
        public function rooms();
        public function roomReserved($data);
        public function roomSearch($data);
    }
?>