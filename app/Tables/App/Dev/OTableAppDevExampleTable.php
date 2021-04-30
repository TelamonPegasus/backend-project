<?php

namespace App\Tables\App\Dev;

use App\Models\User;
use Illuminate\Support\Str;
use Octo\Resources\Components\quasar\OAppTableQuasar;

class OTableAppDevExampleTable implements OAppTableQuasar
{
    public $name = 'OTableAppDevExampleTable';

    public function repository()
    {
        return User::query()
            ->orderBy('updated_at', 'desc');
    }

    public function route()
    {
        return octo_route('app-dev.table.index');
    }

    public function headers(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Created at'
        ];
    }

    public function row($model)
    {
        return [
            'id' => $model->id,
            'name'=> $model->initials,
            'email'=> Str::lower($model->initials) . '*****@' . Str::of($model->email)->afterLast('@'),
            'created_at' => $model->created_at->diffForhumans()
        ];
    }

    public function actions($model)
    {
        return [
            octo_action('app-dev.table.show', $model->id)->setDisabled(true)->get(),
            octo_action('app-dev.table.edit', $model->id)->setDisabled(true)->get(),
            octo_action('app-dev.table.destroy', $model->id)->setDisabled(true)->get()
        ];
    }
}
