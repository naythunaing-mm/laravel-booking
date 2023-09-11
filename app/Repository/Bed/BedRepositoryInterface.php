<?php
    namespace App\Repository\Bed;
    interface BedRepositoryInterface {
        public function getBed();
        public function bedCreate($data);
        public function bedUpdate($data);
        public function bedEdit($id);
    }
?>