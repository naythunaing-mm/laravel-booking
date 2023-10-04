<?php

    namespace App\Repository\Room;
    use App\Utility;
    use App\Constant;
    use App\Models\Customer;
    use App\Models\Reservation;
    use App\Models\Room;
    use App\ReturnMessage;
    use App\Models\RoomAmenity;
    use App\Repository\Room\RoomRepositoryInterface;
    use App\Models\RoomSpecialFeature;
    use App\Models\SpecialFeature;
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
    
    class RoomRepository implements RoomRepositoryInterface {
        public function RoomCreate($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR; 
            DB::beginTransaction();
            try {
                $uniqueName               = Utility::getUploadImage($data['file']);
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
                Utility::cropResizeImage($data['file'],Constant::THUMB_WIDTH,Constant::THUMB_HEIGHT,$destination,$uniqueName);
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
        public function update($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            DB::beginTransaction();
            try {
                $id                       = $data['id'];
                $paraObj                  = Room::find($id);
                $paraObj->name            = $data['name'];
                $paraObj->occupancy       = $data['occupancy'];
                $paraObj->size            = $data['size'];
                $paraObj->bed_id          = $data['bed'];
                $paraObj->view_id         = $data['view'];
                $paraObj->description     = $data['description'];
                $paraObj->detail          = $data['detail'];
                $paraObj->price_per_day   = $data['price'];
                $paraObj->extra_bed_price = $data['extraBed'];
               
                if(array_key_exists('file',$data)){
                    $uniqueName = Utility::getUploadImage($data['file']);
                    $paraObj->thumbnail       = $uniqueName;
                }
                $tempObj = Utility::addUpdate($paraObj);
                $tempObj->save();
                
                self::deleteRoomFeature($id);
                self::deleteRoomAmenity($id);
                self::getRoomSpecialFeature($data['specialfeature'],$tempObj->id);
                self::getRoomAmenity($data['amenity'],$tempObj->id);
                if(array_key_exists('file',$data)){
                    $destination = public_path('assets/upload/' . $tempObj->id . '/thumb');
                    if(!file_exists($destination)){
                        mkdir($destination, 0777, true);
                    }
                    Utility::cropResizeImage($data['file'],Constant::THUMB_WIDTH,Constant::THUMB_HEIGHT,$destination,$uniqueName);
                }
                DB::commit();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::OK;
                $returnedObj['insertedRoomId'] = $tempObj->id;
                return $returnedObj;
            } catch (\Exception $e) {
                $logs = "Room Update Error :: \n";
                $logs .= $e->getMessage();
                Utility::saveErrorLog($logs);
                DB::rollBack();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                return $returnedObj;
            }
           
        }
        private static function deleteRoomFeature($roomId) {
            $delete = RoomSpecialFeature::where("room_id",$roomId)->delete();
            return true;
        }
        private static function deleteRoomAmenity($rooId) {
            $delete = RoomAmenity::where("room_id",$rooId)->delete();
            return true;
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
        public function roomRandomById() {
            $rooms = Room::select (
                                    'id',
                                    'name',
                                    'price_per_day',
                                    'thumbnail',
                                    )
                                    ->whereNull('deleted_at')
                                    ->inRandomOrder()
                                    ->limit(6)
                                    ->get();
            return $rooms;
        }
        public function getRoomListing(){
            $rooms = Room::select(
                                    'room.id',
                                    'room.name',
                                    'room.size',
                                    'room.occupancy',
                                    'room.bed_id',
                                    'room.view_id',
                                    'room.thumbnail',
                                    'room.description',
                                    'room.detail',
                                    'room.price_per_day',
                                    'room.extra_bed_price',
                                    'bed.name as bed_name', 
                                    'view.name as view_name' 
                                )
                                ->leftJoin('bed', 'room.bed_id', '=', 'bed.id') 
                                ->leftJoin('view', 'room.view_id', '=', 'view.id') 
                                ->whereNull('room.deleted_at')
                                ->whereNull('bed.deleted_at')
                                ->whereNull('view.deleted_at')
                                ->get();
        return $rooms;
       
        }
        public function RoomEdit($id){
            $Room = Room::find($id);
            return $Room;
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
    public function roomDetail($id){
        $rooms = Room::select(
                                'room.id',
                                'room.name',
                                'room.size',
                                'room.occupancy',
                                'room.bed_id',
                                'room.view_id',
                                'room.thumbnail',
                                'room.description',
                                'room.detail',
                                'room.price_per_day',
                                'room.extra_bed_price',
                                'bed.name as bed_name', 
                                'view.name as view_name', 
                            )
                            ->leftJoin('bed', 'room.bed_id', '=', 'bed.id') 
                            ->leftJoin('view', 'room.view_id', '=', 'view.id') 
                            ->whereNull('room.deleted_at')
                            ->whereNull('bed.deleted_at')
                            ->whereNull('view.deleted_at')
                            ->get();
        return $rooms;
    }
    public function roomAmenityByroomId($id) {
        $amenity_data = RoomAmenity::SELECT("amenity.name","amenity.type")
                        ->leftJoin("amenity","amenity.id","room_amenity.amenity_id")
                        ->WHERE("room_amenity.room_id",$id)
                        ->whereNull("room_amenity.deleted_at")
                        ->whereNull("amenity.deleted_at")
                        ->get();
        return $amenity_data;
    }
    public function roomFeatureByroomId($id) {
        $feature_data = RoomSpecialFeature::SELECT("special_feature.name")
                        ->leftJoin("special_feature","special_feature.id","room_special_feature.special_feature_id")
                        ->WHERE("room_special_feature.special_feature_id",$id)
                        ->whereNull("room_special_feature.deleted_at")
                        ->whereNull("special_feature.deleted_at")
                        ->get();
        return $feature_data;
    }
        public function rooms() {
            $rooms = Room::select (
                                    'id',
                                    'name',
                                    'price_per_day',
                                    'thumbnail',
                                    )
                                    ->whereNull('deleted_at')
                                    ->inRandomOrder()
                                    ->get();
            return $rooms;
        }
        public function roomReserved($data) {
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            // DB::beginTransaction();
            
            try {
                // Find or create the customer
                $customer = Customer::where('email', $data['email'])->first();
                $room = Room::find($data['room_id']);
                if (!$customer) {
                    $customer = new Customer();
                    $customer->name = $data['name'];
                    $customer->email = $data['email'];
                    $customer->phone = $data['phone'];
                    $tempObj = Utility::addCreated($customer);
                    $tempObj->save();
                }
        
                // Calculate the day difference
                $checkin_date = new \DateTime($data['checkin']);
                $checkout_date = new \DateTime($data['checkout']);
                $interval = $checkin_date->diff($checkout_date);
                $day_difference = $interval->days;
        
                // Create a reservation
                $paraObj = new Reservation();
                $paraObj->checkin = $data['checkin'];
                $paraObj->checkout = $data['checkout'];
                $paraObj->room_id = $data['room_id'];
                $paraObj->extra_bed = isset($data['extra_bed']) ? $data['extra_bed'] : 0;

                // Calculate the total_price based on the extra_bed
                if ($paraObj->extra_bed == 0) {
                    $paraObj->total_price = $room->price_per_day * $day_difference;
                } else {
                    $paraObj->total_price = ($room->price_per_day + $data['extra_bed_price']) * $day_difference;
                }
                
                $paraObj->customer_id = $customer->id; 
                $paraObj->status = isset($data['status']) ? $data['status'] : 0;
        
                $tempObj = Utility::addCreated($paraObj);
                $tempObj->save();
        
                // DB::commit();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::OK;
                $returnedObj['insertedRoomId'] = $tempObj->id;
                return $returnedObj;
            } catch (\Exception $e) {
                // Log the error for debugging purposes
                $logs = "Room Create Error :: \n";
                $logs .= $e->getMessage();
                Utility::saveErrorLog($logs);
                
                // Rollback the transaction and return an error response
                // DB::rollBack();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['error_message'] = "An error occurred while creating the reservation.";
                return $returnedObj;
            }  
        }
        public function roomSearch($data) {
        $checkInDate = Carbon::createFromFormat('m/d/Y', $data['checkin']);
        $checkOutDate = Carbon::createFromFormat('m/d/Y', $data['checkout']);
        $remove_ids = [];
        $sql1 = Reservation::SELECT('room_id')
                ->where('checkin','<',$checkInDate)
                ->where('checkout','>',$checkInDate)
                ->where('status','=',Constant::RESERVATION_AVALIABLE)
                ->whereNull('deleted_at')
                ->get();
        foreach($sql1 as $sql) {
            array_push($remove_ids,$sql->room_id);
        }

        $sql2 = Reservation::SELECT('room_id')
                ->where('checkin','>',$checkInDate)
                ->where('checkin','<',$checkOutDate)
                ->where('status','=',Constant::RESERVATION_AVALIABLE)
                ->whereNull('deleted_at')
                ->get();
        foreach($sql2 as $sql) {
            array_push($remove_ids,$sql->room_id);
        }

        $rooms = Room::SELECT('id','name','price_per_day','thumbnail')
                 ->whereNotIn('id',$remove_ids)
                 ->whereNull('deleted_at')
                 ->orderByDesc('id')
                 ->get();
        return $rooms;
        }
        
    }
?>