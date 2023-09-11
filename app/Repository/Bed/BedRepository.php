<?php
    namespace App\Repository\Bed;
    use App\Repository\Bed\BedRepositoryInterface;
    use App\Models\Bed;
    use App\ReturnMessage;
    use App\Utility;
    class BedRepository implements BedRepositoryInterface {
        public function getBed(){
            $bed = Bed::SELECT("id","name")
                    ->whereNull("deleted_at")
                    ->get();
            return $bed;
        }
        public function bedEdit($id){
            $bed = Bed::find($id);
            return $bed;
        }
        
        public function BedCreate($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR; 
            try {
                $paraObj       = new Bed();
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
        
        public function bedUpdate($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            try {
                $id            = $data['id'];
                $name          = $data['name'];
                $paraObj       = Bed::find($id);
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
    }
?>