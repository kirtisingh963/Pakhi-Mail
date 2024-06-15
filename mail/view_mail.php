<?php include "../config/config.php";

if (!isset($_SESSION['account'])) {
    redirect("../login.php");
}
?>

<?php
if(isset($_GET['mail_id'])){
    $mail = $_GET['mail_id'];
    $callingInbox = mysqli_query($connect, "SELECT * FROM mails JOIN accounts ON mails.user_by = accounts.user_id WHERE mail_id='$mail'");
    $row = mysqli_fetch_array($callingInbox);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox - <?= PROJECT_NAME; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-slate-100">
    <?php include "mail_header.php"; ?>

    <div class="container mt-5">
        <div class="flex gap-2 px-4">
            <div class="w-3/12">
                <?php include_once "side.php"; ?>
            </div>

            <div class="w-9/12">
                <div class="flex flex-col h-screen">
                    <!-- Header -->
                    <header class="bg-white shadow-md mx-4">
                        <div class="container mx-auto px-4">
                            <div class="flex justify-between items-center py-3">
                                <div class="flex items-center gap-4">
                                <a href="inbox.php"><img width="20" height="20" src="https://img.icons8.com/ios-filled/50/circled-left-2.png" alt="circled-left-2"/></a>
                                <h1 class="text-lg font-semibold"><?= $row['fname']; ?>'s mail</h1>
                                </div>
                                <div class="flex ">
                                    <!-- Search Bar -->
                                    <input type="text" class="border border-gray-300 px-4 py-1 rounded-lg focus:outline-none focus:border-blue-400" placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </header>
                    
                    <div class="container mx-auto mt-6 p-4 bg-white rounded-lg shadow-md">

                       
                        <div class="mb-4">
                            <p class="text-gray-700 text-sm font-semibold">To: You  &lt; <?= $getUserData['email'];?> &gt;</p>
                            <p class="text-gray-700 text-sm font-semibold">From: <?= $row['fname']. " " . $row['lname'];?> &lt; <?= $row['email'];?> &gt;</p>
                            <p class="text-gray-700 text-sm font-semibold">Subject: <?= $row['subject'];?></p>
                            <p class="text-gray-700 text-sm font-semibold">Date: April 22, 2024</p>
                        </div>
                        <div class="mb-4">
                            <p class="text-gray-700"><?= $row['subject'];?></p>
                            <p class="text-gray-700"><?= $row['content'];?></p>
                        </div>

                        <!-- attachments (if any) -->
                        <div class="mb-4">
                                    <?php 
                                        $callingAttachment = mysqli_query($connect, "SELECT * FROM attachments WHERE mail_id='".$row['mail_id']."'");
                                        
                                        $countAttachment = mysqli_num_rows($callingAttachment);
                                        if($countAttachment > 0):
                                        ?>
                                            <p class="text-gray-700 font-semibold">Attachment:</p>
                                            <ul class="list-disc ml-4">
                                        <?php
                                            while($attach = mysqli_fetch_array($callingAttachment)):
                                        ?>
                                        <li><a href="attach/<?= $attach['attachment']; ?>" target="_blank" class="text-sm hover:text-blue-700"><?= $attach['attachment']; ?></a></li>
                                        
                                        <?php endwhile;
                                        endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    <?php } ?>
    </html>