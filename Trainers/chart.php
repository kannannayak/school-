<?php 
include("include/header.php");
include("include/conn.php");

// Function to convert time to seconds
function convertTimeToSeconds($time) {
    if ($time !== null && preg_match('/^(\d+):(\d+):(\d+)$/', $time, $matches)) {
        $minutes = (int)$matches[1];
        $seconds = (int)$matches[2];
        $milliseconds = (int)$matches[3];
        return $minutes * 60 + $seconds + $milliseconds / 1000;
    }
    return 0;
}

// Check if 'id' parameter is set in the URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id === null) {
    echo "Error: 'id' parameter is missing in the URL.";
} else {
    $trainer_id = $_SESSION['trainer_id'];
    $sql = "SELECT users.user_name, users.user_age, school_list.school_name, users.user_uniq_id, users.profile_pic,users.user_mobile, trainer.trainer_id, trainer.trainer_name 
            FROM users 
            JOIN school_list ON users.school_id = school_list.school_id 
            JOIN trainer ON users.school_id = trainer.school_id 
            WHERE users.user_id = '$id' AND trainer.trainer_id = '$trainer_id';";

    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            // Fetch student details
            $user_name = $row['user_name'];
            $user_uniq_id = $row['user_uniq_id'];
            $user_age = $row['user_age'];
            $school_id = $row['school_name'];
            $trainer_name = $row['trainer_name'];
            $profile_pic = $row['profile_pic'];
             $user_mobile = $row['user_mobile'];

            // Query to fetch game data
            $gameDataQuery = "
                SELECT game_type_web.game_type_name, total_time
                FROM my_records
                JOIN game_type_web ON my_records.game_id = game_type_web.game_type_id
                WHERE my_records.user_id = $id
                ORDER BY game_type_web.game_type_name, my_records.total_time ASC;
            ";

            $gameDataResult = mysqli_query($conn, $gameDataQuery);
            $gamesData = [];
            $gameCounts = [];

            while ($row = mysqli_fetch_assoc($gameDataResult)) {
                $gameType = $row['game_type_name'];
                $timeInSeconds = convertTimeToSeconds($row['total_time']);

                if (!isset($gamesData[$gameType])) {
                    $gamesData[$gameType] = [];
                    $gameCounts[$gameType] = 0;
                }

                $gamesData[$gameType][] = $timeInSeconds;
                $gameCounts[$gameType]++;
            }

            $jsonGamesData = json_encode($gamesData);
            $jsonGameCounts = json_encode($gameCounts);
            ?>
            
            <style>
                .card {
                    background: #E5F7FF;
                    margin-top: 30px;
                    margin-bottom: 30px;
                } 
                #doughnut-chart {
                    height: 280px!important;
                    width: 280px;
                }
                #line-chart, #line-chart2, #line-chart3 {
                    height: 280px;
                    width: 280px;
                }
                .student {
                    margin-top: 20px;
                    margin-left: 20px;
                    font-size: 50px;
                    color: #102B6E !important;
                }
                .profile-image {
                    border-radius: 50%; 
                    overflow: hidden; 
                    width: 150px; 
                    height: 150px;
                    margin-left: 30px;
                }
            </style>
            <div class="container">
                <div class="card">
                    <div class="title">
                        <h5 class="student">Student Details</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <img src="../RestApi/userApi/<?= $profile_pic ?>" class="profile-image" alt="Profile Image" width="50" height="90">
                            <br><br>
                            <p style="margin-left:30px"><b>Student Name: </b><?= $user_name ?></p>
                            <p style="margin-left:30px"><b>Student ID: </b><?= $user_uniq_id ?></p>
                        </div>
                        <div class="col-md-7">
                            <p><b>Student Age: </b><?= $user_age ?></p>
                            <p><b>Student School: </b><?= $school_id ?></p>
                            <p><b>Trainer Name: </b><?= $trainer_name ?></p>
                             <p><b>Mobile Number: </b><?= $user_mobile ?></p>
                        </div>
                    </div>
              
                <div class="container">
                    <h1 class="text-center" style="margin-top: 100px; margin-bottom: 40px;">Performance Chart</h1>
                    <div style="margin-bottom: 40px;">
                        <canvas id="overall-performance-chart"></canvas>
                    </div>
                    <div id="charts-container" style="margin-bottom: 40px;">
                        <?php foreach ($gamesData as $gameType => $times): ?>
                            <div>
                                <canvas id="<?= str_replace(' ', '-', $gameType) ?>-chart"></canvas>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                  </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    function generateLabels(data) {
                        return data.map((_, index) => (index + 1).toString());
                    }

                    var gamesData = <?= $jsonGamesData ?>;
                    var gameCounts = <?= $jsonGameCounts ?>;

                    Object.keys(gamesData).forEach(function(gameType) {
                        var canvasId = gameType.replace(/\s+/g, '-') + '-chart';
                        var ctx = document.getElementById(canvasId).getContext('2d');
                        var data = gamesData[gameType];
                        var chartData = {
                            labels: generateLabels(data),
                            datasets: [{
                                label: gameType + ' Game',
                                data: data,
                                backgroundColor: '#7DC8EB',
                                borderColor: '#7DC8EB',
                                borderWidth: 3
                            }]
                        };

                        new Chart(ctx, {
                            type: 'line',
                            data: chartData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        ticks: {
                                            stepSize: 1,
                                            callback: function(value, index, values) {
                                                return index + 1;
                                            }
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            stepSize: 1,
                                            callback: function(value) {
                                                var minutes = Math.floor(value / 60);
                                                var seconds = value % 60;
                                                return minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                                            }
                                        }
                                    }
                                },
                                plugins: {
                                    title: {
                                        display: true,
                                        text: gameType + ' Game Performance'
                                    }
                                }
                            }
                        });
                    });

                    var overallCtx = document.getElementById('overall-performance-chart').getContext('2d');
                    var overallData = {
                        labels: Object.keys(gameCounts),
                        datasets: [{
                            label: 'Games Played',
                            data: Object.values(gameCounts),
                            backgroundColor: [
                                '#FF6384',
                                '#36A2EB',
                                '#FFCE56',
                                '#4BC0C0',
                                '#9966FF',
                                '#FF9F40'
                            ],
                            hoverBackgroundColor: [
                                '#FF6384',
                                '#36A2EB',
                                '#FFCE56',
                                '#4BC0C0',
                                '#9966FF',
                                '#FF9F40'
                            ]
                        }]
                    };

                    new Chart(overallCtx, {
                        type: 'doughnut',
                        data: overallData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Overall Game Performance'
                                }
                            }
                        }
                    });
                </script>
            </div>
            <?php
        }
    } else {
        echo "No student details found for the given ID.";
    }
}
?>
