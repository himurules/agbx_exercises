<html>
<body>

<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>

    <form method="post" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>"
          enctype="multipart/form-data">
        <input type="file" name="doc"/>
        <input type="submit" value="Send File"/>
    </form>

<?php } else {
    if (isset($_FILES['doc']) &&
        ($_FILES['doc']['error'] == UPLOAD_ERR_OK)) {
        $filename = basename($_FILES['doc']['name']);
        $xml = simplexml_load_file($_FILES['doc']['tmp_name']);
        $csv_array =[];
        foreach($xml->children() as $child){
            $row = array();
            $row[] = (string)$child->agentID;
            $row[] = (string)$child->uniqueID;
            $row[] = $child->getName();
            $row[] = $child->attributes()->status;
            $row[] = (string)$child->address->state;
            if(strtolower($child->getName()) == 'holidatrental')
                $row[] = 'rent';
            else
                $row[] = (double)$child->price;
            $row[] = date('Y-m-d H:i:s',$child->attributes()->modTime);
            $csv_array[] = $row;
        }
        $f = fopen('php://memory', 'w');
        if(count($csv_array)>0){
            foreach($csv_array as $row){
                fputcsv($f, $row, ",");
            }
        }
        // reset the file pointer to the start of the file
        fseek($f, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        // make php send the generated csv lines to the browser
        fpassthru($f);
    } else {
        print "No valid file uploaded.";
    }
}
?>

</body>
</html>