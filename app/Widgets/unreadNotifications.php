<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use Illuminate\Support\Facades\Auth;

class unreadNotifications extends AbstractWidget
{
    public $reloadTimeout = 2;
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        $count = Auth::user()->unreadNotifications->count();

        //dd($count);
        return view('widgets.unread_notifications', [
            'count' => $count,
        ]);
    }
}
