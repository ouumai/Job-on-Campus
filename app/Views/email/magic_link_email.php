<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job on Campus System</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Inter', Helvetica, Arial, sans-serif; background-color: #f4f7f9;">
    <?php
        $currentLang = session()->get('lang') ?? 'ms';
        $isMs = $currentLang === 'ms';
        $activityTitle = $isMs ? 'Pautan Tetapan Semula Kata Laluan' : 'Password Reset Link';
        $description = $isMs
            ? 'Klik butang di bawah untuk log masuk ke dalam akaun anda secara automatik:'
            : 'Click the button below to sign in to your account automatically:';
        $buttonLabel = $isMs ? 'Log Masuk Sekarang' : 'Log In Now';
        $warning = $isMs
            ? 'Pautan ini sah untuk 5 minit sahaja'
            : 'This link is valid for 5 minutes only.';
        $tokenValue = isset($token) ? (string) $token : '';
        $magicLinkUrl = base_url('magic-link') . '?token=' . urlencode($tokenValue);
    ?>
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <tr>
            <td align="center" style="padding: 40px 0 20px 0; background-color: #92C1FF;">
                <h1 style="color: #ffffff; margin: 0; font-size: 28px; letter-spacing: 1px;">Job on Campus System</h1>
            </td>
        </tr>

        <tr>
            <td style="padding: 40px 30px;">
                <h2 style="color: #181c32; margin-bottom: 20px; font-size: 22px; text-align: center;"><?= esc($activityTitle) ?></h2>
                <p style="color: #5e6278; font-size: 16px; line-height: 1.6; text-align: center; margin-bottom: 30px;"><?= esc($description) ?></p>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?= esc($magicLinkUrl) ?>" style="display: inline-block; padding: 12px 24px; background-color: #0095E8; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600;">
                        <?= esc($buttonLabel) ?>
                    </a>
                </div>

                <p style="color: #F1416C; font-size: 13px; line-height: 1.6; text-align: center; font-weight: 500; margin-top: 20px;">
                    <?= esc($warning) ?>
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 30px; background-color: #f9fafb; text-align: center; border-top: 1px solid #eff2f5;">
                <p style="color: #a1a5b7; font-size: 12px; margin: 0;">
                    &copy; <?= date('Y') ?> Pusat Teknologi Digital (DigitalUKM). All rights reserved.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
