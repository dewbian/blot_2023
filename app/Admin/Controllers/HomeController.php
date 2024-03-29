<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('') 
            ->row(Dashboard::title())
            ->row(function (Row $row) { 
                $row->column(6, function (Column $column) {
                    $column->append(Dashboard::latestContent());
                });

                $row->column(6, function (Column $column) {
                    $column->append(Dashboard::latestRequest());
                }); 
            });
    }
}
