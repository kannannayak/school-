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
     
    .custom-table {
        width: 100%;
        border-collapse: collapse;  background-color:#102B6E;
    }
   
    /* .custom-table th,
    .custom-table td {
        padding: 8px;
        text-align: left;
        background-color:#102B6E
        border-bottom: 1px solid #ddd;
    } */
/* 
    .custom-table thead th {
        background-color:#E6F4FB ; 
        color:#505587 ;
    } */

    /* .custom-table tbody tr:nth-child(even) {
        background-color:#fff;
        background-color:#E6F4FB ; 
    }  */
   
  
.custom-input-class {
    width: 100%;
    height: 30px;
    padding: 5px;
    box-sizing: border-box; /* Ensure padding and border are included in the height */
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}


    </style>
    
   
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">


<h4 class="profile">History</h4>

<div class="table-responsive card">
<table id="myTable" class="table display table-striped custom-table" width="100%">

    <thead>
      <tr class="heading">
        <th scope="col">SN</th>
        <th scope="col">Student Name</th>
        <th scope="col">Student Id</th>
        <th scope="col">Age</th>
        <th scope="col">Gender</th>
        <th scope="col">Game Type</th>
        <th scope="col">Timings</th>
<!--         
        <th scope="col">timings</th> -->
      </tr>
    </thead>
    <tbody class="bodyColor">
    <?php
    $tlog_id= $_SESSION['tlog_id'];
                        $sql = "SELECT users.user_name, users.user_uniq_id, users.age_in_months, gender.sub_gender, game_type_web.game_type_name, my_records.total_time FROM users 
                        JOIN my_records ON users.user_id = my_records.user_id JOIN game_type_web ON my_records.game_id = game_type_web.game_type_id JOIN trainer ON users.school_id = trainer.school_id JOIN gender ON users.gender = gender.gender_id WHERE trainer.tlog_id = '$tlog_id';";
          
                        $res = mysqli_query($conn, $sql);
                        if ($res && mysqli_num_rows($res) > 0) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                // $id = $row['game_type_id'];
                                $user_name = $row['user_name'];
                                $user_uniq_id = $row['user_uniq_id'];
                                $user_age = $row['age_in_months'];
                                $gender = $row['sub_gender'];
                                $game_type_name = $row['game_type_name'];
                                $total_time = $row['total_time'];
                               
                                $count++;

                        ?>
                          
      <tr>
        <th><?= $count ?></th>
        <td><?= $user_name ?></td>
        <td><?= $user_uniq_id ?></td>
        <td><?= $user_age ?></td>
        <th><?= $gender ?></th>
        <td><?= $game_type_name ?></td>
        <td><?= $total_time ?></td>
       
       
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
     <tfoot style="display: none;">
                        <tr>
                            <th> <i class="fa-solid fa-magnifying-glass"></i></th>
                            <th style="display:none"> </th>
                            <th> </th>
                           <th style="display:none"> </th>
 
                            
                        </tr>
                </tfoot>
  </table>
</div>
  







<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    // {
                    //     extend: 'csv',
                    //     className: 'btn btn-primary',
                    //     text: '<i class="fa-solid fa-download"></i> CSV ',
                    //     title: 'Student Reports',
                    //     titleAttr: 'Download as CSV File',
                    // },
                    {
                        extend: 'excel',
                        className: 'btn btn-primary',
                        text: '<i class="fa-solid fa-download"></i> Excel',
                        title: 'Student Reports',
                        titleAttr: 'Download as Excel File',
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-primary',
                        text: '<i class="fa-solid fa-download"></i> PDF',
                        title: 'student Reports',
                        titleAttr: 'Download as PDF File',
                    }
                ],
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function(index) {
                            if (index !== 8) { // Skip 2nd and 4th columns
                                let column = this;
                                let title = $(column.footer()).text();
                                let input = document.createElement('input');
                                input.placeholder = title;
                                    input.className = 'custom-input-class';
                                $(column.header()).append(input);
                                $(input).on('keyup change clear', function() {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw();
                                    }
                                });
                            }
                        });
                }
            });

            $('.dt-button').css({
                'background': '#0191D6',
                'color': '#fff',
                'border-radius': '5px',
                'font-size': '15px',
                'margin-top': '20px',
                'margin-left': '20px',
            });

            $('.dataTables_filter').css({
                'margin-top': '20px',
                'margin-right': '20px',
            });
        });
    </script>
    <?php 
include("include/footer.php");
?>