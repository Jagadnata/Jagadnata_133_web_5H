<?php
trait ApiResponseFormatter {
    public function formatResponse($success, $message, $data = []) {
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data
        ];
    }
}
?>
