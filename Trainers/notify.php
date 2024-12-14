<?php
include("include/header.php");
include("include/conn.php");
?>

<style>
    .send {
        background: linear-gradient(to bottom, #102B6E, #0191D6);
        color: white;
        border-radius: 5px;
    }
    .container {
        margin-top: 100px;
    }
    .message {
        color: #0191D6;
    }
    .notify {
        color: #102B6E;
    }
    .select2-container--default .select2-selection--multiple {
        background-color: white;
        border: 1px solid #aaa;
        border-radius: 4px;
        cursor: text;
        padding-bottom: 10px !important;
        padding-right: 5px;
        position: relative;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container">
    <h4 class="notify">Notify</h4>
    
    <form action="action/post_notify" method="POST">
        <div class="message-box">
            <h6>Send Message to Student</h6>
            <div class="form-group">
                <select id="user" class="form-control select" name="user[]" multiple="multiple">
                    <?php
                    $tlog_id = $_SESSION['tlog_id'];
                    $result = mysqli_query($conn, "SELECT * FROM users JOIN trainer ON users.school_id = trainer.school_id WHERE trainer.tlog_id = '$tlog_id' ");
                    
                    echo "<option value='all' id='selectAll'>Select ALL</option>";
                    
                    while ($user_row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $user_row['user_id'] . "'>" . $user_row['user_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="message" for="message">Message box</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <button type="submit" name="submit" class="send">Send</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#user').select2();

        $('#user').on('select2:select', function(e) {
            if (e.params.data.id === 'all') {
                $('#user > option').prop('selected', true);
                $('#user').trigger('change');
            }
        });
    });
</script>

<?php
include("include/footer.php");
?>
