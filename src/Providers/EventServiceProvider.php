<?php

namespace Webkul\CalendarApp\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen([
            'activitydatagrid.action.before.delete'
        ], function($datagrid) {
                $datagrid->addAction([
                    'title'        => 'Download ICS',
                    'method'       => 'POST',
                    'confirm_text' => false,
                    'route'        => 'admin.activities.download-ics',
                    'icon'         => 'download-icon',
                ]);
            }
        );
    }
}
