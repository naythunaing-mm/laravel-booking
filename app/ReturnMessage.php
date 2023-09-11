<?php
    namespace App;
    use Illuminate\Support\Facades\Auth;
    class ReturnMessage {
        const OK = 200;
        const FORBIDDEN = 403;
        const NOT_FOUND = 404;
        const INTERNAL_SERVER_ERROR =500;
    }
?>