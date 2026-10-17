<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Setup Wizard Routes (Auto-Purged After Installation)
|--------------------------------------------------------------------------
*/
if (file_exists(base_path('routes/setup.php')) && file_exists(app_path('Http/Controllers/SetupController.php'))) {
    require base_path('routes/setup.php');
} else {
    Route::any('/setup/{any?}', function () {
        return redirect()->route('login');
    })->where('any', '.*');
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Website
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home-insurance', [AdminController::class, 'showHomeInsurance'])->name('home-insurance');
Route::get('/auto-insurance', [AdminController::class, 'showAutoInsurance'])->name('auto-insurance');
Route::get('/commercial-auto-insurance', [AdminController::class, 'showCommercialAutoInsurance'])->name('commercial-auto-insurance');
Route::get('/surety-bond', [AdminController::class, 'showSuretyBond'])->name('surety-bond');
Route::get('/life-insurance', [AdminController::class, 'showLifeInsurance'])->name('life-insurance');
Route::get('/health-insurance', [AdminController::class, 'showHealthInsurance'])->name('health-insurance');
Route::get('/umbrella-insurance', [AdminController::class, 'showUmbrellaInsurance'])->name('umbrella-insurance');
Route::get('/personal-coverage', [AdminController::class, 'showPersonalCoverage'])->name('personal-coverage');
Route::get('/property-insurance', [AdminController::class, 'showPropertyInsurance'])->name('property-insurance');
Route::get('/liability-insurance', [AdminController::class, 'showLiabilityInsurance'])->name('liability-insurance');
Route::get('/group-benefits', [AdminController::class, 'showGroupBenefits'])->name('group-benefits');
Route::get('/specialty-coverage', [AdminController::class, 'showSpecialtyCoverage'])->name('specialty-coverage');
Route::get('/coverage', [AdminController::class, 'showCoverage'])->name('coverage');
Route::get('/custom-quote', [AdminController::class, 'showCustomQuote'])->name('custom-quote');
Route::get('/compare', [AdminController::class, 'showCompare'])->name('compare');
Route::get('/story', [AdminController::class, 'showStory'])->name('story');
Route::get('/team', [AdminController::class, 'showTeam'])->name('team');
Route::get('/careers', [AdminController::class, 'showCareers'])->name('careers');
Route::get('/community', [AdminController::class, 'showCommunity'])->name('community');
Route::get('/articles', [AdminController::class, 'showArticles'])->name('articles');
Route::get('/faqs', [AdminController::class, 'showFaqs'])->name('faqs');
Route::get('/guides', [AdminController::class, 'showGuides'])->name('guides');
Route::get('/business-insurance', [AdminController::class, 'showBusinessInsurance'])->name('business-insurance');
Route::get('/claims', [AdminController::class, 'showClaims'])->name('claims');
Route::get('/payment', [AdminController::class, 'showPayment'])->name('payment');
Route::get('/contact', [AdminController::class, 'showContact'])->name('contact');

Route::post('/quotes', [AdminController::class, 'storePublicQuote'])->name('quotes.store');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::match(['get', 'post'], '/check-email', [AuthController::class, 'checkEmail'])->name('check-email');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer / Policyholder Portal (Requires Authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/policies', [UserController::class, 'policies'])->name('user.policies');
    Route::get('/dashboard/policies/{id}', [UserController::class, 'policyDetail'])->name('user.policies.show');
    Route::get('/dashboard/policies/{id}/id-card', [UserController::class, 'downloadIdCard'])->name('user.policies.id-card');
    Route::get('/dashboard/quote', [UserController::class, 'quote'])->name('user.quote');
    Route::get('/dashboard/claims', [UserController::class, 'claims'])->name('user.claims');
    Route::get('/dashboard/documents', [UserController::class, 'documents'])->name('user.documents');
    Route::get('/dashboard/payments', [UserController::class, 'payments'])->name('user.payments');
    Route::get('/dashboard/support', [UserController::class, 'support'])->name('user.support');
    Route::get('/dashboard/settings', [UserController::class, 'settings'])->name('user.settings');

    Route::post('/dashboard/claims', [UserController::class, 'submitClaim'])->name('user.claims.store');
    Route::post('/dashboard/quotes', [UserController::class, 'requestQuote'])->name('user.quotes.store');
    Route::post('/dashboard/quote/{id}/accept', [UserController::class, 'acceptQuote'])->name('user.quotes.accept');
    Route::post('/dashboard/documents/certificate', [UserController::class, 'requestCertificate'])->name('user.documents.certificate');
    Route::get('/dashboard/documents/certificate/{id}', [UserController::class, 'viewCertificate'])->name('user.documents.view-certificate');
    Route::post('/dashboard/invoices/{id}/pay', [UserController::class, 'payInvoice'])->name('user.invoices.pay');
    Route::post('/dashboard/support/ticket', [UserController::class, 'submitSupportTicket'])->name('user.support.ticket');
    Route::post('/dashboard/settings/profile', [UserController::class, 'updateProfile'])->name('user.settings.profile');
    Route::post('/dashboard/settings/password', [UserController::class, 'updatePassword'])->name('user.settings.password');
    Route::post('/dashboard/settings/preferences', [UserController::class, 'updatePreferences'])->name('user.settings.preferences');
});

