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
    <script src="https://cdn.tiny.cloud/1/enylhq0dbo22gf4rnx2r9xzb8vnr5dctgremslk4tr1ybma5/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script> -->

</head>

<body class="bg-slate-100">
    <?php include "mail_header.php"; ?>

    <div class="container mt-5">
        <div class="flex gap-2 px-4">
            <div class="w-3/12">
                <?php include_once "side.php"; ?>
            </div>

            <div class="w-9/12">
                <div class="container mx-auto p-4">
                    <h1 class="text-3xl font-bold mb-4">Compose Mail</h1>

                    <!-- Form for composing email -->
                    <form action="" method="post" enctype="multipart/form-data" class="mx-auto bg-white p-6 rounded-lg shadow-md">
                        <label class="block mb-2">To:</label>
                        <input type="email" name="user_to" class="border border-gray-300 p-2 w-full mb-4" placeholder="recipient@pakhi.com">

                        <label class="block mb-2">Subject:</label>
                        <input type="text" name="subject" class="border border-gray-300 p-2 w-full mb-4" placeholder="Enter subject">

                        <label class="block mb-2" for="textarea">Message:</label>
                        <textarea name="content" id="textarea" rows="5" class="border border-gray-300 p-2 w-full h-32 mb-4" placeholder="Enter your message here"></textarea>

                        <label class="block my-2">Attachment:</label>
                        <input type="file" name="attachment" class="border border-gray-300 p-2 w-full mb-4">

                        <button type="submit" name="compose" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Send Email</button>
                        <button type="submit" name="save" class="bg-slate-700 hover:bg-slate-800 text-white py-2 px-4 rounded">Save to Draft</button>
                    </form>

                    <?php
                    if (isset($_POST['compose']) || isset($_POST['save'])) {
                        $user_to = $_POST['user_to'];
                        $subject = $_POST['subject'];
                        $content = $_POST['content'];
                        $user_by = $getUserData['user_id'];

                        $checkUser = mysqli_query($connect, "SELECT * FROM accounts WHERE email='$user_to' and user_id !='$user_by'");
                        $count_checkUser = mysqli_num_rows($checkUser);
                        $getToUser = mysqli_fetch_array($checkUser);

                        $getToUserId = $getToUser['user_id'];

                        if ($count_checkUser < 1) {
                            alert("to email is not found");
                        } else {
                            $isDraft = 0;
                            if (isset($_POST['save'])) {
                                $isDraft = 1;
                                alert("Saved Draft");
                            }
                            // insert mail into mails table
                            $composeMail = mysqli_query($connect, "INSERT INTO mails (user_to, user_by, subject, content, isDraft) values('$getToUserId', '$user_by', '$subject', '$content', '$isDraft')");

                            if ($composeMail) {
                                // file work
                                if (count($_FILES) > 0) :
                                    $attachment = $_FILES['attachment']['name'];
                                    $tmp_attachment = $_FILES['attachment']['tmp_name'];
                                    move_uploaded_file($tmp_attachment, "attach/$attachment");

                                    $currentMailId = mysqli_insert_id($connect);

                                    $queryForInsertAttach = mysqli_query($connect, "INSERT INTO attachments (attachment, mail_id) values ('$attachment','$currentMailId')");
                                endif;
                                alert("Mail send");
                                redirect("inbox.php");
                            } else {
                                alert("Mail not send");
                                redirect("inbox.php");
                            }
                        }
                    }

                    ?>
                </div>

            </div>
        </div>
</body>

</html>