<?php
    namespace App\Repository\View;
    interface ViewRepositoryInterface {
        public function getView();
        public function viewEdit($id);
        public function create($data);
        public function update($data);
        public function delete($id);
    }
?>