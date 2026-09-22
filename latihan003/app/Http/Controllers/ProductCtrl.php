<?php

namespace App\Http\Controllers;


class ProductCtrl extends Controller
{
    public function products() {
        echo "fungsi product";
    }

    public function detailproducts($id) {
        echo "fungsi detailproduct";
    }

    public function notaproducts($id, $nama) {
        echo $id;
        echo "<br>";
        echo $nama;
    }
}
