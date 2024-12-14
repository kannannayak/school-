<?php
include('../include/config.php');

// Set the default timezone
date_default_timezone_set('Asia/Kolkata');

// Function to compare current date with tournament date and delete rows where tournament date has passed
function deleteExpiredTournaments($con) {
    $current_date = date('d-m-Y');
    $sql = "DELETE FROM `tournament` WHERE STR_TO_DATE(`tourn_date`, '%d-%m-%Y') < STR_TO_DATE('$current_date', '%d-%m-%Y')";
    mysqli_query($con, $sql);
}

if (isset($_POST['update_profile'])) {
    $tourn_type = $_POST['tourn_type'];
    $game_type = $_POST['game_type'];
    $tourn_name = $_POST['tourn_name'];
    $tourn_date = $_POST['tourn_date']; // Expected to be in dd-mm-yyyy format
    $tourn_details = $_POST['tourn_details'];
    $tourn_desc = $_POST['tourn_desc'];

    if (strlen($tourn_desc) > 600) {
        echo "<script>alert('Character count exceeded 600');</script>";
        echo "<script>window.location.href ='../table_tournament';</script>";
    } else {
        // Get the current date in dd-mm-yyyy format for comparison
        $current_date = date('d-m-Y');

        if (strtotime(str_replace('-', '/', $tourn_date)) < strtotime(str_replace('-', '/', $current_date))) {
            echo "<script>alert('Cannot insert tournament with a past date.');</script>";
            echo "<script>window.location.href ='../table_tournament';</script>";
        } else {
            // Check row count before insertion
            $sql_count = "SELECT COUNT(*) AS count FROM tournament";
            $result = mysqli_query($con, $sql_count);
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];

            // If count is 10 or more, prevent insertion
            if ($count >= 10) {
                echo "<script>alert('Maximum number of rows reached in the tournament table');</script>";
                echo "<script>window.location.href ='../table_tournament';</script>";
            } else {
                // Proceed with insertion
                $sql = "INSERT INTO `tournament` (`tourn_type`, `game_type`, `tourn_name`, `tourn_date`, `tourn_details`, `tourn_desc`) 
                        VALUES ('$tourn_type', '$game_type', '$tourn_name', '$tourn_date', '$tourn_details', '$tourn_desc')";
                $res_details = mysqli_query($con, $sql);
    
                if ($res_details) {
                    echo "<script>alert('Data Inserted successfully!');</script>";
                    echo "<script>window.location.href ='../table_tournament';</script>";
                } else {
                    echo "Failed to insert tournament details." . mysqli_error($con);
                }
            }
            
            // Delete expired tournaments after insertion
            deleteExpiredTournaments($con);
        }
    }
}

// Close the database connection
mysqli_close($con);
?>
// Proceed with insertion
                        $sql = "INSERT INTO `tournament` (`tourn_type`,`game_type`,`tourn_name`,`tourn_image`,`tourn_date`,`tourn_url`,`tourn_details`,`tourn_desc`) VALUES ('$tourn_type','$game_type','$tourn_name','$image1','$tourn_date','$tourn_url','$tourn_details','$tourn_desc')";
                        $res_details = mysqli_query($con, $sql);
            
                        if ($res_details) {
                            echo "<script>alert('Data Inserted successfully!');</script>";
                            echo "<script>window.location.href ='../table_tournament';</script>";
                        } else {
                            echo "Failed to insert product details." . mysqli_error($con);
                        }
                    }
                    
                    // Delete expired tournaments after insertion
                    deleteExpiredTournaments($con);
                }
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Invalid file extension.";
        }
    }
}

// Close the database connection
mysqli_close($con);
?>