<?php
session_start();
include( "connect.php" );

//==========REGISTRATION==========//


if ( isset( $_POST[ 'b2' ] ) && !empty( $_POST[ 'username' ] ) &&
    
    !empty( $_POST[ 'upass' ] ) ) {

  


    mysqli_query( $conn, "insert into users set
									
		   							username = '" . $_POST[ 'username' ] . "',
									pass = PASSWORD('" . $_POST[ 'upass' ] . "'),
									email = '" . $_POST[ 'email' ] . "'
" );

    $numreg = mysqli_insert_id( $conn );
    if ( $numreg > 0 ) {
		

		$_SESSION['username'] = $_POST['username'];
	
        header( "location:../index.php" );
        exit();

    } else {
        echo "eddrror aagaya bhai ";
    }

} 


//==========END REGISTRATION==========//


//==========EDIT PROFILE==========//

if ( isset( $_POST[ 'update' ] ) ) {
    
    $fname = $_POST[ 'fname' ] . " " . $_POST[ 'lname' ];
	
    mysqli_query( $conn, "update user_info set
		   							fname = '" . $fname . "',
								 	
									email = '" . $_POST[ 'email' ] . "',
									gender = '" . $_POST[ 'gender' ] . "',
									phone = '" . $_POST[ 'phone' ] . "',
									country = '" . $_POST[ 'country' ] . "',
									state = '" . $_POST[ 'state' ] . "',
									city = '" . $_POST[ 'city' ] . "',
									bio = '" . $_POST[ 'bio' ] . "',
									branch = '" . $_POST[ 'branch' ] . "',
									year = '" . $_POST[ 'year' ] . "',
									facebook = '" . $_POST[ 'facebook' ] . "',
									twitter = '" . $_POST[ 'twitter' ] . "',
									instagram = '" . $_POST[ 'instagram' ] . "'
									where uid = '" . $_SESSION[ 'uid' ] . "' " );
    header( "location:edit_profile.php" );
    exit();
}

//==========END EDIT PROFILE==========//

?>