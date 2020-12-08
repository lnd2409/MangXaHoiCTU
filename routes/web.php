<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('form_login');
});

// Route::redirect('/', '/there');
Route::get('/dang-nhap', 'LoginController@form_login')->name('form_login');
Route::post('/xac-thuc', 'LoginController@login')->name('login');
Route::get('/dang-xuat', 'LoginController@logout')->name('logout');

Route::group(['middleware' => ['checkLogin']], function () {
    // forum
    Route::group(['prefix' => 'hoc-tap'], function () {

        Route::get('/', 'ForumController@index')->name('forum');
        Route::get('/bai-viet/{slug}', 'ForumController@show')->name('forum.show');
        Route::get('/them-cau-hoi', 'QuestionController@create')->name('question.create');
        Route::post('/them-cau-hoi', 'QuestionController@store')->name('question.store');
        // tìm kiếm
        Route::get('/tim-kiem', 'ForumController@search')->name('forum.search');
        Route::get('/xoa-cau-hoi/{id}', 'QuestionController@destroy')->name('question.delete');
        // bình luận
        Route::post('/bai-viet/binh-luan', 'CommentController@store')->name('comment.store');
        Route::post('/bai-viet/binh-luan/tra-loi/', 'CommentController@repcomment')->name('repcomment.store');
        Route::post('/bai-viet/binh-luan/xoa/', 'CommentController@destroycmt')->name('comment.destroy');
        Route::post('/bai-viet/binh-luan/thich', 'CommentController@Ajaxlike')->name('comment.like');
        Route::post('/bai-viet/binh-luan/sua/{id}', 'CommentController@getcomment')->name('comment.update');






        // báo cáo
        Route::post('/bai-viet/bao-cao', 'ReportController@reportComment')->name('report.store');

    });
    Route::group(['prefix' => 'chia-se'], function () {
        Route::get('/', 'ShareController@select')->name('share');
        Route::get('/bai-viet/{slug}', 'ShareController@show')->name('share.show');
        Route::get('/bai-viet/xoa/{id}', 'ShareController@destroy')->name('share.delete');
        Route::get('/them-bai-viet', 'ShareController@create')->name('share.create');
        Route::post('/them-bai-viet', 'ShareController@store')->name('share.store');
        Route::post('/bao-cao', 'ReportController@reportItem')->name('share.report');
        // tìm kiếm
        Route::get('/tim-kiem', 'ShareController@search')->name('share.search');
        //bình luận
        Route::post('/binh-luan', 'ShareController@comment')->name('share.comment.store');
        Route::post('/tra-loi-binh-luan', 'ShareController@repcomment')->name('share.comment.store.rep');
        Route::post('/xoa-binh-luan', 'ShareController@destroycomment')->name('share.comment.destroy');

        // Route::get('/danh-sach/{slug}', 'ShareController@list')->name('share.list');
        Route::get('/{type}', 'ShareController@index')->name('share.type');

    });



    #Quản trị viên
    Route::group(['middleware' => ['checkAdmin']], function () {
        Route::group(['prefix' => 'quan-tri'], function () {

            Route::group(['prefix' => 'cau-lac-bo'], function () {
                Route::get('/danh-sach', 'ClubController@admin')->name('club.admin');
                Route::post('/tao-cau-lac-bo', 'ClubController@adminCreate')->name('club.admin.create');
                Route::post('/cap-nhat', 'ClubController@adminUpdate')->name('club.admin.adminUpdate');
                Route::post('/xoa/{id}', 'ClubController@adminDelete')->name('club.admin.adminDelete');
            });
            #Chia sẽ đồng dùng
            Route::group(['prefix' => 'chia-se-do-dung'], function () {
                Route::get('/danh-sach', 'QuanTri\ShareItemController@getItems')->name('quan-tri.chia-se-do-dung');
                Route::post('/danh-sach/them', 'QuanTri\ShareItemController@ItemStore')->name('quan-tri.chia-se-do-dung.luu');
                Route::post('/danh-sach/get', 'QuanTri\ShareItemController@getAjax')->name('quan-tri.chia-se-do-dung.ajax');
                Route::post('/danh-sach/update', 'QuanTri\ShareItemController@itemUpdate')->name('quan-tri.chia-se-do-dung.update');
                Route::get('/danh-sach/delete/{id}', 'QuanTri\ShareItemController@itemDelete')->name('quan-tri.chia-se-do-dung.delete');
                Route::get('/bai-viet/chua-duyet', 'QuanTri\ShareItemController@getItemsNotAcp')->name('quan-tri.do-dung-chua-duyet');
                Route::get('/bai-viet/{action}/{idItem}', 'QuanTri\ShareItemController@actionItem')->name('quan-tri.duyet-chia-se');
                Route::get('/bai-viet/danh-sach', 'QuanTri\ShareItemController@getAllItems')->name('quan-tri.danh-sach-chia-se');
            });
        });


    });

    Route::group(['prefix' => 'cau-lac-bo'], function () {
        Route::get('/', 'ClubController@index')->name('club');
        Route::get('/bai-viet-rieng/{slug}', 'ClubController@clubPostSlug')->name('club.clubPostSlug');
         // tìm kiếm
        Route::get('/tim-kiem', 'ClubController@search')->name('club.search');


        Route::group(['middleware' => ['checkManage']], function () {

            Route::get('/{slug}/danh-sach-thanh-vien', 'ClubController@listMember')->name('club.listMember');
            Route::get('/{slug}/danh-sach-yeu-cau', 'ClubController@listRequest')->name('club.listRequest');
            Route::post('/{slug}/duyet-thanh-vien/', 'ClubController@accept')->name('club.accept');
            Route::post('/{slug}/huy-thanh-vien/', 'ClubController@denied')->name('club.denied');
            Route::post('/{slug}/xoa-thanh-vien/', 'ClubController@delete')->name('club.delete');
            Route::post('/{slug}/thay-doi-chuc-vu/', 'ClubController@changeRole')->name('club.changeRole');

        });




        Route::get('/xoa-cau-hoi/{id}', 'ClubController@destroy')->name('club.delete');
            //bình luận
            Route::post('/binh-luan', 'ClubController@comment')->name('club.comment.store');
            Route::post('/tra-loi-binh-luan', 'ClubController@commentrep')->name('club.comment.rep');


        //Route::get('/bai-viet/{slug}/', 'ClubController@show')->name('club.show');
        Route::group(['middleware' => ['checkMemberClub']], function () {

            Route::get('/bai-viet/{slug}', 'ClubController@show')->name('club.show');
        });




        Route::get('/them-bai-viet', 'ClubController@create')->name('club.create');
        Route::post('/them-bai-viet', 'ClubController@store')->name('club.store');

        //tham gia câu lạc bộ
        Route::get('/tham-gia/{slug}', 'ClubController@join')->name('club.join');
        Route::get('/danh-sach','ClubController@list' )->name('club.list');
    });


    #Đoàn hội
    Route::group(['prefix' => 'doan-hoi'], function () {
        Route::get('/', 'UnionController@index')->name('union');
        Route::get('/bai-viet/{slug}', 'UnionController@show')->name('union.show');
        Route::get('/them-bai-viet', 'UnionController@create')->name('union.create');
        Route::post('/them-bai-viet', 'UnionController@store')->name('union.store');
        Route::get('/xoa-bai-viet/{id}', 'UnionController@destroy')->name('union.delete');

        //Xem danh sách thành viên
        Route::get('/danh-sach-than-vien/{slug}', 'UnionController@ListMember')->name('union-list-member');


        //bình luận
        Route::post('/binh-luan', 'UnionController@comment')->name('union.comment.store');
        Route::post('/tra-loi-binh-luan', 'UnionController@commentrep')->name('union.comment.rep');

    });




    #môn học
    Route::group(['prefix' => 'mon-hoc'], function () {
        Route::get('/{slug}', 'SubjectController@show')->name('subject.detail');
    });

    //Xem tai lieu sinh vien khac
    Route::get('tai-lieu/{codeStudent}','DocumentShareController@getDocument')->name('tai-lieu.sinhvien');



    //Tài liệu để chung với cái group này luôn
    Route::group(['prefix' => 'tai-khoan'], function () {

        //danh sách học phần
        Route::get('/hoc-phan-da-hoc', 'AccountController@studied')->name('account.studied');
        Route::get('tai-lieu/chon-hoc-ky','DocumentShareController@getHocKy')->name('chon-hoc-ky');
        Route::get('tai-lieu','DocumentShareController@index')->name('tai-lieu');
        Route::get('tai-lieu/tao-thu-muc/{ten_mon_hoc}/{id_mon_hoc}','DocumentShareController@createNewFolderSubjects')->name('tao-thu-muc-mon-hoc');

        #xem của người khác
        Route::get('tai-lieu/thu-muc/{nkSelected}/{hkSelected}/{nameFolder}/{idStudent}', 'DocumentShareController@folderDetailForUser')->name('chi-tiet-thu-muc-hoc-sinh');
        //up bài nè
        Route::get('tai-lieu-1', function () {
            return view('client.pages.docs-share.index-2');
        });

        Route::get('tai-lieu/thu-muc/{nkSelected}/{hkSelected}/{nameFolder}','DocumentShareController@folderDetail')->name('chi-tiet-thu-muc');

        Route::post('tai-lieu/thu-muc/tao-thu-muc-con', 'DocumentShareController@createNewFolderChild')->name('tao-thu-muc-con');
        Route::post('tai-lieu/file/upload-file', 'DocumentShareController@uploadDocuments')->name('upload-file');

        //Thay đổi trạng thái thư mục
        Route::get('tai-lieu/thu-muc/thay-doi-trang-thai/{id}','DocumentShareController@changePermission')->name('thay-doi-trang-thai');
        //Xoa thu muc
        Route::get('tai-lieu/thu-muc/xoa-thu-muc/{id}', 'DocumentShareController@deleteFolder')->name('xoa-thu-muc');

        #tìm kiếm tài liệu môn học
        Route::get('tai-lieu/tim-kiem','DocumentShareController@findDocument')->name('tai-lieu.tim-kiem');
    });
    //lấy ra user hiện tại
    Route::get('current-user', 'UserController@currentUser');

    //form chat
    Route::get('chat', 'ChatController@chatRoom')->name('chat');
    Route::get('chat-person/{mssv}', 'ChatController@chatPerson')->name('chat-person');
    Route::get('chat-person-all/{mssv}', 'ChatController@chat')->name('chat-all');
});
Route::get('/x', function () {
    $user=Auth::user();
    // Notification::send($user, new App\Notifications\InvoicePaid());
    $user->notify(new App\Notifications\InvoicePaid());
});

// Route::get('/tong-luot-thich/{id}', 'StatisticController@getLike');
Route::get('/chon-hoc-ky', 'StatisticController@choiceSemester');
Route::get('/danh-sach-luot-thich', 'StatisticController@getAllLike')->name('listLike');
Route::get('/tong-luot-thich', 'StatisticController@getLikeSingleUser')->name('getLike');

// Trang thông tin cá nhân
Route::get('/thong-tin/{slug}', 'AccountController@Info')->name('Info');

Route::get('/nam-hoc-hien-tai', 'ApiController@SemesterYear')->name('SemesterYear');
Route::get('/bai-viet-da-dang', 'ApiController@Posted')->name('Posted');
Route::get('/da-like', 'ApiController@Liked')->name('Liked');
Route::get('/cau-lac-bo-da-tham-gia', 'ApiController@JoinedClub')->name('JoinedClub');
Route::get('/vat-dung-da-chia-se', 'ApiController@ShareItem')->name('ShareItem');
Route::get('/bai-da-dang', 'ApiController@PostForum')->name('PostForum');

Route::view('/404', '404')->name('404');
