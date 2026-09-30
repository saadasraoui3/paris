<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index() {
        return view('admin.colors.index', ['colors'=>Color::OrderBy('created_at', 'desc')->paginate(10)]);
    }

    public function create() {
        return view('admin.colors.create');
    }

    public function store(Request $r) {
        Color::create($r->all());
        return redirect()->route('admin.colors.index');
    }

    public function edit(Color $color) {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(Request $r, Color $color) {
        $color->update($r->all());
        return redirect()->route('admin.colors.index');
    }

    public function destroy(Color $color) {
        $color->delete();
        return back();
    }
}
