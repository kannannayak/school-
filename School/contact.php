<?php
include("include/header.php");
include("include/conn.php");




?>


<div id="page-wrapper">
    <div class="page-content" style="min-height:142vh;">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Contact</h1>
                </div>
                
                <table id="data_table" class=" display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                            <th scope="col">Contact Date</th>
           
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql =  "SELECT * FROM dz_contact";

                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                         
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {

                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $message = $row['message'];
                                $contact_dt = $row['contact_dt'];



                                $count++;

                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $name ?></td>
                                    <td><?= $email ?></td>
                                    <td><?= $message ?></td>
                                    <td><?= $contact_dt ?></td> 
                                </tr>

                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#data_table').DataTable();

    });
</script>

<?php
include("include/footer.php");
?>