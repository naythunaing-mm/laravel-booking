<?php

    namespace App\Repository\Room;
    use App\Utility;
    use App\Constant;
    use App\Models\Room;
    use App\ReturnMessage;
    use App\Models\RoomAmenity;
    use App\Repository\Room\RoomRepositoryInterface;
    use App\Models\RoomSpecialFeature;
    use Illuminate\Support\Facades\DB;
    use Intervention\Image\Facades\Image;



   
    class RoomRepository implements RoomRepositoryInterface {
        public function RoomCreate($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR; 
            DB::beginTransaction();
            try {
                $uniqueName               = self::getUploadImage($data['file']);
                $paraObj                  = new Room();
                $paraObj->name            = $data['name'];
                $paraObj->occupancy       = $data['occupancy'];
                $paraObj->size            = $data['size'];
                $paraObj->bed_id          = $data['bed'];
                $paraObj->view_id         = $data['view'];
                $paraObj->description     = $data['description'];
                $paraObj->detail          = $data['detail'];
                $paraObj->price_per_day   = $data['price'];
                $paraObj->extra_bed_price = $data['extraBed'];
                $paraObj->thumbnail       = $uniqueName;
                $tempObj = Utility::addCreated($paraObj);
                $tempObj->save();
                $destination = public_path('assets/upload/' . $tempObj->id . '/thumb');
                if(!file_exists($destination)){
                    mkdir($destination, 0777, true);
                }
                self::cropResizeImage($data['file'],Constant::THUMB_WIDTH,Constant::THUMB_HEIGHT,$destination,$uniqueName);
                self::getRoomSpecialFeature($data['specialfeature'],$tempObj->id);
                self::getRoomAmenity($data['amenity'],$tempObj->id);
                DB::commit();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::OK;
                $returnedObj['insertedRoomId'] = $tempObj->id;
                return $returnedObj;
            } catch (\Exception $e) {
                $logs = "Room Create Error :: \n";
                $logs .= $e->getMessage();
                Utility::saveErrorLog($logs);
                DB::rollBack();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                return $returnedObj;
            }  
       
        }
        private static function cropResizeImage($file, $width, $height, $destination,$filName){
            $modifiedImg = Image::make($file)
                           ->crop($width,$height)
                           ->encode();
            $watermarkPath = public_path(Constant::WATERMARK_PATH);
            $watermark = Image::make($watermarkPath);
            $watermarkX = $modifiedImg->width() - $watermark->width() -10;
            $watermarkY = $modifiedImg->height() - $watermark->height()-10;
            $modifiedImg->insert($watermark,'top-left',$watermarkX,$watermarkY);
            $modifiedImg->save($destination . '/' .$filName);
        }
        private static function getUploadImage($file) {
            $extension                = $file->getClientOriginalExtension();
            $uniqueName               = date('Ymd_His'). '_' . uniqid(). "." . $extension;
            return $uniqueName;
        }
        private static function getRoomSpecialFeature($features, $roomId){
            foreach($features as $feature){
                $paraObj = new RoomSpecialFeature();
                $paraObj->room_id = $roomId;
                $paraObj->special_feature_id = $feature;
                $tempObj = Utility::addCreated($paraObj);
                $tempObj->save();
            }
            return true;
        }
        private static function getRoomAmenity($amenities, $roomId){
            foreach($amenities as $amenity){
                $paraObj = new roomAmenity();
                $paraObj->room_id = $roomId;
                $paraObj->amenity_id = $amenity;
                $tempObj = Utility::addCreated($paraObj);
                $tempObj->save();
            }
            return true;
        }
        public function getRoom(){
            $Room = Room::SELECT("id","name")
                    ->whereNull("deleted_at")
                    ->get();
            return $Room;
        }
        public function RoomEdit($id){
            $Room = Room::find($id);
            return $Room;
        }
        
        public function update($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            try {
                $id            = $data['id'];
                $name          = $data['name'];
                $paraObj       = Room::find($id);
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
        public function delete($id){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            try {
                $paraObj       = Room::find($id);
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