<!doctype html>
<html>
  <head>
    <title>Database Reset</title>
  </head>
  <body>

<?php

$db_file = "ce154_nm19311.sql";

// check if the file exists
if ( !file_exists($db_file) ){
    die("file doesn't exist!\n");
}

// read it into a variable
function read_sql($filename) {
    $fp = fopen($filename, "r");
    if ( !$fp ) {
        die("could not open file...\n");
    }

    $buff = "";
    while ( !feof($fp) ){
        $buff .= fgets($fp);
    }

    fclose($fp);

    return $buff;
}

?>

<h2>File reading</h2>
<?php 
    $db_data = read_sql($db_file);

    // calculate sha1 of data, using this to detect changes
    // usually used for passwords...
    $db_hash = sha1($db_data);
?>

<p>File contents is:</p>
<pre>
<?php echo $db_data; ?>
</pre>

<?php if ( !isset( $_POST['submit'] ) || $db_hash != $_POST['hash']  ) { 

    if ( isset( $_POST['hash']) && $db_hash != $_POST['hash']) {
        echo "<p>File changed on disk... please reconfirm</p>";
    }
?>
    <h2>Do you want to run this?</h2>
    <form action="#" method="post">
      <input type="hidden" name="hash" value="<?php echo $db_hash; ?>" />
      <input type="submit" name="submit" value="yes" />
    </from>
<?php } else { 
        echo "<h2>Running Script</h2>";

        echo "<p>trying to connect to the database...</p>";

        // include the database script
        require("database.php");
        $link = connect();

        // run the code
        echo "<p>running sql code...</p>";
        $result = $link->multi_query($db_data);

        if ( !$result ) {
            echo "error running query: ";

            foreach ( $link->error_list as $error ) {
            ?>
<pre><?php var_dump( $error ); ?></pre>
            <?php 
            }

        } else {
    ?>
    <h3>Results</h3>
    <pre><?php
            // borrowed from php.net manual.
            do {

                /* store first result set */
                if ($result = $link->store_result()) {

                   while ($row = $result->fetch_assoc()) {
                       var_dump( $row );
                   }
                   $result->free();

                }

                if ($link->more_results()) {
                    printf("-----------------\n");
                }
            } while ($link->next_result());
        ?></pre>

    <h3>Errors</h3>
    <?php foreach ( $link->error_list as $error ) { ?>
         <pre><?php var_dump( $error ); ?></pre>
    <?php } ?>

    <?php
    }
    echo "done!";
}
?>
  </body>
</html>
