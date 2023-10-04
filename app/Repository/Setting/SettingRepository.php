<?php

    namespace App\Repository\Setting;
    use App\Utility;
    use App\Constant;
    use App\Models\HotelSetting;
    use App\ReturnMessage;
    use App\Repository\Setting\SettingRepositoryInterface;
    use Illuminate\Support\Facades\DB;

    
    class SettingRepository implements SettingRepositoryInterface {
        
        public function update($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            DB::beginTransaction();
            try {
                $id                       = $data['id'];
                $paraObj                  = HotelSetting::find($id);
                $paraObj->name            = $data['name'];
                $paraObj->email           = $data['email'];
                $paraObj->address         = $data['address'];
                $paraObj->checkin         = $data['checkin'];
                $paraObj->checkout        = $data['checkout'];
                $paraObj->online_phone    = $data['online_phone'];
                $paraObj->outline_phone   = $data['outline_phone'];
                $paraObj->size_unit       = $data['size_unit'];
                $paraObj->occupancy       = $data['occupancy'];
                $paraObj->price_unit      = $data['price_unit'];
                $old_image                = $paraObj->logo;
               
                if(array_key_exists('file',$data)){
                    $uniqueName = Utility::getUploadImage($data['file']);
                    $paraObj->logo       = $uniqueName;
                }
                $tempObj = Utility::addUpdate($paraObj);
                $tempObj->save();
                
                if(array_key_exists('file',$data)){
                    $destination = public_path('./images/');
                    if(!file_exists($destination)){
                        mkdir($destination, 0777, true);
                    }
                    Utility::cropResizeImage($data['file'],Constant::THUMB_WIDTH,Constant::THUMB_HEIGHT,$destination,$uniqueName);
                    $old_image_path = public_path('images/' . $old_image);
                    unlink($old_image_path);
                }
                DB::commit();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::OK;
                $returnedObj['insertedRoomId'] = $tempObj->id;
                return $returnedObj;
            } catch (\Exception $e) {
                $logs = "Setting Update Error :: \n";
                $logs .= $e->getMessage();
                Utility::saveErrorLog($logs);
                DB::rollBack();
                $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                return $returnedObj;
            }
           
        }
        
        public function SettingEdit(){
            $editData = HotelSetting::SELECT(
                                                'id',
                                                'name',
                                                'email',
                                                'address',
                                                'checkin',
                                                'checkout',
                                                'online_phone',
                                                'outline_phone',
                                                'size_unit',
                                                'occupancy',
                                                'price_unit',
                                                'logo'
                                            )->first();
            return $editData;
        }   
        
    }
?>