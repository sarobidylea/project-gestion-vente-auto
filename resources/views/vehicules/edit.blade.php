@extends('layouts.app')

@section('title', 'Modifier un véhicule')

@section('styles')

<style>

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
    }

    .breadcrumb {
        color: #777;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .breadcrumb span {
        color: #aaa;
    }

    .page-title {
        font-size: 34px;
        font-weight: 800;
        margin: 0;
    }

    .page-title .red {
        color: #ff1e2d;
    }

    .page-subtitle {
        color: #888;
        margin-top: 8px;
        font-size: 15px;
    }

    .title-line {
        width: 70px;
        height: 4px;
        background: #ff1e2d;
        margin-top: 18px;
        border-radius: 10px;
    }

    .form-card {
        background: #090c0d;
        border: 1px solid #252b2e;
        border-radius: 12px;
        padding: 28px;
        max-width: 1100px;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #252b2e;
    }

    .section-number {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #e50914;
        color: white;
        font-size: 13px;
        font-weight: bold;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label {
        color: #ddd;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .required {
        color: #ff1e2d;
    }

    .form-control {
        width: 100%;
        height: 48px;
        background: #111517;
        border: 1px solid #2b3235;
        border-radius: 7px;
        color: #eee;
        padding: 0 14px;
        font-size: 14px;
        outline: none;
        transition: all .2s ease;
    }

    select.form-control {
        cursor: pointer;
    }

    textarea.form-control {
        height: 130px;
        padding: 14px;
        resize: vertical;
    }

    .form-control:focus {
        border-color: #e50914;
        box-shadow: 0 0 0 2px rgba(229, 9, 20, .10);
    }

    .form-control::placeholder {
        color: #666;
    }

    /* IMAGE ACTUELLE */

    .current-image {
        background: #101314;
        border: 1px solid #292f32;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .current-image-title {
        color: #888;
        font-size: 12px;
        margin-bottom: 10px;
    }

    .current-image img {
        width: 260px;
        height: 160px;
        object-fit: cover;
        border-radius: 7px;
        display: block;
    }

    .image-upload {
        border: 1px dashed #3b4144;
        background: #101314;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
    }

    .image-icon {
        font-size: 30px;
        margin-bottom: 8px;
    }

    .image-upload-text {
        color: #bbb;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .image-upload-info {
        color: #666;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .file-input {
        width: 100%;
        color: #aaa;
        font-size: 13px;
    }

    .file-input::file-selector-button {
        background: #24292c;
        color: white;
        border: 1px solid #3b4144;
        padding: 9px 14px;
        border-radius: 6px;
        cursor: pointer;
        margin-right: 10px;
    }

    .file-input::file-selector-button:hover {
        background: #e50914;
        border-color: #e50914;
    }

    /* ERREURS */

    .error-box {
        background: rgba(229, 9, 20, .08);
        border: 1px solid rgba(229, 9, 20, .35);
        color: #ff7777;
        padding: 15px 18px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .error-box strong {
        color: #ff3d49;
    }

    .error-box ul {
        margin: 8px 0 0 18px;
        padding: 0;
    }

    .field-error {
        color: #ff555f;
        font-size: 12px;
        margin-top: 6px;
    }

    /* BOUTONS */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 25px;
        border-top: 1px solid #252b2e;
    }

    .btn {
        height: 45px;
        padding: 0 22px;
        border-radius: 7px;
        border: none;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: .2s;
    }

    .btn-cancel {
        background: #1b2022;
        color: #bbb;
        border: 1px solid #303638;
    }

    .btn-cancel:hover {
        background: #272d30;
        color: white;
    }

    .btn-submit {
        background: #e50914;
        color: white;
    }

    .btn-submit:hover {
        background: #ff1e2d;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(229, 9, 20, .25);
    }

    @media(max-width: 800px) {

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-card {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
        }

    }

</style>

@endsection


@section('content')

<div class="page-header">

    <div>

        <div class="breadcrumb">
            Accueil
            <span>›</span>
            Véhicules
            <span>›</span>
            Modifier
        </div>

        <h1 class="page-title">
            Modifier le <span class="red">véhicule</span>
        </h1>

        <p class="page-subtitle">
            Mettez à jour les informations de ce véhicule
        </p>

        <div class="title-line"></div>

    </div>

</div>


<div class="form-card">

    {{-- ERREURS --}}

    @if($errors->any())

        <div class="error-box">

            <strong>⚠ Veuillez corriger les erreurs :</strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('vehicules.update', $vehicule) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        @method('PUT')


        {{-- INFORMATIONS --}}

        <div class="form-section">

            <div class="section-title">

                <div class="section-number">
                    1
                </div>

                Informations du véhicule

            </div>


            <div class="form-grid">


                {{-- MARQUE --}}

                <div class="form-group">

                    <label class="form-label" for="marque_id">
                        Marque <span class="required">*</span>
                    </label>

                    <select
                        class="form-control"
                        id="marque_id"
                        name="marque_id"
                        required>

                        @foreach($marques as $marque)

                            <option
                                value="{{ $marque->id }}"
                                {{ old('marque_id', $vehicule->marque_id) == $marque->id ? 'selected' : '' }}>

                                {{ $marque->nom }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- MODELE --}}

                <div class="form-group">

                    <label class="form-label" for="modele">
                        Modèle <span class="required">*</span>
                    </label>

                    <input
                        class="form-control"
                        type="text"
                        id="modele"
                        name="modele"
                        value="{{ old('modele', $vehicule->modele) }}"
                        required>

                </div>


                {{-- ANNEE --}}

                <div class="form-group">

                    <label class="form-label" for="annee">
                        Année <span class="required">*</span>
                    </label>

                    <input
                        class="form-control"
                        type="number"
                        id="annee"
                        name="annee"
                        value="{{ old('annee', $vehicule->annee) }}"
                        required>

                </div>


                {{-- PRIX --}}

                <div class="form-group">

                    <label class="form-label" for="prix">
                        Prix (Ar) <span class="required">*</span>
                    </label>

                    <input
                        class="form-control"
                        type="number"
                        id="prix"
                        name="prix"
                        value="{{ old('prix', $vehicule->prix) }}"
                        step="0.01"
                        min="0"
                        required>

                </div>


                {{-- KILOMETRAGE --}}

                <div class="form-group">

                    <label class="form-label" for="kilometrage">
                        Kilométrage (km) <span class="required">*</span>
                    </label>

                    <input
                        class="form-control"
                        type="number"
                        id="kilometrage"
                        name="kilometrage"
                        value="{{ old('kilometrage', $vehicule->kilometrage) }}"
                        min="0"
                        required>

                </div>


                {{-- CARBURANT --}}

                <div class="form-group">

                    <label class="form-label" for="carburant">
                        Carburant <span class="required">*</span>
                    </label>

                    <select
                        class="form-control"
                        id="carburant"
                        name="carburant"
                        required>

                        <option value="Essence"
                            {{ old('carburant', $vehicule->carburant) == 'Essence' ? 'selected' : '' }}>
                            Essence
                        </option>

                        <option value="Diesel"
                            {{ old('carburant', $vehicule->carburant) == 'Diesel' ? 'selected' : '' }}>
                            Diesel
                        </option>

                        <option value="Hybride"
                            {{ old('carburant', $vehicule->carburant) == 'Hybride' ? 'selected' : '' }}>
                            Hybride
                        </option>

                        <option value="Electrique"
                            {{ old('carburant', $vehicule->carburant) == 'Electrique' ? 'selected' : '' }}>
                            Électrique
                        </option>

                    </select>

                </div>


                {{-- BOITE --}}

                <div class="form-group">

                    <label class="form-label" for="boite_vitesse">
                        Boîte de vitesse <span class="required">*</span>
                    </label>

                    <select
                        class="form-control"
                        id="boite_vitesse"
                        name="boite_vitesse"
                        required>

                        <option value="Manuelle"
                            {{ old('boite_vitesse', $vehicule->boite_vitesse) == 'Manuelle' ? 'selected' : '' }}>
                            Manuelle
                        </option>

                        <option value="Automatique"
                            {{ old('boite_vitesse', $vehicule->boite_vitesse) == 'Automatique' ? 'selected' : '' }}>
                            Automatique
                        </option>

                    </select>

                </div>


                {{-- COULEUR --}}

                <div class="form-group">

                    <label class="form-label" for="couleur">
                        Couleur
                    </label>

                    <input
                        class="form-control"
                        type="text"
                        id="couleur"
                        name="couleur"
                        value="{{ old('couleur', $vehicule->couleur) }}">

                </div>


                {{-- PUISSANCE --}}

                <div class="form-group">

                    <label class="form-label" for="puissance">
                        Puissance (CV)
                    </label>

                    <input
                        class="form-control"
                        type="number"
                        id="puissance"
                        name="puissance"
                        value="{{ old('puissance', $vehicule->puissance) }}"
                        min="0">

                </div>

            </div>

        </div>


        {{-- IMAGE --}}

        <div class="form-section">

            <div class="section-title">

                <div class="section-number">
                    2
                </div>

                Image du véhicule

            </div>


            @if($vehicule->image)

                <div class="current-image">

                    <div class="current-image-title">
                        IMAGE ACTUELLE
                    </div>

                    <img
                        src="{{ asset('storage/' . $vehicule->image) }}"
                        alt="{{ $vehicule->marque->nom }} {{ $vehicule->modele }}">

                </div>

            @endif


            <div class="image-upload">

                <div class="image-icon">
                    📷
                </div>

                <div class="image-upload-text">
                    Remplacer l'image
                </div>

                <div class="image-upload-info">
                    Laissez vide pour conserver l'image actuelle
                </div>

                <input
                    class="file-input"
                    type="file"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

            </div>

        </div>


        {{-- DETAILS --}}

        <div class="form-section">

            <div class="section-title">

                <div class="section-number">
                    3
                </div>

                Détails supplémentaires

            </div>


            <div class="form-grid">


                {{-- STATUT --}}

                <div class="form-group">

                    <label class="form-label" for="statut">
                        Statut <span class="required">*</span>
                    </label>

                    <select
                        class="form-control"
                        id="statut"
                        name="statut"
                        required>

                        <option value="Disponible"
                            {{ old('statut', $vehicule->statut) == 'Disponible' ? 'selected' : '' }}>
                            Disponible
                        </option>

                        <option value="Vendu"
                            {{ old('statut', $vehicule->statut) == 'Vendu' ? 'selected' : '' }}>
                            Vendu
                        </option>

                        <option value="Reserve"
                            {{ old('statut', $vehicule->statut) == 'Reserve' ? 'selected' : '' }}>
                            Réservé
                        </option>

                    </select>

                </div>


                {{-- DESCRIPTION --}}

                <div class="form-group full">

                    <label class="form-label" for="description">
                        Description
                    </label>

                    <textarea
                        class="form-control"
                        id="description"
                        name="description"
                        placeholder="Description du véhicule...">{{ old('description', $vehicule->description) }}</textarea>

                </div>

            </div>

        </div>


        {{-- ACTIONS --}}

        <div class="form-actions">

            <a
                href="{{ route('vehicules.index') }}"
                class="btn btn-cancel">

                ← Annuler

            </a>


            <button
                type="submit"
                class="btn btn-submit">

                ✓ Enregistrer les modifications

            </button>

        </div>


    </form>

</div>

@endsection