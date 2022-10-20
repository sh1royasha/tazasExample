<?php

    include_once './bd.php';

    class Process extends Database{

        public function add($data,$tableName){
            
            if (!empty($data)) {
                $fileds = $placholders = [];
                foreach ($data as $field => $value) {
                    $fileds[] = $field;
                    $placholders[] = ":{$field}";
                }
            }

            if($tableName == 'users'){
                if($this->record($tableName,$fileds[1],$data['email'])){
                    echo "El usuario ya existe";
                }else{
                    $sql = "INSERT INTO {$tableName} (" . implode(',', $fileds) . ") VALUES (" . implode(',', $placholders) . ")";
                    $stmt = $this->conn->prepare($sql);
                    try {
                        $this->conn->beginTransaction();
                        $stmt->execute($data);
                        $lastInsertedId = $this->conn->lastInsertId();
                        $this->conn->commit();
                        return $lastInsertedId;
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                        $this->conn->rollback();
                    }
                }
                
            }else{
                $sql = "INSERT INTO {$tableName} (" . implode(',', $fileds) . ") VALUES (" . implode(',', $placholders) . ")";
                $stmt = $this->conn->prepare($sql);
                try {
                    $this->conn->beginTransaction();
                    $stmt->execute($data);
                    $lastInsertedId = $this->conn->lastInsertId();
                    $this->conn->commit();
                    return $lastInsertedId;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    $this->conn->rollback();
                }
            }
        }

        public function uploadPhoto($file){
            if (!empty($file)) {
                $fileTempPath = $file['tmp_name'];
                $fileName = $file['name'];
                $fileSize = $file['size'];
                $fileType = $file['type'];
                $fileNameCmps = explode('.', $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $allowedExtn = ["jpg", "png", "gif", "jpeg"];
                if (in_array($fileExtension, $allowedExtn)) {
                    $uploadFileDir = $_SERVER["DOCUMENT_ROOT"]. '/NEWPROYECT/assets/uploads/';
                    $destFilePath = $uploadFileDir . $newFileName;
                    if (move_uploaded_file($fileTempPath, $destFilePath)) {
                        return $newFileName;
                    }
                }
            }   
        }

        public function getRows($tableName){
            $sql = "SELECT * FROM {$tableName}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $results = [];
            }
            return $results;
        }

        public function getRow($email,$password,$valueemail,$valuepassword,$tableName){
            $sql = "SELECT * FROM {$tableName} WHERE {$email}=:{$email} AND {$password}=:{$password}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":{$email}"=> $valueemail, ":{$password}"=> $valuepassword]);
            if($stmt->rowCount()>0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $result = [];
            }
            return $result;
        }   

        public function record($tableName,$field, $value){
            $sql = "SELECT * FROM {$tableName}  WHERE {$field}=:{$field}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":{$field}" => $value]);
            if ($stmt->rowCount() > 0) {
                    return 1;
                } else {
                    return 0;
            }
        }

        public function records($tableName,$field, $value){
            $sql = "SELECT * FROM {$tableName}  WHERE {$field}=:{$field}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":{$field}" => $value]);
            if ($stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $results = [];
            }
            return $results;
        }

        public function deleteRow($tableName,$id,$url){
            $sql = "DELETE FROM {$tableName}  WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            try {
                $stmt->execute([':id' => $id]);
                if ($stmt->rowCount() > 0) {
                    unlink($_SERVER["DOCUMENT_ROOT"]. '/NEWPROYECT/assets/uploads/'.$url);
                    return true;
                    }
                } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
                }
        }

        public function update($data, $id,$tableName){
        
            if (!empty($data)) {
            $fileds = '';
            $x = 1;
            $filedsCount = count($data);
            foreach ($data as $field => $value) {
                $fileds .= "{$field}=:{$field}";
                if ($x < $filedsCount) {
                    $fileds .= ", ";
                }
                $x++;
            }
            }
            $sql = "UPDATE {$tableName} SET {$fileds} WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            try {
                $this->conn->beginTransaction();
                $data['id'] = $id;
                $stmt->execute($data);
                $this->conn->commit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                $this->conn->rollback();
            }
        }


    }
?>