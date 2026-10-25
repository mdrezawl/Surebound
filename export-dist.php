<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\ViewErrorBag;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$adminController = app(AdminController::class);
$distDir = __DIR__.'/dist';

function cleanHtml($html)
{
    // Replace localhost, 127.0.0.1 and port numbers with empty string so asset and route URLs become relative
    $html = preg_replace('/https?:\/\/(localhost|127\.0\.0\.1)(:\d+)?/i', '', $html);
    // Remove Laravel Boost browser logger script
    $html = preg_replace('/<script id="browser-logger-active">[\s\S]*?<\/script>/i', '', $html);

    return $html;
}

function savePage($relativePath, $html)
{
    global $distDir;
    $targetPath = $distDir.'/'.ltrim($relativePath, '/');
    $dir = dirname($targetPath);
    if (! is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    file_put_contents($targetPath, cleanHtml($html));
    echo '✓ Exported: '.$relativePath."\n";
}

// 1. Home
$homeHtml = view('home')->render();
savePage('index.html', $homeHtml);

// 2. Home Insurance
$homeInsHtml = $adminController->showHomeInsurance()->render();
savePage('home-insurance/index.html', $homeInsHtml);

// 3. Auto Insurance
$autoInsHtml = $adminController->showAutoInsurance()->render();
savePage('auto-insurance/index.html', $autoInsHtml);

// 4. Personal Coverage
$persHtml = $adminController->showPersonalCoverage()->render();
savePage('personal-coverage/index.html', $persHtml);

// 5. Specialty Coverage
$specHtml = $adminController->showSpecialtyCoverage()->render();
savePage('specialty-coverage/index.html', $specHtml);

// 6. Business Insurance
$bizHtml = $adminController->showBusinessInsurance()->render();
savePage('business-insurance/index.html', $bizHtml);

// 6a. Commercial Auto Insurance
$commAutoHtml = $adminController->showCommercialAutoInsurance()->render();
savePage('commercial-auto-insurance/index.html', $commAutoHtml);

// 6b. Surety Bond
$suretyBondHtml = $adminController->showSuretyBond()->render();
savePage('surety-bond/index.html', $suretyBondHtml);

// 6b. Life Insurance
$lifeHtml = $adminController->showLifeInsurance()->render();
savePage('life-insurance/index.html', $lifeHtml);

// 6c. Health Insurance
$healthHtml = $adminController->showHealthInsurance()->render();
savePage('health-insurance/index.html', $healthHtml);

// 6d. Umbrella Insurance
$umbrellaHtml = $adminController->showUmbrellaInsurance()->render();
savePage('umbrella-insurance/index.html', $umbrellaHtml);

// 6e. Contact Page
$contactHtml = $adminController->showContact()->render();
savePage('contact/index.html', $contactHtml);

// 6f. Privacy Policy
$privacyHtml = $adminController->showPrivacy()->render();
savePage('privacy/index.html', $privacyHtml);

// 6g. Terms of Service
$termsHtml = $adminController->showTerms()->render();
savePage('terms/index.html', $termsHtml);

// 6h. Company & Resource Pages
$storyHtml = $adminController->showStory()->render();
savePage('story/index.html', $storyHtml);

$teamHtml = $adminController->showTeam()->render();
savePage('team/index.html', $teamHtml);

$careersHtml = $adminController->showCareers()->render();
savePage('careers/index.html', $careersHtml);

$communityHtml = $adminController->showCommunity()->render();
savePage('community/index.html', $communityHtml);

$articlesHtml = $adminController->showArticles()->render();
savePage('articles/index.html', $articlesHtml);

$faqsHtml = $adminController->showFaqs()->render();
savePage('faqs/index.html', $faqsHtml);

$guidesHtml = $adminController->showGuides()->render();
savePage('guides/index.html', $guidesHtml);

$claimsHtml = $adminController->showClaims()->render();
savePage('claims/index.html', $claimsHtml);

$paymentHtml = $adminController->showPayment()->render();
savePage('payment/index.html', $paymentHtml);

$coverageHtml = $adminController->showCoverage()->render();
savePage('coverage/index.html', $coverageHtml);

$compareHtml = $adminController->showCompare()->render();
savePage('compare/index.html', $compareHtml);

$customQuoteHtml = $adminController->showCustomQuote()->render();
savePage('custom-quote/index.html', $customQuoteHtml);

$propertyHtml = $adminController->showPropertyInsurance()->render();
savePage('property-insurance/index.html', $propertyHtml);

$liabilityHtml = $adminController->showLiabilityInsurance()->render();
savePage('liability-insurance/index.html', $liabilityHtml);

$groupBenefitsHtml = $adminController->showGroupBenefits()->render();
savePage('group-benefits/index.html', $groupBenefitsHtml);

// 7. Login
$emptyErrors = new ViewErrorBag;
view()->share('errors', $emptyErrors);
$loginHtml = view('auth.login', ['errors' => $emptyErrors])->render();
savePage('login/index.html', $loginHtml);

// 8. Register
$registerHtml = view('auth.register', ['errors' => $emptyErrors])->render();
savePage('register/index.html', $registerHtml);

// 9. User Dashboard
$userController = app(UserController::class);
$userDashboardHtml = $userController->dashboard()->render();
savePage('dashboard/index.html', $userDashboardHtml);

// 10. Admin Dashboard
$adminHtml = $adminController->index()->render();
savePage('admin/index.html', $adminHtml);

// Copy public assets
function copyFolder($src, $dst)
{
    if (! is_dir($src)) {
        return;
    }
    if (! is_dir($dst)) {
        mkdir($dst, 0755, true);
    }
    $files = scandir($src);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        $s = "$src/$file";
        $d = "$dst/$file";
        if (is_dir($s)) {
            copyFolder($s, $d);
        } else {
            copy($s, $d);
        }
    }
}

copyFolder(__DIR__.'/public/css', $distDir.'/css');
copyFolder(__DIR__.'/public/js', $distDir.'/js');
copyFolder(__DIR__.'/public/images', $distDir.'/images');
copyFolder(__DIR__.'/public/fonts', $distDir.'/fonts');
if (file_exists(__DIR__.'/public/favicon.ico')) {
    copy(__DIR__.'/public/favicon.ico', $distDir.'/favicon.ico');
}
if (file_exists(__DIR__.'/public/robots.txt')) {
    copy(__DIR__.'/public/robots.txt', $distDir.'/robots.txt');
}

echo "✓ Full dist export completed successfully!\n";
