<?php include "../config/config.php";

if (!isset($_SESSION['account'])) {
    redirect("../login.php");
}
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
                                <h1 class="text-lg font-semibold">Inbox</h1>
                                <div class="flex ">
                                    <!-- Search Bar -->
                                    <input type="text" class="border border-gray-300 px-4 py-1 rounded-lg focus:outline-none focus:border-blue-400" placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Email List -->
                    <div class="flex-1 overflow-y-auto">
                        <div class="container mx-auto px-4 py-4">
                            <!-- Email Item -->

                            <?php
                            $callingInbox = mysqli_query($connect, "SELECT * FROM mails JOIN accounts ON mails.user_by = accounts.user_id WHERE user_to='$myUserId' AND isDraft='0' ORDER BY mail_id DESC");
                            while ($row = mysqli_fetch_array($callingInbox)) :
                            ?>
                                <div class="bg-white shadow rounded-lg p-3 mb-2">
                                    <div class="flex justify-between items-center">
                                        <div class="flex-1 flex items-center space-x-4">
                                            <?php if ($row['dp']) : ?>
                                                <img src="dp/<?= $row['dp']; ?>" alt="User Avatar" class="w-8 h-8 rounded-full">
                                            <?php else : ?>
                                                <img src="../Images/user-icon.jpg" alt="User Avatar" class="w-8 h-8 rounded-full">
                                            <?php endif; ?>
                                            <div class="flex-1">
                                                <a href="view_mail.php?mail_id=<?= $row['mail_id']; ?>">
                                                    <h2 class="text-md font-semibold hover:text-blue-700"><?= $row['fname'] . " " . $row['lname']; ?></h2>
                                                </a>
                                                <p class="text-gray-500 "><?= $row['subject']; ?> - <?= substr($row['content'], 0, 100); ?>...</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <?php
                                            $callingAttachment = mysqli_query($connect, "SELECT * FROM attachments WHERE mail_id='" . $row['mail_id'] . "'");

                                            $countAttachment = mysqli_num_rows($callingAttachment);
                                            if ($countAttachment > 0) :
                                            ?>
                                                <p class="text-gray-400"><img width="20" height="20" src="https://img.icons8.com/ios/50/attach.png" alt="attach" /></p>

                                            <?php endif; ?>
                                            <span class="text-gray-400">2 min ago</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <!-- More Email Items... -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>