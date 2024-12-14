<?php
include("include/conn.php");

$dateFrom = date('Y-m-d', strtotime($_GET['dateFrom']));
$dateTo = date('Y-m-d', strtotime($_GET['dateTo']));

$query = "SELECT rec.*, us.*, game.game_type_name, sch.school_name, tri.trainer_name, gen.gender_name 
          FROM my_records AS rec
          JOIN users AS us ON rec.user_id = us.user_id
          JOIN school_list AS sch ON us.school_id = sch.school_id
          JOIN trainer AS tri ON us.trainer_id = tri.trainer_id
          JOIN game_type_web AS game ON rec.game_id = game.game_type_id
          JOIN gender AS gen ON us.gender = gen.gender_id
          WHERE rec.created_dt BETWEEN '$dateFrom' AND '$dateTo' 
          AND rec.total_time IS NOT NULL 
          ORDER BY rec.record_id DESC";

$res = mysqli_query($conn, $query);

if ($res) {
    $count = 0;
    while ($row = mysqli_fetch_assoc($res)) {
        $count++;
        $id = $row['user_id'];
        $user_uniq_id = $row['user_uniq_id'];
        $user_name = $row['user_name'];
        $trainer_name = $row['trainer_name'];
        $user_age = $row['user_age'];
        $gender_name = $row['gender_name'];
        $school_name = $row['school_name'];
        $game_type_name = $row['game_type_name'];
        $total_time = $row['total_time'];
        $date = date('d-m-Y', strtotime($row['created_dt']));
?>
        <tr>
            <td><?= $count ?></td>
            <td><?= $user_name ?></td>
            <td><?= $user_uniq_id ?></td>
            <td><?= $trainer_name ?></td>
            <td><?= $user_age ?></td>
            <td><?= $gender_name ?></td>
            <td><?= $school_name ?></td>
            <td><?= $game_type_name ?></td>
            <td><?= $total_time ?></td>
            <td><?= $date ?></td>
        </tr>
<?php
    }
}
?>