// Agent & Underwriter Admin Portal (Requires Authentication + Admin/Agent Role)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/quotes', [AdminController::class, 'storeQuote'])->name('admin.quotes.store');
    Route::patch('/admin/quotes/{id}/status', [AdminController::class, 'updateQuoteStatus'])->name('admin.quotes.status');
    Route::delete('/admin/quotes/{id}', [AdminController::class, 'deleteQuote'])->name('admin.quotes.delete');
    Route::post('/admin/home-insurance', [AdminController::class, 'updateHomeInsurance'])->name('admin.home-insurance.update');
    Route::post('/admin/auto-insurance', [AdminController::class, 'updateAutoInsurance'])->name('admin.auto-insurance.update');
    Route::post('/admin/commercial-auto-insurance', [AdminController::class, 'updateCommercialAutoInsurance'])->name('admin.commercial-auto-insurance.update');
    Route::post('/admin/surety-bond', [AdminController::class, 'updateSuretyBond'])->name('admin.surety-bond.update');
    Route::post('/admin/life-insurance', [AdminController::class, 'updateLifeInsurance'])->name('admin.life-insurance.update');
    Route::post('/admin/health-insurance', [AdminController::class, 'updateHealthInsurance'])->name('admin.health-insurance.update');
    Route::post('/admin/umbrella-insurance', [AdminController::class, 'updateUmbrellaInsurance'])->name('admin.umbrella-insurance.update');
    Route::post('/admin/personal-coverage', [AdminController::class, 'updatePersonalCoverage'])->name('admin.personal-coverage.update');
    Route::post('/admin/property-insurance', [AdminController::class, 'updatePropertyInsurance'])->name('admin.property-insurance.update');
    Route::post('/admin/liability-insurance', [AdminController::class, 'updateLiabilityInsurance'])->name('admin.liability-insurance.update');
    Route::post('/admin/group-benefits', [AdminController::class, 'updateGroupBenefits'])->name('admin.group-benefits.update');
    Route::post('/admin/specialty-coverage', [AdminController::class, 'updateSpecialtyCoverage'])->name('admin.specialty-coverage.update');
    Route::post('/admin/coverage', [AdminController::class, 'updateCoverage'])->name('admin.coverage.update');
    Route::post('/admin/custom-quote', [AdminController::class, 'updateCustomQuote'])->name('admin.custom-quote.update');
    Route::post('/admin/compare', [AdminController::class, 'updateCompare'])->name('admin.compare.update');
    Route::post('/admin/story', [AdminController::class, 'updateStory'])->name('admin.story.update');
    Route::post('/admin/team', [AdminController::class, 'updateTeam'])->name('admin.team.update');
    Route::post('/admin/careers', [AdminController::class, 'updateCareers'])->name('admin.careers.update');
    Route::post('/admin/community', [AdminController::class, 'updateCommunity'])->name('admin.community.update');
    Route::post('/admin/articles', [AdminController::class, 'updateArticles'])->name('admin.articles.update');
    Route::post('/admin/faqs', [AdminController::class, 'updateFaqs'])->name('admin.faqs.update');
    Route::post('/admin/guides', [AdminController::class, 'updateGuides'])->name('admin.guides.update');
    Route::post('/admin/business-insurance', [AdminController::class, 'updateBusinessInsurance'])->name('admin.business-insurance.update');
    Route::post('/admin/claims', [AdminController::class, 'updateClaims'])->name('admin.claims.update');
    Route::post('/admin/payment', [AdminController::class, 'updatePayment'])->name('admin.payment.update');
    Route::post('/admin/contact', [AdminController::class, 'updateContact'])->name('admin.contact.update');

    // API Integrations (Claims API & US Payments)
    Route::post('/admin/api/claims', [AdminController::class, 'saveClaimsApiConfig'])->name('admin.api.claims.update');
    Route::post('/admin/api/claims/test', [AdminController::class, 'testClaimsApiConnection'])->name('admin.api.claims.test');
    Route::post('/admin/api/payments', [AdminController::class, 'savePaymentApiConfig'])->name('admin.api.payments.update');

    // Marketing, Tracking & Pixels (Google, Meta/FB, LinkedIn, Twitter, TikTok, Social Meta)
    Route::post('/admin/marketing', [AdminController::class, 'saveMarketingSettings'])->name('admin.marketing.update');
    Route::post('/admin/marketing/test', [AdminController::class, 'testMarketingPixel'])->name('admin.marketing.test');

    // Invoices Management System
    Route::post('/admin/invoices', [AdminController::class, 'storeInvoice'])->name('admin.invoices.store');
    Route::get('/admin/invoices/{id}/pdf', [AdminController::class, 'printInvoice'])->name('admin.invoices.pdf');
    Route::get('/admin/invoices/{id}/print', [AdminController::class, 'printInvoice'])->name('admin.invoices.print');
    Route::post('/admin/invoices/{id}/pay', [AdminController::class, 'processInvoicePayment'])->name('admin.invoices.pay');
    Route::patch('/admin/invoices/{id}/status', [AdminController::class, 'updateInvoiceStatus'])->name('admin.invoices.status');
    Route::post('/admin/invoices/agency-signature', [AdminController::class, 'saveAgencySignature'])->name('admin.invoices.agency-signature');
    Route::post('/admin/settings/signature', [AdminController::class, 'saveAgencySignature'])->name('admin.settings.signature');

    // Policy Management System (Full Underwriter Admin Control)
    Route::post('/admin/policies', [AdminController::class, 'storePolicy'])->name('admin.policies.store');
    Route::get('/admin/policies/{id}', [AdminController::class, 'getPolicy'])->name('admin.policies.show');
    Route::put('/admin/policies/{id}', [AdminController::class, 'updatePolicy'])->name('admin.policies.update');
    Route::patch('/admin/policies/{id}/status', [AdminController::class, 'updatePolicyStatus'])->name('admin.policies.status');
    Route::delete('/admin/policies/{id}', [AdminController::class, 'deletePolicy'])->name('admin.policies.delete');

    // Claims Intake & FNOL Management System (Admin Control)
    Route::post('/admin/claims-center', [AdminController::class, 'storeClaimRecord'])->name('admin.claims-center.store');
    Route::get('/admin/claims-center/{id}', [AdminController::class, 'getClaimRecord'])->name('admin.claims-center.show');
    Route::put('/admin/claims-center/{id}', [AdminController::class, 'updateClaimRecord'])->name('admin.claims-center.update');
    Route::patch('/admin/claims-center/{id}/status', [AdminController::class, 'updateClaimRecordStatus'])->name('admin.claims-center.status');
    Route::delete('/admin/claims-center/{id}', [AdminController::class, 'deleteClaimRecord'])->name('admin.claims-center.delete');

    // User & Account Management System
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::patch('/admin/users/{id}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.role');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Customer Support Tickets & Concierge (Admin Control)
    Route::post('/admin/support/content', [AdminController::class, 'updateSupportContent'])->name('admin.support.content.update');
    Route::get('/admin/support-tickets/{id}', [AdminController::class, 'getSupportTicket'])->name('admin.support-tickets.show');
    Route::patch('/admin/support-tickets/{id}/status', [AdminController::class, 'updateSupportTicketStatus'])->name('admin.support-tickets.status');
    Route::delete('/admin/support-tickets/{id}', [AdminController::class, 'deleteSupportTicket'])->name('admin.support-tickets.delete');

    // Live Database Auto-Migration & System Cache Refresh (Admin Control)
    Route::get('/admin/system/migrate', [AdminController::class, 'runLiveMigrations'])->name('admin.system.migrate');
});
