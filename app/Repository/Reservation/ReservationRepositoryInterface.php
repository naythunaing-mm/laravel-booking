<?php
    namespace App\Repository\Reservation;
    interface ReservationRepositoryInterface {
        public function reserve($data);
        public function getReservation();
        public function delete($id);
       
    }
?>