<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\PublikasiStatus;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaRequest;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public $mainMenu    = "Publikasi";
    public $subMenu     = "Agenda";

    public function index(Request $request): View
    {
        $agenda = Agenda::orderBy('id');
        $this->applyFilters($agenda, $request);

        $additionalData = [
            'agenda' => $agenda->paginate(25),
            'penanggungJawab' => User::where('role_id', '!=', Role::Admin)->get(),
        ];

        return $this->createView('List', 'dashboard.publikasi.agenda.index', $additionalData);
    }

    public function create(): View
    {
        $additionalData = [
            'penanggungJawab' => User::where('role_id', '!=', Role::Admin)->get(),
        ];

        return $this->createView('Tambah', 'dashboard.publikasi.agenda.form', $additionalData);
    }

    public function store(AgendaRequest $request)
    {
        try {
            $data = $request->validated();

            if (isset($data['is_published']) && $data['is_published'] == "on") {
                $data['is_published'] = PublikasiStatus::Published;
            } else {
                $data['is_published'] = PublikasiStatus::Unpublished;
            }

            $agenda = new Agenda($data);
            $agenda->time = $data['time_1'] .' - '. $data['time_2'];
            $agenda->published_at = $data['published_at_submit'];
            $agenda->save();

            return redirect()->route('dashboard-publikasi-agenda')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data agenda berhasil disimpan.'],
                ]);
        } catch (\Exception $e) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Validasi Gagal!',
                    'alert_icon' => 'mdi-alert',
                    'alert_messages' => [$e],
                ]);
        }
    }

    public function edit($id): View
    {
        $agenda = Agenda::findOrfail($id);
        $agenda->time = explode(' - ', $agenda->time);
        $additionalData = [
            'agenda' => $agenda,
            'penanggungJawab' => User::where('role_id', '!=', Role::Admin)->get(),
        ];

        return $this->createView('Edit', 'dashboard.publikasi.agenda.form', $additionalData);
    }

    public function update(AgendaRequest $request, $id)
    {
        try {
            $agenda = Agenda::findOrfail($id);

            $data = $request->validated();
            $data['published_at'] = $data['published_at_submit'];

            if (isset($data['is_published']) && $data['is_published'] == "on") {
                $data['is_published'] = PublikasiStatus::Published;
            } else {
                $data['is_published'] = PublikasiStatus::Unpublished;
            }

            $agenda->time = $data['time_1'] .' - '. $data['time_2'];
            $agenda->update($data);

            return redirect()->route('dashboard-publikasi-agenda')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data agenda berhasil diperbaharui.'],
                ]);
        } catch (\Exception $e) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Validasi Gagal!',
                    'alert_icon' => 'mdi-alert',
                    'alert_messages' => [$e],
                ]);
        }
    }

    public function delete($id)
    {
        try {
            $agenda = Agenda::findOrFail($id);
            $agenda->delete();
            return redirect()->route('dashboard-publikasi-agenda')
                ->with([
                    'alert_type' => 'success',
                    'alert_title' => 'Berhasil!',
                    'alert_icon' => 'mdi-check-circle-outline',
                    'alert_messages' => ['Data agenda berhasil dihapus.'],
                ]);
        } catch (\Exception $e) {
            return back()
                ->with([
                    'alert_type' => 'danger',
                    'alert_title' => 'Gagal!',
                    'alert_icon' => 'mdi-alert',
                    'alert_messages' => [$e],
                ]);
        }
    }

    private function createView(string $detailMenu, string $viewPath, array $additionalData = []): View
    {
        $view = array_merge([
            'mainMenu' => $this->mainMenu,
            'subMenu' => $this->subMenu,
            'detailMenu' => $detailMenu,
        ], $additionalData);

        return view($viewPath)->with($view);
    }

    private function applyFilters($query, Request $request): void
    {
        $searchQuery = $request->query('search');
        $statusQuery = $request->query('status');

        if ($searchQuery) {
            $query->search($searchQuery);
        }

        if (!is_null($statusQuery)) {
            $query->status($statusQuery);
        }
    }
}
