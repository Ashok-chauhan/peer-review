<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Registration;

use App\Controllers\Editor\Ediitor;


/**
 * @var RouteCollection $routes
 */

//$routes->get('/', 'Home::index');
$routes->get('/', 'Login::index', ['filter' => 'loggedin']);
$routes->post('/', 'Login::index');
$routes->get('/registration', 'Registration::index', ['filter' => 'loggedin']);
$routes->get('/activate/(:segment)', 'Registration::activate/$1');
$routes->post('/registration', 'Registration::index');
$routes->get('/registration/thankyou', 'Registration::thankyou');

//$routes->get('/login', 'Login::index',['filter'=>'loggedin']);
//$routes->post('/login','Login::index');
$routes->group('user', static function ($routes) {

    $routes->get('resetpass/', 'User\User::resetpass');
    $routes->get('logout/', 'User\User::logout');
    $routes->post('resetpass/', 'User\User::resetpass');
    $routes->get('resetlink/(:segment)/(:segment)', 'User\User::resetlink/$1/$2');
    $routes->post('resetlink/(:segment)/(:segment)', 'User\User::resetlink/$1/$2');
    $routes->get('newpassword/', 'User\User::newpassword');
    $routes->post('newpassword/', 'User\User::newpassword');
    $routes->get('resetfeedback/', 'User\User::resetfeedback');
});
$routes->group('author', static function ($routes) {

    $routes->get('profile', 'Author\Profile::index', ['filter' => 'auth']);
    $routes->get('bellnotification', 'Author\Profile::bellnotification', ['filter' => 'auth']);
    $routes->get('logout', 'Author\Profile::logout');
    $routes->get('submission', 'Author\Submission::index', ['filter' => 'auth']);
    $routes->post('submission', 'Author\Submission::index', ['filter' => 'auth']);
    $routes->get('viewsubmission', 'Author\Submission::listView', ['filter' => 'auth']);
    $routes->get('downloads/(:segment)', 'Author\Submission::downloads', ['filter' => 'auth']);
    $routes->get('revision/(:segment)', 'Author\Submission::revision', ['filter' => 'auth']);
    $routes->get('discussion/(:segment)', 'Author\Submission::discussion', ['filter' => 'auth']);
    $routes->get('reply/(:num)/(:num)', 'Author\Submission::reply/$1/$2', ['filter' => 'auth']);
    $routes->post('reply', 'Author\Submission::reply', ['filter' => 'auth']);
    $routes->post('revision', 'Author\Submission::revision', ['filter' => 'auth']);
    $routes->post('contributor', 'Author\Submission::contributor');
    $routes->get('submissionComplete', 'Author\Submission::submissionComplete');
    $routes->post('deleteCoauthor', 'Author\Submission::deleteCoauthor');
    $routes->post('deleteTempFile', 'Author\Submission::deleteTempFile');
    $routes->post('authorTempUpload/', 'Author\Submission::authorTempUpload');
    $routes->get('detailview/(:segment)', 'Author\Submission::detailview', ['filter' => 'auth']);
    $routes->post('update_bellnotification/', 'Author\Profile::update_bellnotification', ['filter' => 'auth']);

});


