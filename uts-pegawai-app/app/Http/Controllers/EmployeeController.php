<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    // READ + SEARCH
    public function index(Request $request)
    {
        $search = $request->input('search');

        $employees = Employee::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nip', 'like', "%{$search}%")
                      ->orWhere('nama', 'like', "%{$search}%")
                      ->orWhere('jabatan', 'like', "%{$search}%")
                      ->orWhere('departemen', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return Inertia::render('Employees/Index', [
            'employees' => $employees,
            'filters'   => ['search' => $search],
        ]);
    }

    // CREATE (form)
    public function create()
    {
        return Inertia::render('Employees/Create');
    }

    // CREATE (simpan)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip'        => 'required|string|max:50|unique:employees,nip',
            'nama'       => 'required|string|max:150',
            'jabatan'    => 'required|string|max:100',
            'departemen' => 'required|string|max:100',
            'gaji'       => 'required|integer|min:0',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    // UPDATE (form)
    public function edit(Employee $employee)
    {
        return Inertia::render('Employees/Edit', [
            'employee' => $employee,
        ]);
    }

    // UPDATE (simpan)
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'nip'        => 'required|string|max:50|unique:employees,nip,' . $employee->id,
            'nama'       => 'required|string|max:150',
            'jabatan'    => 'required|string|max:100',
            'departemen' => 'required|string|max:100',
            'gaji'       => 'required|integer|min:0',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }
}