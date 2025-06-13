<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PositionController extends Controller
{
    public function show($id)
    {
        $position = Position::with(['company'])
            ->findOrFail($id);

        return Inertia::render('PositionDetail', [
            'position' => $position
        ]);
    }
} 