<?php 
include('includes/header.php'); 
?>

<?php 
$mysqli = new mysqli("localhost", "root", "", "adminpanel");
if(isset($_GET['date'])){
    $date = $_GET['date'];
    $stmt = $mysqli->prepare("SELECT * FROM appt WHERE DATE = ?");
    $stmt->bind_param('s', $date);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[]= $row['timeslot'];
            }
            
            $stmt->close();
        }
    }
    }
if(isset($_POST['submit']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $timeslot= $_POST['timeslot'];
    $service= $_POST['service'];
    $status= $_POST['status'];
    $transaction= $_POST['payment'];
    $stmt = $mysqli->prepare("SELECT * FROM appt WHERE DATE= ? AND timeslot= ?");
    $stmt->bind_param('ss', $date, $timeslot); 
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            $message ="<div class= 'alert alert-danger'>Already Booked</div>";
            }else{
                $stmt = $mysqli->prepare("INSERT INTO appt(firstname, lastname,email,contact, DATE, timeslot, service, status, transaction) VALUES (?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param('sssssssss', $firstname, $lastname, $email, $contact, $date, $timeslot, $service, $status, $transaction);
                $stmt->execute();
                $message ="<div class= 'alert alert-success' >Appointment Successfull</div>";
                $bookings[]= $timeslot;
                $stmt-> close();
                $mysqli->close();
        }
    }
}

$duration = 30;
$cleanup = 0;
$start = "9:00";
$end = '16:00';
$breakStart = '12:00';
$breakEnd = '13:00';

function timeslots($duration, $cleanup, $start, $end, $breakStart, $breakEnd)
{
  $start = new DateTime($start);
  $end = new DateTime($end);
  $interval = new DateInterval('PT' . $duration . 'M');
  $cleanupinterval = new DateInterval('PT' . $cleanup . 'M');
  $breakStart = new DateTime($breakStart);
  $breakEnd = new DateTime($breakEnd);
  $slots = array();

  for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupinterval)) {
    $endperiod = clone $intStart;
    $endperiod->add($interval);
    
    // Check if the current time slot is within the break period
    if (!($intStart >= $breakStart && $intStart < $breakEnd) && !($endperiod > $breakStart && $endperiod <= $breakEnd)) {
      if ($endperiod > $end) {
        break;
      }
      $slots[] = $intStart->format('H:iA') . '-' . $endperiod->format('H:iA');
    }
  }

  return $slots;
}
?>


<div class="container">
  <div class="row justify-content-center">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Appointment for Date: <?php echo date('m/d/Y', strtotime($date));?></h1>
                                <?php echo (isset($message))?$message:"";?>

                                <div class="row">
                                <?php $timeslots = timeslots($duration, $cleanup, $start, $end, $breakStart, $breakEnd);
                                foreach($timeslots as $timeslot){ 
                                    ?>
                                <div class= "col-md-2">
                                    <div class="form-group">
                                      <?php if(in_array($timeslots, $bookings)){
                                      ?>
                                      <button class="btn btn-danger"><?php echo $timeslot;?></button>
                                      <?php }?>
                                        <?php if(in_array($timeslot, $bookings)){?>
                                            <button class="btn btn-danger"><?php echo $timeslot;?></button>
                                         <?php }else{?>
                                           <button class="btn btn-success book" data-timeslot="<?php echo $timeslot; ?>"><?php echo $timeslot;?></button>
                                    <?php }?>
                                    </div>
                                </div>
                                <?php }?>   
                                <a class="btn btn-primary btn-block" href="calendar.php">Back</a>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Appointing for:<span id="slot"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
       </div>

       <div class="row justify-content-center">
       <div class="col-xl-6 col-lg-6 col-md-6">
      <div class="modal-body">
            <?php
                        if(isset($_SESSION['status']) && $_SESSION['status'] !='')
                         {
                        echo '<h2 clas= "bg-danger text-white">' .$_SESSION['status']. ' </h2>';
                        unset ($_SESSION['status']);
                        } ?>
                            </div class="col-md-12">
                            <form action="" method="POST" autocomplete="off">

                                <div class="form-group">    
                                        <label for="">Timeslot</label>
                                        <input type="text" class="form-control" readonly name="timeslot" id="timeslot">
                                        </div>

                                <div class="form-group">

                                        <input type="text" class="form-control" name="firstname"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="form-group">    
                                        <input type="text" class="form-control" name="lastname"
                                            placeholder="Last Name" required>
                                </div>
                                
                                <div class="form-group">
                                    <input type="email" class="form-control checking_email" name="email"
                                        placeholder="Email Address" required>
                                        <small class="error_email" style="color: red;"></small>
                                </div>

                                    <div class="form-group">
                                        <input type="contact" class="form-control"
                                            name="contact" placeholder="Contact Number" required>
                                    </div>

                                <div class="form-group">
                                 <label>Select Service</label>
                                  <select name="service" placeholder="-SELECT-">
                                    <option value="">Select</option>
                                    <option value="Tooth Extraction">Tooth Extraction</option>
                                    <option value="Orthodontist">Orthodontist</option>
                                    <option value="Treatment">Treatment</option>

                                   </select>
                                </div>

                                <div class="form-group">
                                <label for="payment">Payment Amount (50 PHP): </label>
                                <label for="a">Gcash no.: 0997 280 6864 </label>
                                <input type="text" class="form-control" name="payment" placeholder="Enter GCash transaction details" required>
                      </div>
                      <input type="hidden" name="status" value="pending">
                                <div>

                      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>

    </div>
  </div>
</div>
</div>
</div>
</div>

<?php 
include('includes/scripts.php');
?>
 