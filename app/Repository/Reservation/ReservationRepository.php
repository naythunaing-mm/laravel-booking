<?php

namespace App\Repository\Reservation;

use App\Constant;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

use App\ReturnMessage;
use App\Utility;

use App\Repository\Reservation\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
   public function __construct()
   {
      DB::connection()->enableQueryLog();
   }

   public function reserve($data){
      $returnMsgObj = array();
      $returnMsgObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
      DB::beginTransaction();
      try {
         $customerName = $data['name'];
         $cutomerEmail = $data['email'];
         $customerPhone = $data['phone'];
         
         $isExtraBed = array_key_exists("is_extra_bed", $data) ? 1 : 0;
         $checkInDate = Carbon::createFromFormat('m/d/Y', $data['checkin']);
         $checkOutDate = Carbon::createFromFormat('m/d/Y', $data['checkout']);  
         $dayDiff = $checkInDate->diffInDays($checkOutDate);

         $room = Room::find($data['room_id']);
         $price = $room->price_per_day;
         $extraPrice = $room->extra_bed_price;

         if ($isExtraBed == 0) {
            $total_price = $price * $dayDiff;
         } else {
            $total_price = ($price + $extraPrice) * $dayDiff;
         }
         
         $customer_id = self::getCustomerId($customerName, $cutomerEmail, $customerPhone);

         $paramObj = new Reservation();
         $paramObj->room_id = $room->id;
         $paramObj->checkin = $checkInDate->format('Y-m-d');
         $paramObj->checkout = $checkOutDate->format('Y-m-d');
         $paramObj->extra_bed = $isExtraBed;
         $paramObj->total_price = $total_price;
         $returnObj = Utility::addCreated($paramObj);
         $returnObj->customer_id = $customer_id;
         $returnObj->save();

         DB::commit();

         $logMsg = "Room Reservation Store :: ";
         Utility::saveDebugLog($logMsg);

         $returnMsgObj['softGuideStatusCode'] = ReturnMessage::OK;
         return $returnMsgObj;
      } catch (\Exception $e) {
         DB::rollBack();
         $returnMsgObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
         $logMsg = "Room Reservation Store Error :: ";
         $logMsg .= $e->getMessage();
         Utility::saveErrorLog($logMsg);
      }
   }
   private static function getCustomerId($name, $email, $phone){
      $customer_id = null;
      $customer = Customer::SELECT("id")
                  ->where("name",$name)
                  ->where("email", $email)
                  ->where("phone", $phone)
                  ->first();
      if($customer == null){
         $paramObj = new Customer();

         $paramObj->name = $name;
         $paramObj->email = $email;
         $paramObj->phone = $phone;
         $returnObj = Utility::addCreated($paramObj);
         $returnObj->save();
         $customer_id = $returnObj->id;
      } else {
         $customer_id = $customer->id;
      }
      return $customer_id;
   }
   public function getReservation() {
      $reservations = Reservation::select(
                                             'reservation.id',
                                             'reservation.checkin',
                                             'reservation.checkout',
                                             'reservation.room_id',
                                             'reservation.extra_bed',
                                             'reservation.total_price',
                                             'reservation.customer_id',
                                             'reservation.status',
                                             'customer.name as customer_name',
                                             'customer.email',
                                             'customer.phone',
                                             'room.name as room_name', 
                                             
                                          )
                        ->leftJoin('customer', 'reservation.customer_id', '=', 'customer.id') 
                        ->leftJoin('room', 'reservation.room_id', '=', 'room.id') 
                        ->whereNull('customer.deleted_at')
                        ->whereNull('room.deleted_at')
                        ->whereNull('reservation.deleted_at')
                        ->paginate(Constant::PAGE_LIMIT);
         return $reservations;
   }
   public function delete($id){
      $returnedObj = array();
      $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
      try {
          $paraObj       = Reservation::find($id);
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