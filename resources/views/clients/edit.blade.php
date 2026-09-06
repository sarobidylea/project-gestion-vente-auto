@extends('layouts.app')

@section('title', 'Modifier le client')

@section('content')

<style>
    .client-form {
        max-width: 900px;
        margin: 0 auto;
    }

    .form-header {
        margin-bottom: 30px;
    }

    .form-header h1 {
        font-size: 30px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 8px;
    }

    .form-header p {
        color: #888;
        margin: 0;
    }

    .form-card {
        background: #101010;
        border: 1px solid #252525;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 15px 40px rgba(0,0,0,.3);
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #252525;
    }

    .section-title span {
        width: 4px;
        height: 22px;
        background: #e50914;
        border-radius: 4px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 22px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        color: #ddd;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        background: #080808;
        border: 1px solid #2d2d2d;
        border-radius: 10px;
        color: #fff;
        padding: 13px 15px;
        font-size: 14px;
        outline: none;
        transition: .2s;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #e50914;
        box-shadow: 0 0 0 3px rgba(229,9,20,.1);
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .error {
        color: #ff5a62;
        font-size: 12px;
        margin-top: 6px;
    }

    .buttons {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #252525;
    }

    .btn {
        text-decoration: none;
        border: none;
        border-radius: 10px;
        padding: 13px 22px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
    }

    .btn-cancel {
        background: #1d1d1d;
        color: #ccc;
    }

    .btn-cancel:hover {
        background: #292929;
        color: #fff;
    }

    .btn-save {
        background: #e50914;
        color: #fff;
    }

    .btn-save:hover {
        background: #c70711;
        transform: translateY(-1px);
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-card {
            padding: 20px;
        }

        .buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="client-form">

    <div class="form-header">
        <h1>Modifier le client</h1>
        <p>Modifiez les informations de {{ $client->prenom }} {{ $client->nom }}.</p>
    </div>

    <div class="form-card">

        <div class="section-title">
            <span></span>
            Informations du client
        </div>

        <form action="{{ route('clients.update', $client) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">

                {{-- Nom --}}
                <div class="form-group">
                    <label for="nom">Nom *</label>

                    <input
                        type="text"
                        id="nom"
                        name="nom"
                        value="{{ old('nom', $client->nom) }}"
                        placeholder="Ex : Rakoto"
                        required
                    >

                    @error('nom')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Prénom --}}
                <div class="form-group">
                    <label for="prenom">Prénom *</label>

                    <input
                        type="text"
                        id="prenom"
                        name="prenom"
                        value="{{ old('prenom', $client->prenom) }}"
                        placeholder="Ex : Jean"
                        required
                    >

                    @error('prenom')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Adresse e-mail *</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $client->email) }}"
                        placeholder="exemple@gmail.com"
                        required
                    >

                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Téléphone --}}
                <div class="form-group">
                    <label for="telephone">Téléphone *</label>

                    <input
                        type="text"
                        id="telephone"
                        name="telephone"
                        value="{{ old('telephone', $client->telephone) }}"
                        placeholder="Ex : 0341234567"
                        required
                    >

                    @error('telephone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Adresse --}}
                <div class="form-group full">
                    <label for="adresse">Adresse</label>

                    <textarea
                        id="adresse"
                        name="adresse"
                        placeholder="Adresse complète du client..."
                    >{{ old('adresse', $client->adresse) }}</textarea>

                    @error('adresse')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="buttons">

                <a href="{{ route('clients.index') }}" class="btn btn-cancel">
                    Annuler
                </a>

                <button type="submit" class="btn btn-save">
                    Enregistrer les modifications
                </button>

            </div>

        </form>

    </div>

</div>

@endsection