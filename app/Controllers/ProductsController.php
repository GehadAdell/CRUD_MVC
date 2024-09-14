<?php

class ProductsController
{
    public function index()
    {
        $db = new Product();
        $data['products'] = $db->getAllProducts();
        View::load('product/index', $data);
    }

    public function add()
    {
        View::load("product/add");
    }

    public function store()
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
        }

        $data = array(
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "qty" => $qty
        );

        $db = new Product();
        if ($db->insertProduct($data)) {
            View::load('product/add', ["success" => "Data Added Successfully"]);
        } else {
            View::load("product/add");
        }
    }


    public function update($id)
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
        }

        $dataupdate = array(
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "qty" => $qty
        );

        $db = new Product();
        if ($db->updateProduct($id, $dataupdate)) {
            View::load('product/edit', ["success" => "Data Updated Successfully", 'row' => $db->getRow($id)]);
        } else {
            View::load("product/edit", ['row' => $db->getRow($id)]);
        }
    }

    public function edit($id)
    {
        $db = new Product();
        if ($db->getRow($id)) {
            $data['row'] = $db->getRow($id);
            View::load("product/edit", $data);
        } else {
            echo "Error";
        }
    }

    public function delete($id)
    {
        $db = new Product();
        if ($db->deleteProduct($id)) {
            View::load("product/delete");
        } else {
            echo "Error";
        }
    }
}
