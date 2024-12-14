<?php
// 'user' object
class User
{
    // database connection and table name
    private $conn;
    private $table_name = "users";

    // object properties
    public $cus_id;
    public $forgot_otp;
    public $cus_name;
    public $cus_parent_name;
    public $cus_gender;
    public $cus_email;
    public $cus_dob;
    public $cus_age;
    public $cus_school;
    public $cus_address;
    public $cus_district;
    public $cus_pincode;
    public $cus_id_proof;
    public $cus_profile_pic;
    public $cus_password;
    public $cus_confirm_pass;
    public $cus_trainer_id;
    public $game_id;
     public $start_time;
      public $end_time;
        public $user_id;
          public $date;
    public $total_time;
    
    //   public $user_id;
    public $notification_id;
    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }
public function Register()
{
    try {
        // Calculate age
        $dob = new DateTime($this->cus_dob);
        $now = new DateTime();
        $ageDifference = $now->diff($dob);
        $age = $ageDifference->y;
        $age_in_months = sprintf("%02d yr %02d months", $ageDifference->y, $ageDifference->m);

        // Generate unique customer ID
        $random_number = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $cus_uniq_id = 'MIT' . $random_number;

        // Insert user data into the database
        $query = "INSERT INTO `users` (`user_name`, `gender`, `user_uniq_id`, `parent_name`, `user_email`, `user_mobile`, `user_dob`, `school_id`, `user_address`, `district`, `state`, `pincode`, `login_password`, `confirm_password`, `trainer_id`, `user_age`, `age_in_months`, `user_created`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($query);

        // Bind parameters and execute
        $stmt->bindParam(1, $this->cus_name);
        $stmt->bindParam(2, $this->cus_gender);
        $stmt->bindParam(3, $cus_uniq_id);
        $stmt->bindParam(4, $this->cus_parent_name);
        $stmt->bindParam(5, $this->cus_email);
        $stmt->bindParam(6, $this->cus_mobile);
        $stmt->bindParam(7, $this->cus_dob);
        $stmt->bindParam(8, $this->cus_school);
        $stmt->bindParam(9, $this->cus_address);
        $stmt->bindParam(10, $this->cus_district);
        $stmt->bindParam(11, $this->cus_state);
        $stmt->bindParam(12, $this->cus_pincode);
        $stmt->bindParam(13, $this->cus_password);
        $stmt->bindParam(14, $this->cus_confirm_pass);
        $stmt->bindParam(15, $this->cus_trainer_id);
        $stmt->bindParam(16, $age);
        $stmt->bindParam(17, $age_in_months);

        if (!$stmt->execute()) {
            // Log SQL error
            $error = $stmt->errorInfo();
            return ['status' => false, 'error' => 'Registration failed - SQL Error', 'sql_error' => $error];
        }

        // File upload handling
        if (isset($this->cus_id_proof) && $this->cus_id_proof['error'] === UPLOAD_ERR_OK &&
            isset($this->cus_profile_pic) && $this->cus_profile_pic['error'] === UPLOAD_ERR_OK) {
            
            $idProofPath = 'upload/id_proof/' . $this->cus_id_proof['name'];
            $profilePicPath = 'upload/profile_pic/' . $this->cus_profile_pic['name'];

            if (move_uploaded_file($this->cus_id_proof['tmp_name'], $idProofPath) &&
                move_uploaded_file($this->cus_profile_pic['tmp_name'], $profilePicPath)) {
                
                $queryUpdate = "UPDATE `users` SET `id_proof`=?, `profile_pic`=? WHERE `user_mobile`=?";
                $stmtUpdate = $this->conn->prepare($queryUpdate);
                $stmtUpdate->bindParam(1, $idProofPath);
                $stmtUpdate->bindParam(2, $profilePicPath);
                $stmtUpdate->bindParam(3, $this->cus_mobile);

                if (!$stmtUpdate->execute()) {
                    // Log SQL error for update
                    $error = $stmtUpdate->errorInfo();
                    return ['status' => false, 'error' => 'Failed to update file paths', 'sql_error' => $error];
                }
            } else {
                return ['status' => false, 'error' => 'File upload failed'];
            }
        }

        // If successful
        return ['status' => true, 'message' => 'Registered successfully'];
    } catch (Exception $e) {
        return ['status' => false, 'error' => 'Exception occurred', 'exception_message' => $e->getMessage()];
    }
}





    public function userDetail()
    {
        $sqlQuery = "SELECT * FROM `users` WHERE `user_id` = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();
        return $stmt;
    }




    public function phoneCheck()
    {
        $query = "SELECT * FROM `users` WHERE `user_mobile` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->cus_phone);
        $stmt->execute();
        return $stmt;
    }

 public function emailCheck()
    {
        $query = "SELECT * FROM `users` WHERE `user_email` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->cus_email);
        $stmt->execute();
        return $stmt;
    }


   public function loginCheck()
    {
        $query = "SELECT * FROM users WHERE user_email = '$this->cus_email' AND confirm_password = '$this->cus_password'  LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }





     public function forgot($email)
    {
        $query = "SELECT * FROM users WHERE user_email = ?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $rowCount = $stmt->rowCount();

    if (!empty($email) && $rowCount > 0) {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['mail'] = $email;

        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'vicky964242@gmail.com';
        $mail->Password = 'imfxosyiuhtynzff';
        $mail->setFrom('vicky964242@gmail.com', 'OTP Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Your verify code";
        $mail->Body = "<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3><br><br><p>With regards,</p><b>Mithra Sports</b>";

        if (!$mail->send()) {
            sendResponse(500, false, 'OTP send failed, Invalid Email');
        } else {
            echo json_encode(['status' => true, 'message' => "OTP sent to $email"]);
        }
    } else {
        sendResponse(400, false, 'This Mail Not Registered, Enter Valid Mail ID');
    }
}
    public function profileDetail()
    {
        $this->bz_user_id = htmlspecialchars(strip_tags($this->bz_user_id));
        $query = "SELECT * FROM " . $this->table_name . " WHERE bz_cus_id = $this->bz_user_id";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    
        public function getCustomerData($user_id) {
    try {
        $query = "SELECT a.user_id, a.user_uniq_id, a.user_name, a.user_email, a.user_mobile, sch.school_name, a.profile_pic, b.trainer_name, dis.district_name, a.age_in_months,dis.district_name
          FROM users AS a 
          JOIN school_list AS sch ON a.school_id = sch.school_id
          JOIN trainer AS b ON a.trainer_id = b.trainer_id
          JOIN district AS dis ON a.district = dis.district_id
          WHERE a.user_id = :user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT); // Assuming customer_id is an integer
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false; // No customer found with the given ID
        }
    } catch (PDOException $e) {
        // Log or handle the database error
        error_log("Database error: " . $e->getMessage());
        return false;
    }
    }
    
  public function gethistoryData($user_id) {
    try {
        $query = "SELECT a.record_id, a.game_id, a.start_time, a.end_time, a.total_time, a.created_dt, b.user_name, b.user_id, game.game_type_name
                  FROM my_records AS a 
                  JOIN users AS b ON a.user_id = b.user_id
                  JOIN game_type_web AS game ON a.game_id = game.game_type_id
                  WHERE a.user_id = :user_id
                  ORDER BY record_id DESC"; // Sort by game_id and start_time

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
            
            // Process records to assign game numbers
            $gameNumbers = [];
            foreach ($records as &$record) {
                $game_id = $record['game_id'];
                if (!isset($gameNumbers[$game_id])) {
                    $gameNumbers[$game_id] = 0;
                }
                $gameNumbers[$game_id]++;
                $record['game_no'] = $gameNumbers[$game_id];
            }

            return $records;
        } else {
            return false; // No records found for the given user ID
        }
    } catch (PDOException $e) {
        // Log or handle the database error
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}


//  public function get_unseen_notifications_count($user_id) {
//         $stmt = $this->conn->prepare("
//             SELECT COUNT(*) as unseen_count
//             FROM notification n
//             LEFT JOIN notification_view nv 
//             ON n.id = nv.notification_id AND nv.user_id = ?
//             WHERE nv.id IS NULL
//         ");
//         $stmt->bind_param("i", $user_id);
//         $stmt->execute();
//         $stmt->bind_result($unseen_count);
//         $stmt->fetch();
//         $stmt->close();
//         return $unseen_count;
//     }
    public function get_unseen_notifications_count($user_id) {
        try {
            $query = "
         SELECT COUNT(*) as unseen_count FROM notification n LEFT JOIN notification_view nv ON n.notifi_id = nv.notification_id AND nv.user_id = :user_id WHERE n.user_id = :user_id AND nv.view_id IS NULL;
            ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result === false) {
                error_log("Failed to fetch unseen notifications count for user_id: $user_id");
                return false;
            }
            return $result['unseen_count'];
        } catch (PDOException $e) {
            error_log("PDOException in get_unseen_notifications_count: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Exception in get_unseen_notifications_count: " . $e->getMessage());
            return false;
        }
    }
      public function getAlltutorVideos()
    {

        $query = "SELECT tutorial_web_id ,tutorial_web_name,video_web,	tutorial_source_file, tutorial_web_details,tutorial_web_created 
        FROM `tutorial_web` 
        ORDER BY tutorial_web_id DESC";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    
      public function sliderFetch()
    {
        $query = "SELECT * FROM `images`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
       public function fetchtournament()
{
    $query = "SELECT * FROM `tournament` 
                         JOIN game_type_web AS game ON game.game_type_id = tournament.game_type 
                         ORDER BY `tourn_id` DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}

    
    
    
    //   public function records()
    // {
    //   $query = "SELECT * FROM `my_records` WHERE user_id = $this->user_id ORDER BY total_time ASC LIMIT 3";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     return $stmt;
    // }
    
    
    
    
   public function records($user_id, $game_id = null)
{
    $query = "SELECT my.*, gam.game_type_name   FROM `my_records` AS my
    JOIN game_type_web AS gam ON my.game_id = gam.game_type_id 
    WHERE user_id = :user_id";

    if ($game_id !== null) {
        $query .= " AND game_id = :game_id";
    }
    $query .= " ORDER BY total_time ASC LIMIT 3";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    if ($game_id !== null) {
        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $stmt;
}

    
public function del() {
        try {
            // Check if the record exists
            $checkQuery = "SELECT COUNT(*) FROM `my_records` WHERE record_id = :record_id";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->bindParam(':record_id', $this->record_id, PDO::PARAM_INT);
            $checkStmt->execute();

            // Fetch the count of records with the given record_id
            $recordExists = $checkStmt->fetchColumn();

            if ($recordExists == 0) {
                // Record not found
                return ['status' => false, 'message' => 'Record ID not found.'];
            } else {
                // Record found, proceed to delete
                $deleteQuery = "DELETE FROM `my_records` WHERE record_id = :record_id";
                $deleteStmt = $this->conn->prepare($deleteQuery);
                $deleteStmt->bindParam(':record_id', $this->record_id, PDO::PARAM_INT);

                if ($deleteStmt->execute()) {
                    return ['status' => true, 'message' => 'Record removed successfully'];
                } else {
                    return ['status' => false, 'message' => 'Failed to remove record'];
                }
            }
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
public function del_notification() {
        try {
            // Check if the record exists
            $checkQuery = "SELECT COUNT(*) FROM `notification` WHERE notifi_id = :notifi_id";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->bindParam(':notifi_id', $this->notifi_id, PDO::PARAM_INT);
            $checkStmt->execute();

            // Fetch the count of records with the given record_id
            $recordExists = $checkStmt->fetchColumn();

            if ($recordExists == 0) {
                // Record not found
                return ['status' => false, 'message' => 'notification ID not found.'];
            } else {
                // Record found, proceed to delete
                $deleteQuery = "DELETE FROM `notification` WHERE notifi_id = :notifi_id";
                $deleteStmt = $this->conn->prepare($deleteQuery);
                $deleteStmt->bindParam(':notifi_id', $this->notifi_id, PDO::PARAM_INT);

                if ($deleteStmt->execute()) {
                    return ['status' => true, 'message' => 'notification removed successfully'];
                } else {
                    return ['status' => false, 'message' => 'Failed to remove record'];
                }
            }
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
     public function state(){
         $query = "SELECT * FROM `state`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt; 
     }
    public function fetchnotification($user_id)
{
    $query = "SELECT * FROM `notification` WHERE user_id = :user_id ORDER BY notifi_id DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// public function timer() {
//     $query = "INSERT INTO my_records (game_id, user_id, total_time) VALUES (:game_id, :user_id, :total_time)";
    
//     $stmt = $this->conn->prepare($query);

//     // Calculate the total time difference in seconds with milliseconds
//     $start_time = new DateTime($this->start_time);
//     $end_time = new DateTime($this->end_time);
//     $interval = $start_time->diff($end_time);
    
//     // Format the total time as minutes:seconds:milliseconds
//     $total_time = sprintf('%02d:%02d:%03d', 
//                           ($interval->h * 60) + $interval->i, // Convert hours to minutes and add minutes
//                           $interval->s, 
//                           $interval->f * 1000); // Convert fractional seconds to milliseconds

//     // Bind parameters
//     $stmt->bindParam(':game_id', $this->game_id);
//     $stmt->bindParam(':user_id', $this->user_id);
//     $stmt->bindParam(':total_time', $total_time);

//     // Execute the query and return the result
//     if ($stmt->execute()) {
//         return true;
//     } else {
//         return false;
//     }
// }
public function timer() {
    $query = "INSERT INTO my_records (game_id, user_id, total_time, created_dt) VALUES (:game_id, :user_id, :total_time, :current_time)";

    $stmt = $this->conn->prepare($query);
    
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date('Y-m-d h:i:s A');

    // Binding parameters
    $stmt->bindParam(':game_id', $this->game_id);
    $stmt->bindParam(':user_id', $this->user_id);
    $stmt->bindParam(':total_time', $this->total_time);
    $stmt->bindParam(':current_time', $current_time);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

public function notification_view_check() {
    $query = "SELECT * FROM notification_view WHERE user_id = :user_id AND notification_id = :notification_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
    $stmt->bindParam(':notification_id', $this->notification_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

public function notification_view() {
    $query = "INSERT INTO notification_view (notification_id, user_id) VALUES (:notification_id, :user_id)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':notification_id', $this->notification_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Failed to insert notification view: " . implode(", ", $stmt->errorInfo()));
        return false;
    }
}




public function getanalyticsData($user_id) {
    try {
        // First, get all game types
        $gameQuery = "SELECT game_type_id, game_type_name FROM game_type_web";
        $gameStmt = $this->conn->prepare($gameQuery);
        $gameStmt->execute();
        $allGames = $gameStmt->fetchAll(PDO::FETCH_ASSOC);

        // Define date ranges for daily, weekly, and monthly
        $currentDate = date('Y-m-d');
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $startOfMonth = date('Y-m-01');

        // Fetch performance data for each period
        $dataPeriods = [
            'daily' => [$currentDate . ' 00:00:00', $currentDate . ' 23:59:59'],
            'weekly' => [$startOfWeek . ' 00:00:00', $currentDate . ' 23:59:59'],
            'monthly' => [$startOfMonth . ' 00:00:00', $currentDate . ' 23:59:59']
        ];

        $consolidated_data = [];

        foreach ($dataPeriods as $period => $dates) {
            list($startDate, $endDate) = $dates;

            // Query to get performance data for the user based on the period
            $query = "SELECT us.age_in_months, dis.district_name, game.game_type_id, game.game_type_name, 
                      COUNT(rec.game_id) AS games_played, 
                      MIN(rec.total_time) AS min_time,
                      (SELECT MIN(rec2.created_dt) FROM my_records rec2 WHERE rec2.game_id = game.game_type_id AND rec2.user_id = :user_id AND rec2.total_time = MIN(rec.total_time)) AS min_time_date
                      FROM game_type_web AS game
                      LEFT JOIN my_records AS rec ON game.game_type_id = rec.game_id AND rec.user_id = :user_id
                      JOIN users AS us ON rec.user_id = us.user_id 
                      JOIN district AS dis ON us.district = dis.district_id
                      WHERE us.user_id = :user_id AND rec.created_dt BETWEEN :start_date AND :end_date
                      GROUP BY game.game_type_id, game.game_type_name, us.age_in_months";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->bindParam(":start_date", $startDate);
            $stmt->bindParam(":end_date", $endDate);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                // If no records are found, get the age_in_months from the users table
                $ageQuery = "SELECT age_in_months FROM users WHERE user_id = :user_id";
                $ageStmt = $this->conn->prepare($ageQuery);
                $ageStmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
                $ageStmt->execute();
                $userAge = $ageStmt->fetch(PDO::FETCH_ASSOC);
                $age_in_months = $userAge ? $userAge['age_in_months'] : null;
            } else {
                // Use the age from the result
                $age_in_months = $result[0]['age_in_months'];
            }

            // Create a map of game data for easier lookup
            $gameDataMap = array();
            foreach ($result as $row) {
                $gameDataMap[$row['game_type_id']] = $row;
            }

            // Process all games and include performance data if available
            foreach ($allGames as $game) {
                $game_id = $game['game_type_id'];
                if (isset($gameDataMap[$game_id])) {
                    $row = $gameDataMap[$game_id];
                    $consolidated_data[$period][] = array(
                        'game_type_id' => $game_id,
                        'game_type_name' => $row['game_type_name'],
                        'games_played' => $row['games_played'],
                        'min_time' => $row['min_time'],
                        'min_time_date' => $row['min_time_date']
                    );
                } else {
                    $consolidated_data[$period][] = array(
                        'game_type_id' => $game_id,
                        'game_type_name' => $game['game_type_name'],
                        'games_played' => 0,
                        'min_time' => null,
                        'min_time_date' => null
                    );
                }
            }
        }

        // Fetch overall statistics for the given user
        $overallQuery = "SELECT game_type_id, game_type_name,
                         COUNT(rec.game_id) AS overall_games_played,
                         MIN(rec.total_time) AS overall_min_time,
                         (SELECT MIN(rec2.created_dt) FROM my_records rec2 WHERE rec2.game_id = game.game_type_id AND rec2.user_id = :user_id AND rec2.total_time = MIN(rec.total_time)) AS overall_min_time_date
                         FROM game_type_web AS game
                         LEFT JOIN my_records AS rec ON game.game_type_id = rec.game_id AND rec.user_id = :user_id
                         GROUP BY game.game_type_id, game.game_type_name";

        $overallStmt = $this->conn->prepare($overallQuery);
        $overallStmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $overallStmt->execute();
        $overallResult = $overallStmt->fetchAll(PDO::FETCH_ASSOC);

        // Map overall statistics by game_type_id
        $overallStatsMap = array();
        foreach ($overallResult as $row) {
            $overallStatsMap[$row['game_type_id']] = $row;
        }

        // Integrate overall statistics into the consolidated data
        foreach ($consolidated_data as $period => &$periodData) {
            foreach ($periodData as &$gameData) {
                $game_id = $gameData['game_type_id'];
                if (isset($overallStatsMap[$game_id])) {
                    $gameData['overall_games_played'] = $overallStatsMap[$game_id]['overall_games_played'];
                    $gameData['overall_min_time'] = $overallStatsMap[$game_id]['overall_min_time'];
                    $gameData['overall_min_time_date'] = $overallStatsMap[$game_id]['overall_min_time_date'];
                } else {
                    $gameData['overall_games_played'] = 0;
                    $gameData['overall_min_time'] = null;
                    $gameData['overall_min_time_date'] = null;
                }
            }
        }

        return $consolidated_data;
    } catch (PDOException $e) {
        // Log or handle the database error
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}






public function getperformanceData($user_id) {
    try {
        // Modify the query to calculate total games played
        $query = "SELECT a.user_id, game.game_type_id, game.game_type_name, 
                  COUNT(rec.game_id) AS games_played, MIN(rec.total_time) AS min_time,
                  (SELECT COUNT(*) FROM my_records WHERE user_id = :user_id) AS total_games_played
                  FROM users AS a 
                  JOIN my_records AS rec ON a.user_id = rec.user_id
                  JOIN game_type_web AS game ON rec.game_id = game.game_type_id
                  WHERE a.user_id = :user_id
                  GROUP BY a.user_id, game.game_type_id, game.game_type_name";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $consolidated_data = array();
            $total_games_played = 0;

            foreach ($result as $row) {
                $game_id = $row['game_type_id'];
                if (!isset($consolidated_data[$game_id])) {
                    $consolidated_data[$game_id] = array(
                        'game_type_id' => $game_id,
                        'game_type_name' => $row['game_type_name'],
                        'games_played' => $row['games_played'],
                        'best_records' => $row['min_time']
                    );
                } else {
                    $consolidated_data[$game_id]['games_played'] += $row['games_played'];
                    if ($row['min_time'] < $consolidated_data[$game_id]['min_time']) {
                        $consolidated_data[$game_id]['min_time'] = $row['min_time'];
                    }
                }
                // Total games played by the user
                $total_games_played = $row['total_games_played'];
            }

            return array(
                'total_games_played' => $total_games_played,
                'games_data' => array_values($consolidated_data)
            );
        } else {
            return false; // No data found
        }
    } catch (PDOException $e) {
        // Log or handle the database error
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}




     public function getisdarecords()
    {

        $query = "SELECT * FROM `topers_list_web` ORDER BY time   LIMIT 3";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    
    public function privacyPolicy()
    {

        $query = "SELECT privacy FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
      public function company_details()
    {

        $query = "SELECT company_details  FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    
    public function aboutUs()
    {

        $query = " SELECT about FROM `info` WHERE info_id = 1 ";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
     public function customercare()
    {

        $query = " SELECT customer_care FROM `info` WHERE info_id = 1 ";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
     public function termCondition()
    {

        $query = " SELECT terms FROM `info` WHERE info_id = 1 ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function rules()
    {

        $query = " SELECT rules FROM `info` WHERE info_id = 1 ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //   public function gender()
    // {

    //     $query = " SELECT * FROM `gender` WHERE gender_status = 0  ";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     return $stmt;
    // }
     public function gender()
    {

        $query = " SELECT * FROM `gender`  ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
      public function age()
    {

        $query = " SELECT * FROM `age`  ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
     public function game()
    {

        $query = " SELECT * FROM `game_type_web`  ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
  public function district()
    {

        $query = " SELECT *  FROM `district` WHERE state_id = $this->state_id ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
     public function school_list()
    {

        $query = " SELECT * FROM `school_list`  ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
// public function get_isda_records($gender_id = null, $game_type_id = null, $min_age = null, $max_age = null)
// {
//     // Start building the query
//     $query = "SELECT * FROM `isda_records` WHERE 1=1";
    
//     if (!is_null($gender_id)) {
//         $query .= " AND gender_id = :gender_id";
//     }
    
//     if (!is_null($game_type_id)) {
//         $query .= " AND game_type_id = :game_type_id";
//     }
    
//     if (!is_null($min_age)) {
//         $query .= " AND age >= :min_age";
//     }

//     if (!is_null($max_age)) {
//         $query .= " AND age <= :max_age";
//     }

//     // Add the ORDER BY clause at the end of the query
//     $query .= " ORDER BY record_id DESC";

//     // Debug: print the final query
//     error_log("Final SQL Query: " . $query);

//     $stmt = $this->conn->prepare($query);

//     if (!is_null($gender_id)) {
//         $stmt->bindParam(':gender_id', $gender_id, PDO::PARAM_INT);
//     }

//     if (!is_null($game_type_id)) {
//         $stmt->bindParam(':game_type_id', $game_type_id, PDO::PARAM_INT);
//     }

//     if (!is_null($min_age)) {
//         $stmt->bindParam(':min_age', $min_age, PDO::PARAM_INT);
//     }

//     if (!is_null($max_age)) {
//         $stmt->bindParam(':max_age', $max_age, PDO::PARAM_INT);
//     }

//     $stmt->execute();
//     return $stmt;
// }

public function get_isda_records($gender_id = null, $game_type_id = null, $age_id = null)
{
    // Start building the query
    $query = "SELECT isd.*, gen.gender_name, gam.game_type_name  
              FROM `isda_records` AS isd
              JOIN gender AS gen ON isd.gender_id = gen.gender_id
              JOIN game_type_web AS gam ON isd.game_type_id = gam.game_type_id  
              WHERE 1=1";
    
    if (!is_null($gender_id)) {
        $query .= " AND isd.gender_id = :gender_id";
    }
    
    if (!is_null($game_type_id)) {
        $query .= " AND isd.game_type_id = :game_type_id";
    }

    // Check if age_id is provided
    if (!is_null($age_id)) {
        // Retrieve min_age and max_age from the database based on age_id
        $age_query = "SELECT min_age, max_age FROM `age` WHERE age_id = :age_id";
        $age_stmt = $this->conn->prepare($age_query);
        $age_stmt->bindParam(':age_id', $age_id, PDO::PARAM_INT);
        $age_stmt->execute();
        $age_row = $age_stmt->fetch(PDO::FETCH_ASSOC);
        
        // Check if min_age and max_age are retrieved successfully
        if ($age_row) {
            $min_age = $age_row['min_age'];
            $max_age = $age_row['max_age'];
            // Add age filter to the query
            $query .= " AND isd.age BETWEEN :min_age AND :max_age";
        } else {
            // If age_id is not found, log an error
            error_log("Age ID not found: $age_id");
            return new PDOStatement(); // Return an empty PDOStatement
        }
    }

    // Add the ORDER BY clause at the end of the query
    $query .= " ORDER BY isd.record_id DESC";

    // Debug: print the final query
    error_log("Final SQL Query: " . $query);

    $stmt = $this->conn->prepare($query);

    if (!is_null($gender_id)) {
        $stmt->bindParam(':gender_id', $gender_id, PDO::PARAM_INT);
    }

    if (!is_null($game_type_id)) {
        $stmt->bindParam(':game_type_id', $game_type_id, PDO::PARAM_INT);
    }

    if (!is_null($age_id)) {
        $stmt->bindParam(':min_age', $min_age, PDO::PARAM_INT);
        $stmt->bindParam(':max_age', $max_age, PDO::PARAM_INT);
    }

    // Execute the query
    if (!$stmt->execute()) {
        // Log an error if query execution fails
        error_log("Error executing query: " . print_r($stmt->errorInfo(), true));
    }
    
    return $stmt;
}


    public function get_trainers_dropdown()
{
    $query = "SELECT tri.trainer_id,tri.trainer_name 
              FROM `trainer` AS tri 
              JOIN school_list AS sch ON tri.school_id = sch.school_id 
              WHERE   trainer_status = 1";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}






    public function get_trainers($school_id)
{
    $query = "SELECT tri.* 
              FROM `trainer` AS tri 
              JOIN school_list AS sch ON tri.school_id = sch.school_id 
              WHERE tri.school_id = :school_id AND trainer_status = 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':school_id', $school_id);
    $stmt->execute();
    return $stmt;
}

   

   public function updateProfilePic($user_id, $profile_pic_path) {
        $query = "UPDATE " . $this->table_name . " SET profile_pic = :profile_pic WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':profile_pic', $profile_pic_path);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
     public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
    
public function checkOTP($email_id, $otp) {
    $query = "SELECT forgot_otp FROM " . $this->table_name . " WHERE user_email = :email_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':email_id', $email_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Debug: Output the fetched OTP and the provided OTP
        error_log("Database OTP: " . $row['forgot_otp']);
        error_log("Provided OTP: " . $otp);
        
        if ($row['forgot_otp'] == $otp) {
            return ['status' => true, 'message' => 'OTP verified successfully'];
        } else {
            return ['status' => false, 'message' => 'Invalid OTP'];
        }
    } else {
        return ['status' => false, 'message' => 'Email ID not found'];
    }
}

public function updatePassword($email_id, $new_password) {
    // Query to update both confirm_password and login_password
    $query = "UPDATE " . $this->table_name . " 
              SET confirm_password = :new_password, login_password = :new_password 
              WHERE user_email = :email_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':new_password', $new_password);
    $stmt->bindParam(':email_id', $email_id);

    if ($stmt->execute()) {
        return ['status' => true, 'message' => 'Password updated successfully'];
    } else {
        return ['status' => false, 'message' => 'Password update failed'];
    }
}







   
}
?>

