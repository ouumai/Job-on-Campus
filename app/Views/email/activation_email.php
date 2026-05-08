<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= lang('Email.activation_title') ?> - JoC System</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Inter', Helvetica, Arial, sans-serif; background-color: #f4f7f9;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <tr>
            <td align="center" style="padding: 40px 0 20px 0; background-color: #92C1FF;">
                <h1 style="color: #ffffff; margin: 0; font-size: 28px; letter-spacing: 1px;">Job on Campus System</h1>
            </td>
        </tr>

        <tr>
            <td style="padding: 40px 30px;">
                <h2 style="color: #181c32; margin-bottom: 20px; font-size: 22px; text-align: center;">
                    <?= lang('Email.activation_title') ?>
                </h2>

                <?php 
                    // Pengecekan selamat untuk username
                    $display_name = 'User';
                    if (isset($user) && is_object($user)) {
                        $display_name = $user->username;
                    } elseif (isset($username)) {
                        $display_name = $username;
                    }
                ?>

                <p style="color: #5e6278; font-size: 16px; line-height: 1.6; text-align: center;">
                    <?= lang('Email.activation_greeting') ?> <strong><?= $display_name ?></strong>,<br>
                    <?= lang('Email.activation_message') ?>
                </p>

                <div style="text-align: center; margin: 40px 0;">
                    <div style="display: inline-block; padding: 15px 40px; background-color: #f1faff; border: 2px dashed #63A7FF; border-radius: 8px;">
                        <span style="font-size: 36px; font-weight: bold; color: #0095E8; letter-spacing: 10px;">
                            <?php 
                                // Guna hash jika token tak wujud (Shield hantar $hash atau $token)
                                echo $token ?? $hash ?? '000000'; 
                            ?>
                        </span>
                    </div>
                </div>

                <p style="color: #5e6278; font-size: 14px; line-height: 1.6; text-align: center; margin-bottom: 10px;">
                    <?= lang('Email.activation_expiry') ?>
                </p>

                <p style="color: #F1416C; font-size: 13px; line-height: 1.6; text-align: center; font-weight: 500; margin-top: 0;">
                    <?= lang('Email.activation_ignore') ?>
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 30px; background-color: #f9fafb; text-align: center; border-top: 1px solid #eff2f5;">
                <p style="color: #a1a5b7; font-size: 12px; margin: 0;">
                    &copy; <?= date('Y') ?> Pusat Teknologi Digital (DigitalUKM). All rights reserved.<br>
                    Universiti Kebangsaan Malaysia, 43600 UKM Bangi, Selangor.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>