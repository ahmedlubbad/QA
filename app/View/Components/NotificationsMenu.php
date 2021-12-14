<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationsMenu extends Component
{

    public $notifications;
    public $unreadCount;
    /* أي var معرف public بنبعت تلقائيا لملف view*/

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->notifications = Auth::user()->notifications()->take(7)->get();
        $this->unreadCount = Auth::user()->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications-menu');/*, ['notifications' => $this->notifications]*/
    }
}
