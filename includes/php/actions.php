<?php
    session_start();

    $action = $_REQUEST['action'];

    if(!empty($action)){
        require_once './proccess.php';
        $obj = new Process();
    }

    if($action == 'product' && !empty($_POST)){

        $name = $_POST['name'];
        $description = $_POST['description'];
        $photo = $_FILES['file'];

        $imagename = '';
        $imagename = $obj->uploadPhoto($photo);
        $product = [
            'name' => $name,
            'description' => $description,
            'photo' => $imagename,
        ];

        $addproduct = $obj->add($product,'product');
        echo json_encode($product);
    }

    if($action == 'users' && !empty($_POST)){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];

        $user = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone
        ];

        $adduser = $obj->add($user,'users');
        echo  json_encode($user);

    }

    if($action == 'login'){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $showuser = $obj->getRow('email','password',$email,$password,'users');
        echo json_encode($showuser);
    }

    if($action == "getproducts"){
        $products = $obj->getRows('product');
        echo json_encode($products);
    }

    if($action == 'order'){
        $name = $_POST['name'];
        $product = $_POST['product'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $description = $_POST['description'];
        $photo = $_FILES['file'];

        $imagename = '';
        $imagename = $obj->uploadPhoto($photo);

        $order = [
            'name' => $name,
            'email' => $email,
            'product' => $product,
            'description' => $description,
            'model' => $imagename,
            'phone' => $phone
        ];

        $addorder = $obj->add($order,'orders');
        echo json_encode($order);
    }

    if($action == 'delproducts'){
        $id = $_REQUEST['id'];
        $url = $_REQUEST['url'];

        $isDeleted = $obj->deleteRow('product',$id,$url);
        if ($isDeleted) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
        exit();
    }

    if($action == 'getorders'){
        $orders = $obj->getRows('orders');
        echo json_encode($orders);
    }

    if($action == 'getordersuser'){
        $email = $_REQUEST['user'];
        $ordersUser = $obj->records('orders','email',$email);
        echo json_encode($ordersUser);
    }

    if($action == 'show'){
         $show = $obj->getRows('users');
         echo json_encode($show);
    }

    if($action == 'updEstado'){
        $id = $_REQUEST['id'];
        $dat = $_REQUEST['date'];
        $estupdate = [
            'estado' => $dat
        ];

        $upEst = $obj->update($estupdate,$id,'orders');
        echo json_encode($estupdate);
    }

?>