<?php 
    namespace App;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\DB;
    class Utility{
        public static function addCreated( $paraObj ){
            if(Auth::guard('Admin')->check()){
                $date          = date('Y-m-d H:i:s');
                $paraObj->created_at = $date;
                $paraObj->updated_at = $date;
                if(Auth::guard('Admin')->check()){
                    $user_id       = Auth::guard('Admin')->user()->id;
                    $paraObj->created_by = $user_id;
                    $paraObj->updated_by = $user_id;
                }    
               
            }
            return $paraObj;
        }
        public static function addUpdate($paraObj){
            $date   = date('Y-m-d H:i:s');
            $paraObj->updated_at = $date;
            if(Auth::guard('Admin')->check()){
                $paraObj->updated_by = Auth::guard('Admin')->user()->id;
            }
            return $paraObj;
        }
        public static function addDelete($paraObj){
            $date   = date('Y-m-d H:i:s');
            $paraObj->deleted_at = $date;
            if(Auth::guard('Admin')->check()){
                $paraObj->deleted_by = Auth::guard('Admin')->user()->id;
            }
            return $paraObj;
        }
        public static function saveDebugLog($logMessage) {
            $querylog = DB::getQueryLog();
            $formattedQuaries = '';

            foreach($querylog as $query){
                $sqlQuery = $query['query'];
                foreach($query['bindings'] as $binding){
                    $sqlQuery = preg_replace('/\?/',"'". $binding . "'" , $sqlQuery, 1);
                }
                $formattedQuaries .= $sqlQuery . PHP_EOL;
            }
            log::debug($logMessage . PHP_EOL . $formattedQuaries);
        }
        
        public static function saveErrorLog($logMessage){
            $querylog = DB::getQueryLog();
            $formattedQuaries = '';
            foreach($querylog as $query){
                $sqlQuery = $query['query'];
                foreach($query['bindings'] as $binding){
                    $sqlQuery = preg_replace('/\?/',"'". $binding . "'" , $sqlQuery, 1);
                }
                $formattedQuaries .= $sqlQuery . PHP_EOL;
            }
            log::error($logMessage . PHP_EOL . $formattedQuaries);
        }     
}