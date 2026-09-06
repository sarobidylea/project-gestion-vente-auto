@extends('layouts.app')

@section('title', 'Modifier la marque')

@section('styles')
<style>
    .form-page {
        max-width: 900px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-header h1 {
        color: #fff;
        font-size: 32px;
        font-weight: 800;
        margin: 0;
    }

    .page-header p {
        color: #777;
        margin-top: 8px;
    }

    .form-card {
        background: #0d0d0d;
        border: 1px solid #222;
        border-radius: 14px;
        padding: 35px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        color: #ddd;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .required {
        color: #e50914;
    }

    .form-control {
        width: 100%;
        box-sizing: border-box;
        padding: 13px 15px;
        background: #080808;
        border: 1px solid #292929;
        border-radius: 8px;
        color: #fff;
        outline: none;
        font-size: 14px;
        transition: .3s;
    }

    .form-control:focus {
        border-color: #e50914;
        box-shadow: 0 0 0 3px rgba(229, 9, 20, .08);
    }

    textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }

    .file-input {
        padding: 11px;
    }

    .form-help {
        color: #666;
        font-size: 12px;
        margin-top: 7px;
    }

    .error {
        color: #ff626a;
        font-size: 12px;
        margin-top: 6px;
    }

    /* Logo actuel */

    .current-logo {
        margin-bottom: 15px;
    }

    .current-logo p {
        color: #777;
        font-size: 12px;
        margin-bottom: 10px;
    }

    .current-logo img {
        width: 100px;
        height: 100px;
        object-fit: contain;
        background: #080808;
        border: 1px solid #292929;
        border-radius: 10px;
        padding: 10px;
    }

    /* Actions */

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 25px;
        border-top: 1px solid #222;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 13px 22px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: .3s;
    }

    .btn-back {
        background: #181818;
        color: #bbb;
    }

    .btn-back:hover {
        background: #242424;
        color: #fff;
    }

    .btn-save {
        background: #e50914;
        color: #fff;
    }

    .btn-save:hover {
        background: #ff1a25;
        transform: translateY(-2px);
    }

    @media (max-width: 700px) {
        .form-card {
            padding: 22px;
        }

        .form-actions {
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')

<div class="form-page">

    <div class="page-header">
        <h1>Modifier la marque</h1>

        <p>
            Modification de :
            <strong style="color:#fff;">
                {{ $marque->nom }}
            </strong>
        </p>
    </div>

    <div class="form-card">

        <form
            action="{{ route('marques.update', $marque) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            {{-- Nom --}}
            <div class="form-group">

                <label class="form-label">
                    Nom de la marque
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="nom"
                    class="form-control"
                    value="{{ old('nom', $marque->nom) }}"
                    required
                >

                @error('nom')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- Logo actuel --}}
            @if($marque->logo)

                <div class="current-logo">

                    <p>Logo actuel</p>

                    <img
                        src="{{ asset('storage/' . $marque->logo) }}"
                        alt="{{ $marque->nom }}"
                    >

                </div>

            @endif

            {{-- Nouveau logo --}}
            <div class="form-group">

                <label class="form-label">
                    Nouveau logo
                </label>

                <input
                    type="file"
                    name="logo"
                    class="form-control file-input"
                    accept="image/jpeg,image/png,image/jpg,image/webp"
                >

                <div class="form-help">
                    Laissez vide si vous souhaitez conserver le logo actuel.
                    Formats : JPG, JPEG, PNG, WEBP — maximum 5 Mo.
                </div>

                @error('logo')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- Description --}}
            <div class="form-group">

                <label class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    class="form-control"
                    placeholder="Description de la marque..."
                >{{ old('description', $marque->description) }}</textarea>

                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- Actions --}}
            <div class="form-actions">

                <a
                    href="{{ route('marques.index') }}"
                    class="btn btn-back"
                >
                    ← Retour
                </a>

                <button
                    type="submit"
                    class="btn btn-save"
                >
                    ✓ Enregistrer les modifications
                </button>

            </div>

        </form>

    </div>

</div>

@endsection