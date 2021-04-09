@php

$params = isset($params) && is_array($params) ? $params : [];
$showHistorial = isset($showHistorial) ? $showHistorial : '';
$showRoute = isset($showRoute) ? $showRoute : '';
$editRoute = isset($editRoute) ? $editRoute : '';
$deleteRoute = isset($deleteRoute) ? $deleteRoute : '';

$skipHistorial = isset($skipHistorial) ? (bool) $skipHistorial : false;
$skipShow = isset($skipShow) ? (bool) $skipShow : false;
$skipEdit = isset($skipEdit) ? (bool) $skipEdit : false;
$skipDelete = isset($skipDelete) ? (bool) $skipDelete : false;

@endphp

@if ($skipHistorial)
    <a href="{{ route($showRoute, $params) }}" class="text-dark mr-2 icons">
        <i class="bi bi-clock-history"></i>
    </a>
@endif

@if ($skipShow)
    <a href="{{ route($showRoute, $params) }}" class="text-primary mr-2 icons">
        <i class="bi bi-eye-fill"></i>
    </a>
@endif

@if ($skipEdit)
    <a href="{{ route($editRoute, $params) }}" class="text-success mr-2 icons">
        <i class="bi bi-pencil-fill"></i>
    </a>
@endif

@if ($skipDelete)
    <a href="{{ route($deleteRoute, $params) }}" class="text-danger mr-2 icons">
        <i class="bi bi-trash"></i>
    </a>
@endif
