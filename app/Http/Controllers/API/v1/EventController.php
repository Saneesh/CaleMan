<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventListRequest;
use App\Http\Resources\EventResource;
use App\Models\Entities\Event;
use App\Models\Entities\EventDate;
use App\Models\Entities\EventTime;
use App\Models\Entities\User;
use App\Models\Repositories\EventDate\EventDateRepositoryInterface;
use App\Models\Repositories\EventTime\EventTimeRepositoryInterface;
use App\Models\Repositories\User\UserInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $user;
    protected $eventDate;
    protected $eventTime;

    /**
     * Create a new controller instance.
     */
    public function __construct(UserInterface $user, 
        EventDateRepositoryInterface $eventDate,
        EventTimeRepositoryInterface $eventTime
    )
    {
        $this->user = $user;
        $this->eventDate = $eventDate;
        $this->eventTime = $eventTime;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->user->getUserById($request->user_id);

        // Store the event date for the user.
        $eventDate = $this->eventDate->create([
            'user_id' => $user->id,
            'event_date' => $request->event_date
        ]);

        // Store the event time slots for the user for a particular date.
        foreach ($request->slots as $slot) {
            $eventTime = $this->eventTime->create([
                'user_id' => $user->id,
                'event_date_id' => $eventDate->id,
                'slot_start' => $slot['start'],
                'slot_end' => $slot['end']
            ]);    
        }

        return response()->json([
            'message' => 'Successfully created the slots!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(EventListRequest $request)
    {
        $event = $this->eventDate->getEventsByDate([
            'user_id' => $request->user_id,      
            'event_date' => $request->event_date
        ]);

        if(!$event) {
            return response()->json(['error' => 'Invalid user']);
        }

        if($event->eventDates->isEmpty()) {
            return response()->json(['error' => 'No records exists for this event date']);
        }
        
        return new EventResource($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    /**
     * Book an event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function book(Request $request) {
        //return $request->all();

        $bookEvent = $this->eventDate->bookEvent([
            'user_id' => $request->user_id,
            'inviter_id' => $request->inviter_id,
            'event_date' => $request->event_date,
            'slot_start' => $request->slot_start,
            'slot_end' => $request->slot_end
        ]);

        if(!$bookEvent) {
            return response()->json(['error' => 'Cannot book for this event']);
        }

        return response()->json([
            'message' => 'Successfully assigned slots!'
        ]);
    }
}
