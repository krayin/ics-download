<?php

namespace Webkul\CalendarApp\Http\Controllers\Activity;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Lead\Repositories\ActivityRepository;

class ActivityController extends Controller
{
    /**
     * ActivityRepository object
     *
     * @var \Webkul\Lead\Repositories\ActivityRepository
     */
    protected $activityRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Lead\Repositories\ActivityRepository  $activityRepository
     *
     * @return void
     */
    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function downloadICS()
    {
        $id = request('id');

        $activity = $this->activityRepository
                    ->select('lead_activities.id', 'users.name as organizer_name', 'schedule_from', 'schedule_to', 'comment')
                    ->leftJoin('users', 'lead_activities.user_id', '=', 'users.id')
                    ->where('lead_activities.id', $id)
                    ->first();

        $icsContent =   view('calendarapp::ics.sample-ics', [
                            'summary'       => $activity->comment,
                            'organizerName' => $activity->organizer_name,
                            'scheduleTo'    => (new \DateTime($activity->schedule_to, new \DateTimeZone("UTC")))->format('YdmThisZ'),
                            'scheduleFrom'  => (new \DateTime($activity->schedule_from, new \DateTimeZone("UTC")))->format('YdmThisZ'),
                        ])->render();

        return response()->json([
            'status'        => true,
            'fileContent'   => $icsContent,
            'fileName'      => "meeting_" . $activity->id . ".ics",
            'message'       => trans('calendarapp::app.messages.file_download_success'),
        ], 200);
    }
}