<?php include "../config/config.php"; ?>
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
    <div class="mx-10 bg-white shadow-lg mt-5 p-3">
        <h1 class="text-2xl font-bold">User Settings</h1>
    </div>
    <div class="mx-10 mt-2">
    <a href="inbox.php" class="text-blue-600">Go back</a>
</div>

    <div class="flex gap-2 bg-white shadow-lg p-3 mx-10 mt-5">

        <div class="w-3/12 p-4">
            <!-- Form for changing DP -->
            <form action="" method="post" enctype="multipart/form-data" class="mb-6">
                <div class="mb-4">
                    <label for="profile_picture" class="flex justify-center">
                        <?php if ($getUserData['dp']) : ?>
                            <img src="dp/<?= $getUserData['dp']; ?>" alt="User Avatar" class="w-56 h-56 rounded-full">
                        <?php else : ?>
                            <img src="../Images/user-icon.jpg" alt="User Avatar" class="w-56 h-56 rounded-full">
                        <?php endif; ?>
                    </label>
                    <input type="file" name="profile_picture" onchange="this.form.submit()" id="profile_picture" accept="image/*" style="display: none;" class="border border-gray-300 p-2 cursor-pointer">
                </div>
                <div class="h-16 -mt-16">
                    <div class="text-center">
                        <p class="text-slate-600">Click to change</p>
                    </div>

                    <h2 class=" text-slate-700 text-center font-bold text-xl mt-8"><?= $getUserData['fname']. " " .$getUserData['lname']; ?></h2>
                </div>
            </form>

            <?php
            if (isset($_FILES['profile_picture'])) {
                $dp = $_FILES['profile_picture']['name'];
                $tmp_dp = $_FILES['profile_picture']['tmp_name'];

                move_uploaded_file($tmp_dp, "dp/$dp");

                $query = mysqli_query($connect, "UPDATE accounts SET dp='$dp' WHERE user_id='" . $getUserData['user_id'] . "'");
                if ($query) {
                    redirect("setting.php");
                }
            }
            ?>
        </div>

        <div class="w-9/12 p-4">

            <!-- Form for updating personal information -->
            <form action="" method="post" class="mb-6">
                <label class="block mb-2">First Name:</label>
                <input type="text" name="fname" class="border border-gray-300 p-2 mb-2 w-full rounded" value="<?= $getUserData['fname']; ?>">

                <label class="block mb-2">Last Name:</label>
                <input type="text" name="lname" class="border border-gray-300 p-2 mb-2 w-full rounded cursor" value="<?= $getUserData['lname']; ?>">

                <label class="block mb-2">Email:</label>
                <input type="email" name="email" class="border border-gray-300 p-2 mb-2 w-full rounded cursor-not-allowed" value="<?= $getUserData['email']; ?>" disabled>

                <label class="block mb-2">Date of Birth:</label>
                <input type="date" name="dob" class="border border-gray-300 p-2 mb-2 w-full rounded" value="<?= $getUserData['dob']; ?>">

                <label class="block mb-2">Gender:</label>
                <select name="gender" class="border border-gray-300 p-2 mb-2 w-full rounded">
                    <option value="m" <?php if ($getUserData['gender'] === 'm') echo 'selected'; ?>>Male</option>
                    <option value="f" <?php if ($getUserData['gender'] === 'f') echo 'selected'; ?>>Female</option>
                    <option value="o" <?php if ($getUserData['gender'] === 'o') echo 'selected'; ?>>Other</option>
                </select>

                <button type="submit" name="update_profile" class="bg-blue-500 text-white py-2 px-4 rounded">Save Changes</button>
            </form>

            <?php 
            if(isset($_POST['update_profile'])){
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];

                $updateProfile = mysqli_query($connect, "UPDATE accounts SET fname='$fname', lname='$lname', dob='$dob', gender='$gender' WHERE user_id='".$getUserData['user_id']."'");

                if($updateProfile){
                    alert("Update Profile");
                    redirect("setting.php");
                }
            }
            ?>
        </div>
    </div>
</body>

</html>