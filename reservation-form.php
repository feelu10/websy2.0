<!-- RESERVATION-FORM PAGE -->

<?php
session_start();
if (!$_SESSION['login']) {
    header('Location: connection.php');
}
session_abort();

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/dbconnect.php'; ?>

<?php

if (isset($_SESSION['login'])) {
    if (isset($_POST["Title"])) {
        $Title = $_POST["Title"];
    }
    if (isset($_POST["description"])) {
        $description = $_POST["description"];
    }
    if (isset($_POST["dateDebut"])) {
        $dateDebut = $_POST["dateDebut"];
    }
    if (isset($_POST["dateend"])) {
        $dateend = $_POST["dateend"];
    }

    error_reporting(0);
    ini_set('display_errors', 0);
    date_default_timezone_set("Asia/Manila");
    $conn = mysqli_connect("localhost", "root", "", "school");
}

$studentQuery = mysqli_query($conn, "SELECT * FROM users WHERE role = 'student' AND status = 'available'");
$students = array();

while ($student = mysqli_fetch_assoc($studentQuery)) {
    $students[] = $student;
}

$userQuery = mysqli_query($conn, "SELECT id, firstname, lastname FROM users WHERE login = '" . $_SESSION['login'] . "'");
$user = mysqli_fetch_assoc($userQuery);
$_SESSION['id'] = $user['id'];
$firstname = $user['firstname'];
$lastname = $user['lastname'];
$fullName = $firstname . ' ' . $lastname;
?>

