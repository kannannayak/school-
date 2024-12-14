<?php
    include('include/header.php');
    include('include/config.php');

    ?>
    <?php
   $Tutorial_video_query = "SELECT COUNT(*) AS tutorial_web_url FROM tutorial_web";
   $Tutorial_video_result = mysqli_query($con, $Tutorial_video_query);
   $row_Tutorial_video = mysqli_fetch_assoc($Tutorial_video_result);
   $tutorial_web_url = $row_Tutorial_video['tutorial_web_url'];

   $news = "SELECT COUNT(*) AS news_url FROM news";
   $news_count = mysqli_query($con, $news);
   $row_news = mysqli_fetch_assoc($news_count);
   $news_url = $row_news ['news_url'];


   $game_type_web= "SELECT COUNT(*) AS game_type_name FROM  game_type_web";
   $game_fetch = mysqli_query($con, $game_type_web);
   $row_game = mysqli_fetch_assoc($game_fetch);
   $game_type_name = $row_game['game_type_name'];


   $tournament= "SELECT COUNT(*) AS tourn_id FROM  tournament";
   $tournament_fetch = mysqli_query($con, $tournament);
   $row_tournament = mysqli_fetch_assoc($tournament_fetch);
   $tourn_id = $row_tournament['tourn_id'];


   $registerform= "SELECT COUNT(*) AS id FROM  registerform";
   $registerform_fetch = mysqli_query($con, $registerform);
   $row_registerform = mysqli_fetch_assoc($registerform_fetch);
   $id = $row_registerform['id'];

   $comments= "SELECT COUNT(*) AS name FROM  comments";
   $comments_fetch = mysqli_query($con, $comments);
   $row_comments = mysqli_fetch_assoc($comments_fetch);
   $name = $row_comments['name'];
   
   $franchise= "SELECT COUNT(*) AS franch FROM  franchise_register";
   $franchise_fetch = mysqli_query($con, $franchise);
   $franchise_comments = mysqli_fetch_assoc($franchise_fetch);
   $franch = $franchise_comments['franch'];
    ?>
    <style>
        /* body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f0f0f0;
} */

.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    max-width: 1200px;
    padding: 100px;
    box-sizing: border-box;
}

.card {
    background-color: #C7E2EF;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 16px;
    flex: 1 1 calc(33.333% - 32px);
    box-sizing: border-box;
    text-align: center;
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}
.movehome{
     
    margin-left: 40px;
    margin-top: 30px;

}
.card h3 {
    margin-top: 0;
}

@media (max-width: 768px) {
    .card {
        flex: 1 1 calc(50% - 32px);
    }
}

@media (max-width: 480px) {
    .card {
        flex: 1 1 100%;
    }
}

    </style>  
    <div class="movehome">
         <a class="" href="https://themithraa.com/Superadmin/choosedashboard">  
             <button class="btn btn-primary  btng"> <i class="fa-solid fa-house"></i> Home</button>
          </a>
    </div>
    
    <div class="card-container">
         
        <div class="card">
            <h3>Tutorial Video</h3>
            <p>Count</p>
            <p><?= $tutorial_web_url ?></p>
            <a href="table_tutorial" class="circle-tile-footer text-white">More Info <i class="fa fa-chevron-circle-right"></i></a>
        </div>
        <div class="card">
            <h3>News Video</h3>
            <p>Count</p>
            <p><?= $news_url ?></p>
            <a href="table_news" class="circle-tile-footer text-white">More Info <i class="fa fa-chevron-circle-right"></i></a>
        </div>
        <!--<div class="card">-->
        <!--    <h3>Game Type</h3>-->
        <!--    <p>Count</p>-->
        <!--    <p><?= $game_type_name ?></p>-->
        <!--    <a href="table_game" class="circle-tile-footer text-white">More Info <i class="fa fa-chevron-circle-right"></i></a>-->
        <!--</div>-->
        <div class="card">
            <h3>Comments</h3>
            <p>count</p>
            <p><?= $name ?></p>
            <a href="comments" class="circle-tile-footer text-white">More Info <i class="fa fa-chevron-circle-right"></i></a>
        </div>
        <div class="card">
            <h3>Tournament</h3>
            <p>Count</p>
            <p><?= $tourn_id ?></p>
            <a href="table_tournament" class="circle-tile-footer text-white">More Info <i class="fa fa-chevron-circle-right"></i></a>
        </div>
        <div class="card">
            <h4>Tournament-Registered Students</h4>
            <p>Count</p>
            <p><?= $id ?></p>
            <a href="register_tour" class="circle-tile-footer text-white">More Info <i class="fa fa-chevron-circle-right"></i></a>
        </div>
        
         <div class="card">
            <h4>Franchise Request</h4>
            <p>Count</p>
            <p><?= $franch ?></p>
            <a href="franchise" class="circle-tile-footer text-white">More Info <i class="fa fa-chevron-circle-right"></i></a>
        </div>
        
    </div>



    <?php
    include('include/footer.php')

    ?>