$routes->group('editor', static function ($routes) {

    $routes->get('', 'Editor\Editor::index', ['filter' => 'auth']);
    $routes->get('byauthor/(:segment)', 'Editor\Editor::byAuthor', ['filter' => 'auth']);
    $routes->get('downloads/(:segment)', 'Editor\Editor::downloads');
    $routes->get('downloadZip/(:segment)', 'Editor\Editor::downloadZip');
    $routes->get('downloadpeerZip/(:segment)', 'Editor\Editor::downloadpeerZip');

    $routes->get('accepted/(:num)/(:num)', 'Editor\Editor::accepted/$1/$2', ['filter' => 'auth']);
    $routes->get('accepted_copyediting/(:num)/(:num)', 'Editor\Editor::accepted_copyediting/$1/$2', ['filter' => 'auth']);
    $routes->get('accepted_production/(:num)/(:num)', 'Editor\Editor::accepted_production/$1/$2', ['filter' => 'auth']);


    // $routes->post('notify/(:num)/(:num)', 'Editor\Editor::notify/$1/$2', ['filter' => 'auth']);
    $routes->get('bellnotification', 'Editor\Editor::bellnotification', ['filter' => 'auth']);
    $routes->get('notify', 'Editor\Editor::notify', ['filter' => 'auth']);
    $routes->post('notify', 'Editor\Editor::notify', ['filter' => 'auth']);
    $routes->get('getRevisionFile/(:segment)', 'Editor\Editor::getRevisionFile', ['filter' => 'auth']);
    $routes->post('toreview/', 'Editor\Editor::toReview', ['filter' => 'auth']);
    ///
    //# $routes->post('/', 'Editor\Editor::tocopyedit', ['filter' => 'auth']);
    $routes->post('tocopyedit', 'Editor\Editor::tocopyedit', ['filter' => 'auth']);

    //tocopyedit may be tocopyeditnot required
    $routes->post('sendtopeer/', 'Editor\Editor::sendtopeer', ['filter' => 'auth']);
    $routes->post('editorUpload/', 'Editor\Editor::editorUpload');
    $routes->get('deleteEditorUpload/(:num)/(:num)', 'Editor\Editor::deleteEditorUpload/$1/$2', ['filter' => 'auth']);
    $routes->post('peerDiscussion/', 'Editor\Editor::peerDiscussion');
    $routes->post('tocpeditor/', 'Editor\Editor::tocpeditor');
    // $routes->post('tocopyedit/', 'Editor\Editor::tocpeditor');
    $routes->post('toproduction', 'Editor\Editor::toproduction', ['filter' => 'auth']);


    $routes->post('send_to_copyeditor/', 'Editor\Editor::send_to_copyeditor', ['filter' => 'auth']);
    $routes->post('send_to_production/', 'Editor\Editor::send_to_production', ['filter' => 'auth']);


    $routes->post('sendCopyEditor/', 'Editor\Editor::sendCopyEditor', ['filter' => 'auth']);
    $routes->post('copyeditorDiscussion/', 'Editor\Editor::copyeditorDiscussion', ['filter' => 'auth']);
    $routes->get('requestrevision/(:segment)', 'Editor\Editor::requestrevision', ['filter' => 'auth']);
    $routes->post('requestrevision/(:segment)', 'Editor\Editor::requestrevision', ['filter' => 'auth']);
    $routes->get('editorialhistory/(:segment)', 'Editor\Editor::editorialHistory_all', ['filter' => 'auth']);
    $routes->get('production/(:segment)', 'Editor\Editor::production', ['filter' => 'auth']);
    $routes->post('final_email/', 'Editor\Editor::final_email', ['filter' => 'auth']);
    $routes->post('reset_all/', 'Editor\Editor::reset_all', ['filter' => 'auth']);
    $routes->post('update_bellnotification/', 'Editor\Editor::update_bellnotification', ['filter' => 'auth']);





});

$routes->group('admin', static function ($routes) {
    $routes->get('', 'Admin\Admin::index', ['filter' => 'auth']);
    $routes->post('', 'Admin\Admin::index', ['filter' => 'auth']);

    $routes->get('registration/', 'Admin\Admin::registration', ['filter' => 'auth']);
    $routes->post('registration/', 'Admin\Admin::registration', ['filter' => 'auth']);
});

