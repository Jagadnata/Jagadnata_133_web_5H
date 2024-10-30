<?php

namespace Controller;

include 'Traits/ResponseFormatter.php';
include 'Controllers/Controller.php';

use Traits\ResponseFormatter;

class ProductController extends Controller
{
    use ResponseFormatter;

    public function __construct()
    {
        $this->controllerName = "Get All Product";
        $this->controllerMethod = "GET";
    }

    public function getAllProduct()
    {
        // Array dummy data
        $dummyData = [
            "nama" => "Material",
            "kategori" => "Alat",
            "stok" => "25 buah"
        ];

        $response = [
            "controller_attribute" => $this->getControllerAttribute(),
            "product" => $dummyData
        ];

        return $this->responseFormatter(200, "Success", $response);
    }
}
