<div class="flex-1 py-5 shadow-lg px-16 flex justify-between bg-white">
    <a href="../index.php" class="text-3xl font-black text-blue-900">PakhiMail</a>

    <div class="flex items-center gap-4">
        <a href="setting.php" class="flex items-center gap-1" title="Profile">
            <!-- User Avatar -->

            <?php if ($getUserData['dp']) : ?>
                <img src="dp/<?= $getUserData['dp']; ?>" alt="User Avatar" class="w-8 h-8 rounded-full">
            <?php else : ?>
                <img src="../Images/user-icon.jpg" alt="User Avatar" class="w-8 h-8 rounded-full">
            <?php endif; ?>


            <span class="text-gray-700 font-semibold capitalize"><?= $getUserData['fname']; ?></span>
        </a>

        <!-- signout button  -->
        <a href="../logout.php" class="text-red-600 hover:text-red-700 font-semibold hover:underline">Sign Out</a>
    </div>
</div>