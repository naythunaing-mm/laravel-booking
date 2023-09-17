<?php
    namespace App\Repository\Feature;
    use App\Repository\Feature\FeatureRepositoryInterface;
    use App\Models\SpecialFeature;
    use App\Models\RoomSpecialFeature;
    use App\Utility;
    use App\ReturnMessage;
    class FeatureRepository implements FeatureRepositoryInterface {
        public function getFeature(){
            $feature_data = SpecialFeature::SELECT("id","name")
                    ->whereNull("deleted_at")
                    ->get();
            return $feature_data;
        }
        public function FeatureEdit($id){
            $Feature_data = SpecialFeature::find($id);
            return $Feature_data;
        }
        public function FeatureCreate($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR; 
            try {
                $paraObj       = new SpecialFeature();
                $paraObj->name = $data['name'];
                $tempObj       = Utility::addCreated($paraObj);
                $tempObj->save();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            } catch (\Exception $e) {
                $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                return $returnedObj;

            }  
        }
        public function FeatureUpdate($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            try {
                $id            = $data['id'];
                $name          = $data['name'];
                $paraObj       = SpecialFeature::find($id);
                $paraObj->name = $name;
                $tempObj       = Utility::addUpdate($paraObj);
                $tempObj->save();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            } catch (\Exception $e) {
                $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                return $returnedObj;
            }
           
        }
        public function getFeatureByroomId($roomId){
            $featureData = [];
            $data = RoomSpecialFeature::SELECT("special_feature_id")
                    ->WHERE("room_id",$roomId)
                    ->whereNull("deleted_at")
                    ->get();
            foreach($data as $feature) {
                array_push($featureData,$feature->special_feature_id);
            }
            return $featureData;

        }

    }
?>