<?php

namespace App\Http\Livewire\Admin;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Backups extends Component
{
    protected $listeners = ['delete'];

    public function create()
    {
        try {
            /* only database backup*/
            Artisan::call('backup:run --only-db');
            /* all backup */
            /* Artisan::call('backup:run'); */
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- new backup started \r\n" . $output);
            $this->emit('success');

        } catch (Exception $e) {
            $this->emit('error');
        }
    }

    public function download($file_name)
    {
        $fs = Storage::disk('public')->url(config('app.name') . '/' . $file_name);

        return redirect($fs);

        // return redirect('/storage/' . config('app.name') . '/' . $file_name);
    }

    public function delete($file_name)
    {
        // $fs = Storage::disk('public')->url(config('app.name') . '/' . $file_name);
        Storage::delete('/public/' . config('app.name') . '/' . $file_name);
        $this->emit('success');

    }

    public function render()
    {
        $files = Storage::disk('public')->allFiles('clinica');
        $backups = [];
        foreach ($files as $file) {
            if (substr($file, -4) == '.zip') {
                $backups[] = [
                    'file_path' => $file,
                    'file_name' => str_replace('clinica/', '', $file),
                    /* 'file_size' => $file->size($file),
                    'last_modified' => $file->lastModified($file), */
                ];
            }
        }
        $backups = collect(array_reverse($backups));

        return view('livewire.admin.backups', compact('backups'));
    }
}
