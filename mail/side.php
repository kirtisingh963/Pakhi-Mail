<div class="col-span-1 bg-white p-6 rounded-lg shadow">

    <a href="compose.php" class="bg-gray-200 hover:bg-gray-300 rounded-md p-2 font-semibold "><span class="mr-2"><i class="fa fa-plus"></i></span>Compose Mail</a>

    <!-- Sidebar Links -->
    <ul class="space-y-2 mt-6">
        <li>
            <a href="inbox.php" class="flex items-center space-x-2 text-gray-800 hover:text-blue-500">
                <span class="text-lg"><i class="fa-solid fa-inbox"></i></span>
                <span>Inbox (
                    <?php
                    echo $coountingInbox = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mails JOIN accounts ON mails.user_by = accounts.user_id WHERE user_to='$myUserId' AND isDraft='0'"));
                    ?>
                    )
                </span>
            </a>
        </li>
        <li>
            <a href="outbox.php" class="flex items-center space-x-2 text-gray-800 hover:text-blue-500">
                <span class="text-lg"><i class="fa-solid fa-inbox"></i></span>
                <span>Outbox (
                    <?php
                    echo $coountingOutbox = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mails JOIN accounts ON mails.user_to = accounts.user_id WHERE user_by='$myUserId' AND isDraft='0'"));
                    ?>
                    )
                </span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-2 text-gray-600 hover:text-blue-500">
                <span class="text-lg"><i class="far fa-star"></i></span>
                <span>Starred</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-2 text-gray-600 hover:text-blue-500">
                <span class="text-lg"><i class="far fa-paper-plane"></i></span>
                <span>Sent</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-2 text-gray-600 hover:text-blue-500">
                <span class="text-lg"><i class="fa-solid fa-circle-exclamation"></i></span>
                <span>Spam</span>
            </a>
        </li>
        <li>
            <a href="draft.php" class="flex items-center space-x-2 text-gray-600 hover:text-blue-500">
                <span class="text-lg"><i class="fa-regular fa-clipboard"></i></span>
                <span>Draft (
                    <?php
                    echo $coountingDraft = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mails JOIN accounts ON mails.user_to = accounts.user_id WHERE user_by='$myUserId' AND isDraft='1'"));
                    ?>
                    )
                </span>
            </a>
        </li>
        <!-- Add more sidebar links as needed -->
    </ul>
</div>