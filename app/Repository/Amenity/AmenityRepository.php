<?php
    namespace App\Repository\Amenity;
    use App\Repository\Amenity\AmenityRepositoryInterface;
    use App\Models\Amenity;
    use App\Models\RoomAmenity;
    use App\Utility;
    use App\ReturnMessage;
    class AmenityRepository implements AmenityRepositoryInterface {
        public function getAmenity(){
            $Amenity = Amenity::SELECT("id","name","type")
                    ->whereNull("deleted_at")
                    ->get();
            return $Amenity;
        }
        public function AmenityEdit($id){
            $Amenity_data = Amenity::find($id);
            return $Amenity_data;
        }
        public function AmenityCreate($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR; 
            try {
                $paraObj       = new Amenity();
                $paraObj->name = $data['name'];
                $paraObj->type = $data['type'];
                $tempObj       = Utility::addCreated($paraObj);
                $tempObj->save();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            } catch (\Exception $e) {
                $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                return $returnedObj;

            }  
        }
        public function AmenityUpdate($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            try {
                $id            = $data['id'];
                $name          = $data['name'];
                $type          = $data['type'];
                $paraObj       = Amenity::find($id);
                $paraObj->name = $name;
                $paraObj->type = $type; 
                $tempObj       = Utility::addUpdate($paraObj);
                $tempObj->save();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            } catch (\Exception $e) {
                $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                return $returnedObj;
            }
           
        }
        public function getAmenityByroomId($roomId){
            $amenityData = [];
            $data = RoomAmenity::SELECT("amenity_id")
                    ->WHERE("room_id",$roomId)
                    ->whereNull("deleted_at")
                    ->get();
            foreach($data as $amenity) {
                array_push($amenityData,$amenity->amenity_id);
            }
            return $amenityData;

        }

    }
?>