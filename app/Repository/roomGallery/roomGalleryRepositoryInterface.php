<?php
    namespace App\Repository\roomGallery;
    interface roomGalleryRepositoryInterface {
        public function getRoomGalleryById($roomId);   
        public function createRoomGallery($data);
        public function deleteGallery($id);

        public function editGallery($id);
        public function updateGallery($id);
    
    }
?>