<?php

    namespace App\Repository\roomGallery;
    use App\Repository\roomGallery\roomGalleryRepositoryInterface;
    use App\Models\RoomGallery;
    use App\ReturnMessage;
    use App\Utility;
    use App\Constant;
    use App\Models\Room;

    class roomGalleryRepository implements roomGalleryRepositoryInterface {
        public function getRoomGalleryById($roomId){
            $roomGallery = RoomGallery::select("id", "image", "room_id")
                ->where("room_id", "=", $roomId)
                ->whereNull("deleted_at")
                ->get();
            return $roomGallery;
        }
        public function editGallery($id){
            $gallery = RoomGallery::find($id);
            return $gallery;
        }
        public function createRoomGallery($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR; 
           
            try {
                $uniqueName               = Utility::getUploadImage($data['file']);
                $paraObj                  = new RoomGallery();
                $paraObj->room_id         = $data['id'];
                $paraObj->image           = $uniqueName;
                
                $tempObj = Utility::addCreated($paraObj);
                $tempObj->save();
                $destination = public_path('assets/upload/' . $data['id']);
                if(!file_exists($destination)){
                    mkdir($destination, 0777, true);
                }
                Utility::cropResizeImage($data['file'],Constant::UPLOAD_WIDTH,Constant::UPLOAD_HEIGHT,$destination,$uniqueName);
            
                $returnedObj['softGuideStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            } catch (\Exception $e) {
                $logs = "Room Gallery Error :: \n";
                $logs .= $e->getMessage();
                Utility::saveErrorLog($logs);
                $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                return $returnedObj;
            }  
       
        }
        public function updateGallery($data) {
        
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR; 
           
            try {
                $id                       = $data['id'];
                $room_id                  = $data['room_id'];
                $uniqueName               = Utility::getUploadImage($data['file']);
                $paraObj                  = RoomGallery::find($id);
                $old_image                = $paraObj->image;
                $paraObj->image           = $uniqueName; 
                $tempObj = Utility::addUpdate($paraObj);
                $tempObj->save();
                $destination = public_path('assets/upload/' . $room_id);
                if(!file_exists($destination)){
                    mkdir($destination, 0777, true);
                }
                Utility::cropResizeImage($data['file'],Constant::UPLOAD_WIDTH,Constant::UPLOAD_HEIGHT,$destination,$uniqueName);
                $old_image_path = public_path('assets/upload/' . $room_id . '/' . $old_image);
                unlink($old_image_path);
                $returnedObj['softGuideStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            } catch (\Exception $e) {
                $logs = "Room Gallery Error :: \n";
                $logs .= $e->getMessage();
                Utility::saveErrorLog($logs);
                $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                return $returnedObj;
            } 
        }
        
        public function deleteGallery($id){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            try {
                $paraObj       = RoomGallery::find($id);
                $tempObj       = Utility::addDelete($paraObj);
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