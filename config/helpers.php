<?php
    session_start();

    // Fungsi buka encrypt
    function buka_encrypt($ID){
        return urldecode(base64_decode($ID));
    }
    // Fungsi tutup encrypt
    function tutup_encrypt($ID){
        return urlencode(base64_encode($ID));
    }
    
    function uploadFile($path = '', $file = array(), $prefix = '', $suffix = '') {
        
        $path = $path . date('Y') . '/' . $prefix .'/';

        $status = true;
        if(!empty($path) and !is_dir($path)) 
            $status = mkdir($path, 0777, true);

        if( $status ) 
        {
            $basename = explode('.',basename($file["name"]));
            $filename = $file["name"];
            
            // rename file
            $file["name"] = $prefix.'_'.$suffix.'.'.$basename[1];
            
            if ($file['error'] == UPLOAD_ERR_OK)
            {
                try 
                {
                    if ( ! move_uploaded_file( $file['tmp_name'] , $path.$file["name"]) ) 
                    {
                        throw new Exception('Could not move file ' . $filename . ' to '. $path);
                    }
                    return $file["name"];
                } 
                catch (Exception $e) {
                            die ('File did not upload: ' . $e->getMessage());
                }
            } 
        }
    }

    function uploadFileBlob($file) {
        $file_content = file_get_contents($file['tmp_name']);  
        return $file_content;
    }
    
    function insertRecord($conn, $table = "", $record = array(), $pkey = "ID") {
        if(isset($record)) 
        {
            $is_contain_blob = 0;
            foreach ( $record as $key => $val ) {
                if(strpos($key, "_BLOB") === false ) {
                    $a_key[] = $key;   
                    $a_val[] = (strpos($val, "{") === false ) ? "'$val'" : str_replace("{", "", str_replace("}", "", $val)); 
                }
                else {
                    ++$is_contain_blob;       
                } 
            } 
            
            $sql = "INSERT INTO $table (";
            $sql .= implode(',', $a_key) . ") VALUES (".implode(',', $a_val) .") RETURNING $pkey INTO :$pkey";

            $stid = mysqli_query($conn, $sql); 

            bind_param($stid, ":$pkey", $insertedid, 32);

            // $status = oci_execute($stid, OCI_DEFAULT);
            
            // oci_free_statement($stid);
            
            /* $sql = ociparse($conn, "select max(ID) ID from $table");
            ociexecute($sql);
        
            while ($row = oci_fetch_array ($sql, OCI_ASSOC)) {
                $a_row = $row;        
            } */
            
            // if($stid)
            //     oci_commit($conn);
            // else
            //     oci_rollback($conn);
                
            // if($is_contain_blob and $status)
            //     $status = updateBlob($conn, $table, $record, $insertedid);
            
            return $insertedid;
        }
    }
    
    function updateRecord($conn, $table = "", $record = array(), $id) {
        if(isset($record)) 
        {
            $sql = "update $table set ";
            
            $is_contain_blob = 0;
            foreach ( $record as $key => $val ) {
                if(strpos($key, "_BLOB") === false ) {
                    $val = (strpos($val, "{") === false ) ? "'$val'" : str_replace("{", "", str_replace("}", "", $val));  
            
                    $a_val[] = "$key = $val"; 
                }
                else {
                    ++$is_contain_blob;       
                }
            }
            
            $sql.= implode(',',$a_val);
            $sql.= " where ID = $id";

            $stid = mysqli_query($conn, $sql);
            //$status = oci_execute($stid);
            
            // if($status)
            //     oci_commit($conn);
            // else
            //     oci_rollback($conn);
                
            // if($is_contain_blob and $status)
            //     $status = updateBlob($conn, $table, $record, $id);
                
            return $id;
        }
    }
    
    function updateBlob($conn, $table = "", $record = array(), $id) {
        foreach($record as $key => $val) {
            if(strpos($key, "_BLOB") !== false ) {
                $a_key[] = $key;
                $a_keyblob[] = $key;
                $a_keybind[] = ":".$key;
                $a_content[":".$key] = $val;
                $a_val[] = "EMPTY_BLOB()";
            }
            else {
                continue;
            }
        }
        
        if($a_keybind) {
            foreach ($a_keybind as $ndx => $keys) {
                $$a_keyblob[$ndx] = oci_new_descriptor($conn, OCI_D_LOB);
                
                $sql = "UPDATE $table SET $a_keyblob[$ndx] = $a_val[$ndx] WHERE ID = $id RETURNING $a_keyblob[$ndx] INTO $a_keybind[$ndx]";

                $stid = oci_parse($conn, $sql);
                oci_bind_by_name($stid, "$keys", $$a_keyblob[$ndx], -1, OCI_B_BLOB);
                oci_execute($stid, OCI_DEFAULT);
                
                $status = $$a_keyblob[$ndx]->save($a_content[$keys]);
                
                oci_free_statement($stid);
                $$a_keyblob[$ndx]->free();
            }
        }
        
        if($status)
            oci_commit($conn);
        else
            oci_rollback($conn);
        
        return $status;
    }
    
    function deleteRecord($conn, $table = "", $key = "ID", $id) {
        $sql = "delete from $table where $key = $id";

        $stid = mysqli_query($conn, $sql);
        //$status = oci_execute($stid);

        return $id;
    }
    
    function genNoDatang($conn, $date) {
        $sql = "select max(no_datang) no_datang from datang_detail where no_datang like 'SKDWNI/3578/$date/%'";
        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        
        $no_datang = 0;
        while ($row = oci_fetch_array ($stid, OCI_ASSOC)) {
            $no_datang = $row['NO_DATANG'];
        }

        $no_datang = explode("/", $no_datang);
        $maxno_datang = str_pad((int) $no_datang[3] + 1, 4, '0', STR_PAD_LEFT);
        
        return "SKDWNI/3578/$date/$maxno_datang";
    }
    
    function genNoForm($conn, $date) {
        $sql = "select max(no_form) no_form from datang_header where no_form like 'REG/3578/$date/%'";
        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        
        $no_datang = 0;
        while ($row = oci_fetch_array ($stid, OCI_ASSOC)) {
            $no_datang = $row['NO_FORM'];
        }

        $no_datang = explode("/", $no_datang);
        $maxno_datang = str_pad((int) $no_datang[3] + 1, 4, '0', STR_PAD_LEFT);
        
        return "REG/3578/$date/$maxno_datang";
    }
    
    function debug($data, $isexit = true) {
        if(is_array($data)) {
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }
        elseif(is_object($data)) {
            echo "<pre>";
            var_dump($data);
            echo "</pre>";
        }else {
            echo $data;
        }
        
        if($isexit) {
            die();
        }
    }
    
    function thisPage() {
        return end(explode('/', $_SERVER['PHP_SELF']));
    }
    
    function setFlash($page, $message = array()) {
        $_SESSION[$page]['flash']['page'] = $page;    
        $_SESSION[$page]['flash']['status'] = $message[0];    
        $_SESSION[$page]['flash']['message'] = $message[1];    
    }
    
    function getFlash($page) {
        if(isset($_SESSION[$page]['flash']['message'])) { 
            $i_message = $_SESSION[$page]['flash'];
            
            unset($_SESSION[$page]);
            
            return $i_message;
        }
        else
            return null;
    }
    function pReplace($obj) {
    $grs = '\ ';
    $syntax = str_replace(trim($grs),'/',$obj);
    $syntax = $obj;
    $syntax = str_replace("'",'`',$syntax);
    $syntax = str_replace('"','`',$syntax);
    $syntax = str_replace("\`",'`',$syntax);
    return $syntax;
    }
?> 