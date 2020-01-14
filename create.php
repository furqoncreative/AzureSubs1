<?php
    require 'inc/database.php';

    if (!empty($_POST)) {
        $nameError = null;
        $emailError = null;
        $phoneError = null;
        $addressError = null;


        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $date = date("Y-m-d");


        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }

        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }

        if (empty($phone)) {
            $phoneError = 'Please enter phone Number';
            $valid = false;
        }

        if (empty($address)) {
            $phoneError = 'Please enter address';
            $valid = false;
        }

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'INSERT INTO users (name, email, phone, address, date) values(?, ?, ?, ?,?)';
            $q = $pdo->prepare($sql);
            $q->execute(array($name, $email, $phone, $address, $date));
            Database::disconnect();
            header('Location: index.php');
        }
    }

    require 'inc/header.php';
?>

<div class="container">
    <div class="row">
        <h3>Add User</h3>
    </div>

    <div class="row">
        <form class="form-horizontal" action="create.php" method="post">
            <div class="form-group <?php echo !empty($nameError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Name</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="name" type="text" placeholder="Name" value="<?php echo !empty($name) ? $name : ''; ?>">
                    <?php if (!empty($nameError)): ?>
                        <span class="help-block"><?php echo $nameError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($emailError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Email Address</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email) ? $email : ''; ?>">
                    <?php if (!empty($emailError)): ?>
                        <span class="help-block"><?php echo $emailError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($phoneError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">phone Number</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="phone" type="text" placeholder="phone Number" value="<?php echo !empty($phone) ? $phone : ''; ?>">
                    <?php if (!empty($phoneError)): ?>
                        <span class="help-block"><?php echo $phoneError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($addressError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Address</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="address" type="text" placeholder="address" value="<?php echo !empty($address) ? $address : ''; ?>">
                    <?php if (!empty($addressError)): ?>
                        <span class="help-block"><?php echo $addressError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Add</button>
                    <a class="btn btn-default" href="index.php">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
