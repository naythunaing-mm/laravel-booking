<?php
    namespace App\Repository\Amenity;
    interface AmenityRepositoryInterface {
        public function getAmenity();
        public function AmenityCreate($data);
        public function AmenityUpdate($data);
        public function AmenityEdit($id);
        public function getAmenityByroomId($roomId);
    }
?>