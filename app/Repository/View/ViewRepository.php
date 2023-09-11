<?php
    namespace App\Repository\View;
    use App\Repository\View\ViewRepositoryInterface;
    use App\Models\View;
    use App\Utility;
    use App\ReturnMessage;
    class ViewRepository implements ViewRepositoryInterface {
        public function getView(){
            $view = View::SELECT("id","name")
                    ->whereNull("deleted_at")
                    ->get();
            return $view;
        }
        public function viewEdit($id){
            $view = View::find($id);
            return $view;
        }
        public function create($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR; 
            try {
                $paraObj       = new View();
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
        public function update($data){
            $returnedObj = array();
            $returnedObj['softGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            try {
                $id            = $data['id'];
                $name          = $data['name'];
                $paraObj       = View::find($id);
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
                $paraObj       = View::find($id);
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