<?php
require 'public/index.php';
$userModel = model('App\Models\UserModel');
$user = $userModel->first();
if ($user) {
    echo "ID: " . $user->id . "\n";
    echo "Email: " . ($user->email ?? 'NULL') . "\n";
} else {
    echo "No user found.\n";
}
