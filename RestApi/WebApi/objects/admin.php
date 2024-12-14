<?php
// 'user' object
class User
{

    // database connection and table name
    private $conn;
    private $table_name = "customer";

    // object properties
    // public $id;
    // public $name;
    public $cus_id;
    public $cus_name;
    public $cus_phone;
    public $cus_email;
    public $cus_password;
    public $cus_proof;
    public $cus_route;
    public $c_password;
    public $w_password;
    public $bz_cus_status;

    public $otp;

   

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function loginCheck()
    {
        $query = "SELECT * FROM customer WHERE customer_phone = '$this->cus_phone' AND customer_status = 1 LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function aboutUs()
    {

        $query = "SELECT * FROM `about_us`";
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
   
    public function getAllTutorial()
    {

        $query = "SELECT * FROM `tutorial` order by tut_id desc";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    public function getAllNews()
    {

        $query = "SELECT * FROM `news` order by news_id desc";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
   
    public function getAlltutorVideos()
    {

        $query = "SELECT * FROM `tutorial_web` order by tutorial_web_id desc";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
   

    public function profileDetail()
    {
        $this->bz_cus_id = htmlspecialchars(strip_tags($this->bz_cus_id));
        $query = "SELECT * FROM " . $this->table_name . " WHERE bz_cus_id = $this->bz_cus_id";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    public function phoneCheck()
    {
        $query = "SELECT * FROM customer WHERE customer_phone = $this->cus_phone";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function emailCheck()
    {
        $query = "SELECT * FROM customer WHERE customer_email = '$this->cus_email'";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    public function passwordCheck()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE bz_cus_password = '$this->bz_cus_password'";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }


    // public function Register()
    // {
  
    //     $query = "INSERT INTO customer SET `customer_phone` = '$this->cus_phone', `customer_otp` = '$this->otp'";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     return $stmt;
    // }
    
    public function franchise() {
    date_default_timezone_set('Asia/Calcutta');
    $date = date('Y-m-d');

    // Prepare the query to insert customer data into the database
    $query = "INSERT INTO `franchise_register` (`name`, `phone_number`, `email_id`, `investment`, `state`, `city`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    
    // Bind the parameters correctly
    $stmt->bindParam(1, $this->name);
    $stmt->bindParam(2, $this->phone_number);
    $stmt->bindParam(3, $this->email_id);
    $stmt->bindParam(4, $this->investment);
    $stmt->bindParam(5, $this->state);
    $stmt->bindParam(6, $this->city);
    $stmt->bindParam(7, $date);
    
    // Execute the query to register the customer
    return $stmt->execute();
}


           public function userDetail()
        {
            $sqlQuery = "SELECT * FROM `customer` where `customer_id` = '$this->cus_id'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        
        
   
    public function termCondition()
    {

        $query = "SELECT term FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function about_us()
    {

        $query = "SELECT about FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function rules()
    {

        $query = "SELECT rules FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

public function toplist() {
    $query = "
        WITH ranked AS (
            SELECT 
                b.*, 
                a.game_type_name, 
                a.game_type_img, 
                a.game_type_createed_dt, 
                sch.school_name,
                CASE WHEN b.gender = 'Female' THEN ROW_NUMBER() OVER (PARTITION BY b.game_id, b.gender ORDER BY b.time ASC) END AS row_num_female,
                CASE WHEN b.gender = 'Male' THEN ROW_NUMBER() OVER (PARTITION BY b.game_id, b.gender ORDER BY b.time ASC) END AS row_num_male
            FROM 
                `game_type_web` AS a
            JOIN 
                `topers_list_web` AS b ON a.game_type_id = b.game_id
            JOIN 
                `school_list` AS sch ON b.school_id = sch.school_id
        )
        SELECT *
        FROM ranked
        WHERE 
            row_num_male <= 3 OR (row_num_female <= 3 AND gender = 'Female')
        ORDER BY 
            game_id ASC, gender ASC, time ASC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
}







    public function customerCare()
    {
     $query = "SELECT customer_care FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
     public function companyDetails()
    {

        $query = "SELECT `email` FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
     public function faqs()
    {

        $query = "SELECT `faqs` FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
   

        public function fetchUsernotification() {
            $query = "SELECT * FROM user_notifi ORDER BY user_notifi_id DESC";
            $stmt = $this->conn->prepare($query);
            
            $stmt->execute();
            $feederStatus = $stmt->fetchall(PDO::FETCH_ASSOC); // Specify fetch style as PDO::FETCH_ASSOC
            return $feederStatus;
        }
        
        
       public function fetchTournament() {
        
            $query = "SELECT 
    t.tourn_id,
    gtw.game_type_name,
    t.tourn_type,
    t.tourn_name,
    DATE_FORMAT(t.tourn_date, '%d-%m-%Y') AS tourn_date,
    t.tourn_details,
    t.tourn_image,
    t.tourn_desc
FROM 
    tournament t
JOIN 
    game_type_web gtw ON t.game_type = gtw.game_type_id
ORDER BY 
    t.tourn_created DESC;;
";
            $stmt = $this->conn->prepare($query);
        
            $stmt->execute();
            $tournament = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tournament;
        } 
    public function TournamentRegister() {
        // SQL query to insert data into tournament_register table
        $query = "INSERT INTO tournament_register 
                  (tourn_for_id, name, email, gender, age, grade, phone, schl_name, address, district, pincode) 
                  VALUES 
                  (:tourn_id, :name, :email, :gender, :age, :grade, :phone, :schoolname, :address, :district, :pincode)";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':tourn_id', $this->tourn_id);
        $stmt->bindParam(':name', $this->cus_name);
        $stmt->bindParam(':email', $this->cus_email);
        $stmt->bindParam(':gender', $this->cus_phone);
        $stmt->bindParam(':age', $this->cus_age);
        $stmt->bindParam(':grade', $this->cus_grade);
        $stmt->bindParam(':phone', $this->cus_phone);
        $stmt->bindParam(':schoolname', $this->cus_schoolname);
        $stmt->bindParam(':address', $this->cus_address);
        $stmt->bindParam(':district', $this->cus_district);
        $stmt->bindParam(':pincode', $this->cus_pincode);

        // Execute the query
        if ($stmt->execute()) {
            return true; // Return true if the insertion was successful
        } else {
            return false; // Return false if the insertion failed
        }
    }
    
    
   public function comments()
{
    $query = "INSERT INTO comments (name, email, phone, comments) VALUES (:name, :email, :phone, :comments)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':phone', $this->phone); // Corrected binding parameter
    $stmt->bindParam(':comments', $this->comments);
    
    if ($stmt->execute()) {
        return true; // Return true if the insertion was successful
    } else {
        return false; // Return false if the insertion failed
    }
}



public function registertournament()
{
    // SQL query to insert data
    $query = "INSERT INTO tournament_register (name, trainer_id, phone, schl_name, parent_name, dob, gender, tournament,otherCoach) 
              VALUES (:name, :trainer_id, :phone, :schl_name, :parent_name, :dob, :gender, :tournament,:otherCoach)";
    
    // Prepare the statement
    $stmt = $this->conn->prepare($query);
    
    // Bind parameters
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':trainer_id', $this->trainer_id);
    $stmt->bindParam(':gender', $this->gender);
    $stmt->bindParam(':phone', $this->phone);
    $stmt->bindParam(':schl_name', $this->schl_name);
    $stmt->bindParam(':parent_name', $this->parent_name);
    $stmt->bindParam(':dob', $this->dob);
    $stmt->bindParam(':tournament', $this->tournament);
     $stmt->bindParam(':otherCoach', $this->otherCoach);

    // Execute the query
    if ($stmt->execute()) {
        return true; // Return true if the insertion was successful
    } else {
        // Print error message if insertion failed
        printf("Error: %s.\n", $stmt->error);
        return false; // Return false if the insertion failed
    }
}


public function fetchgallery() {
    // Base URL for images
    $baseUrl = "https://themithraa.com/Superadmin/";

    // SQL query to select images_name
    $query = "SELECT images_name FROM `image_web` ORDER BY image_id DESC";
    $stmt = $this->conn->prepare($query);
    
    // Execute the query
    $stmt->execute();

    // Fetch all results
    $tournament = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Append the base URL to each image name
    foreach ($tournament as &$image) {
        $image['images_name'] = $baseUrl . $image['images_name'];
    }

    return $tournament;
}

        
        
        
       public function fetchslider() {
      $baseUrl = "https://themithraa.com/Superadmin/";

    // SQL query to select images_name
    $query = "SELECT * FROM `web_slider_img` ORDER BY img_id DESC";
    $stmt = $this->conn->prepare($query);
    
    // Execute the query
    $stmt->execute();

    // Fetch all results
    $tournament = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Append the base URL to each image name
    foreach ($tournament as &$image) {
        $image['web_img'] = $baseUrl . $image['web_img'];
    }

    return $tournament;
    }
    
    
           public function fetchstimg() {
      $baseUrl = "https://themithraa.com/";

    // SQL query to select images_name
    $query = "SELECT * FROM `sports_tacking_img` ORDER BY img_id DESC";
    $stmt = $this->conn->prepare($query);
    
    // Execute the query
    $stmt->execute();

    // Fetch all results
    $tournament = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Append the base URL to each image name
    foreach ($tournament as &$image) {
        $image['img_name'] = $baseUrl . $image['img_name'];
    }

    return $tournament;
    }
    
    
           public function fetchscustomerimg() {
      $baseUrl = "https://themithraa.com/";

    // SQL query to select images_name
    $query = "SELECT * FROM `patners` ORDER BY patner_id DESC";
    $stmt = $this->conn->prepare($query);
    
    // Execute the query
    $stmt->execute();

    // Fetch all results
    $tournament = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Append the base URL to each image name
    foreach ($tournament as &$image) {
        $image['img_name'] = $baseUrl . $image['img_name'];
    }

    return $tournament;
    }
    
    
    
    public function fetchsachievers() {
      $baseUrl = "https://themithraa.com/Superadmin/";

    // SQL query to select images_name
    $query = "SELECT * FROM `achievers` ORDER BY acheiver_id DESC";
    $stmt = $this->conn->prepare($query);
    
    // Execute the query
    $stmt->execute();

    // Fetch all results
    $tournament = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Append the base URL to each image name
    foreach ($tournament as &$image) {
        $image['image'] = $baseUrl . $image['image'];
    }

    return $tournament;
    }
    

public function images()
{
    $query = "INSERT INTO images (images_name) VALUES (:images_name)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':images_name', $this->images_name);
 
    if ($stmt->execute()) {
        return true; // Return true if the insertion was successful
    } else {
        return false; // Return false if the insertion failed
    }
}

 public function fetchabt_content()
    {

       
        
         $query = "SELECT * FROM `about_us_number`";
            $stmt = $this->conn->prepare($query);
            
            $stmt->execute();
            $feederStatus = $stmt->fetchall(PDO::FETCH_ASSOC); // Specify fetch style as PDO::FETCH_ASSOC
            return $feederStatus;
    }
    
   public function fetch_worldrecord()
{
    $query = "SELECT we.*, game.game_type_name, gen.gender_name, ag.age_name, ag.age_id 
              FROM website_record AS we 
              JOIN game_type_web AS game ON we.game = game.game_type_id
              JOIN gender AS gen ON we.gender_id = gen.gender_id 
              JOIN website_agelist AS ag ON we.age_id = ag.age_id";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all records

    // Initialize an array to hold grouped data
    $groupedData = [];

    // Group records by age_id
    foreach ($records as $record) {
        $ageId = $record['age_id'];
        $ageName = $record['age_name'];
        if (!isset($groupedData[$ageId])) {
            $groupedData[$ageId] = [
                'ageGroup' => $ageName,
                'data' => []
            ];
        }

        $groupedData[$ageId]['data'][] = [
            'event' => $record['game_type_name'],
            'gender' => $record['gender_name'],
            'time' => $record['timing'],
            'athlete' => $record['name'],
            'country' => $record['country'], // Assuming this is the correct field for the country
            'year' => $record['create_date'] // Assuming this is the correct field for years
        ];
    }

    // Sort the grouped data by age_id in ascending order
    ksort($groupedData);

    // Sort the records within each age group by event
    foreach ($groupedData as $ageId => &$ageData) {
        usort($ageData['data'], function($a, $b) {
            return strcmp($a['event'], $b['event']);
        });
    }

    // Convert the grouped and sorted data to the desired structure
    $orderedData = array_values($groupedData);

    return $orderedData;
}






}
