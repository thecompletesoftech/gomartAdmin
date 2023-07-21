<?php

use App\Services\ManagerLanguageService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

$mls = new ManagerLanguageService('lang_breadcrumbs');
// Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
//     $trail->push('Dashboard', route('home.index'));
// });

// Breadcrumbs::for('subcategories', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('SubCategories', route('sub_categories.index'));
// });

/*------------- Admin Dashboard (Admin Home) -------------*/
// Home
Breadcrumbs::for('admin.dashboard', function ($trail) use ($mls) {
    $trail->push($mls->messageLanguage('only_name', 'dashboard', 2), route('admin.dashboard'));
});

Breadcrumbs::for("admin.profile", function ($trail) use ($mls) {
    $trail->parent("admin.dashboard");
    $trail->push($mls->messageLanguage('only_name', 'profile', 2), route("admin.profile"));
});
Breadcrumbs::for("admin.change-password", function ($trail) use ($mls) {
    $trail->parent("admin.dashboard");
    $trail->push($mls->messageLanguage('only_name', 'change_password', 2), route("admin.change_password"));
});

// general Settings
Breadcrumbs::for('admin.settings.edit_general', function ($trail) {
    $trail->parent("admin.dashboard");
    $trail->push('Settings - General', route("admin.settings.edit_general"));
});

Breadcrumbs::macro('resource', function ($name, $title, $list = false) {
    // Home > $title
    Breadcrumbs::for("admin.$name.index", function ($trail) use ($name, $title) {
        $trail->parent("admin.dashboard");
        $trail->push($title, route("admin.$name.index"));
    });



    // Home > $title > Add New
    Breadcrumbs::for("admin.$name.create", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Add New $title", route("admin.$name.create"));
    });
// My Changes
      Breadcrumbs::for("admin.$name.excel", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Add New $title", route("admin.$name.excel"));
    });
//      
    // Home > $title > Edit
    Breadcrumbs::for("admin.$name.edit", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Edit $title", url("admin/$name/{id}/edit"));
    });
    // Home > $title > Details
    Breadcrumbs::for("admin.$name.show", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push(" Details", url("admin/$name/{id}"));
    });
    Breadcrumbs::for("admin.$name.rating", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push(" Details", url("admin/$name/{id}"));
    });
     Breadcrumbs::for("admin.$name.win", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push(" Details", url("admin/$name/{id}"));
    });
    if ($list == true) {
        Breadcrumbs::for("admin.$name.list", function ($trail) use ($name, $title) {
            $trail->parent("admin.dashboard");
            $trail->push($title, route("admin.$name.list"));
        });
    }
});

/*------------- Admin Users ------------------------*/
Breadcrumbs::resource('users', $mls->messageLanguage('only_name', 'user', 2));
/*------------- Admin Roles ------------------------*/
Breadcrumbs::resource('roles', $mls->messageLanguage('only_name', 'role', 2));
/*------------- Admin Permissions ------------------------*/
Breadcrumbs::resource('permissions', $mls->messageLanguage('only_name', 'permission', 2));
/*------------- Admin Category ------------------------*/
Breadcrumbs::resource('categorys', $mls->messageLanguage('only_name', 'category', 2));
/*------------- Admin Item ------------------------*/
Breadcrumbs::resource('items', $mls->messageLanguage('only_name', 'item', 2));
/*------------- Admin Banner ------------------------*/
Breadcrumbs::resource('banners', $mls->messageLanguage('only_name', 'banner', 2));
/*------------- Admin Notification ------------------------*/
Breadcrumbs::resource('notifications', $mls->messageLanguage('only_name', 'notification', 2));
/*------------- Admin Order ------------------------*/
Breadcrumbs::resource('orders', $mls->messageLanguage('only_name', 'order', 2));