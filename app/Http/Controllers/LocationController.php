<?php
namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        // If using server-side DataTables AJAX, the view will request apiList via JS.
        return view('locations.index');
    }

    public function apiList(Request $request)
    {
        // simple server-side processing for datatables
        $query = Location::query();

        if ($search = $request->get('search')['value'] ?? null) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
        }

        $recordsTotal = $query->count();

        // ordering & pagination
        $start = intval($request->get('start', 0));
        $length = intval($request->get('length', 10));
        $data = $query->skip($start)->take($length)->get();

        return response()->json([
            'draw' => intval($request->get('draw')),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $data->map(function($loc){
                return [
                    $loc->id,
                    $loc->name,
                    $loc->address,
                    $loc->latitude,
                    $loc->longitude,
                    $loc->status,
                    // actions (render from client or pass id)
                ];
            }),
        ]);
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'nullable|in:0,1',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        Location::create($v->validated());
        return redirect()->route('locations.index')->with('success','Location created.');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'nullable|in:0,1',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        $location->update($v->validated());
        return redirect()->route('locations.index')->with('success','Location updated.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success','Location deleted.');
    }

    public function importCsv(Request $request)
    {
        // Expect a file upload field name 'csv'
        $request->validate([
            'csv' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv')->getRealPath();

        $handle = fopen($path, 'r');
        if ($handle === false) {
            return redirect()->back()->withErrors(['csv' => 'Cannot open uploaded CSV.']);
        }

        $inserted = 0;
        $header = null;
        while (($row = fgetcsv($handle)) !== false) {
            if ($header === null) {
                $header = array_map(fn($h) => strtolower(trim($h)), $row);
                continue;
            }
            // Map row to associative array by header
            $record = [];
            foreach ($header as $i => $key) {
                $record[$key] = $row[$i] ?? null;
            }
            $name = $record['name'] ?? $record['title'] ?? null;
            if (!$name) {
                continue;
            }
            Location::create([
                'name' => $name,
                'address' => $record['address'] ?? null,
                'latitude' => $record['latitude'] !== '' ? $record['latitude'] : null,
                'longitude' => $record['longitude'] !== '' ? $record['longitude'] : null,
                'type' => $record['type'] ?? null,
                'status' => isset($record['status']) ? (int)$record['status'] : 1,
            ]);
            $inserted++;
        }
        fclose($handle);

        return redirect()->route('locations.index')->with('success', "Imported {$inserted} locations.");
    }

    public function importDefault()
    {
        $path = storage_path('app/locations.csv');
        if (!file_exists($path)) {
            return redirect()->back()->withErrors(['csv' => 'Default CSV not found at storage/app/locations.csv']);
        }
        $handle = fopen($path, 'r');
        if ($handle === false) {
            return redirect()->back()->withErrors(['csv' => 'Cannot open default CSV file.']);
        }
        $inserted = 0;
        $header = null;
        while (($row = fgetcsv($handle)) !== false) {
            if ($header === null) {
                $header = array_map(fn($h) => strtolower(trim($h)), $row);
                continue;
            }
            $record = [];
            foreach ($header as $i => $key) {
                $record[$key] = $row[$i] ?? null;
            }
            $name = $record['name'] ?? $record['title'] ?? null;
            if (!$name) {
                continue;
            }
            Location::create([
                'name' => $name,
                'address' => $record['address'] ?? null,
                'latitude' => $record['latitude'] !== '' ? $record['latitude'] : null,
                'longitude' => $record['longitude'] !== '' ? $record['longitude'] : null,
                'type' => $record['type'] ?? null,
                'status' => isset($record['status']) ? (int)$record['status'] : 1,
            ]);
            $inserted++;
        }
        fclose($handle);

        return redirect()->route('locations.index')->with('success', "Imported {$inserted} locations from default CSV.");
    }
}
