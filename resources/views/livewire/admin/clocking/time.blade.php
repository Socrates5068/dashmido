<div>
    <x-jet-validation-errors class="mt-4 mb-4" />
    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-6">
            <label for="regular-form-1" class="form-label">Inicio</label>
            <input wire:model="time.start" type="time" class="form-control" placeholder="Input inline 1"
                aria-label="default input inline 1">
        </div>
        <div class="col-span-6">
            <label for="regular-form-1" class="form-label">Fin</label>
            <input wire:model="time.end" type="time" class="form-control" placeholder="Input inline 2"
                aria-label="default input inline 2">
        </div>
    </div>
    @isset($time['key'])
        <button wire:click="update" class="mt-5 btn btn-warning">Actualizar</button>
        <button wire:click="resetVariables" class="mt-5 btn btn-danger">cancelar</button>
    @else
        <button wire:click="morning({{ $schedule->id }})" class="mt-5 btn btn-primary">Agregar</button>
    @endisset
</div>
