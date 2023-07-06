<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::where('user_id', '=', auth()->user()->id)->get();
        return response()->view('ControlPanel.Note.index', ['notes' => $notes]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('ControlPanel.Note.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|string|min:3',
            'description' => 'string',
        ]);
        if (!$validator->fails()) {
            $note = new Note();
            $note->title = $request->input('title');
            $note->description = $request->input('description');
            $note->user_id = auth()->user()->getAuthIdentifier();
            $isSaved = $note->save();
            return response()->json(
                ['message' => $isSaved ? 'Create Success' :'Create Failed'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                [   'message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return response()->view('ControlPanel.Note.show', [
                'note' => $note,
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return response()->view('ControlPanel.Note.edit', [
            'note' => $note,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|string|min:3',
            'description' => 'string',
        ]);
        if (!$validator->fails()) {
            $note->title = $request->input('title');
            $note->description = $request->input('description');
            $note->user_id = auth()->user()->getAuthIdentifier();
            $isSaved = $note->save();
            return response()->json(
                ['message' => $isSaved ? 'update success' : 'update failed'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $deleted = $note->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );


}
}
