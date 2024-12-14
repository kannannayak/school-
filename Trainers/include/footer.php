</div>
    </div>

</body>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- jQuery -->
<!-- Select2 JS -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script>const toggler = document.querySelector(".btn");
toggler.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});
    </script> 
    <script>
    // Wait for the DOM to be ready
    document.addEventListener("DOMContentLoaded", function() {
        // Get the bell iconn and notification modal
        const bellIcon = document.getElementById("notifyIcon");
        const modal = document.getElementById("notificationModal");

        // Add click event listener to the bell icon
        bellIcon.addEventListener("click", function() {
            // Show the notification modal
            modal.classList.add("show");
            modal.style.display = "block";
        });

        // Close the modal when close button is clicked
        modal.querySelector(".btn-close").addEventListener("click", function() {
            modal.classList.remove("show");
            modal.style.display = "none";
        });
    });
</script>
    <!-- <script src="script.js"></script> -->
</html>
