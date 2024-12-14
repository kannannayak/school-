<?php
include("include/header.php");
include("include/conn.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($id !== null) {
    $sql = "
        SELECT us.*, sch.school_name, tri.trainer_name, dis.district_name, st.state_name, gen.gender_name
        FROM `users` AS us
        JOIN school_list AS sch ON us.school_id = sch.school_id
        JOIN trainer AS tri ON us.trainer_id = tri.trainer_id
        JOIN district AS dis ON us.district = dis.district_id
        JOIN gender AS gen ON us.gender = gen.gender_id
        JOIN state AS st ON us.state = st.state_id
        WHERE `user_id` = $id
    ";

    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
}

if ($row) {
    $studentID = $row['user_id'] ?? 'N/A';
    $studentName = $row['user_name'] ?? 'N/A';
    $parentName = $row['parent_name'] ?? 'N/A';
    $address = $row['address'] ?? 'N/A';
    $district = $row['district_name'] ?? 'N/A';
    $state = $row['state_name'] ?? 'N/A';
    $trainerName = $row['trainer_name'] ?? 'N/A';
    $pincode = $row['pincode'] ?? 'N/A';
    $gender = $row['gender_name'] ?? 'N/A';
    $age = $row['age_in_months'] ?? 'N/A';
    $schoolName = $row['school_name'] ?? 'N/A';
    $email = $row['user_email'] ?? 'N/A';
    $phone = $row['user_mobile'] ?? 'N/A';
    $password = $row['login_password'] ?? 'N/A';
    $profilePic = $row['profile_pic'] ?? 'default.png';
    $idProof = $row['id_proof'] ?? 'default.png';
} else {
    $studentID = 'N/A';
    $studentName = 'N/A';
    $parentName = 'N/A';
    $address = 'N/A';
    $district = 'N/A';
    $state = 'N/A';
    $trainerName = 'N/A';
    $pincode = 'N/A';
    $gender = 'N/A';
    $age = 'N/A';
    $schoolName = 'N/A';
    $email = 'N/A';
    $phone = 'N/A';
    $password = 'N/A';
    $profilePic = 'default.png';
    $idProof = 'default.png';
}

function convertTimeToSeconds($time) {
    if ($time !== null && preg_match('/^(\d+):(\d+):(\d+)$/', $time, $matches)) {
        $minutes = (int)$matches[1];
        $seconds = (int)$matches[2];
        $milliseconds = (int)$matches[3];
        return $minutes * 60 + $seconds + $milliseconds / 1000;
    }
    return 0;
}

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
    textarea {
        width: 95% !important;
        height: 100px !important;
        margin: auto !important;
        resize: none;
    }
</style>

<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <div class="row" style="padding-top: 2%;">
            <div class="col-lg-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Student Details</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="inputSizing" class="panel-collapse">
                        <div class="portlet-body">
                            <h3 class="text-center" style="margin-top:-5px;margin-bottom:25px;"><?= htmlspecialchars($studentName) ?></h3>
                            <div class="row" id="add_service" style="padding-left: 10px; padding-right: 10px;">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Student ID</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($studentID) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Student Name</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($studentName) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Parent Name</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($parentName) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Address</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($address) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">District</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($district) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">State</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($state) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Trainer Name</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($trainerName) ?></div>
                                    </div><br>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Pincode</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($pincode) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Gender</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($gender) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Age</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($age) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">School Name</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($schoolName) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Email Id</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($email) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Phone Number </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($phone) ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-5" style="font-weight:bold;">Password</div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-6"><?= htmlspecialchars($password) ?></div>
                                    </div><br>
                                </div>

                                <div class="col-md-6" style="font-weight:bold;">
                                    <h3 class="text-center">Profile Pic</h3>
                                    <img src="http://themithraa.com/RestApi/userApi/<?= htmlspecialchars($profilePic) ?>" alt="" style="width: 300px;margin-left: 20%;">
                                </div>
                                <div class="col-md-6" style="font-weight:bold;">
                                    <h3 class="text-center">ID Proof</h3>
                                    <img src="http://themithraa.com/RestApi/userApi/<?= htmlspecialchars($idProof) ?>" alt="" style="width: 300px;margin-left: 20%;">
                                </div>
                            </div>

                            <h1 class="text-center" style="margin-top: 100px; margin-bottom:40px;">Performance Chart</h1>
                            
                            <div>
                                <canvas id="overall-performance-chart"></canvas>
                            </div>

                            <div id="charts-container">
                                <?php foreach ($gamesData as $gameType => $times): ?>
                                    <div>
                                        <canvas id="<?= str_replace(' ', '-', $gameType) ?>-chart"></canvas>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
