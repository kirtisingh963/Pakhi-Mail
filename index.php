<?php include "config/config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= PROJECT_NAME; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">
    <?php include "include/header.php"; ?>

    <div class="container mt-3 px-16">
        <div class="flex flex-1">
            <div class="w-8/12 p-16">
                <h1 class="text-6xl font-black text-serif text-teal-700">Welcome in <?= PROJECT_NAME; ?></h1>
                <p class="text-lg leading-8 mt-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam accusantium repellendus ratione perspiciatis quisquam, rerum consequatur modi quam. Doloribus culpa excepturi placeat explicabo qui harum possimus eligendi, voluptate ducimus! Nulla!</p>
            </div>


            <div class="w-4/12 p-5">

                <div class="bg-white shadow border-slate-300 border rounded-lg p-3">
                    <div class="w-full">
                        <h2 class="text-2xl font-bold my-5 ms-5">Create an account 100% free</h2>
                    </div>


                    <form action="" method="post" class="max-w-sm mx-auto">
                        <div class="flex gap-3">
                            <div class="flex-1">
                                <div class="mb-4">
                                    <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your First Name</label>
                                    <input type="text" id="fname" name="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="e.g Kirti" required />
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="mb-4">
                                    <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Last Name</label>
                                    <input type="text" id="lname" name="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="e.g Singh" required />
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
                            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username@pakhi.com" required />
                        </div>
                        <div class="mb-4">
                            <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact</label>
                            <input type="tel" id="contact" name="contact" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="e.g 9999999999" required />
                        </div>
                        <div class="flex gap-3">

                            <div class="mb-4 flex-1">
                                <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Gender</label>
                                <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username@pakhi.com">

                                    <option value="">Select your gender</option>
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                    <option value="o">Other</option>

                                </select>
                            </div>
                            <div class="mb-4 flex-1">
                                <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
                                <input type="date" id="dob" name="dob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username@pakhi.com" required />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>
                        <div class="mb-2 flex justify-end flex-1">
                            <button type="submit" name="create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create an account</button>
                        </div>
                    </form>

                    <?php 
                        // create account work

                        if(isset($_POST['create'])){
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $dob = $_POST['dob'];
                            $email = $_POST['email'];
                            $contact = $_POST['contact'];
                            $gender = $_POST['gender'];
                            $password = md5($_POST['password']); // md5 used for encrypted password

                            $query = mysqli_query($connect, "insert into accounts (fname, lname, email, contact, gender, dob, password) values ('$fname', '$lname', '$email', '$contact', '$gender', '$dob', '$password')");

                            if($query){
                                $_SESSION['account'] = $email;
                                alert("Registration Successful");
                                redirect("login.php");
                            }
                            else{
                                alert("Failed to create an account try again");
                                redirect("index.php");
                            }                            
                        }
                    ?>
                </div>

            </div>
        </div>
    </div>
</body>

</html>