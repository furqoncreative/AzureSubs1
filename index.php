<?php require 'inc/header.php'; ?>

<div class="container">
    <div class="row">
        <h3>Azure Submission 1</h3>
    </div>

    <div class="row">
        <p><a href="create.php" class="btn btn-success">Add User</a></p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Address </th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require 'inc/database.php';

                    $pdo = Database::connect();
                    $getCustomers = $pdo->prepare('SELECT * FROM users ORDER BY id DESC');
                    $getCustomers->execute();

                    if($getCustomers->rowCount() > 0) {
                        while ($row = $getCustomers->fetch()) {
                            echo '<tr>';
                            echo '<td>'. $row['name'] . '</td>' . PHP_EOL;
                            echo '<td>'. $row['email'] . '</td>' . PHP_EOL;
                            echo '<td>'. $row['phone'] . '</td>' . PHP_EOL;
                            echo '<td>'. $row['address'] . '</td>' . PHP_EOL;
                            echo '<td>'. $row['date'] . '</td>' . PHP_EOL;
                            echo '<td>' . PHP_EOL;
                            echo '<a class="btn btn-default" href="read.php?id='.$row['id'].'">Read</a>' . PHP_EOL;
                            echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>' . PHP_EOL;
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>' . PHP_EOL;
                            echo '</td>' . PHP_EOL;
                            echo '</tr>' . PHP_EOL;
                        }
                    } else {
                        echo '<tr>';
                        echo '<td>Nothing here...</td>' . PHP_EOL;
                        echo '<td>Nothing here...</td>' . PHP_EOL;
                        echo '<td>Nothing here...</td>' . PHP_EOL;
                        echo '<td>Nothing here...</td>' . PHP_EOL;
                        echo '</tr>';
                    }

                    Database::disconnect();
                ?>
            </tbody>
        </table>
    </div>
</div>