<main>
    <!-- Add this in the head section of your HTML -->
    <div class="container my-3">

        <div class="row justify-content-center align-items-center">
            <article class="col-sm">
                <form method="post" id="reservationform" action="submit.php">
                    <h1>Reservation</h1>

                    <div class="row mb-3 align-items-center">
                            <label class="col-form-label text-end fw-normal fs-5">Incharge :</label>
                            <div class="col-sm-9">
                                <h4 class="text-start mb-0"><?= $fullName ?></h4>
                            </div>

                    <?php if (isset($_SESSION['login'])) { ?>
                        <div class="row mb-3">
                            <label for="student_in_charge">Personnel in charge :</label>
                            <select name="student_in_charge" class="form-control" required>
                                <?php
                                // Display each student as an option in the dropdown
                                if (empty($students)) {
                                    echo '<option value="" disabled>No student available at this time</option>';
                                } else {
                                    foreach ($students as $student) {
                                        $displayText = $student['firstname'] . ' ' . $student['lastname'] . ' - ' . $student['year'] . ' ' . $student['course'];
                                        echo '<option value="' . $student['id'] . '">' . $displayText . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <label>Purpose:</label>
                            <input type="text" name="Title" class="form-control" maxlength="50" placeholder="50 Characters maximum" required><br /><br />
                        </div>
                        <div class="row mb-3">
                            <label for="description">List of members :</label>
                            <textarea id="description" name="description" class="form-control" maxlength="200" placeholder="200 Characters maximum" required></textarea>
                        </div>
                        <div class="row mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" min="<?= date("Y-m-d", strtotime("now")) ?>" required><br /><br />
                        </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="reservation_type">Select Type :</label>
                                <select name="reservation_type" id="reservation_type" required>
                                    <option value="room">Room</option>
                                    <option value="venue">Venue</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <!-- Venue Dropdown -->
                            <div class="col" id="venueDropdownContainer" style="display:none;">
                                <label for="venueDropdown">Select Venue:</label>
                                <select id="venueDropdown" name="venueDropdown" class="form-control">
                                    <?php
                                    // Fetch venues from the database
                                    $venueQuery = mysqli_query($conn, "SELECT * FROM venues WHERE status = 'available'");
                                    while ($venue = mysqli_fetch_assoc($venueQuery)) {
                                        echo '<option value="' . $venue['id'] . '">' . $venue['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Room Dropdown -->
                            <div class="col" id="roomDropdownContainer" style="display:none">
                                <label for="roomDropdown">Select Room:</label>
                                <select id="roomDropdown" name="roomDropdown" class="form-control">
                                    <?php
                                    // Fetch rooms from the database
                                    $roomQuery = mysqli_query($conn, "SELECT * FROM rooms WHERE status = 'available'");
                                    while ($room = mysqli_fetch_assoc($roomQuery)) {
                                        echo '<option value="' . $room['id'] . '">' . $room['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col" id="imageContainer">
                                <img id="selectedImage"  alt="Selected Image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="start_time">Start time :</label>
                                <select name="start_time" required>
                                    <option value="08:00:00">08 AM</option>
                                    <option value="09:00:00">09 AM</option>
                                    <option value="10:00:00">10 AM</option>
                                    <option value="11:00:00">11 AM</option>
                                    <option value="12:00:00">12 PM</option>
                                    <option value="13:00:00">01 PM</option>
                                    <option value="14:00:00">02 PM</option>
                                    <option value="15:00:00">03 PM</option>
                                    <option value="16:00:00">04 PM</option>
                                    <option value="17:00:00">05 PM</option>
                                    <option value="18:00:00">06 PM</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="end_time">End time :</label>
                                <select name="end_time" required>
                                    <option value="09:00:00">09 AM</option>
                                    <option value="10:00:00">10 AM</option>
                                    <option value="11:00:00">11 AM</option>
                                    <option value="12:00:00">12 PM</option>
                                    <option value="13:00:00">01 PM</option>
                                    <option value="14:00:00">02 PM</option>
                                    <option value="15:00:00">03 PM</option>
                                    <option value="16:00:00">04 PM</option>
                                    <option value="17:00:00">05 PM</option>
                                    <option value="18:00:00">06 PM</option>
                                    <option value="19:00:00">07 PM</option>
                                </select>
                            </div>
                        </div>
                        <?php
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']); // Clear the session message to avoid displaying it on subsequent page loads
                            }
                        ?>
                        <!-- Add these hidden inputs inside your form -->
                        <input type="hidden" name="selected_id" id="selectedId" value="">
                        <input type="hidden" name="selected_type" id="selectedType" value="">

                        <div class="row block mb-3 my-5">
                            <button class="form-control submit" width="100%" type="submit" name="submit">BOOK</button>
                        </div>

                    <?php } else { ?>
                        <a class="lead" href="connection.php">Log in to book</a>
                    <?php } ?>

                </form>

            </article>

            <!-- Encart droite -->
            <article class="col-md my-3 h-100 bg-light">
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni similique porro est delectus atque aliquam, velit voluptates nulla consectetur adipisci esse, harum sed quam quis minus, rerum fugit. Suscipit, quos.</h5>
                        <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur dolor tempora nisi rerum dolore sed neque minus praesentium quo consectetur?.<br><span class="text-alert">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, quia..</span><br>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit.. </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Reservation from Monday to Friday</li>
                        <li class="list-group-item">The day before at the latest</li>
                        <li class="list-group-item">From 8 am to 7 pm</li>
                    </ul>
                    <div class="card-body py-3">
                        <a href="planning.php" class="card-link">See the schedule</a>
                    </div>
                </div> <!-- /card -->
            </article>
        </div> <!-- /row -->
    </div> 
</main> 

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to handle venue selection
        function handleVenueSelection(venueId) {
            // Replace the following line with your logic to fetch venue data from the database
            $.ajax({
                url: 'fetch_venue_data.php', 
                method: 'POST',
                data: { venueId: venueId },
                success: function (response) {
                    console.log(response); // Log the response to the console

                    // Update modal content with venue information
                    $('#venueModalBody').html(response);
                    // Show the modal
                    $('#venueModal').modal('show');
                    updateSelectedImage(response);
                }
            });
        }

        // Function to handle room selection
        function handleRoomSelection(roomId) {
            $.ajax({
                url: 'fetch_room_data.php', 
                method: 'POST',
                data: { roomId: roomId },
                success: function (response) {
                    // Update modal content with room information
                    $('#roomModalBody').html(response);
                    // Show the modal
                    $('#roomModal').modal('show');
                    updateSelectedImage(response);
                }
            });
        }

        // Attach an event listener to handle type selection
        $('#reservation_type').change(function () {
            var selectedType = $(this).val();

            // Hide both dropdown containers
            $('#venueDropdownContainer, #roomDropdownContainer').hide();

            // Show the corresponding dropdown based on the selected type
            if (selectedType === 'venue') {
                $('#venueDropdownContainer').show();
            } else if (selectedType === 'room') {
                $('#roomDropdownContainer').show();
            }
        });

        // Attach an event listener to handle room selection
        $('#roomDropdown').change(function () {
            var selectedRoomId = $(this).val();
            $('#selectedId').val(selectedRoomId);
            handleRoomSelection(selectedRoomId);
        });

        // Attach an event listener to handle venue selection
        $('#venueDropdown').change(function () {
            var venueId = $(this).val();
            $('#selectedId').val(venueId);
            handleVenueSelection(venueId);
        });

        // Function to update the selected image
        function updateSelectedImage(imageSource) {
            // Remove HTML comments from the image source
            var cleanedImageSource = imageSource.replace(/<!--[\s\S]*?-->/g, '');

            // Set the cleaned image source to the selectedImage
            $('#selectedImage').attr('src', cleanedImageSource);
        }
    });
</script>
