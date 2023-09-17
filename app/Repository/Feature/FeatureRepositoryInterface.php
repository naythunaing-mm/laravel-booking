<?php
    namespace App\Repository\Feature;
    interface FeatureRepositoryInterface {
        public function getFeature();
        public function FeatureCreate($data);
        public function FeatureUpdate($data);
        public function FeatureEdit($id);
        public function getFeatureByroomId($roomId);
    }
?>