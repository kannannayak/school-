<?php
include("include/header.php");
include("include/conn.php");

?>
<style>
     .profile
    {
        color:#102B6E !important;
        margin-top :25px;
        margin-left:50px;
    }
     body{
            background:#E6F4FB !important;
           
        }
        .heading{
            background:#0095DA !important;
            color:white;
            font-weight:5px;

        }
        .bodyColor{
            background:#E6F4FB !important;
            
        }
     
    /* .custom-table {
        width: 100%;
        border-collapse: collapse;  background-color:#102B6E;
    }
    */
        /* table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }
   
    .custom-table th,
    .custom-table td {
        padding: 8px;
        text-align: left;
        background-color:#E6F4FB 
        border-bottom: 1px solid #ddd;
    }

    .custom-table thead th {
        background-color:#E6F4FB ; 
        color:#505587 ;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color:#fff; Light gray
        background-color:#E6F4FB ; 
    } */

   
    </style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<h4 class="profile">Student</h4>

<div class="table-responsive card">
<table id="myTable" class="table display table-striped custom-table" width="100%">

    <thead>
      <tr class="heading">
        <th scope="col">SN</th>
        <th scope="col">Student Name</th>
        <th scope="col">Student Id</th>
        <th scope="col" class="text-center">Best Records</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody class="bodyColor">
    <?php
                   
                         
//   $sql="SELECT users.*
//   FROM users ORDER BY user_id DESC";
$tlog_id= $_SESSION['tlog_id'];
                $sql="SELECT *
                FROM users
                JOIN trainer ON users.school_id = trainer.school_id
                WHERE users.school_id = trainer.school_id AND trainer.tlog_id = '$tlog_id' 
                ";       
           
                         $res = mysqli_query($conn, $sql);
                         if ($res && mysqli_num_rows($res) > 0) {

                            $count=0;
                             while ($row = mysqli_fetch_assoc($res)) {
                                $id = $row['user_id'];

                                $sql2="SELECT my_records.*, game_type_web.game_type_name,TIME_FORMAT(total_time, '%i:%s') AS formatted_time
                                FROM my_records                  
                                JOIN game_type_web ON my_records.game_id = game_type_web.game_type_id where my_records.user_id = $id
                                ";

                                 $res2 = mysqli_query($conn, $sql2);
                              
                                 
                                 $user_name = $row['user_name'];
                                 $user_uniq_id = $row['user_uniq_id'];
                                 $user_age = $row['user_age'];
                                 $gender = $row['gender'];
                                 $user_grade = $row['user_grade'];
                                
                        $count++;
                        ?>
                          
      <tr>
        <th><?= $count ?></th>
        <td><?= $user_name ?></td>
        
    
        <td><?= $user_uniq_id ?></td>
        <td class="text-center">
        <?php 
    while ($row2 = mysqli_fetch_assoc($res2)) { 
        echo '<b>'.$row2['game_type_name'] .'</b>'. ': ' .'<span class="mr-3">'. $row2['formatted_time'].'</span>';
    } 
?>  

        </td>
      
       
        <td>
    <!-- <a href="#" data-id="<?= $id ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a> -->
    <a href="chart.php?id=<?= $id ?>" ><i class="fa-solid fa-eye ml-3"></i></a>
</td>
       
       
      </tr>
      <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7" class="text-center">No Subcategories found.</td>
                            </tr>
                        <?php
                        }
                        ?>
    </tbody>
  </table>
</div>
  

<?php 
include("include/footer.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend:'copyHtml5',
                    text:'copy  <i class="fas fa-copy"></i>',
                    className: 'btn btn-primary'
                },
                {
                    extend:'csvHtml5',
                    text:'csv  <i class="fas fa-file-csv"></i>',
                    className: 'btn btn-primary'
                }

               
            ]
        });
        $('.dt-button').css({
            'background' :'#0191D6' ,
            'color':'#fff',
            'border-radius':'5px',
            'font-size':'20px',
            'margin-top':'20px',
            'margin-left':'20px',
           
            
        });
        $('.dataTables_filter').css(
            {
                
            
            'margin-top':'20px',
            'margin-right':'20px',
            
            
            
            });
    }); 
</script>