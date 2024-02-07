<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Jaringan;
use App\Models\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = [
            'rule'      => new Rule,
            'jaringan'  => new Jaringan,
        ];
    }
    public function showPengaturan(): View
    {
        $data = [
            'title'     => 'Pengaturan Umum',
            'id_page'   => 'pengaturan-index',
            'umum'      => $this->model['rule']->all(),
            'jaringan'  => $this->model['jaringan']->all(),
        ];
        return view('components.dash.pengaturan.index', $data);
    }

    public function handleCreateRule(Request $request): RedirectResponse
    {
        if ($request->has('status')) {
            $this->model['rule']->where('status', 'used')->update([
                'status'    => 'unused'
            ]);
            $status = 'used';
        } else {
            $status = 'unused';
        }

        $this->model['rule']->create([
            'start_masuk'   => $request->input('start_masuk'),
            'end_masuk'   => $request->input('end_masuk'),
            'start_pulang'   => $request->input('start_pulang'),
            'longitude'   => $request->input('longitude'),
            'latitude'   => $request->input('latitude'),
            'status'    => $status,
        ]);

        return back()->with('success', 'Berhasil menambahkan ketentuan umum');
    }

    public function handleUseRule($rule_id): RedirectResponse
    {
        $this->model['rule']->where('status', 'used')->update([
            'status'    => 'unused'
        ]);

        $this->model['rule']->where('status', 'unused')->where('rule_id', $rule_id)->update([
            'status'    => 'used'
        ]);

        return back()->with('info', 'Berhasil menggunakan ketentuan umum yang dipilih');
    }

    public function handleDeleteRule($rule_id): RedirectResponse
    {
        $this->model['rule']->where('rule_id', $rule_id)->delete();

        return back()->with('warning', 'Ketentuan umum telah dihapus');
    }

    public function handleCreateJaringan(Request $request): RedirectResponse
    {
        $this->model['jaringan']->create([
            'nama_jaringan'     => $request->input('nama_jaringan'),
            'ip_address'        => $request->input('ip_address')
        ]);

        return redirect('/pengaturan#jaringan')->with('success', 'Berhasil menambahkan jaringan');
    }

    public function handleDeleteJaringan($jaringan_id): RedirectResponse
    {
        $this->model['jaringan']->where('jaringan_id', $jaringan_id)->delete();

        return redirect('/pengaturan#jaringan')->with('warning', 'Ketentuan jaringan telah dihapus!');
    }
}