$routes->group('peer', static function ($routes) {
    $routes->get('', 'Peer\Peer::index', ['filter' => 'auth']);
    $routes->post('', 'Peer\Peer::index', ['filter' => 'auth']);
    $routes->get('bellnotification', 'Peer\Peer::bellnotification', ['filter' => 'auth']);
    $routes->get('discussion/(:num)/(:num)', 'Peer\Peer::discussion/$1/$2', ['filter' => 'auth']);
    $routes->post('discussion/(:num)/(:num)', 'Peer\Peer::discussion/$1/$2', ['filter' => 'auth']);
    $routes->post('updateReview', 'Peer\Peer::updateReview');
    $routes->get('accept/(:num)/(:num)', 'Peer\Peer::accept/$1/$2', ['filter' => 'auth']);
    $routes->post('accept', 'Peer\Peer::accept', ['filter' => 'auth']);
    //$routes->get('detailview/(:segment)', 'Peer\Peer::detailview', ['filter' => 'auth']);
    $routes->get('detailview/(:num)/(:num)', 'Peer\Peer::detailview/$1/$2', ['filter' => 'auth']);
    //$routes->post('detailview', 'Peer\Peer::detailview', ['filter' => 'auth']);
    $routes->post('notify', 'Peer\Peer::notify', ['filter' => 'auth']);
    $routes->get('finalupload/(:num)/(:num)', 'Peer\Peer::finalupload/$1/$2', ['filter' => 'auth']);
    // $routes->post('finalupload', 'Peer\Peer::accept', ['filter' => 'auth']);
    $routes->post('update_bellnotification/', 'Peer\Peer::update_bellnotification', ['filter' => 'auth']);

});

$routes->group('editcopy', static function ($routes) {
    $routes->get('', 'Editcopy\Editcopy::index');
    $routes->get('accept/(:num)/(:num)', 'Editcopy\Editcopy::accept/$1/$2', ['filter' => 'auth']);
    $routes->post('accept/', 'Editcopy\Editcopy::accept', ['filter' => 'auth']);
    $routes->get('bellnotification', 'Editcopy\Editcopy::bellnotification', ['filter' => 'auth']);

    $routes->get('discussion/(:num)/(:num)', 'Editcopy\Editcopy::discussion/$1/$2', ['filter' => 'auth']);
    $routes->post('discussion/(:num)/(:num)', 'Editcopy\Editcopy::discussion/$1/$2', ['filter' => 'auth']);
    $routes->get('detailview/(:num)/(:num)', 'Editcopy\Editcopy::detailview/$1/$2', ['filter' => 'auth']);
    $routes->post('update_copyediting/', 'Editcopy\Editcopy::update_copyediting', ['filter' => 'auth']); //not used
    $routes->post('notify', 'Editcopy\Editcopy::notify', ['filter' => 'auth']);
    $routes->get('finalupload/(:num)/(:num)', 'Editcopy\Editcopy::finalupload/$1/$2', ['filter' => 'auth']);
    $routes->post('updateCopyediting/', 'Editcopy\Editcopy::updateCopyediting', ['filter' => 'auth']);
    $routes->post('update_bellnotification/', 'Editcopy\Editcopy::update_bellnotification', ['filter' => 'auth']);



    // $routes->get('test', 'Copyediting\Copyediting::test');
});

$routes->group('production', static function ($routes) {
    $routes->get('', 'Production\Production::index');
    $routes->get('accept/(:num)/(:num)', 'Production\Production::accept/$1/$2', ['filter' => 'auth']);
    $routes->post('accept/', 'Production\Production::accept', ['filter' => 'auth']);
    $routes->get('bellnotification', 'Production\Production::bellnotification', ['filter' => 'auth']);

    $routes->get('discussion/(:num)/(:num)', 'Production\Production::discussion/$1/$2', ['filter' => 'auth']);
    $routes->post('discussion/(:num)/(:num)', 'Production\Production::discussion/$1/$2', ['filter' => 'auth']);
    $routes->get('detailview/(:num)/(:num)', 'Production\Production::detailview/$1/$2', ['filter' => 'auth']);
    $routes->post('update_copyediting/', 'Production\Production::update_copyediting', ['filter' => 'auth']);
    $routes->post('notify', 'Production\Production::notify', ['filter' => 'auth']);
    $routes->get('finalupload/(:num)/(:num)', 'Production\Production::finalupload/$1/$2', ['filter' => 'auth']);
    $routes->post('updateProduction/', 'Production\Production::updateProduction', ['filter' => 'auth']);
    $routes->post('update_bellnotification/', 'Production\Production::update_bellnotification', ['filter' => 'auth']);




});

$routes->group('dash', static function ($routes) {
    $routes->get('', 'Dash\Dash::index', ['filter' => 'auth']);
});

$routes->get('/about', 'Home::about');
